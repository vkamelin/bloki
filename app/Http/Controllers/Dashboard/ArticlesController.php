<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    public function index()
    {
        return view('dashboard.articles.index');
    }

    public function create()
    {
        return view('dashboard.articles.form');
    }

    public function edit($id)
    {
        return view('dashboard.articles.form', compact('id'));
    }
}