<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectloggeInAppController extends Controller
{

    public function index(){
        $user = Auth::user();
        return view('layouts.awaiting_review', compact('user'));
    }
    public function stop(){
        $user = Auth::user();
        $shops = $user->shop;
        return view('layouts.stop_shop', compact('shops'));
    }
}
