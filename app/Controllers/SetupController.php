<?php

namespace App\Controllers;

class SetupController extends BaseController
{
    public function index(): string
    {
        return view('setup/index', [
            'title' => 'Setup',
        ]);
    }
}
