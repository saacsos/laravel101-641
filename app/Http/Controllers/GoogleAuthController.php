<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callback() {
        $googleUser = Socialite::driver('google')->user();
        $email = $googleUser->getEmail();
        $user = User::whereEmail($email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $googleUser->getName();
            $user->email = $googleUser->getEmail();
            $user->role = 'CUSTOMER';
            $user->email_verified_at = now();
            $user->password = Hash::make($user->email . Str::random(16));
            $user->save();

            Auth::loginUsingId($user->id);
            return redirect()->route('tasks.index');
        } else {
            Auth::loginUsingId($user->id);
            return redirect()->route('tasks.index');
        }
    }
}
