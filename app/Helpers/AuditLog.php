<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

function auditLog($action, $table, $recordId = null, $description = null)
{
    DB::table('audit_logs')->insert([
        'user_id' => Auth::check() ? Auth::id() : null,
        'action' => $action,
        'table_name' => $table,
        'record_id' => $recordId,
        'description' => $description,
        'ip_address' => request()->ip(),
        'created_at' => now(),
    ]);
}
