<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FieldRequest;
use App\Models\Field;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FieldsApiController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        // TODO: Реализовать получение списка полей с пагинацией, сортировкой и фильтрацией

        return response()->json([], 200);
    }

    public function store(FieldRequest $request): JsonResponse
    {
        // TODO: Реализовать создание нового поля

        return response()->json([], 200);
    }

    public function show(Field $field): JsonResponse
    {
        // TODO: Реализовать получение деталей поля

        return response()->json([], 200);
    }

    public function update(FieldRequest $request): JsonResponse
    {
        // TODO: Реализовать обновление поля

        return response()->json([], 200);
    }

    public function destroy(Field $field)
    {
        // TODO: Реализовать удаление поля

        return response()->json([], 200);
    }

    public function restore(Field $field)
    {
        // TODO: Реализовать восстановление удаленного поля

        return response()->json([], 200);
    }
}
