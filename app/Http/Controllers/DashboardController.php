<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Customer;
use App\Models\IncomingTransaction;
use App\Models\OutgoingTransaction;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countProduct = Product::count();
        $countCategory = Category::count();
        $countIncoming = IncomingTransaction::count();
        $countOutgoing = OutgoingTransaction::count();
        $countUser = User::count();
        $countCustomer = Customer::count();
        $countSupplier = Supplier::count();
        $activityLatest = ActivityLog::latest()->first(); 
        $activity = $activityLatest ? $activityLatest->user->name . ' | ' . $activityLatest->action : 'Belum ada aktivitas';
        $title = 'Dashboard';

        return view('dashboard', compact([
            'countProduct',
            'countCategory',
            'countIncoming',
            'countOutgoing',
            'countUser',
            'countCustomer',
            'countSupplier',
            'activity',
            'title'
        ]));

    }
}
