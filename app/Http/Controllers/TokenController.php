<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();
        $tokenName = stripcslashes($request->post('name', ''));
        [,$plainToken] = explode('|',$user->createToken($tokenName)->plainTextToken);
        $request->session()->flash('plainToken', $plainToken);
        return redirect('dashboard');
    }
}
