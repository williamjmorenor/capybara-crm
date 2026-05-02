<?php

namespace App\Services;

use App\Models\LeadModel;
use App\Models\ContactModel;

class LeadService
{
    protected LeadModel $leadModel;
    protected ContactModel $contactModel;

    public function __construct()
    {
        $this->leadModel    = new LeadModel();
        $this->contactModel = new ContactModel();
    }

    /**
     * Convert a lead into a contact.
     * Returns the new contact's ID on success, or false on failure.
     */
    public function convertToContact(int $leadId): int|false
    {
        $lead = $this->leadModel->find($leadId);
        if (! $lead) {
            return false;
        }

        $contactData = [
            'name'   => $lead['name'],
            'email'  => $lead['email'] ?? null,
            'status' => 'active',
            'notes'  => $lead['notes'] ?? null,
        ];

        $contactId = $this->contactModel->insert($contactData, true);
        if (! $contactId) {
            return false;
        }

        // Mark lead as qualified and soft-delete it
        $this->leadModel->update($leadId, ['status' => 'qualified']);
        $this->leadModel->delete($leadId);

        return (int) $contactId;
    }
}
