<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->date;
        $userId = $request->user;

        $data = ActivityLog::when($date, function ($query) use ($date) {
                $query->whereDate('created_at', $date);
            })
            ->when($userId, function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('activity.index', [
            'title' => 'Aktivitas',
            'data' => $data,
            'users' => User::orderBy('created_at')->where('role', '!=', 'manager')->get()
        ]);
    }

}
