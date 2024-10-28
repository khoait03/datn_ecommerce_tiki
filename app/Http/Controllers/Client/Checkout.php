<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Checkout extends Controller
{
    //
    public function index()
    {
        return view('layouts.checkout');
    }
}
