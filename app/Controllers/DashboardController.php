<?php

namespace App\Controllers;

use App\Models\ContactModel;
use App\Models\LeadModel;
use App\Models\OpportunityModel;
use App\Models\ActivityModel;
use App\Models\TicketModel;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $leadModel        = new LeadModel();
        $contactModel     = new ContactModel();
        $opportunityModel = new OpportunityModel();
        $activityModel    = new ActivityModel();

        $leadsByStatus = [
            'new'       => $leadModel->where('status', 'new')->countAllResults(),
            'contacted' => $leadModel->where('status', 'contacted')->countAllResults(),
            'qualified' => $leadModel->where('status', 'qualified')->countAllResults(),
            'lost'      => $leadModel->where('status', 'lost')->countAllResults(),
        ];

        $totalContacts         = $contactModel->where('deleted_at', null)->countAllResults();
        $activeOpportunities   = $opportunityModel->whereIn('status', ['new', 'in_progress', 'negotiation'])->countAllResults();
        $recentActivities      = $activityModel->orderBy('date', 'DESC')->limit(5)->findAll();

        $ticketModel  = new TicketModel();
        $openTickets  = $ticketModel->whereIn('status', ['new', 'assigned'])->countAllResults();

        $data = [
            'title'              => 'Dashboard',
            'leadsByStatus'      => $leadsByStatus,
            'totalContacts'      => $totalContacts,
            'activeOpportunities'=> $activeOpportunities,
            'recentActivities'   => $recentActivities,
            'openTickets'        => $openTickets,
        ];

        return view('dashboard/index', $data);
    }
}
