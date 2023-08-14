<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
    {
        public function index()
        {
            $activityLogs = ActivityLog::orderBy('created_at')->get();
            return view('activity-log.index', compact('activityLogs'));
        }
    }