<?php

namespace App\Controllers;

use App\Models\ContactModel;
use App\Models\ActivityModel;

class ContactsController extends BaseController
{
    protected ContactModel $contactModel;

    public function __construct()
    {
        $this->contactModel = new ContactModel();
    }

    public function index(): string
    {
        $search = $this->request->getGet('search');
        $query  = $this->contactModel->where('deleted_at', null);

        if ($search) {
            $query = $query->groupStart()
                ->like('name', $search)
                ->orLike('email', $search)
                ->orLike('company', $search)
                ->groupEnd();
        }

        $contacts = $query->orderBy('name', 'ASC')->findAll();

        return view('contacts/index', ['title' => 'Contacts', 'contacts' => $contacts, 'search' => $search]);
    }

    public function create(): string
    {
        return view('contacts/create', ['title' => 'New Contact']);
    }

    public function store()
    {
        $rules = [
            'name'   => 'required|min_length[2]|max_length[100]',
            'email'  => 'permit_empty|valid_email|max_length[150]',
            'status' => 'required|in_list[active,inactive]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->contactModel->insert([
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'phone'   => $this->request->getPost('phone'),
            'company' => $this->request->getPost('company'),
            'status'  => $this->request->getPost('status'),
            'notes'   => $this->request->getPost('notes'),
        ]);

        return redirect()->to('/contacts')->with('success', 'Contact created successfully.');
    }

    public function show(int $id): string
    {
        $contact    = $this->contactModel->find($id);
        if (! $contact) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Contact not found.');
        }

        $activityModel = new ActivityModel();
        $activities    = $activityModel
            ->where('related_type', 'contact')
            ->where('related_id', $id)
            ->orderBy('date', 'DESC')
            ->findAll();

        return view('contacts/show', ['title' => $contact['name'], 'contact' => $contact, 'activities' => $activities]);
    }

    public function edit(int $id): string
    {
        $contact = $this->contactModel->find($id);
        if (! $contact) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Contact not found.');
        }

        return view('contacts/edit', ['title' => 'Edit Contact', 'contact' => $contact]);
    }

    public function update(int $id)
    {
        $contact = $this->contactModel->find($id);
        if (! $contact) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Contact not found.');
        }

        $rules = [
            'name'   => 'required|min_length[2]|max_length[100]',
            'email'  => 'permit_empty|valid_email|max_length[150]',
            'status' => 'required|in_list[active,inactive]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->contactModel->update($id, [
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'phone'   => $this->request->getPost('phone'),
            'company' => $this->request->getPost('company'),
            'status'  => $this->request->getPost('status'),
            'notes'   => $this->request->getPost('notes'),
        ]);

        return redirect()->to('/contacts/' . $id)->with('success', 'Contact updated successfully.');
    }

    public function delete(int $id)
    {
        $contact = $this->contactModel->find($id);
        if (! $contact) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Contact not found.');
        }

        $this->contactModel->delete($id);

        return redirect()->to('/contacts')->with('success', 'Contact deleted successfully.');
    }
}
