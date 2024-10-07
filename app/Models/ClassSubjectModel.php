<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ClassSubjectModel extends Model
{
    use HasFactory;

    protected $table = 'class_subject';

    static public function getRecord(){
        $return = ClassSubjectModel::select('class_subject.*', 'class.class_name as class_name', 'subject.subject_name as subject_name', 'users.name as created_by_name')
                                    ->join('subject', 'subject.id', '=', 'class_subject.subject_id')
                                    ->join('class', 'class.id', '=', 'class_subject.class_id')
                                    ->join('users', 'users.id', '=', 'class_subject.created_by')
                                    ->where('class_subject.soft_delete', '=', 0);
        
        if(!empty(Request::get('class_name'))){
            $return = $return->where('class.class_name', 'like', '%'.Request::get('class_name').'%');
        }
        if(!empty(Request::get('subject_name'))){
            $return = $return->where('subject.subject_name', 'like', '%'.Request::get('subject_name').'%');
        }
        if(!empty(Request::get('date'))){
            $return = $return->whereDate('class_subject.created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('class_subject.id', 'desc')
                        ->paginate(15);
                    
        return $return;            
    }
    
    static public function getAlreadyFirst($class_id, $subject_id){
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->first();
    }

    static public function getAssignSubjectID($class_id){
        return self::where('class_id', '=', $class_id)->where('soft_delete', '=', 0)->get();
    }

    static public function deleteSubject($class_id){
        return self::where('class_id', '=', $class_id)->delete();
    }

    static public function mySubject($class_id){
        return self::select('class_subject.*', 'class.class_name as class_name', 'subject.subject_name as subject_name', 'subject.type as subject_type')
                    ->join('subject', 'subject.id', '=', 'class_subject.subject_id')
                    ->join('class', 'class.id', '=', 'class_subject.class_id')
                    ->join('users', 'users.id', '=', 'class_subject.created_by')
                    ->where('class_subject.class_id', '=', $class_id)
                    ->where('class_subject.soft_delete', '=', 0)
                    ->where('class_subject.status', '=', 0)
                    ->orderBy('class_subject.id', 'desc')
                    ->get();
    }
}
