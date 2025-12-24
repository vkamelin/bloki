<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\RevisionResource;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class RevisionsController extends Controller
{
    public function index(): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение списка ревизий с пагинацией, сортировкой и фильтрацией

        return view('dashboard.revisions.index');
    }

    public function show(int $id): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение деталей ревизии

        return view('dashboard.revisions.show');
    }

    public function restore(int $id): RedirectResponse
    {
        // TODO: Реализовать восстановление ревизии

        return redirect()->route('dashboard.revisions.index');
    }

    public function compare(int $id1, int $id2)
    {
        // TODO: Реализовать сравнение двух ревизий

        return view('dashboard.revisions.compare');
    }
}
