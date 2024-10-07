<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher['getRecord'] = User::getTeacher();

        return view('admin.pages.teacher.index', $teacher);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.teacher.create');   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'required|max:12'
        ]);


        $teacher = new User();
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);

        if(!empty($request->date_of_birth)){
            $teacher->date_of_birth = trim($request->date_of_birth);
        }

        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->address = trim($request->address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_exp = trim($request->work_exp);

        if(!empty($request->date_of_joining)){
            $teacher->date_of_joining = trim($request->date_of_joining);
        }

        $teacher->status = trim($request->status);

        if(!empty($request->file('image'))){
            $ext = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $randomStr = date('Ymdhis').Str::random(20);
            $fileName = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $fileName);

            $teacher->image = $fileName;
        }

        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->role = 2;
        $teacher->save();

        return redirect()->route('admin.teacher')->with('success', 'Create Teacher Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher['getTeacher'] = User::find($id);

        if(!empty($teacher['getTeacher'])){
            return view('admin.pages.teacher.edit', $teacher);
        }
        else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
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
        $teacher->qualification = trim($request->qualification);
        $teacher->work_exp = trim($request->work_exp);

        if(!empty($request->date_of_joining)){
            $teacher->date_of_joining = trim($request->date_of_joining);
        }

        $teacher->status = trim($request->status);

        if(!empty($request->file('image'))){
            $ext = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $randomStr = date('Ymdhis').Str::random(20);
            $fileName = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $fileName);

            $teacher->image = $fileName;
        }

        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->role = 2;
        $teacher->save();

        return redirect()->route('admin.teacher')->with('success', 'Update Teacher Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = User::find($id);
        
        $teacher->soft_delete = 1;
        $teacher->save();

        return redirect()->route('admin.teacher')->with('success', 'Deleted Teacher Successfully!');
    }
}
