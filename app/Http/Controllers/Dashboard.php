<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index(Request $request)
    {
        $tokens = \Illuminate\Support\Facades\Auth::user()->tokens;
        $plainToken = $request->session()->get('plainToken');
        return view('dashboard', compact('tokens', 'plainToken'));
    }
}
