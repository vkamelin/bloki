<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Http\Controllers\Controller;
use App\Models\Revision;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RevisionsApiController extends Controller
{
    public function index(Request $request)
    {
        // TODO: Реализовать получение списка ревизий с пагинацией, сортировкой и фильтрацией

        return response()->json([], 200);
    }

    public function show(Revision $revision): JsonResponse
    {
        // TODO: Реализовать получение деталей ревизии

        return response()->json([], 200);
    }

    public function restore(Revision $revision): JsonResponse
    {
        // TODO: Реализовать восстановление ревизии

        return response()->json([], 200);
    }

    public function compare(Request $request): JsonResponse
    {
        // TODO: Реализовать сравнение двух ревизий

        return response()->json([], 200);
    }
}
