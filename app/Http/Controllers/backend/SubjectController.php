<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassSubjectModel;
use App\Models\SubjectModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subject['getRecord'] = SubjectModel::getRecord();

        return view('admin.pages.subject.index', $subject);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subject = new SubjectModel();
        $subject->subject_name = trim($request->subject_name);
        $subject->type = trim($request->type);
        $subject->status = trim($request->status);
        $subject->created_by = Auth::user()->id;
        $subject->save();

        return redirect()->route('admin.subject')->with('success', 'Created Subject Successfully');
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
        $subject['getRecord'] = SubjectModel::find($id);

        if(!empty($subject['getRecord'])){
            return view('admin.pages.subject.edit', $subject);
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
        $subject = SubjectModel::find($id);
        $subject->subject_name = trim($request->subject_name);
        $subject->type = trim($request->type);
        $subject->status = trim($request->status);
        $subject->save();

        return redirect()->route('admin.subject')->with('success', 'Update Subject Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = SubjectModel::find($id);
        
        $subject->soft_delete = 1;
        $subject->save();

        return redirect()->route('admin.subject')->with('success', 'Deleted Subject Successfully!');
    }

    public function mySubject(){
        $subject['getRecord'] = ClassSubjectModel::mySubject(Auth::user()->class_id);

        return view('student.pages.my_subject.index', $subject);
    }

    public function ParentStudentSubject($student_id){
        $user = User::find($student_id);

        $data['getUser'] = $user;
        $data['getRecord'] = ClassSubjectModel::mySubject($user->class_id);

        return view('parent.pages.my_student.my_student_subject', $data);
    }
}
