<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class CollectionsController extends Controller
{
    public function index()
    {
        return view('dashboard.collections.index');
    }

    public function create()
    {
        return view('dashboard.collections.form');
    }

    public function edit($id)
    {
        return view('dashboard.collections.form', compact('id'));
    }
}