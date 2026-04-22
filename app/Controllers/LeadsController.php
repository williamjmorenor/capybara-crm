<?php

namespace App\Controllers;

use App\Models\LeadModel;
use App\Models\UserModel;
use App\Models\ActivityModel;
use App\Services\LeadService;

class LeadsController extends BaseController
{
    protected LeadModel $leadModel;

    public function __construct()
    {
        $this->leadModel = new LeadModel();
    }

    public function index(): string
    {
        $search       = $this->request->getGet('search');
        $statusFilter = $this->request->getGet('status');

        $query = $this->leadModel->where('deleted_at', null);

        if ($search) {
            $query = $query->groupStart()
                ->like('name', $search)
                ->orLike('email', $search)
                ->groupEnd();
        }

        if ($statusFilter) {
            $query = $query->where('status', $statusFilter);
        }

        $leads = $query->orderBy('created_at', 'DESC')->findAll();

        return view('leads/index', [
            'title'        => 'Leads',
            'leads'        => $leads,
            'search'       => $search,
            'statusFilter' => $statusFilter,
        ]);
    }

    public function create(): string
    {
        $userModel = new UserModel();
        $users     = $userModel->where('active', 1)->findAll();

        return view('leads/create', ['title' => 'New Lead', 'users' => $users]);
    }

    public function store()
    {
        $rules = [
            'name'   => 'required|min_length[2]|max_length[100]',
            'email'  => 'permit_empty|valid_email|max_length[150]',
            'source' => 'required|in_list[web,referral,manual,other]',
            'status' => 'required|in_list[new,contacted,qualified,lost]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->leadModel->insert([
            'name'            => $this->request->getPost('name'),
            'email'           => $this->request->getPost('email'),
            'source'          => $this->request->getPost('source'),
            'status'          => $this->request->getPost('status'),
            'estimated_value' => $this->request->getPost('estimated_value') ?: 0,
            'assigned_to'     => $this->request->getPost('assigned_to') ?: null,
            'notes'           => $this->request->getPost('notes'),
        ]);

        return redirect()->to('/leads')->with('success', 'Lead created successfully.');
    }

    public function show(int $id): string
    {
        $lead = $this->leadModel->find($id);
        if (! $lead) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Lead not found.');
        }

        $activityModel = new ActivityModel();
        $activities    = $activityModel
            ->where('related_type', 'lead')
            ->where('related_id', $id)
            ->orderBy('date', 'DESC')
            ->findAll();

        return view('leads/show', ['title' => $lead['name'], 'lead' => $lead, 'activities' => $activities]);
    }

    public function edit(int $id): string
    {
        $lead = $this->leadModel->find($id);
        if (! $lead) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Lead not found.');
        }

        $userModel = new UserModel();
        $users     = $userModel->where('active', 1)->findAll();

        return view('leads/edit', ['title' => 'Edit Lead', 'lead' => $lead, 'users' => $users]);
    }

    public function update(int $id)
    {
        $lead = $this->leadModel->find($id);
        if (! $lead) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Lead not found.');
        }

        $rules = [
            'name'   => 'required|min_length[2]|max_length[100]',
            'email'  => 'permit_empty|valid_email|max_length[150]',
            'source' => 'required|in_list[web,referral,manual,other]',
            'status' => 'required|in_list[new,contacted,qualified,lost]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->leadModel->update($id, [
            'name'            => $this->request->getPost('name'),
            'email'           => $this->request->getPost('email'),
            'source'          => $this->request->getPost('source'),
            'status'          => $this->request->getPost('status'),
            'estimated_value' => $this->request->getPost('estimated_value') ?: 0,
            'assigned_to'     => $this->request->getPost('assigned_to') ?: null,
            'notes'           => $this->request->getPost('notes'),
        ]);

        return redirect()->to('/leads/' . $id)->with('success', 'Lead updated successfully.');
    }

    public function delete(int $id)
    {
        $lead = $this->leadModel->find($id);
        if (! $lead) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Lead not found.');
        }

        $this->leadModel->delete($id);

        return redirect()->to('/leads')->with('success', 'Lead deleted successfully.');
    }

    public function convert(int $id)
    {
        $lead = $this->leadModel->find($id);
        if (! $lead) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Lead not found.');
        }

        // Show confirmation page on GET, but since this is POST we do the conversion
        $service   = new LeadService();
        $contactId = $service->convertToContact($id);

        if ($contactId === false) {
            return redirect()->to('/leads/' . $id)->with('error', 'Could not convert lead to contact.');
        }

        return redirect()->to('/contacts/' . $contactId)->with('success', 'Lead converted to contact successfully.');
    }
}
