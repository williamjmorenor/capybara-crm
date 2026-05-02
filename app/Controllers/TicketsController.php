<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\TicketMessageModel;
use App\Models\UserModel;
use App\Models\OpportunityModel;

class TicketsController extends BaseController
{
    protected TicketModel $ticketModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
    }

    public function index(): string
    {
        $statusFilter = $this->request->getGet('status');
        $search       = $this->request->getGet('search');

        $query = $this->ticketModel->where('deleted_at', null);

        if ($statusFilter) {
            $query = $query->where('status', $statusFilter);
        }

        if ($search) {
            $query = $query->like('title', $search);
        }

        $tickets = $query->orderBy('created_at', 'DESC')->findAll();

        $userModel = new UserModel();
        $clientIds = array_unique(array_filter(array_column($tickets, 'client_id')));
        $clients   = [];
        if ($clientIds) {
            foreach ($userModel->whereIn('id', $clientIds)->findAll() as $u) {
                $clients[$u['id']] = $u;
            }
        }

        return view('dashboard/tickets/index', [
            'title'        => lang('Crm.tickets'),
            'tickets'      => $tickets,
            'clients'      => $clients,
            'statusFilter' => $statusFilter,
            'search'       => $search,
        ]);
    }

    public function create(): string
    {
        $userModel = new UserModel();
        $agents    = $userModel->where('active', 1)->where('type', 'internal')->findAll();
        $clients   = $userModel->where('active', 1)->where('type', 'client')->findAll();

        return view('dashboard/tickets/create', [
            'title'   => lang('Crm.new_ticket'),
            'agents'  => $agents,
            'clients' => $clients,
        ]);
    }

    public function store()
    {
        $rules = [
            'title'  => 'required|min_length[2]|max_length[200]',
            'status' => 'required|in_list[new,assigned,solved,closed]',
            'type'   => 'required|in_list[support,warranty,incident,commercial]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $assignedTo = $this->request->getPost('assigned_to') ?: null;
        $status     = $assignedTo ? 'assigned' : $this->request->getPost('status');

        $this->ticketModel->insert([
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'client_id'   => $this->request->getPost('client_id') ?: null,
            'assigned_to' => $assignedTo,
            'status'      => $status,
            'priority'    => $this->request->getPost('priority') ?: 'medium',
            'type'        => $this->request->getPost('type'),
            'is_billable' => $this->request->getPost('is_billable') ? 1 : 0,
        ]);

        return redirect()->to('/tickets')->with('success', lang('Crm.ticket_created'));
    }

    public function show(int $id): string
    {
        $ticket = $this->ticketModel->find($id);
        if (! $ticket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Ticket not found.');
        }

        $messageModel = new TicketMessageModel();
        $messages     = $messageModel->where('ticket_id', $id)->orderBy('created_at', 'ASC')->findAll();

        $userModel = new UserModel();
        $agents    = $userModel->where('active', 1)->where('type', 'internal')->findAll();
        $client    = $ticket['client_id'] ? $userModel->find($ticket['client_id']) : null;
        $assignee  = $ticket['assigned_to'] ? $userModel->find($ticket['assigned_to']) : null;

        $authorIds = array_unique(array_filter(array_column($messages, 'author_id')));
        $authors   = [];
        if ($authorIds) {
            foreach ($userModel->whereIn('id', $authorIds)->findAll() as $u) {
                $authors[$u['id']] = $u;
            }
        }

        $existingOpportunity = null;
        if ($ticket['is_billable']) {
            $oppModel            = new OpportunityModel();
            $existingOpportunity = $oppModel->where('ticket_id', $id)->first();
        }

        return view('dashboard/tickets/show', [
            'title'               => $ticket['title'],
            'ticket'              => $ticket,
            'messages'            => $messages,
            'agents'              => $agents,
            'client'              => $client,
            'assignee'            => $assignee,
            'authors'             => $authors,
            'existingOpportunity' => $existingOpportunity,
        ]);
    }

    public function edit(int $id): string
    {
        $ticket = $this->ticketModel->find($id);
        if (! $ticket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Ticket not found.');
        }

        $userModel = new UserModel();
        $agents    = $userModel->where('active', 1)->where('type', 'internal')->findAll();
        $clients   = $userModel->where('active', 1)->where('type', 'client')->findAll();

        return view('dashboard/tickets/edit', [
            'title'   => lang('Crm.edit_ticket'),
            'ticket'  => $ticket,
            'agents'  => $agents,
            'clients' => $clients,
        ]);
    }

    public function update(int $id)
    {
        $ticket = $this->ticketModel->find($id);
        if (! $ticket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Ticket not found.');
        }

        $rules = [
            'title'  => 'required|min_length[2]|max_length[200]',
            'status' => 'required|in_list[new,assigned,solved,closed]',
            'type'   => 'required|in_list[support,warranty,incident,commercial]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $status     = $this->request->getPost('status');
        $closedAt   = ($status === 'closed' && $ticket['status'] !== 'closed') ? date('Y-m-d H:i:s') : $ticket['closed_at'];
        $assignedTo = $this->request->getPost('assigned_to') ?: null;
        if ($assignedTo && $status === 'new') {
            $status = 'assigned';
        }

        $this->ticketModel->update($id, [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'client_id'   => $this->request->getPost('client_id') ?: null,
            'assigned_to' => $assignedTo,
            'status'      => $status,
            'priority'    => $this->request->getPost('priority') ?: 'medium',
            'type'        => $this->request->getPost('type'),
            'is_billable' => $this->request->getPost('is_billable') ? 1 : 0,
            'closed_at'   => $closedAt,
        ]);

        return redirect()->to('/tickets/' . $id)->with('success', lang('Crm.ticket_updated'));
    }

    public function delete(int $id)
    {
        $ticket = $this->ticketModel->find($id);
        if (! $ticket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Ticket not found.');
        }

        $this->ticketModel->delete($id);

        return redirect()->to('/tickets')->with('success', lang('Crm.ticket_deleted'));
    }

    public function addMessage(int $id)
    {
        $ticket = $this->ticketModel->find($id);
        if (! $ticket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Ticket not found.');
        }

        $message = trim($this->request->getPost('message') ?? '');
        if ($message === '') {
            return redirect()->to('/tickets/' . $id)->with('error', lang('Crm.message_required'));
        }

        $msgType = $this->request->getPost('msg_type') ?: 'public';
        if (! in_array($msgType, ['public', 'private'])) {
            $msgType = 'public';
        }

        $messageModel = new TicketMessageModel();
        $messageModel->insert([
            'ticket_id'   => $id,
            'author_id'   => session()->get('user_id'),
            'author_type' => 'user',
            'message'     => $message,
            'type'        => $msgType,
        ]);

        return redirect()->to('/tickets/' . $id)->with('success', lang('Crm.message_added'));
    }

    public function assign(int $id)
    {
        $ticket = $this->ticketModel->find($id);
        if (! $ticket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Ticket not found.');
        }

        $assignedTo = $this->request->getPost('assigned_to') ?: null;
        $status     = $assignedTo ? 'assigned' : 'new';

        $this->ticketModel->update($id, [
            'assigned_to' => $assignedTo,
            'status'      => $status,
        ]);

        return redirect()->to('/tickets/' . $id)->with('success', lang('Crm.ticket_assigned'));
    }

    public function createOpportunity(int $id)
    {
        $ticket = $this->ticketModel->find($id);
        if (! $ticket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Ticket not found.');
        }

        if (! $ticket['is_billable']) {
            return redirect()->to('/tickets/' . $id)->with('error', lang('Crm.ticket_not_billable'));
        }

        $oppModel = new OpportunityModel();
        if ($oppModel->where('ticket_id', $id)->countAllResults() > 0) {
            return redirect()->to('/tickets/' . $id)->with('error', lang('Crm.opportunity_exists'));
        }

        $oppId = $oppModel->insert([
            'contact_id' => null,
            'ticket_id'  => $id,
            'origin'     => 'ticket',
            'title'      => lang('Crm.opportunity_from_ticket') . ' #' . $id . ': ' . $ticket['title'],
            'amount'     => 0,
            'status'     => 'new',
        ]);

        return redirect()->to('/opportunities/' . $oppId)->with('success', lang('Crm.opportunity_created_from_ticket'));
    }
}
