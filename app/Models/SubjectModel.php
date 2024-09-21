<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class SubjectModel extends Model
{
    use HasFactory;

    protected $table = 'subject';

    static public function getRecord(){
        $return = SubjectModel::select('subject.*', 'users.name as created_by_name')
                    ->join('users', 'users.id', 'subject.created_by');
                    

        if(!empty(Request::get('subject_name'))){
            $return = $return->where('subject.subject_name', 'like', '%'.Request::get('subject_name').'%');
        }
        if(!empty(Request::get('type'))){
            $return = $return->where('subject.type', '=', Request::get('type'));
        }
        if(!empty(Request::get('date'))){
            $return = $return->whereDate('subject.created_at', '=', Request::get('date'));
        }

        $return = $return->where('subject.soft_delete', '=', 0)
                    ->orderBy('subject.id', 'desc')
                    ->paginate(15);

        return $return;
    }

    static public function getSubject(){
        $return = SubjectModel::select('subject.*')
                    ->join('users', 'users.id', 'subject.created_by')
                    ->where('subject.soft_delete', '=', 0)
                    ->where('subject.status', '=', 0)
                    ->orderBy('subject.subject_name', 'asc')
                    ->get();

        return $return;
    }
}
