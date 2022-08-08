<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permissions\Permission;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (!auth()->user()->can(Permission::CAN_CREATE_USERS)) {
            return redirect('login');
        }
        return view('dashboard.index');
    }
}