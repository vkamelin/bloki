<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntryRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EntriesController extends Controller
{
    public function index(): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение списка записей с пагинацией, сортировкой и фильтрацией

        return view('dashboard.entries.index');
    }

    public function create(): Factory|ViewContract|View
    {
        return view('dashboard.entries.form');
    }

    public function store(EntryRequest $request): RedirectResponse
    {
        return redirect()->route('dashboard.entries.index');
    }

    public function show(int $id): Factory|ViewContract|View
    {
        return view('dashboard.entries.show');
    }

    public function edit($id): Factory|ViewContract|View
    {
        return view('dashboard.entries.form', compact('id'));
    }
}
