<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FieldGroupRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FieldGroupsController extends Controller
{
    public function index(): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение списка групп полей с пагинацией, сортировкой и фильтрацией

        return view('dashboard.field-groups.index');
    }

    public function create(): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение формы создания группы полей

        return view('dashboard.field-groups.form');
    }

    public function store(FieldGroupRequest $request): RedirectResponse
    {
        // TODO: Реализовать создание новой группы полей

        return redirect()->route('dashboard.field-groups.index');
    }

    public function show(int $id): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение деталей группы полей

        return view('dashboard.field-groups.show');
    }

    public function edit(int $id): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение формы редактирования группы полей

        return view('dashboard.field-groups.form', compact('id'));
    }

    public function update(FieldGroupRequest $request, int $id): RedirectResponse
    {
        // TODO: Реализовать обновление группы полей

        return redirect()->route('dashboard.field-groups.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        // TODO: Реализовать удаление группы полей

        return redirect()->route('dashboard.field-groups.index');
    }

    public function restore(int $id): RedirectResponse
    {
        // TODO: Реализовать восстановление удаленной группы полей

        return redirect()->route('dashboard.field-groups.index');
    }
}
