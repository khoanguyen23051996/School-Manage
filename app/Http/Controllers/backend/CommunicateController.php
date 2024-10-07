<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Mail\SendEmailUser;
use App\Models\NoticeBoardMessageModel;
use App\Models\NoticeBoardModel;
use App\Models\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer as MailMailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommunicateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function NoticeBoard()
    {
        $data['getRecord'] = NoticeBoardModel::getRecord();

        return view('admin.pages.communicate.notice_board.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function NoticeBoard_create()
    {
        return view('admin.pages.communicate.notice_board.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function NoticeBoard_store(Request $request)
    {
        $save = new NoticeBoardModel();
        $save->title = $request->title;
        $save->notice_date = $request->notice_date;
        $save->publish_date = $request->publish_date;
        $save->message = $request->message;
        $save->created_by = Auth::user()->id;
        $save->save();

        if(!empty($request->message_to)){
            foreach($request->message_to as $message_to){
                $message = new NoticeBoardMessageModel();
                $message->notice_board_id = $save->id;
                $message->message_to = $message_to;
                $message->save();
            }
        }

        return redirect()->route('admin.communicate.notice_board')->with('success', 'Created Notice Board Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['getRecord'] = NoticeBoardModel::find($id);

        return view('admin.pages.communicate.notice_board.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $save = NoticeBoardModel::find($id);
        $save->title = $request->title;
        $save->notice_date = $request->notice_date;
        $save->publish_date = $request->publish_date;
        $save->message = $request->message;
        $save->created_by = Auth::user()->id;
        $save->save();

        NoticeBoardMessageModel::DeleteRecord($id);

        if(!empty($request->message_to)){
            foreach($request->message_to as $message_to){
                $message = new NoticeBoardMessageModel();
                $message->notice_board_id = $save->id;
                $message->message_to = $message_to;
                $message->save();
            }
        }

        return redirect()->route('admin.communicate.notice_board')->with('success', 'Updated Notice Board Successfully');
    }

    public function destroy(string $id)
    {
        $save = NoticeBoardModel::find($id);
        $save->delete();

        NoticeBoardMessageModel::DeleteRecord($id);

        return redirect()->route('admin.communicate.notice_board')->with('success', 'Deleted Notice Board Successfully');
    }

    public function Notice_boardStudent(){
        $data['getRecord'] = NoticeBoardModel::getRecordUser(Auth::user()->role);

        return view('student.pages.notice_board.index', $data);
    }

    public function Notice_boardTeacher(){
        $data['getRecord'] = NoticeBoardModel::getRecordUser(Auth::user()->role);

        return view('teacher.pages.notice_board.index', $data);
    }

    public function Notice_boardParent(){
        $data['getRecord'] = NoticeBoardModel::getRecordUser(Auth::user()->role);

        return view('parent.pages.notice_board.index', $data);
    }

    public function SendEmail(){
        $data['getRecord'] = NoticeBoardModel::getRecord();

        return view('admin.pages.communicate.notice_board.send_email', $data);
    }

    public function SearchUser(Request $request){
        $json = array();
        if(!empty($request->search)){
            $getUser = User::SearchUser($request->search);
            foreach($getUser as $value){
                $type = '';

                if($value->role == 1){
                    $type = 'Admin';
                }
                else if($value->role == 2){
                    $type = 'Teacher';
                }
                else if($value->role == 3){
                    $type = 'Student';
                }
                else if($value->role == 4){
                    $type = 'Parent';
                }

                $name = $value->name. ' - '. $type;
                $json[] = ['id'=>$value->id, 'text'=>$name];
            }
        }
        
        echo json_encode($json);
    }

    public function SendEmailUser(Request $request){
        if(!empty($request->user_id)){
            $user = User::find($request->user_id);
            $user->send_message = $request->message;
            $user->send_subject = $request->subject;

            Mail::to($user->email)->send(new SendEmailUser($user));
        }

        if(!empty($request->message_to)){
            foreach($request->message_to as $role){
                $getUser = User::getUser($role);
                foreach ($getUser as $user){
                    $user->send_message = $request->message;
                    $user->send_subject = $request->subject;

                    Mail::to($user->email)->send(new SendEmailUser($user));
                }
            }
        }
        return redirect()->back()->with('success', 'Send Mail Successfully!');
    }
}
