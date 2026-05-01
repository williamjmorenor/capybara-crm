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
