<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        return view('activity.index', [
            'title' => 'Aktivitas',
            'data' => ActivityLog::all()
        ]);
    }
}
