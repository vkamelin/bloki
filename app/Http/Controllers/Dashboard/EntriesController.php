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
        // TODO: Реализовать отображение формы создания записи

        return view('dashboard.entries.form');
    }

    public function store(EntryRequest $request): RedirectResponse
    {
        // TODO: Реализовать создание новой записи

        return redirect()->route('dashboard.entries.index');
    }

    public function show(int $id): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение деталей записи

        return view('dashboard.entries.show');
    }

    public function edit(int $id): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение формы редактирования записи

        return view('dashboard.entries.form', compact('id'));
    }

    public function update(EntryRequest $request, int $id): RedirectResponse
    {
        // TODO: Реализовать обновление записи

        return redirect()->route('dashboard.entries.index');
    }

    public function destroy($id): RedirectResponse
    {
        // TODO: Реализовать удаление записи

        return redirect()->route('dashboard.entries.index');
    }

    public function restore($id): RedirectResponse
    {
        // TODO: Реализовать восстановление удаленной записи

        return redirect()->route('dashboard.entries.index');
    }

    public function preview($id)
    {
        // TODO: Реализовать предварительный просмотр записи

        return view('dashboard.entries.preview', compact('id'));
    }

    public function publish($id): RedirectResponse
    {
        // TODO: Реализовать публикация записи

        return redirect()->route('dashboard.entries.index');
    }

    public function unpublish($id): RedirectResponse
    {
        // TODO: Реализовать снятие с публикации записи

        return redirect()->route('dashboard.entries.index');
    }
}
