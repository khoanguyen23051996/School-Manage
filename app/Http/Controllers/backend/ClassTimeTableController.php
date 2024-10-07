<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ClassSubjectTimeTableModel;
use App\Models\SubjectModel;
use App\Models\User;
use App\Models\WeekModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        
        if(!empty($request->class_id)){
            $data['getSubject'] = ClassSubjectModel::mySubject($request->class_id);
        }

        $getWeek = WeekModel::getRecord();

        $week = array();
        foreach($getWeek as $value){
            $dataWeek = array();
            $dataWeek['week_id'] = $value->id;
            $dataWeek['week_name'] = $value->name;

            if(!empty($request->class_id) && !empty($request->subject_id)){
                $classSubject = ClassSubjectTimeTableModel::getRecordClassSubject($request->class_id, $request->subject_id, $value->id);

                if(!empty($classSubject)){
                    $dataWeek['start_time'] = $classSubject->start_time;
                    $dataWeek['end_time'] = $classSubject->end_time;
                    $dataWeek['room_number'] = $classSubject->room_number;
                }
                else{
                    $dataWeek['start_time'] = '';
                    $dataWeek['end_time'] = '';
                    $dataWeek['room_number'] = '';
                }
            }
            else{
                $dataWeek['start_time'] = '';
                $dataWeek['end_time'] = '';
                $dataWeek['room_number'] = '';
            }

            $week[] = $dataWeek;
        }
        $data['week'] = $week;

        return view('admin.pages.class_time_table.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function get_subject(Request $request)
    {   
        $getSubject = ClassSubjectModel::mySubject($request->class_id);

        $html = "<option value=''>Select</option>";
        
        foreach($getSubject as $value){
            $html .= "<option value='".$value->subject_id."'>".$value->subject_name."</option>";
        }

        $json['html'] = $html;
        echo json_encode($json);
    }

   public function insert_update(Request $request){

        ClassSubjectTimeTableModel::where('class_id', '=', $request->class_id)
                                ->where('subject_id', '=',  $request->subject_id)
                                ->delete();

        foreach($request->timetable as $timetable ){
            if(!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number'])){
                $save = new ClassSubjectTimeTableModel();
                $save->class_id = $request->class_id;
                $save->subject_id = $request->subject_id;
                $save->week_id = $timetable['week_id'];
                $save->start_time = $timetable['start_time'];
                $save->end_time = $timetable['end_time'];
                $save->room_number = $timetable['room_number'];
                $save->save();
            }
        }

        return redirect()->back()->with('success', 'Class Timetable Successfully Saved');
    }

    public function myTimeTable(Request $request){
        $result = array();
        $getRecord = ClassSubjectModel::mySubject(Auth::user()->class_id);
        foreach($getRecord as $value){
            $dataSubject['name'] = $value->subject_name;

            $getWeek = WeekModel::getRecord();
            $week = array();

            foreach($getWeek as $valueWeek){
                $dataWeek = array();
                $dataWeek['week_name'] = $valueWeek->name;

                $classSubject = ClassSubjectTimeTableModel::getRecordClassSubject($value->class_id, $value->subject_id, $valueWeek->id);

                if(!empty($classSubject)){
                    $dataWeek['start_time'] = $classSubject->start_time;
                    $dataWeek['end_time'] = $classSubject->end_time;
                    $dataWeek['room_number'] = $classSubject->room_number;
                }
                else{
                    $dataWeek['start_time'] = '';
                    $dataWeek['end_time'] = '';
                    $dataWeek['room_number'] = ''; 
                }

                $week[] = $dataWeek;
            }

            $dataSubject['week'] = $week;
            $result[] = $dataSubject;
        }

        $data['getRecord'] = $result;

        return view('student.pages.my_timetable.index', $data);
    }

    public function myTimeTableTeacher($class_id, $subject_id){
        $data['getClass'] = ClassModel::find($class_id);
        $data['getSubject'] = SubjectModel::find($subject_id);

        $getWeek = WeekModel::getRecord();
        $week = array();

        foreach($getWeek as $valueWeek){
            $dataWeek = array();
            $dataWeek['week_name'] = $valueWeek->name;

            $classSubject = ClassSubjectTimeTableModel::getRecordClassSubject($class_id, $subject_id, $valueWeek->id);

            if(!empty($classSubject)){
                $dataWeek['start_time'] = $classSubject->start_time;
                $dataWeek['end_time'] = $classSubject->end_time;
                $dataWeek['room_number'] = $classSubject->room_number;
            }
            else{
                $dataWeek['start_time'] = '';
                $dataWeek['end_time'] = '';
                $dataWeek['room_number'] = ''; 
            }

            $result[] = $dataWeek;
        }

        $data['getRecord'] = $result;

        return view('teacher.pages.my_timetable.index', $data);
    }

    public function myTimeTableParent($class_id, $subject_id, $student_id){
        $data['getClass'] = ClassModel::find($class_id);
        $data['getSubject'] = SubjectModel::find($subject_id);
        $data['getStudent'] = User::find($student_id);

        $getWeek = WeekModel::getRecord();
        $week = array();

        foreach($getWeek as $valueWeek){
            $dataWeek = array();
            $dataWeek['week_name'] = $valueWeek->name;

            $classSubject = ClassSubjectTimeTableModel::getRecordClassSubject($class_id, $subject_id, $valueWeek->id);

            if(!empty($classSubject)){
                $dataWeek['start_time'] = $classSubject->start_time;
                $dataWeek['end_time'] = $classSubject->end_time;
                $dataWeek['room_number'] = $classSubject->room_number;
            }
            else{
                $dataWeek['start_time'] = '';
                $dataWeek['end_time'] = '';
                $dataWeek['room_number'] = ''; 
            }

            $result[] = $dataWeek;
        }

        $data['getRecord'] = $result;

        return view('parent.pages.my_student.my_timetable', $data);
    }
}
