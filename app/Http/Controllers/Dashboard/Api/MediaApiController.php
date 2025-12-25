<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaRequest;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class MediaApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // TODO: Реализовать получение списка медиафайлов с пагинацией, сортировкой и фильтрацией

        return response()->json([], 200);
    }

    public function store(MediaRequest $request): JsonResponse
    {
        // TODO: Реализовать загрузка нового медиафайла

        return response()->json([], 200);
    }

    public function show(Media $media): JsonResponse
    {
        // TODO: Реализовать получение деталей медиафайла

        return response()->json([], 200);
    }

    public function update(MediaRequest $request, Media $media): JsonResponse
    {
        // TODO: Реализовать обновление медиафайла

        return response()->json([], 200);
    }

    public function destroy(Media $media): JsonResponse
    {
        // TODO: Реализовать удаление медиафайла

        return response()->json([], 200);
    }

    public function restore(Media $media): JsonResponse
    {
        // TODO: Реализовать восстановление удаленного медиафайла

        return response()->json([], 200);
    }

    public function transform(Request $request, Media $media): JsonResponse
    {
        // TODO: Реализовать создание трансформации медиафайла

        return response()->json([], 200);
    }
}
