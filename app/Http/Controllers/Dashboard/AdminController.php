<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,manager');
    }

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
