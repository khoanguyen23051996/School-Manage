<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AssignClassTeacher;
use App\Http\Controllers\backend\AssignClassTeacherController;
use App\Http\Controllers\backend\AttendanceController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\CalendarController;
use App\Http\Controllers\backend\ChatController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\ClassController;
use App\Http\Controllers\backend\ClassSubjectController;
use App\Http\Controllers\backend\ClassTimeTableController;
use App\Http\Controllers\backend\CommunicateController;
use App\Http\Controllers\backend\ParentController;
use App\Http\Controllers\backend\StudentController;
use App\Http\Controllers\backend\SubjectController;
use App\Http\Controllers\backend\TeacherController;
use App\Http\Controllers\backend\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('auth_login', [AuthController::class, 'authLogin'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('forgot_password', [AuthController::class, 'forgot_password'])->name('forgot_password');
Route::post('auth_forgot_password', [AuthController::class, 'authForgot_password'])->name('auth.forgot_password');
Route::get('reset/{token}', [AuthController::class, 'reset'])->name('reset');
Route::post('reset/{token}', [AuthController::class, 'post_reset'])->name('auth.reset');



Route::group(['middleware' => 'common'], function(){
    Route::get('chat', [ChatController::class, 'chat'])->name('chat');
    Route::post('submit_message', [ChatController::class, 'submit_message'])->name('submit_message');
});


Route::group(['middleware' => 'admin'], function(){
    //Dashboard
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    //End Dashboard

    //Admin
    Route::get('admin/admin', [AdminController::class, 'index'])->name('admin.admin');
    Route::get('admin/admin/create', [AdminController::class, 'create'])->name('admin.admin.create');
    Route::post('admin/admin/store', [AdminController::class, 'store'])->name('admin.admin.store');
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.admin.edit');
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update'])->name('admin.admin.update');
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.admin.delete');
    //End Admin

    //Teacher
    Route::get('admin/teacher', [TeacherController::class, 'index'])->name('admin.teacher');
    Route::get('admin/teacher/create', [TeacherController::class, 'create'])->name('admin.teacher.create');
    Route::post('admin/teacher/store', [TeacherController::class, 'store'])->name('admin.teacher.store');
    Route::get('admin/teacher/edit/{id}', [TeacherController::class, 'edit'])->name('admin.teacher.edit');
    Route::post('admin/teacher/edit/{id}', [TeacherController::class, 'update'])->name('admin.teacher.update');
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'destroy'])->name('admin.teacher.delete');
    //End Teacher

    //Student
    Route::get('admin/student', [StudentController::class, 'index'])->name('admin.student');
    Route::get('admin/student/create', [StudentController::class, 'create'])->name('admin.student.create');
    Route::post('admin/student/store', [StudentController::class, 'store'])->name('admin.student.store');
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit'])->name('admin.student.edit');
    Route::post('admin/student/edit/{id}', [StudentController::class, 'update'])->name('admin.student.update');
    Route::get('admin/student/delete/{id}', [StudentController::class, 'destroy'])->name('admin.student.delete');
    //End Student

    //Parent
    Route::get('admin/parent', [ParentController::class, 'index'])->name('admin.parent');
    Route::get('admin/parent/create', [ParentController::class, 'create'])->name('admin.parent.create');
    Route::post('admin/parent/store', [ParentController::class, 'store'])->name('admin.parent.store');
    Route::get('admin/parent/edit/{id}', [ParentController::class, 'edit'])->name('admin.parent.edit');
    Route::post('admin/parent/edit/{id}', [ParentController::class, 'update'])->name('admin.parent.update');
    Route::get('admin/parent/delete/{id}', [ParentController::class, 'destroy'])->name('admin.parent.delete');
    Route::get('admin/parent/my-student/{id}', [ParentController::class, 'myStudent'])->name('admin.parent.my-student');
    Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class, 'AssignStudentParent'])->name('admin.parent.assign_student_parent');
    Route::get('admin/parent/assign_student_parent_delete/{parent_id}', [ParentController::class, 'AssignStudentParentDelete'])->name('admin.parent.assign_student_parent_delete');
    //End Parent

    //Class
    Route::get('admin/class', [ClassController::class, 'index'])->name('admin.class');
    Route::get('admin/class/create', [ClassController::class, 'create'])->name('admin.class.create');
    Route::post('admin/class/store', [ClassController::class, 'store'])->name('admin.class.store');
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit'])->name('admin.class.edit');
    Route::post('admin/class/edit/{id}', [ClassController::class, 'update'])->name('admin.class.update');
    Route::get('admin/class/delete/{id}', [ClassController::class, 'destroy'])->name('admin.class.delete');
    //End Class

    //Subject
    Route::get('admin/subject', [SubjectController::class, 'index'])->name('admin.subject');
    Route::get('admin/subject/create', [SubjectController::class, 'create'])->name('admin.subject.create');
    Route::post('admin/subject/store', [SubjectController::class, 'store'])->name('admin.subject.store');
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit'])->name('admin.subject.edit');
    Route::post('admin/subject/edit/{id}', [SubjectController::class, 'update'])->name('admin.subject.update');
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'destroy'])->name('admin.subject.delete');
    //End Subject

    //Assign Subject
    Route::get('admin/assign_subject', [ClassSubjectController::class, 'index'])->name('admin.assign_subject');
    Route::get('admin/assign_subject/create', [ClassSubjectController::class, 'create'])->name('admin.assign_subject.create');
    Route::post('admin/assign_subject/store', [ClassSubjectController::class, 'store'])->name('admin.assign_subject.store');
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit'])->name('admin.assign_subject.edit');
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'update'])->name('admin.assign_subject.update');
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'destroy'])->name('admin.assign_subject.delete');
    //End Assign Subject

    //Assign Class Teacher
    Route::get('admin/assign_class_teacher', [AssignClassTeacherController::class, 'index'])->name('admin.assign_class_teacher');
    Route::get('admin/assign_class_teacher/create', [AssignClassTeacherController::class, 'create'])->name('admin.assign_class_teacher.create');
    Route::post('admin/assign_class_teacher/store', [AssignClassTeacherController::class, 'store'])->name('admin.assign_class_teacher.store');
    Route::get('admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'edit'])->name('admin.assign_class_teacher.edit');
    Route::post('admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'update'])->name('admin.assign_class_teacher.update');
    //End Assign Class Teacher

    //Class Time Table
    Route::get('admin/class_timetable', [ClassTimeTableController::class, 'index'])->name('admin.class_timetable');
    Route::post('admin/class_timetable/get_subject', [ClassTimeTableController::class, 'get_subject'])->name('admin.class_timetable.get_subject');
    Route::post('admin/class_timetable/add', [ClassTimeTableController::class, 'insert_update'])->name('admin.class_timetable.add');
    //End Class Time Table

    //Attendance
    Route::get('admin/attendance/student', [AttendanceController::class, 'AttendanceStudent'])->name('admin.attendance.student');
    Route::post('admin/attendance/student/save', [AttendanceController::class, 'AttendanceStudentSave'])->name('admin.attendance.student.save');
    Route::get('admin/attendance/report', [AttendanceController::class, 'AttendanceReport'])->name('admin.attendance.report');
    //End Attendance

    //Communicate
    Route::get('admin/communicate/notice_board', [CommunicateController::class, 'NoticeBoard'])->name('admin.communicate.notice_board');
    Route::get('admin/communicate/notice_board/create', [CommunicateController::class, 'NoticeBoard_create'])->name('admin.communicate.notice_board.create');
    Route::post('admin/communicate/notice_board/store', [CommunicateController::class, 'NoticeBoard_store'])->name('admin.communicate.notice_board.store');
    Route::get('admin/communicate/notice_board/edit/{id}', [CommunicateController::class, 'edit'])->name('admin.communicate.notice_board.edit');
    Route::post('admin/communicate/notice_board/edit/{id}', [CommunicateController::class, 'update'])->name('admin.communicate.notice_board.update');
    Route::get('admin/communicate/notice_board/delete/{id}', [CommunicateController::class, 'destroy'])->name('admin.communicate.notice_board.delete');
    //End Communicate

    //Send Email
    Route::get('admin/communicate/send_email', [CommunicateController::class, 'SendEmail'])->name('admin.communicate.send_email');
    Route::post('admin/communicate/send_email', [CommunicateController::class, 'SendEmailUser'])->name('admin.communicate.send_email');
    Route::get('admin/communicate/search_user', [CommunicateController::class, 'SearchUser'])->name('admin.communicate.search_user');
    //End Send Email

    //My Account
    Route::get('admin/my_account', [UserController::class, 'my_account'])->name('admin.my_account');
    Route::post('admin/my_account', [UserController::class, 'update_my_account_admin'])->name('admin.update_my_account');
    //End My Account

    //Change Password
    Route::get('admin/change_password', [UserController::class, 'change_password'])->name('admin.change_password');
    Route::post('admin/change_password', [UserController::class, 'update_change_password'])->name('admin.change_password.store');
    //End Change Password
});


Route::group(['middleware' => 'teacher'], function(){
    Route::get('teacher/dashboard', [DashboardController::class, 'index'])->name('teacher.dashboard');

    //My Student
    Route::get('teacher/my_student', [StudentController::class, 'myStudent'])->name('teacher.my_student');
    Route::post('teacher/my_account', [UserController::class, 'update_my_account_teacher'])->name('teacher.update_my_account');
    //End Student

    //My Class & Subject
    Route::get('teacher/my_class_subject', [AssignClassTeacherController::class, 'MyClassSubject'])->name('teacher.my_class_subject');
    Route::get('teacher/my_class_subject/class_timetable/{class_id}/{subject_id}', [ClassTimeTableController::class, 'myTimeTableTeacher'])->name('teacher.my_class_subject.class_timetable');
    //End My Class & Subject

    //My Calendar
    Route::get('teacher/calendar', [CalendarController::class, 'CalendarTeacher'])->name('teacher.my_calendar');
    //End Calendar

    //Attendance
    Route::get('teacher/attendance/student', [AttendanceController::class, 'AttendanceStudentTeacher'])->name('teacher.attendance.student');
    Route::post('teacher/attendance/student/save', [AttendanceController::class, 'AttendanceStudentSave'])->name('teacher.attendance.student.save');
    Route::get('teacher/attendance/report', [AttendanceController::class, 'AttendanceReportTeacher'])->name('teacher.attendance.report');
    //End Attendance

    //Notice board
    Route::get('teacher/notice_board', [CommunicateController::class, 'Notice_boardTeacher'])->name('teacher.notice_board');
    //End Notice board

    //My Account
    Route::get('teacher/my_account', [UserController::class, 'my_account'])->name('teacher.my_account');
    Route::post('teacher/my_account', [UserController::class, 'update_my_account_teacher'])->name('teacher.update_my_account');
    //End My Account

    //Change Password
    Route::get('teacher/change_password', [UserController::class, 'change_password'])->name('teacher.change_password');
    Route::post('teacher/change_password', [UserController::class, 'update_change_password'])->name('teacher.change_password.store');
    //End Change Password
});


Route::group(['middleware' => 'student'], function(){
    Route::get('student/dashboard', [DashboardController::class, 'index'])->name('student.dashboard');
    
    //My Account
    Route::get('student/my_account', [UserController::class, 'my_account'])->name('student.my_account');
    Route::post('student/my_account', [UserController::class, 'update_my_account_student'])->name('student.update_my_account');
    //End My Account

    //My Subject
    Route::get('student/my_subject', [SubjectController::class, 'mySubject'])->name('student.my_subject');
    //End My Subject

    //My TimeTable
    Route::get('student/my_timetable', [ClassTimeTableController::class, 'myTimeTable'])->name('student.my_timetable');
    //End My TimeTable

    //My Calendar
    Route::get('student/my_calendar', [CalendarController::class, 'myCalendar'])->name('student.my_calendar');
    //End My Calendar

    //My Attendance
    Route::get('student/my_attendance', [AttendanceController::class, 'MyAttendanceStudent'])->name('student.my_attendance');
    //End My Attendance

    //Notice board
    Route::get('student/notice_board', [CommunicateController::class, 'Notice_boardStudent'])->name('student.notice_board');
    //End Notice board
   

    //Change Password
    Route::get('student/change_password', [UserController::class, 'change_password'])->name('student.change_password');
    Route::post('student/change_password', [UserController::class, 'update_change_password'])->name('student.change_password.store');
    //End Change Password


});


Route::group(['middleware' => 'parent'], function(){
    Route::get('parent/dashboard', [DashboardController::class, 'index'])->name('parent.dashboard');

    //My Student
    Route::get('parent/my_student', [ParentController::class, 'myStudentParent'])->name('parent.my_student');
    Route::get('parent/my_student/subject/{student_id}', [SubjectController::class, 'ParentStudentSubject'])->name('parent.my_student.subject');
    Route::get('parent/my_student/subject/class_timetable/{class_id}/{subject_id}/{student_id}', [ClassTimeTableController::class, 'myTimeTableParent'])->name('parent.my_student.subject.class_timetable');
    Route::get('parent/my_student/calendar/{student_id}', [CalendarController::class, 'CalendarParent'])->name('parent.my_student.calendar');
    Route::get('parent/my_student/attendance/{student_id}', [AttendanceController::class, 'AttendanceParent'])->name('parent.my_student.attendance');
    //End My Student

    //Notice board
    Route::get('parent/notice_board', [CommunicateController::class, 'Notice_boardParent'])->name('parent.notice_board');
    //End Notice board
    
    //My Account
    Route::get('parent/my_account', [UserController::class, 'my_account'])->name('parent.my_account');
    Route::post('parent/my_account', [UserController::class, 'update_my_account_parent'])->name('parent.update_my_account');
    //End My Account

    //Change Password
    Route::get('parent/change_password', [UserController::class, 'change_password'])->name('parent.change_password');
    Route::post('parent/change_password', [UserController::class, 'store'])->name('parent.change_password.store');
    //End Change Password

});