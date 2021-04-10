<?php

namespace App\Http\Controllers;

use Auth;
use App\Push;
use App\Message;
use App\MobilePushUsers;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $push = push::all();
        $users = MobilePushUsers::all();
        return view('communication')->with([ 'push' => $push, 'users' => $users ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chat()
    {
        $user = Auth::user();
        $messages = Message::where('from', $user->id)->orderBy('created_at', 'desc')->get()->unique('to');
        $chatList = Message::orWhere('from', $user->id)->orWhere('to', $user->id)->orderBy('created_at', 'asc')->get();
        return view('chat', ['messages' => $messages, 'chatList' => $chatList]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chatList($id)
    {
        $user = Auth::user();
        $messages = Message::where('from', $user->id)->where('to', $id)->orderBy('created_at', 'asc')->get();
        return view('chat', ['messages' => $messages]);
    }
}
