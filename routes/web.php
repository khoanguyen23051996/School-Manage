<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\ClassController;
use App\Http\Controllers\backend\ClassSubjectController;
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

    //Change Password
    Route::get('admin/change_password', [UserController::class, 'index'])->name('admin.change_password');
    Route::post('admin/change_password', [UserController::class, 'store'])->name('admin.change_password.store');
    //End Change Password
});


Route::group(['middleware' => 'teacher'], function(){
    Route::get('teacher/dashboard', [DashboardController::class, 'index'])->name('teacher.dashboard');

    //Change Password
    Route::get('teacher/change_password', [UserController::class, 'index'])->name('teacher.change_password');
    Route::post('teacher/change_password', [UserController::class, 'store'])->name('teacher.change_password.store');
    //End Change Password
});


Route::group(['middleware' => 'student'], function(){
    Route::get('student/dashboard', [DashboardController::class, 'index'])->name('student.dashboard');

    //Change Password
    Route::get('student/change_password', [UserController::class, 'index'])->name('student.change_password');
    Route::post('student/change_password', [UserController::class, 'store'])->name('student.change_password.store');
    //End Change Password

});


Route::group(['middleware' => 'parent'], function(){
    Route::get('parent/dashboard', [DashboardController::class, 'index'])->name('parent.dashboard');

    //Change Password
    Route::get('parent/change_password', [UserController::class, 'index'])->name('parent.change_password');
    Route::post('parent/change_password', [UserController::class, 'store'])->name('parent.change_password.store');
    //End Change Password
});