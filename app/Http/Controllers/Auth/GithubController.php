<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GithubController extends Controller
{
    //

    public function redirect(){
        return Socialite::driver('github')->redirect();

    }

    public function callback(){

        $githubuser=Socialite::driver('github')->user();
        $user= User::updateOrCreate(
            [
                'email'=>$githubuser->getEmail(),

            ],[
                'name' =>$githubuser->getName() ?? $githubuser->getNickname(),
                'github_id' =>$githubuser->getId(),
                'avatar' =>$githubuser->getAvatar(),
                'password' => null,

            ]

        );
        
        Auth::login($user);

        //redirect accordin to user role
        if ($user->role === 'admin') {
            return redirect()->intended('/admin/');
        }
        return redirect()->intended('/');


    }
}
