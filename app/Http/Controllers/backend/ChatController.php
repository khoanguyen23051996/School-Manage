<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ChatModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chat(Request $request){
    $sender_id = Auth::user()->id;

    $data = [];

    if (!empty($request->receiver_id)) {
        $receiver_id = base64_decode($request->receiver_id);
        if ($receiver_id == $sender_id) {
            return redirect()->back()->with('error', 'Error, Please try again!');
        }

        $data['getReceiver'] = User::getSingle($receiver_id);
        $data['getChat'] = ChatModel::getChat($receiver_id, $sender_id);
    }

    $data['getChatUser'] = ChatModel::getChatUser($sender_id);

    return view('chat.index', $data);
    }

    
    public function submit_message(Request $request)
    {
        $chat = new ChatModel();
        $chat->sender_id = Auth::user()->id;
        $chat->receiver_id = $request->receiver_id;
        $chat->message = $request->message;
        $chat->created_date = time();
        $chat->save();

        $getChat = ChatModel::where('id', '=', $chat->id)->get();

        return response()->json([
            "status" => true,
            "success" => view('chat._single', [
                "getChat" =>$getChat
            ])->render(),
        ], 200);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
