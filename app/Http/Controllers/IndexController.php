<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Silahkan Pilih Table di Sidebar',
        ];
        return view('index', $data);
    }
}
