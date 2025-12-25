<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FieldGroupRequest;
use App\Models\FieldGroup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class FieldGroupsApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // TODO: Реализовать получение списка групп полей с пагинацией, сортировкой и фильтрацией

        return response()->json([], 200);
    }

    public function store(FieldGroupRequest $request)
    {
        // TODO: Реализовать создание новой группы полей

        return response()->json([], 200);
    }

    public function show(FieldGroup $fieldGroup): JsonResponse
    {
        // TODO: Реализовать получение деталей группы полей

        return response()->json([], 200);
    }

    public function update(FieldGroupRequest $request, FieldGroup $fieldGroup)
    {
        // TODO: Реализовать обновление группы полей

        return response()->json([], 200);
    }

    public function destroy(FieldGroup $fieldGroup)
    {
        // TODO: Реализовать удаление группы полей

        return response()->json([], 200);
    }

    public function restore(FieldGroup $fieldGroup): JsonResponse
    {
        // TODO: Реализовать восстановление удаленной группы полей

        return response()->json([], 200);
    }
}
