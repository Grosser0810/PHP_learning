<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Reauest;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}