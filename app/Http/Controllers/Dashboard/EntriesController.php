<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class EntriesController extends Controller
{
    public function index()
    {
        return view('dashboard.entries.index');
    }

    public function create()
    {
        return view('dashboard.entries.form');
    }

    public function edit($id)
    {
        return view('dashboard.entries.form', compact('id'));
    }
}