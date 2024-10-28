<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailHome extends Controller
{
    //
    public function index()
    {
        return view('layouts.detail');
    }
}
