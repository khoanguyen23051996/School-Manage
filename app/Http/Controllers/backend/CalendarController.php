<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AssignClassTeacherModel;
use App\Models\ClassSubjectModel;
use App\Models\ClassSubjectTimeTableModel;
use App\Models\User;
use App\Models\WeekModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function myCalendar()
    {
        $data['getMyTimeTable'] = $this->getTimeTable(Auth::user()->class_id);

        return view('student.pages.my_calendar.index', $data);
    }

    public function getTimetable($class_id){
        $result = array();
        $getRecord = ClassSubjectModel::mySubject($class_id);
        foreach($getRecord as $value){
            $dataSubject['name'] = $value->subject_name;

            $getWeek = WeekModel::getRecord();
            $week = array();

            foreach($getWeek as $valueWeek){
                $dataWeek = array();
                $dataWeek['week_name'] = $valueWeek->name;
                $dataWeek['fullcalendar_day'] = $valueWeek->fullcalendar_day;

                $classSubject = ClassSubjectTimeTableModel::getRecordClassSubject($value->class_id, $value->subject_id, $valueWeek->id);

                if(!empty($classSubject)){
                    $dataWeek['start_time'] = $classSubject->start_time;
                    $dataWeek['end_time'] = $classSubject->end_time;
                    $dataWeek['room_number'] = $classSubject->room_number;
                    $week[] = $dataWeek;
                }
            }

            $dataSubject['week'] = $week;
            $result[] = $dataSubject;
        }

        return $result;
    }

    public function CalendarParent($student_id)
    {
        $getStudent = User::find($student_id);

        $data['getStudent'] = $getStudent;
        $data['getMyTimeTable'] = $this->getTimeTable($getStudent->class_id);

        return view('parent.pages.my_student.calendar', $data);
    }

    public function CalendarTeacher()
    {
        $teacher_id = Auth::user()->id;

        $data['getClassTimeTable'] = AssignClassTeacherModel::getCalendarTeacher($teacher_id);
        
        return view('teacher.pages.my_calendar.index', $data);
    }

}
