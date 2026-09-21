<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;






use  App\Models\User;
use  App\Mail\varifyUser;



class authController extends Controller
{
    //

    public function login(){

        if (auth()->check()) {

            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.home');
        }
        return view('login');
    }

    public function signin(){
        return view('signIn');

    }

    /**user create new account  */

    public function signUp(Request $request){

    $request->validate([
        'name'=>'required|min:4|max:20',
        'email'=>'required|email',
        'password'=>'required|min:8',
        'Confirm_password'=>'required|same:password|min:8'
    ]);   
    
    $user=new User();
    $user->name=$request->name;
    $user->email=$request->email;
    $user->password = Hash::make($request->Confirm_password);
    if($user->save()){
        
        $link=Crypt::encryptString($user->email);
        $link=url('/varifyUser/'.$link);
        Mail::to($user->email)->send(new varifyUser($link));

        Session::put('user',$user);

        return redirect('/login')->with('success', 'Registration successful.');
    }else{
        return redirect()->with('error', 'Registration faild!');

    }

    }
    /**varify user email address */
    function varifyUser($email){
        $orgEmail=Crypt::decryptString($email);
        $user=User::where('email',$orgEmail)->first();
        if($user){
            $user->email_verified_at=now();
            if($user->save()){
                return redirect('/login');
            }
        }

    }

    /**user login(sign to account) */


    public function user_signIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // Check email verification
        if ($user->email_verified_at === null) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Please verify your email address before logging in.',
            ])->onlyInput('email');
        }

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'user') {
            return redirect()->route('user.home');
        }

        // Unknown/unauthorized role
        Auth::logout();

        return back()->withErrors([
            'email' => 'Your account does not have permission to access the application.',
        ])->onlyInput('email');

    }

    public function logout(Request $request){

        Auth::logout();

       
        $request->session()->invalidate();
        $request->session()->regenerateToken();
         return redirect()->route('login');


    }



       
     

}
