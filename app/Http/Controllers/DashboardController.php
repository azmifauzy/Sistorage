<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'unactiviedUsers' => User::where('status_id', '2')->get(),
            'user' => User::where('id', session('id'))->first(),
        ];

        return view('pages.dashboard.index', $data);
    }
}
