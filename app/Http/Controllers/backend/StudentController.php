<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student['getRecord'] = User::getStudent();
        $student['getClass'] = ClassModel::getClass();
        return view('admin.pages.student.index', $student);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student['getClass'] = ClassModel::getClass();
        return view('admin.pages.student.create', $student);
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


        $student = new User();
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);
        }
        

        $student->caste = trim($request->caste);
        $student->mobile_number = trim($request->mobile_number);

        if(!empty($request->admission_date)){
            $student->admission_date = trim($request->admission_date);
        }

        if(!empty($request->file('image'))){
            $ext = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $randomStr = date('Ymdhis').Str::random(20);
            $fileName = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $fileName);

            $student->image = $fileName;
        }

        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->role = 3;
        $student->save();

        return redirect()->route('admin.student')->with('success', 'Create Student Successfully!');
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
        $student['getStudent'] = User::find($id);

        if(!empty($student['getStudent'])){
            $student['getClass'] = ClassModel::getClass();
            return view('admin.pages.student.edit', $student);
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


        $student = User::find($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);
        }
        

        $student->caste = trim($request->caste);
        $student->mobile_number = trim($request->mobile_number);

        if(!empty($request->admission_date)){
            $student->admission_date = trim($request->admission_date);
        }

        if(!empty($request->file('image'))){
            if(!empty($student->getImage())){
                unlink('upload/profile/'.$student->image);
            }
            $ext = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $randomStr = date('Ymdhis').Str::random(20);
            $fileName = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $fileName);

            $student->image = $fileName;
        }

        $student->status = trim($request->status);
        $student->email = trim($request->email);
        
        if(!empty($request->password)){
            $student->password = Hash::make($request->password);
        }

        $student->save();

        return redirect()->route('admin.student')->with('success', 'Updated Student Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = User::find($id);
        
        $student->soft_delete = 1;
        $student->save();

        return redirect()->route('admin.student')->with('success', 'Deleted Student Successfully!');
    }
}
