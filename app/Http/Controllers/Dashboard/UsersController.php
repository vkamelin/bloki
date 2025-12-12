<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        return view('dashboard.users.index');
    }

    public function create()
    {
        return view('dashboard.users.form');
    }

    public function edit($id)
    {
        return view('dashboard.users.form', compact('id'));
    }
}