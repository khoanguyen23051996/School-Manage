<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignClassTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['getRecord'] = AssignClassTeacherModel::getRecord();

        return view('admin.pages.assign_class_teacher.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacherClass();
        
        return view('admin.pages.assign_class_teacher.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!empty($request->teacher_id)){
            foreach($request->teacher_id as $teacher_id){
                $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id);
                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status = trim($request->status);
                    $getAlreadyFirst->save();
                }
                else{
                    $assign_subject = new AssignClassTeacherModel;
                    $assign_subject->class_id = trim($request->class_id);
                    $assign_subject->teacher_id = $teacher_id;
                    $assign_subject->status = trim($request->status);
                    $assign_subject->created_by = Auth::user()->id;
                    $assign_subject->save();
                }
               
            }

            return redirect()->route('admin.assign_class_teacher')->with('success', 'Assign Class To Teacher Successfully!');
        }
        else{
            return redirect()->back()->with('error', 'Due to some Error, Please try again!');
        }
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
        $getRecord = AssignClassTeacherModel::find($id);

        if(!empty($getRecord)){
            $data['getRecord'] = $getRecord;
            $data['getAssignTeacherID'] = AssignClassTeacherModel::getAssignTeacherID($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getTeacher'] = User::getTeacherClass();

            return view('admin.pages.assign_class_teacher.edit', $data);
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
        AssignClassTeacherModel::deleteTeacher($request->class_id);

        if(!empty($request->teacher_id)){
            foreach($request->teacher_id as $teacher_id){
                $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id);
                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status = trim($request->status);
                    $getAlreadyFirst->save();
                }
                else{
                    $assign_subject = new AssignClassTeacherModel;
                    $assign_subject->class_id = trim($request->class_id);
                    $assign_subject->teacher_id = $teacher_id;
                    $assign_subject->status = trim($request->status);
                    $assign_subject->created_by = Auth::user()->id;
                    $assign_subject->save();
                }
               
            }

            return redirect()->route('admin.assign_class_teacher')->with('success', 'Update Class To Teacher Successfully!');
        }
    }

    public function MyClassSubject()
    {
        $data['getRecord'] = AssignClassTeacherModel::getMyClassSubject(Auth::user()->id);

        return view('teacher.pages.my_class_subject.index', $data);
    }
}
