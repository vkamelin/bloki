<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntryRequest;
use App\Models\Entry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EntriesApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // TODO: Реализовать получение списка записей с пагинацией, сортировкой и фильтрацией

        return response()->json([], 200);
    }

    public function store(EntryRequest $request): JsonResponse
    {
        // TODO: Реализовать создание новой записи

        return response()->json([], 200);
    }

    public function show(Entry $entry): JsonResponse
    {
        // TODO: Реализовать получение деталей записи

        return response()->json([], 200);
    }

    public function update(EntryRequest $request, Entry $entry)
    {
        // TODO: Реализовать обновление записи

        return response()->json([], 200);
    }

    public function destroy(Entry $entry)
    {
        // TODO: Реализовать удаление записи

        return response()->json([], 200);
    }

    public function restore(Entry $entry)
    {
        // TODO: Реализовать восстановление удаленной записи

        return response()->json([], 200);
    }

    public function preview(Entry $entry)
    {
        // TODO: Реализовать предварительный просмотр записи

        return response()->json([], 200);
    }

    public function publish(Entry $entry)
    {
        // TODO: Реализовать публикация записи

        return response()->json([], 200);
    }

    public function unpublish(Entry $entry)
    {
        // TODO: Реализовать снятие с публикации записи

        return response()->json([], 200);
    }
}
