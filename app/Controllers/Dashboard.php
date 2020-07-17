<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = array(
            'title' => 'Dashboard',
        );
        return view('dashboard/index', $data);
    }
}
