<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // TODO: Реализовать получение списка администраторов

        return response()->json([], 200);
    }

    public function store(AdminRequest $request): JsonResponse
    {
        // TODO: Реализовать создание нового администратора

        return response()->json([], 200);
    }

    public function update(AdminRequest $request, Admin $admin): JsonResponse
    {
        // TODO: Реализовать обновление администратора

        return response()->json([], 200);
    }

    public function destroy(Admin $admin): JsonResponse
    {
        // TODO: Реализовать удаление администратора

        return response()->json([], 200);
    }
}
