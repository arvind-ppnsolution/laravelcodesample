<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * For showing dashboard data
     *
     * @return View responce blade view with data
     */
    public function index()
    {
        return view('admin.modules.dashboard.index',[
            'skillsfindr_count' => User::where('role_id', 2)->count(),
            'skillsmastr_count' => User::where('role_id', 3)->count(),
            'category_count' => User::count(),
            'type_count' => User::count()
        ]);
    }
}
