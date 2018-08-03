<?php

namespace Laravel\Http\Controllers\Auth;

use Laravel\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Laravel\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

 
    protected function authenticated($request, $user)
    {
        if($user->isAdmin == 1) {
           return redirect()->intended('/admin');
        }

        return redirect()->intended('/home');
    }


    public function signInSocial($provider){

        $user = Socialite::driver($provider)->user();
        // dd($user);
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect('/home');

    }



     public function findOrCreateUser($user, $provider)
    {
        $social = $provider.'_'.$user->user['id'];
        $authUser = User::where('social', $social)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $social,
            'social'    => $social,
            
        ]);
    }
}
