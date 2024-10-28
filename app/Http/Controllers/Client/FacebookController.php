<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    //

    public function fbpage()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookcallback()
    {

    }

    public function deleteuser()
    {

    }
}
