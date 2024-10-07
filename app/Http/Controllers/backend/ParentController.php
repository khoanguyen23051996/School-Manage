<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parent['getRecord'] = User::getParent();
        return view('admin.pages.parent.index', $parent);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.parent.create');
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


        $parent = new User();
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->status = trim($request->status);
        $parent->email = trim($request->email);
        $parent->password = Hash::make($request->password);
        $parent->role = 4;
        $parent->save();

        return redirect()->route('admin.parent')->with('success', 'Create Parent Successfully!');
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
        $parent['getParent'] = User::find($id);

        if(!empty($parent['getParent'])){
            return view('admin.pages.parent.edit', $parent);
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


        $parent = User::find($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->status = trim($request->status);
        $parent->email = trim($request->email);
        
        if(!empty($request->password)){
            $parent->password = Hash::make($request->password);
        }

        $parent->save();

        return redirect()->route('admin.parent')->with('success', 'Updated Parent Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parent = User::find($id);
        
        $parent->soft_delete = 1;
        $parent->save();

        return redirect()->route('admin.parent')->with('success', 'Deleted Parent Successfully!');
    }

    public function myStudent(Request $request, string $id){
        
        $parent['getParent'] = User::find($id);
        $parent['parent_id'] = $id;
        $parent['getSearchStudent'] = User::getSearchStudent();
        $parent['getRecord'] = User::getMyStudent($id);
        
        return view('admin.pages.parent.my_student', $parent);
    }

    public function AssignStudentParent($student_id, $parent_id){

        $student = User::find($student_id);
        $student->parent_id = $parent_id;
        $student->save();

        return redirect()->back()->with('success', 'Student Successfully Assign!');
    }

    public function AssignStudentParentDelete($student_id){

        $student = User::find($student_id);
        $student->parent_id = null;
        $student->save();

        return redirect()->back()->with('success', 'Student Successfully Assign Delete!');
    }

    public function myStudentParent(){
        $id = Auth::user()->id;
      
        $parent['getRecord'] = User::getMyStudent($id);
        
        return view('parent.pages.my_student.index', $parent);
    }
}
