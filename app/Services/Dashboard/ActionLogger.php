<?php

namespace App\Services\Dashboard;

use App\Models\DashboardActionLog;
use Illuminate\Support\Facades\Request;

class ActionLogger
{
    public function log($action, $entityType, $entityId, $description = null, $userId = null)
    {
        DashboardActionLog::create([
            'user_id' => $userId ?? auth()->guard('dashboard')->user()->id,
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'description' => $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent()
        ]);
    }

    public function logCreation($entityType, $entityId, $description = null, $userId = null)
    {
        $this->log('create', $entityType, $entityId, $description, $userId);
    }

    public function logUpdate($entityType, $entityId, $description = null, $userId = null)
    {
        $this->log('update', $entityType, $entityId, $description, $userId);
    }

    public function logDeletion($entityType, $entityId, $description = null, $userId = null)
    {
        $this->log('delete', $entityType, $entityId, $description, $userId);
    }

    public function logView($entityType, $entityId, $description = null, $userId = null)
    {
        $this->log('view', $entityType, $entityId, $description, $userId);
    }
}