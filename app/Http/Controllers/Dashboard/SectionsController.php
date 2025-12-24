<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntryRequest;
use App\Http\Requests\SectionRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\Client\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SectionsController extends Controller
{
    public function index(): Factory|ViewContract|View
    {
        return view('dashboard.sections.index');
    }

    public function create(): Factory|ViewContract|View
    {
        return view('dashboard.sections.create');
    }

    public function store(EntryRequest $request): RedirectResponse
    {
        return redirect()->route('dashboard.sections.index');
    }

    public function show(int $id): Factory|ViewContract|View
    {
        return view('dashboard.sections.show');
    }

    public function edit(int $id): Factory|ViewContract|View
    {
        return view('dashboard.sections.edit');
    }

    public function update(SectionRequest $request, int $id): RedirectResponse
    {
        return redirect()->route('dashboard.sections.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        return redirect()->route('dashboard.sections.index');
    }

    public function restore($id): RedirectResponse
    {
        return redirect()->route('dashboard.sections.index');
    }

    public function reorder(Request $request)
    {
        return redirect()->route('dashboard.sections.index');
    }
}
