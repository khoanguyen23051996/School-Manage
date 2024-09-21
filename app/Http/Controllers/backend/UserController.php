<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if(Hash::check($request->old_password, $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('success', 'Password Change Successfully');
        }
        else{
            return redirect()->back()->with('error', 'Old Password is not Currect');
        }
    }

    
}
