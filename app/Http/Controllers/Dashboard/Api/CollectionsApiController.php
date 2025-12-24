<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollectionRequest;
use App\Models\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CollectionsApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // TODO: Реализовать получение списка коллекций с пагинацией, сортировкой и фильтрацией

        return response()->json([], 200);
    }

    public function store(CollectionRequest $request): JsonResponse
    {
        // TODO: Реализовать создание новой коллекции

        return response()->json([], 200);
    }

    public function show(Collection $collection): JsonResponse
    {
        // TODO: Реализовать получение деталей коллекции

        return response()->json([], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CollectionRequest $request, Collection $collection): JsonResponse
    {
        // TODO: Реализовать обновление коллекции

        return response()->json([], 200);
    }

    public function destroy(Collection $collection): JsonResponse
    {
        // TODO: Реализовать удаление коллекции

        return response()->json([], 200);
    }

    public function restore(Collection $collection): JsonResponse
    {
        // TODO: Реализовать восстановление удаленной коллекции

        return response()->json([], 200);
    }

    public function duplicate(Collection $collection): JsonResponse
    {
        // TODO: Реализовать создание копии коллекции

        return response()->json([], 200);
    }
}
