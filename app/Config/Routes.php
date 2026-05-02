<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth routes
$routes->get('/', 'AuthController::login');
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::loginPost');
$routes->get('logout', 'AuthController::logout');

// Client portal routes
$routes->get('portal/login', 'ClientPortalController::login');
$routes->post('portal/login', 'ClientPortalController::loginPost');
$routes->get('portal/logout', 'ClientPortalController::logout');

$routes->group('portal', ['filter' => 'client_portal'], function ($routes) {
    $routes->get('tickets', 'ClientPortalController::tickets');
    $routes->get('tickets/create', 'ClientPortalController::createTicket');
    $routes->post('tickets/create', 'ClientPortalController::storeTicket');
    $routes->get('tickets/(:num)', 'ClientPortalController::showTicket/$1');
    $routes->post('tickets/(:num)/message', 'ClientPortalController::addMessage/$1');
});

// Protected routes
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');

    // Contacts
    $routes->get('contacts', 'ContactsController::index');
    $routes->get('contacts/create', 'ContactsController::create');
    $routes->post('contacts/create', 'ContactsController::store');
    $routes->get('contacts/(:num)', 'ContactsController::show/$1');
    $routes->get('contacts/(:num)/edit', 'ContactsController::edit/$1');
    $routes->post('contacts/(:num)/edit', 'ContactsController::update/$1');
    $routes->post('contacts/(:num)/delete', 'ContactsController::delete/$1');

    // Leads
    $routes->get('leads', 'LeadsController::index');
    $routes->get('leads/create', 'LeadsController::create');
    $routes->post('leads/create', 'LeadsController::store');
    $routes->get('leads/(:num)', 'LeadsController::show/$1');
    $routes->get('leads/(:num)/edit', 'LeadsController::edit/$1');
    $routes->post('leads/(:num)/edit', 'LeadsController::update/$1');
    $routes->post('leads/(:num)/delete', 'LeadsController::delete/$1');
    $routes->post('leads/(:num)/convert', 'LeadsController::convert/$1');

    // Opportunities
    $routes->get('opportunities', 'OpportunitiesController::index');
    $routes->get('opportunities/create', 'OpportunitiesController::create');
    $routes->post('opportunities/create', 'OpportunitiesController::store');
    $routes->get('opportunities/(:num)', 'OpportunitiesController::show/$1');
    $routes->get('opportunities/(:num)/edit', 'OpportunitiesController::edit/$1');
    $routes->post('opportunities/(:num)/edit', 'OpportunitiesController::update/$1');
    $routes->post('opportunities/(:num)/delete', 'OpportunitiesController::delete/$1');

    // Tickets
    $routes->get('tickets', 'TicketsController::index');
    $routes->get('tickets/create', 'TicketsController::create');
    $routes->post('tickets/create', 'TicketsController::store');
    $routes->get('tickets/(:num)', 'TicketsController::show/$1');
    $routes->get('tickets/(:num)/edit', 'TicketsController::edit/$1');
    $routes->post('tickets/(:num)/edit', 'TicketsController::update/$1');
    $routes->post('tickets/(:num)/delete', 'TicketsController::delete/$1');
    $routes->post('tickets/(:num)/message', 'TicketsController::addMessage/$1');
    $routes->post('tickets/(:num)/assign', 'TicketsController::assign/$1');
    $routes->post('tickets/(:num)/opportunity', 'TicketsController::createOpportunity/$1');

    // Profile
    $routes->get('profile', 'AuthController::profile');
    $routes->post('profile', 'AuthController::profileUpdate');

    // Setup (admin only)
    $routes->get('setup', 'SetupController::index', ['filter' => 'admin']);

    // Activities
    $routes->get('activities', 'ActivitiesController::index');
    $routes->get('activities/create', 'ActivitiesController::create');
    $routes->post('activities/create', 'ActivitiesController::store');
    $routes->get('activities/(:num)/edit', 'ActivitiesController::edit/$1');
    $routes->post('activities/(:num)/edit', 'ActivitiesController::update/$1');
    $routes->post('activities/(:num)/delete', 'ActivitiesController::delete/$1');

    // Tags
    $routes->get('tags', 'TagsController::index');
    $routes->get('tags/create', 'TagsController::create');
    $routes->post('tags/create', 'TagsController::store');
    $routes->get('tags/(:num)/edit', 'TagsController::edit/$1');
    $routes->post('tags/(:num)/edit', 'TagsController::update/$1');
    $routes->post('tags/(:num)/delete', 'TagsController::delete/$1');
});

