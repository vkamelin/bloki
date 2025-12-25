<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Entry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SectionsApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // TODO: Реализовать получение списка разделов с пагинацией, сортировкой и фильтрацией

        return response()->json([], 200);
    }

    public function store(SectionRequest $request)
    {
        // TODO: Реализовать создание нового раздела

        return response()->json([], 200);
    }

    public function show(Entry $section): JsonResponse
    {
        // TODO: Реализовать получение деталей раздела

        return response()->json([], 200);
    }

    public function update(SectionRequest $request, Entry $section): JsonResponse
    {
        // TODO: Реализовать обновление раздела

        return response()->json([], 200);
    }

    public function destroy(Entry $section)
    {
        // TODO: Реализовать удаление раздела

        return response()->json([], 200);
    }

    public function restore(Entry $section): JsonResponse
    {
        // TODO: Реализовать восстановление удаленного раздела

        return response()->json([], 200);
    }

    public function reorder(Request $request): JsonResponse
    {
        // TODO: Реализовать изменение порядка разделов

        return response()->json([], 200);
    }
}
