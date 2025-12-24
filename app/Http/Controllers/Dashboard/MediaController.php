<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function index(): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение списка медиафайлов с пагинацией, сортировкой и фильтрацией

        return view('dashboard.media.index');
    }

    public function upload(): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение формы загрузки медиафайла

        return view('dashboard.field-groups.form');
    }

    public function store(MediaRequest $request): RedirectResponse
    {
        // TODO: Реализовать загрузка нового медиафайла

        return redirect()->route('dashboard.media.index');
    }

    public function show(int $id): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение деталей медиафайла

        return view('dashboard.media.show');
    }

    public function edit(int $id): Factory|ViewContract|View
    {
        // TODO: Реализовать отображение формы редактирования медиафайла

        return view('dashboard.media.form', compact('id'));
    }

    public function update(MediaRequest $request, int $id): RedirectResponse
    {
        // TODO: Реализовать обновление медиафайла

        return redirect()->route('dashboard.media.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        // TODO: Реализовать удаление медиафайла

        return redirect()->route('dashboard.media.index');
    }

    public function restore(int $id): RedirectResponse
    {
        // TODO: Реализовать восстановление удаленного медиафайла

        return redirect()->route('dashboard.media.index');
    }

    public function transform(int $id, array $preset): JsonResource
    {
        // TODO: Реализовать создание трансформации медиафайла

        return new JsonResource([]);
    }

    public function download(int $id)
    {
        // TODO: Реализовать возврат файла в теле запроса

        $filePath = '';

        return response()->download(storage_path($filePath));
    }
}
