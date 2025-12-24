<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FieldsController extends Controller
{
    public function index(): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение списка полей с пагинацией, сортировкой и фильтрацией

        return view('dashboard.fields.index');
    }

    public function create(): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение формы создания поля

        return view('dashboard.fields.create');
    }

    public function store(SectionRequest $request): RedirectResponse
    {
        // TODO: Реализовать создание нового поля

        return redirect()->route('dashboard.fields.index');
    }

    public function show(int $id): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение деталей поля

        return view('dashboard.fields.show');
    }

    public function edit(int $id): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение формы редактирования поля

        return view('dashboard.fields.edit');
    }

    public function update(int $id, SectionRequest $request): RedirectResponse
    {
        // TODO: Реализовать обновление поля

        return redirect()->route('dashboard.fields.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        // TODO: Реализовать удаление поля

        return redirect()->route('dashboard.fields.index');
    }

    public function restore(int $id): RedirectResponse
    {
        // TODO: Реализовать восстановление удаленного поля

        return redirect()->route('dashboard.fields.index');
    }
}
