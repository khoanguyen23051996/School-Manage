<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getEmailSingle($email){
        return User::where('email', '=', $email)->first();
    }

    static public function getTokenSingle($remember_token){
        return User::where('remember_token', '=', $remember_token)->first();
    }

    static public function getRecord(){
        $return = self::select('users.*')
                    ->where('role', '=', 1)
                    ->where('soft_delete', '=', 0);
        
        if(!empty(Request::get('email'))){
            $return = $return->where('email', 'like', '%'.Request::get('email').'%');
        }
        if(!empty(Request::get('name'))){
            $return = $return->where('email', 'like', '%'.Request::get('name').'%');
        }
        if(!empty(Request::get('date'))){
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }
                    
        $return = $return->orderBy('id', 'desc')
                        ->paginate(15);

        return $return;
    }

    static public function getStudent(){
        $return = self::select('users.*', 'class.class_name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
                    ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')  
                    ->join('class', 'class.id', '=', 'users.class_id')
                    ->where('users.role', '=', 3)
                    ->where('users.soft_delete', '=', 0);
        
        if(!empty(Request::get('email'))){
            $return = $return->where('email', 'like', '%'.Request::get('email').'%');
        }
        if(!empty(Request::get('name'))){
            $return = $return->where('name', 'like', '%'.Request::get('name').'%');
        }
        if(!empty(Request::get('class_name'))){
            $return = $return->where('class.class_name', 'like', '%'.Request::get('class_name').'%');
        }
        if(!empty(Request::get('date'))){
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }
                    
        $return = $return->orderBy('users.id', 'desc')
                        ->paginate(15);

        return $return;
    }

    public function getImage(){
        if(!empty($this->image) && file_exists('upload/profile/'.$this->image)){
            return url('upload/profile/'.$this->image);
        }
        else{
            return '';
        }
    }

    static public function getTeacher(){
        $return = self::select('users.*')
                    ->where('users.role', '=', 2)
                    ->where('users.soft_delete', '=', 0);
        
        if(!empty(Request::get('email'))){
            $return = $return->where('email', 'like', '%'.Request::get('email').'%');
        }
        if(!empty(Request::get('name'))){
            $return = $return->where('name', 'like', '%'.Request::get('name').'%');
        }
        if(!empty(Request::get('date'))){
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }
                    
        $return = $return->orderBy('users.id', 'desc')
                        ->paginate(15);

        return $return;
    }

    static public function getTeacherClass(){
        $return = self::select('users.*')
                    ->where('users.role', '=', 2)
                    ->where('users.soft_delete', '=', 0);
                    
        $return = $return->orderBy('users.id', 'desc')
                        ->paginate(15);

        return $return;
    }

    static public function getParent(){
        $return = self::select('users.*')
                    ->where('users.role', '=', 4)
                    ->where('users.soft_delete', '=', 0);
        
        if(!empty(Request::get('email'))){
            $return = $return->where('email', 'like', '%'.Request::get('email').'%');
        }
        if(!empty(Request::get('name'))){
            $return = $return->where('name', 'like', '%'.Request::get('name').'%');
        }
        if(!empty(Request::get('date'))){
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }
                    
        $return = $return->orderBy('users.id', 'desc')
                        ->paginate(15);

        return $return;
    }

    static public function getSearchStudent(){
        if(!empty(Request::get('id')) || !empty(Request::get('name')) || !empty(Request::get('last_name')) || !empty(Request::get('email'))){
            $return = self::select('users.*', 'class.class_name as class_name', 'parent.name as parent_name')
                    ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                    ->join('class', 'class.id', '=', 'users.class_id')
                    ->where('users.role', '=', 3)
                    ->where('users.soft_delete', '=', 0);
        
            if(!empty(Request::get('id'))){
                $return = $return->where('users.id', '=', Request::get('id'));
            }
            if(!empty(Request::get('name'))){
                $return = $return->where('users.name', 'like', '%'.Request::get('name').'%');
            }
            if(!empty(Request::get('email'))){
                $return = $return->where('users.email', 'like', '%'.Request::get('email').'%');
            }
                        
            $return = $return->orderBy('users.id', 'desc')
                            ->limit(50)
                            ->get();
            return $return;
        }
    }

    static function getMyStudent($parent_id){
        $return = self::select('users.*', 'class.class_name as class_name', 'parent.name as parent_name')
                        ->join('users as parent', 'parent.id', '=', 'users.parent_id')
                        ->join('class', 'class.id', '=', 'users.class_id')
                        ->where('users.role', '=', 3)
                        ->where('users.parent_id', '=', $parent_id)
                        ->where('users.soft_delete', '=', 0)
                        ->orderBy('users.id', 'desc')
                        ->get();
        return $return;
    }

    static public function getTeacherStudent($teacher_id){
        $return = self::select('users.*', 'class.class_name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
                    ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')  
                    ->join('class', 'class.id', '=', 'users.class_id')
                    ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'class.id')
                    ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
                    ->where('assign_class_teacher.status', '=', 0)
                    ->where('assign_class_teacher.soft_delete', '=', 0)
                    ->where('users.role', '=', 3)
                    ->where('users.soft_delete', '=', 0);

        if(!empty(Request::get('name'))){
            $return = $return->where('users.name', 'like', '%'.Request::get('name').'%');
        }
        if(!empty(Request::get('class_name'))){
            $return = $return->where('class.class_name', 'like', '%'.Request::get('class_name').'%');
        }
                    
        $return = $return->orderBy('users.id', 'desc')
                        ->groupBy('users.id')
                        ->paginate(15);

        return $return;
    }

    static public function getStudentClass($class_id){
        return self::select('users.id', 'users.name', 'users.last_name')
                    ->where('users.role', '=', '3')
                    ->where('users.soft_delete', '=', '0')
                    ->where('users.class_id', '=', $class_id)
                    ->orderBy('users.id', 'desc')
                    ->get();
    }

    static public function getAttendance($student_id, $class_id, $attendance_date){
        return StudentAttendanceModel::CheckAlreadyAttendance($student_id, $class_id, $attendance_date);
    }   

    static public function getTotalUser($role){
        return self::select('users.id')
                    ->where('role', '=', $role)
                    ->where('soft_delete', '=', 0)
                    ->count();
    }

    static public function SearchUser($search){
        $return = self::select('users.*');
        $return = $return->where(function($query) use ($search){
                  $query->where('users.name', 'like', '%'.$search.'%')  
                  ->orwhere('users.last_name', 'like', '%'.$search.'%');        
                })
                ->limit(10)
                ->get();
        
        return $return;
    }

    static public function getUser($role){
        return self::select('users.*')
                    ->where('users.role', '=', $role)
                    ->where('users.soft_delete', '=', 0)
                    ->get();
    }

    static public function getTeacherStudentCount($teacher_id){
        $return = self::select('users.id')
                    ->join('class', 'class.id', '=', 'users.class_id')
                    ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'class.id')
                    ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
                    ->where('assign_class_teacher.status', '=', 0)
                    ->where('assign_class_teacher.soft_delete', '=', 0)
                    ->where('users.role', '=', 3)
                    ->where('users.soft_delete', '=', 0)
                    ->orderBy('users.id', 'desc')
                    ->groupBy('users.id')
                    ->count();

        return $return;
    }

    public function getImageDirect(){
        if(!empty($this->image) && file_exists('upload/profile/'.$this->image)){
            return url('upload/profile/'.$this->image);
        }
        else{
            return url('upload/profile/user.jpg');
        }
    }
}
