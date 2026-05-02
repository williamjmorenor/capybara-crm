<?php

namespace App\Controllers;

use App\Models\OpportunityModel;
use App\Models\ContactModel;

class OpportunitiesController extends BaseController
{
    protected OpportunityModel $opportunityModel;

    public function __construct()
    {
        $this->opportunityModel = new OpportunityModel();
    }

    public function index(): string
    {
        $statuses     = ['new', 'in_progress', 'negotiation', 'won', 'lost'];
        $kanban       = [];

        foreach ($statuses as $status) {
            $kanban[$status] = $this->opportunityModel
                ->where('status', $status)
                ->orderBy('created_at', 'DESC')
                ->findAll();
        }

        return view('opportunities/index', ['title' => 'Opportunities', 'kanban' => $kanban, 'statuses' => $statuses]);
    }

    public function create(): string
    {
        $contactModel = new ContactModel();
        $contacts     = $contactModel->where('deleted_at', null)->where('status', 'active')->findAll();

        return view('opportunities/create', ['title' => 'New Opportunity', 'contacts' => $contacts]);
    }

    public function store()
    {
        $rules = [
            'title'  => 'required|min_length[2]|max_length[200]',
            'status' => 'required|in_list[new,in_progress,negotiation,won,lost]',
            'amount' => 'permit_empty|decimal',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->opportunityModel->insert([
            'contact_id' => $this->request->getPost('contact_id') ?: null,
            'title'      => $this->request->getPost('title'),
            'amount'     => $this->request->getPost('amount') ?: 0,
            'status'     => $this->request->getPost('status'),
            'close_date' => $this->request->getPost('close_date') ?: null,
            'notes'      => $this->request->getPost('notes'),
        ]);

        return redirect()->to('/opportunities')->with('success', 'Opportunity created successfully.');
    }

    public function show(int $id): string
    {
        $opportunity = $this->opportunityModel->find($id);
        if (! $opportunity) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Opportunity not found.');
        }

        $contact = null;
        if ($opportunity['contact_id']) {
            $contactModel = new ContactModel();
            $contact      = $contactModel->find($opportunity['contact_id']);
        }

        return view('opportunities/show', [
            'title'       => $opportunity['title'],
            'opportunity' => $opportunity,
            'contact'     => $contact,
        ]);
    }

    public function edit(int $id): string
    {
        $opportunity = $this->opportunityModel->find($id);
        if (! $opportunity) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Opportunity not found.');
        }

        $contactModel = new ContactModel();
        $contacts     = $contactModel->where('deleted_at', null)->findAll();

        return view('opportunities/edit', [
            'title'       => 'Edit Opportunity',
            'opportunity' => $opportunity,
            'contacts'    => $contacts,
        ]);
    }

    public function update(int $id)
    {
        $opportunity = $this->opportunityModel->find($id);
        if (! $opportunity) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Opportunity not found.');
        }

        $rules = [
            'title'  => 'required|min_length[2]|max_length[200]',
            'status' => 'required|in_list[new,in_progress,negotiation,won,lost]',
            'amount' => 'permit_empty|decimal',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->opportunityModel->update($id, [
            'contact_id' => $this->request->getPost('contact_id') ?: null,
            'title'      => $this->request->getPost('title'),
            'amount'     => $this->request->getPost('amount') ?: 0,
            'status'     => $this->request->getPost('status'),
            'close_date' => $this->request->getPost('close_date') ?: null,
            'notes'      => $this->request->getPost('notes'),
        ]);

        return redirect()->to('/opportunities/' . $id)->with('success', 'Opportunity updated successfully.');
    }

    public function delete(int $id)
    {
        $opportunity = $this->opportunityModel->find($id);
        if (! $opportunity) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Opportunity not found.');
        }

        $this->opportunityModel->delete($id);

        return redirect()->to('/opportunities')->with('success', 'Opportunity deleted successfully.');
    }
}
