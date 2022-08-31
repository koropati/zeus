<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permissions\Permission;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.index');
    }
}