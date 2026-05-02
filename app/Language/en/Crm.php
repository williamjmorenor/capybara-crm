<?php

/**
 * Capybara CRM — English language strings.
 *
 * Usage in views:  <?= lang('Crm.key') ?>
 */

return [

    // ----------------------------------------------------------------
    // Navigation / Layout
    // ----------------------------------------------------------------
    'nav_dashboard'    => 'Dashboard',
    'nav_contacts'     => 'Contacts',
    'nav_leads'        => 'Leads',
    'nav_opportunities'=> 'Opportunities',
    'nav_activities'   => 'Activities',
    'nav_tags'         => 'Tags',
    'logout'           => 'Logout',
    'page_title_suffix'=> 'Capybara CRM',
    'app_name'         => 'Capybara CRM',
    'app_subtitle'     => 'Customer Relationship Manager',

    // ----------------------------------------------------------------
    // Auth
    // ----------------------------------------------------------------
    'sign_in_subtitle' => 'Sign in to your account',
    'email_address'    => 'Email Address',
    'password'         => 'Password',
    'sign_in'          => 'Sign In',

    // ----------------------------------------------------------------
    // Common actions / labels
    // ----------------------------------------------------------------
    'back'             => 'Back',
    'edit'             => 'Edit',
    'save_changes'     => 'Save Changes',
    'cancel'           => 'Cancel',
    'delete'           => 'Delete',
    'search'           => 'Search',
    'filter'           => 'Filter',
    'clear'            => 'Clear',
    'actions'          => 'Actions',
    'view_all'         => 'View All',
    'none_option'      => '— None —',
    'add_activity'     => 'Add Activity',
    'no_activities'    => 'No activities yet.',

    // Common field labels
    'name'             => 'Name',
    'email'            => 'Email',
    'phone'            => 'Phone',
    'company'          => 'Company',
    'status'           => 'Status',
    'notes'            => 'Notes',
    'created'          => 'Created',
    'type'             => 'Type',
    'description'      => 'Description',
    'date'             => 'Date',
    'related'          => 'Related',
    'title'            => 'Title',
    'contact'          => 'Contact',
    'color'            => 'Color',
    'preview'          => 'Preview',

    // Status values
    'status_active'      => 'Active',
    'status_inactive'    => 'Inactive',
    'status_new'         => 'New',
    'status_contacted'   => 'Contacted',
    'status_qualified'   => 'Qualified',
    'status_lost'        => 'Lost',
    'status_in_progress' => 'In Progress',
    'status_negotiation' => 'Negotiation',
    'status_won'         => 'Won',
    'setup'              => 'Setup',
    'user_global_settings' => 'Global user configuration for the application.',
    'setup_description'  => 'Use this page to configure global user defaults and administration settings.',
    'default_user_role'  => 'Default User Role',
    'default_user_role_description' => 'The role assigned to newly created users by default.',
    'require_password_reset' => 'Require Password Reset',
    'require_password_reset_description' => 'Force users to reset their password on next login.',
    'setup_admin_only_note' => 'This section is only available to administrators.',

    // ----------------------------------------------------------------
    // Dashboard
    // ----------------------------------------------------------------
    'total_contacts'       => 'Total Contacts',
    'total_leads'          => 'Total Leads',
    'active_opportunities' => 'Active Opportunities',
    'recent_activities'    => 'Recent Activities',
    'leads_by_status'      => 'Leads by Status',
    'no_recent_activities' => 'No recent activities.',

    // ----------------------------------------------------------------
    // Contacts
    // ----------------------------------------------------------------
    'contacts'              => 'Contacts',
    'new_contact'           => 'New Contact',
    'create_contact'        => 'Create Contact',
    'edit_contact'          => 'Edit Contact',
    'contact_details'       => 'Contact Details',
    'search_contacts'       => 'Search by name, email or company…',
    'no_contacts'           => 'No contacts found.',
    'create_first_contact'  => 'Create the first contact',
    'delete_contact_confirm'=> 'Delete this contact?',

    // ----------------------------------------------------------------
    // Leads
    // ----------------------------------------------------------------
    'leads'               => 'Leads',
    'new_lead'            => 'New Lead',
    'create_lead'         => 'Create Lead',
    'edit_lead'           => 'Edit Lead',
    'lead_details'        => 'Lead Details',
    'search_leads'        => 'Search by name or email…',
    'all_statuses'        => 'All statuses',
    'no_leads'            => 'No leads found.',
    'delete_lead_confirm' => 'Delete this lead?',
    'source'              => 'Source',
    'estimated_value'     => 'Estimated Value ($)',
    'est_value'           => 'Est. Value',
    'assigned_to'         => 'Assigned To',
    'unassigned'          => 'Unassigned',
    'source_web'          => 'Web',
    'source_referral'     => 'Referral',
    'source_manual'       => 'Manual',
    'source_other'        => 'Other',
    'convert_to_contact'      => 'Convert to Contact',
    'convert_lead_title'      => 'Convert Lead to Contact',
    'convert_lead_body'       => 'This will create a new contact from the lead data and archive the lead.',
    'yes_convert'             => 'Yes, Convert',
    'convert_pipeline_hint'   => 'Convert this lead into a contact to move them forward in the pipeline.',
    'convert_lead_confirm'    => 'Convert this lead to a contact?',

    // ----------------------------------------------------------------
    // Opportunities
    // ----------------------------------------------------------------
    'opportunities'              => 'Opportunities',
    'new_opportunity'            => 'New Opportunity',
    'create_opportunity'         => 'Create Opportunity',
    'edit_opportunity'           => 'Edit Opportunity',
    'opportunity_details'        => 'Opportunity Details',
    'amount'                     => 'Amount ($)',
    'profile'                    => 'My Profile',
    'profile_password_hint'      => 'Leave blank to keep your current password.',
    'amount_label'               => 'Amount',
    'close_date'                 => 'Close Date',
    'no_opportunities'           => 'No opportunities',
    'delete_opportunity_confirm' => 'Delete?',

    // ----------------------------------------------------------------
    // Activities
    // ----------------------------------------------------------------
    'activities'              => 'Activities',
    'new_activity'            => 'New Activity',
    'create_activity'         => 'Create Activity',
    'edit_activity'           => 'Edit Activity',
    'all_types'               => 'All types',
    'no_activities_found'     => 'No activities found.',
    'delete_activity_confirm' => 'Delete this activity?',
    'related_to'              => 'Related To',
    'related_id_label'        => 'Related ID',
    'related_id_placeholder'  => 'e.g. 1',
    'type_call'               => 'Call',
    'type_email'              => 'Email',
    'type_meeting'            => 'Meeting',
    'type_note'               => 'Note',
    'related_lead'            => 'Lead',
    'related_contact'         => 'Contact',
    'related_opportunity'     => 'Opportunity',

    // ----------------------------------------------------------------
    // Tags
    // ----------------------------------------------------------------
    'tags'               => 'Tags',
    'new_tag'            => 'New Tag',
    'create_tag'         => 'Create Tag',
    'edit_tag'           => 'Edit Tag',
    'no_tags'            => 'No tags yet.',
    'create_first_tag'   => 'Create the first tag',
    'delete_tag_confirm' => 'Delete this tag?',
    'color_hint'         => 'Pick a color for the tag badge',

    // ----------------------------------------------------------------
    // Tickets
    // ----------------------------------------------------------------
    'nav_tickets'                      => 'Tickets',
    'tickets'                          => 'Tickets',
    'new_ticket'                       => 'New Ticket',
    'create_ticket'                    => 'Create Ticket',
    'edit_ticket'                      => 'Edit Ticket',
    'ticket_details'                   => 'Ticket Details',
    'no_tickets'                       => 'No tickets found.',
    'delete_ticket_confirm'            => 'Delete this ticket?',
    'ticket_created'                   => 'Ticket created successfully.',
    'ticket_updated'                   => 'Ticket updated successfully.',
    'ticket_deleted'                   => 'Ticket deleted successfully.',
    'ticket_assigned'                  => 'Ticket assigned successfully.',
    'ticket_not_billable'              => 'This ticket is not marked as billable.',
    'opportunity_exists'               => 'An opportunity already exists for this ticket.',
    'opportunity_created_from_ticket'  => 'Opportunity created from ticket.',
    'opportunity_from_ticket'          => 'Opportunity from Ticket',
    'open_tickets'                     => 'Open Tickets',
    'my_tickets'                       => 'My Tickets',
    'all_tickets'                      => 'All Tickets',
    'priority'                         => 'Priority',
    'priority_low'                     => 'Low',
    'priority_medium'                  => 'Medium',
    'priority_high'                    => 'High',
    'ticket_type'                      => 'Type',
    'ticket_type_support'              => 'Support',
    'ticket_type_warranty'             => 'Warranty',
    'ticket_type_incident'             => 'Incident',
    'ticket_type_commercial'           => 'Commercial',
    'is_billable'                      => 'Billable',
    'status_new_ticket'                => 'New',
    'status_assigned'                  => 'Assigned',
    'status_solved'                    => 'Solved',
    'status_closed'                    => 'Closed',
    'assign_agent'                     => 'Assign Agent',
    'assigned_agent'                   => 'Assigned Agent',
    'create_opportunity_from_ticket'   => 'Create Opportunity',
    'messages'                         => 'Messages',
    'message_required'                 => 'Message cannot be empty.',
    'message_added'                    => 'Message added.',
    'msg_type_public'                  => 'Public (visible to client)',
    'msg_type_private'                 => 'Private (internal only)',
    'no_messages'                      => 'No messages yet.',
    'ticket_closed_no_reply'           => 'This ticket is closed and cannot receive new messages.',
    'reply'                            => 'Reply',
    'send'                             => 'Send',
    'client_portal'                    => 'Client Portal',
    'invalid_credentials'              => 'Invalid email or password.',
    'welcome_back'                     => 'Welcome back',
    'logged_out'                       => 'You have been logged out.',
    'portal_subtitle'                  => 'Log in to view your support tickets',

];
