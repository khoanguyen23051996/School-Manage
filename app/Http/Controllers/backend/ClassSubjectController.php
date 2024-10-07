<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $assign_subject['getRecord'] = ClassSubjectModel::getRecord();

        return view('admin.pages.assign_subject.index', $assign_subject);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $assign_subject['getClass'] = ClassModel::getClass();
        $assign_subject['getSubject'] = SubjectModel::getSubject();
        
        return view('admin.pages.assign_subject.create', $assign_subject);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!empty($request->subject_id)){
            foreach($request->subject_id as $subject_id){
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);
                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status = trim($request->status);
                    $getAlreadyFirst->save();
                }
                else{
                    $assign_subject = new ClassSubjectModel;
                    $assign_subject->class_id = trim($request->class_id);
                    $assign_subject->subject_id = $subject_id;
                    $assign_subject->status = trim($request->status);
                    $assign_subject->created_by = Auth::user()->id;
                    $assign_subject->save();
                }
               
            }

            return redirect()->route('admin.assign_subject')->with('success', 'Subject Successfully Assign to Class');
        }
        else{
            return redirect()->back()->with('error', 'Due to some Error, Please try again');
        }
    }

    public function edit(string $id)
    {
        $getRecord = ClassSubjectModel::find($id);

        if(!empty($getRecord)){
            $assign_subject['getRecord'] = $getRecord;
            $assign_subject['getAssignSubjectID'] = ClassSubjectModel::getAssignSubjectID($getRecord->class_id);
            $assign_subject['getClass'] = ClassModel::getClass();
            $assign_subject['getSubject'] = SubjectModel::getSubject();
            return view('admin.pages.assign_subject.edit', $assign_subject);
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
        ClassSubjectModel::deleteSubject($request->class_id);

        if(!empty($request->subject_id)){
            foreach($request->subject_id as $subject_id){
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->classid, $subject_id);
                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status = trim($request->status);
                    $getAlreadyFirst->save();
                }
                else{
                    $assign_subject = new ClassSubjectModel;
                    $assign_subject->class_id = trim($request->class_id);
                    $assign_subject->subject_id = $subject_id;
                    $assign_subject->status = trim($request->status);
                    $assign_subject->created_by = Auth::user()->id;
                    $assign_subject->save();
                }
            }
        }
        
        return redirect()->route('admin.assign_subject')->with('success', 'Subject Successfully Assign to Class');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assign_subject = ClassSubjectModel::find($id);
        
        $assign_subject->soft_delete = 1;
        $assign_subject->save();

        return redirect()->route('admin.assign_subject')->with('success', 'Deleted Assign Subject Successfully!');
    }
}
