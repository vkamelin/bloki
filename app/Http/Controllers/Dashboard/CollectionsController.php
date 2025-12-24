<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollectionRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CollectionsController extends Controller
{
    public function index(): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение списка коллекций с пагинацией, сортировкой и фильтрацией

        return view('dashboard.collections.index');
    }

    public function create(): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение формы создания коллекции

        return view('dashboard.collections.form');
    }

    public function store(CollectionRequest $request): RedirectResponse
    {
        // TODO: Реализовать создание новой коллекции

        return redirect()->route('dashboard.collections.index');
    }

    public function show(int $id): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение деталей коллекции

        return view('dashboard.collections.show');
    }

    public function edit($id): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение формы редактирования коллекции

        return view('dashboard.collections.form', compact('id'));
    }

    public function update(CollectionRequest $request, int $id): RedirectResponse
    {
        // TODO: Реализовать обновление коллекции

        return redirect()->route('dashboard.collections.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        // TODO: Реализовать удаление коллекции

        return redirect()->route('dashboard.collections.index');
    }

    public function restore(int $id): RedirectResponse
    {
        // TODO: Реализовать восстановление удаленной коллекции

        return redirect()->route('dashboard.collections.index');
    }

    public function duplicate(int $id): RedirectResponse
    {
        // TODO: Реализовать создание копии коллекции

        return redirect()->route('dashboard.collections.index');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        // TODO: Реализовать полное удаление коллекции

        return redirect()->route('dashboard.collections.index');
    }

    public function import(): Factory|ViewContract|View
    {
        return view('dashboard.collections.import');
    }

    public function importFile(): RedirectResponse
    {
        return redirect()->route('dashboard.collections.import');
    }

    public function export(): Factory|ViewContract|View
    {
        return view('dashboard.collections.export');
    }

    public function exportFile(): RedirectResponse
    {
        return redirect()->route('dashboard.collections.export');
    }
}
