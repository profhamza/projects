<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->stateless()->redirect();
    }
    public function callback($service)
    {
        $user = Socialite::with($service)->stateless()->user();
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser, true);
        return redirect("home");
    }
    public function findOrCreateUser($user)
    {
       $authUser = User::where('provider_id', $user->getId())->first();
       if ($authUser)
       {
           return $authUser;
       }
       return User::create([
           'name'        => $user->getName(),
           'email'       => $user->getEmail(),
           'password'    => md5(rand(1, 1000)),
           'provider_id' => $user->getId(),
           'phone' => ""
       ]);
    }
}
