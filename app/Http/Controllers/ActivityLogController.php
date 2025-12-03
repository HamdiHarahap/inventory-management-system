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

    public function generatePDF(Request $request)
    {
        $date = $request->date;
        $userId = $request->user;

        $activity = ActivityLog::when($date, function ($query) use ($date) {
                $query->whereDate('created_at', $date);
            })
            ->when($userId, function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->get(); 

        $data = [
            'title' => 'Log Aktivitas',
            'activity' => $activity,
            'filtered_date' => $date,
            'filtered_user' => $userId,
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('activity.pdf', $data);

        return $pdf->stream('log-aktivitas.pdf');
    }


}
