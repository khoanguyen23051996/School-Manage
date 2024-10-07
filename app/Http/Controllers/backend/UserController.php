<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function my_account(Request $request)
    {
        $user['getRecord'] = User::find(Auth::user()->id);
        if(Auth::user()->role == 1){
            return view('admin.pages.my_account.index', $user);
        }
        elseif(Auth::user()->role == 2){
            return view('teacher.pages.my_account.index', $user);
        }
        elseif(Auth::user()->role == 3){
            return view('student.pages.my_account.index', $user);
        }
        elseif(Auth::user()->role == 4){
            return view('parent.pages.my_account.index', $user);
        }
    }

    public function update_my_account_admin(Request $request)
    {
        $id = Auth::user()->id;

        $admin = User::find($id);
        $admin->name = trim($request->name);
        $admin->save();

        return redirect()->back()->with('success', 'Update My Account Successfully!');
    }

    public function update_my_account_teacher(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'mobile_number' => 'required|max:12'
        ]);


        $teacher = User::find($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);

        if(!empty($request->date_of_birth)){
            $teacher->date_of_birth = trim($request->date_of_birth);
        }

        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->address = trim($request->address);

        if(!empty($request->file('image'))){
            $ext = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $randomStr = date('Ymdhis').Str::random(20);
            $fileName = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $fileName);

            $teacher->image = $fileName;
        }
        $teacher->save();

        return redirect()->back()->with('success', 'Update My Account Successfully!');
    }

    public function update_my_account_student(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'mobile_number' => 'required|max:12'
        ]);


        $student = User::find($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);

        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);
        }

        $student->mobile_number = trim($request->mobile_number);

        if(!empty($request->file('image'))){
            $ext = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $randomStr = date('Ymdhis').Str::random(20);
            $fileName = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $fileName);

            $student->image = $fileName;
        }
        $student->save();

        return redirect()->back()->with('success', 'Update My Account Successfully!');
    }

    public function update_my_account_parent(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'mobile_number' => 'required|max:12'
        ]);


        $parent = User::find($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->save();

        return redirect()->back()->with('success', 'Update My Account Successfully!');
    }

    public function change_password(Request $request)
    {
        return view('profile.index');
    }

    public function update_change_password(Request $request)
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
