<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoolgleController extends Controller
{
    //
     public function redirect(){
        return Socialite::driver('google')->redirect();

    }

    public function callback(){

        try{
            $gooogleUser=Socialite::drive('google')->user();
            $finduser=User::where('google_id',$gooogleUser->id)->first();

            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('/'); 
            }else{
            $user = User::where('email', $googleUser->email)->first();

            if(!$user){
                $user=User::Create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => null,

                ]);
            }else{
                $user->update(['google_id'=>$googleUser->id]);
            }

            Auth::login($user);
            return redirect()->intended('/');

            }
        }catch(Exception $e){
            return redirect('login')->with('error', 'Somthing Wrong !');

        }

    }
    
}
