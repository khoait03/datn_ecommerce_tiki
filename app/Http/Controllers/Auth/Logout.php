<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Logout extends Controller
{
    public function index()
    {
        Auth::logout();
        return redirect()->back();
    }
}
