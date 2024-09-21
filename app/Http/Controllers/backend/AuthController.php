<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        
        if(!empty(Auth::check())){
            if(Auth::user()->role == 1){
                return redirect()->route('admin.dashboard');
            }
            elseif(Auth::user()->role == 2){
                return redirect()->route('teacher.dashboard');
            }
            elseif(Auth::user()->role == 3){
                return redirect()->route('student.dashboard');
            }
            elseif(Auth::user()->role == 4){
                return redirect()->route('parent.dashboard');
            }
        }
        
        return view('auth.login');
    }

    public function authLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
       
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)){
            if(Auth::user()->role == 1){
                return redirect()->route('admin.dashboard');
            }
            elseif(Auth::user()->role == 2){
                return redirect()->route('teacher.dashboard');
            }
            elseif(Auth::user()->role == 3){
                return redirect()->route('student.dashboard');
            }
            elseif(Auth::user()->role == 4){
                return redirect()->route('parent.dashboard');
            }
        }
        else{
            return redirect()->route('login')->with('error', 'Check your Email and Password, Please!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function forgot_password(){
        return view('auth.forgot_password');
    }

    public function authForgot_password(Request $request){
        $user = User::getEmailSingle($request->email);
        if(!empty($user)){
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', 'Check your Email and Password, Please!');
        }
        else{
            return redirect()->back()->with('error', 'Email not exist!');
        }
    }

    public function reset($remember_token){
        $user = User::getTokenSingle($remember_token);
        if(!empty($user)){
            $dataReset['user'] = $user;

            return view('auth.reset', $dataReset);
        }
        else{
            abort(404);
        }
    }

    public function post_reset($remember_token, Request $request){
        if($request->password == $request->confirm_password){
            $user = User::getTokenSingle($remember_token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect()->route('login')->with('success', 'Reset Password Successfully!');
        }
        else{
            return redirect()->back()->with('error', 'Password dont match!');
        }
    }


}
