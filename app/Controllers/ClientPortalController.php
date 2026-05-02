<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TicketModel;
use App\Models\TicketMessageModel;

class ClientPortalController extends BaseController
{
    public function login()
    {
        if (session()->get('client_logged_in') === true) {
            return redirect()->to('/portal/tickets');
        }

        return view('portal/login', ['title' => lang('Crm.client_portal')]);
    }

    public function loginPost()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $user      = $userModel->findByEmail($this->request->getPost('email'));

        if (! $user || ! password_verify($this->request->getPost('password'), $user['password'])) {
            return redirect()->back()->withInput()->with('error', lang('Crm.invalid_credentials'));
        }

        if (! $user['active'] || $user['type'] !== 'client') {
            return redirect()->back()->withInput()->with('error', lang('Crm.invalid_credentials'));
        }

        session()->set([
            'client_logged_in' => true,
            'client_id'        => $user['id'],
            'client_name'      => $user['name'],
        ]);

        return redirect()->to('/portal/tickets')->with('success', lang('Crm.welcome_back') . ', ' . $user['name'] . '!');
    }

    public function logout()
    {
        session()->remove(['client_logged_in', 'client_id', 'client_name']);

        return redirect()->to('/portal/login')->with('success', lang('Crm.logged_out'));
    }

    public function tickets(): string
    {
        $clientId    = session()->get('client_id');
        $ticketModel = new TicketModel();
        $tickets     = $ticketModel->where('client_id', $clientId)->orderBy('created_at', 'DESC')->findAll();

        return view('portal/tickets/index', [
            'title'   => lang('Crm.my_tickets'),
            'tickets' => $tickets,
        ]);
    }

    public function createTicket(): string
    {
        return view('portal/tickets/create', ['title' => lang('Crm.new_ticket')]);
    }

    public function storeTicket()
    {
        $rules = [
            'title' => 'required|min_length[2]|max_length[200]',
            'type'  => 'required|in_list[support,warranty,incident,commercial]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $ticketModel = new TicketModel();
        $ticketId    = $ticketModel->insert([
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'client_id'   => session()->get('client_id'),
            'status'      => 'new',
            'priority'    => 'medium',
            'type'        => $this->request->getPost('type'),
            'is_billable' => 0,
        ]);

        return redirect()->to('/portal/tickets/' . $ticketId)->with('success', lang('Crm.ticket_created'));
    }

    public function showTicket(int $id): string
    {
        $clientId    = session()->get('client_id');
        $ticketModel = new TicketModel();
        $ticket      = $ticketModel->find($id);

        if (! $ticket || (int) $ticket['client_id'] !== (int) $clientId) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Ticket not found.');
        }

        $messageModel = new TicketMessageModel();
        $messages     = $messageModel
            ->where('ticket_id', $id)
            ->where('type', 'public')
            ->orderBy('created_at', 'ASC')
            ->findAll();

        $userModel = new UserModel();
        $authorIds = array_unique(array_filter(array_column($messages, 'author_id')));
        $authors   = [];
        if ($authorIds) {
            foreach ($userModel->whereIn('id', $authorIds)->findAll() as $u) {
                $authors[$u['id']] = $u;
            }
        }

        return view('portal/tickets/show', [
            'title'    => $ticket['title'],
            'ticket'   => $ticket,
            'messages' => $messages,
            'authors'  => $authors,
        ]);
    }

    public function addMessage(int $id)
    {
        $clientId    = session()->get('client_id');
        $ticketModel = new TicketModel();
        $ticket      = $ticketModel->find($id);

        if (! $ticket || (int) $ticket['client_id'] !== (int) $clientId) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Ticket not found.');
        }

        if (in_array($ticket['status'], ['solved', 'closed'])) {
            return redirect()->to('/portal/tickets/' . $id)->with('error', lang('Crm.ticket_closed_no_reply'));
        }

        $message = trim($this->request->getPost('message') ?? '');
        if ($message === '') {
            return redirect()->to('/portal/tickets/' . $id)->with('error', lang('Crm.message_required'));
        }

        $messageModel = new TicketMessageModel();
        $messageModel->insert([
            'ticket_id'   => $id,
            'author_id'   => $clientId,
            'author_type' => 'client',
            'message'     => $message,
            'type'        => 'public',
        ]);

        return redirect()->to('/portal/tickets/' . $id)->with('success', lang('Crm.message_added'));
    }
}
