<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function googlepage()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $findUser = User::where('google_id', $googleUser->id)->first();

            if ($findUser) {
                Auth::login($findUser);
                return redirect('/');
            } else {
                $existingUser = User::where('email', $googleUser->email)->first();
                if ($existingUser) {
                    $existingUser->google_id = $googleUser->id;
                    $existingUser->save();
                    Auth::login($existingUser);
                } else {
                    $newUser = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'password' => encrypt('123456'),
                    ]);
                    $newUser->syncRoles(''); // gán vai trò mặc định

                    Auth::login($newUser);
                }
                return redirect('/');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
