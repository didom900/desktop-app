<?php

namespace App\Http\Controllers;

use App\User;
use App\Staff;
use App\Clients;
use App\StaffContact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::all();        
        return view('staff')->with([ 'staff' => $staff ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clients()
    {
        $clients = Clients::all();        
        return view('clients')->with([ 'clients' => $clients ]);
    }

    /**
     * Display a listing of Staff motion Law members.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $staff = Staff::all();        
        return $staff;
    }

    /**
     * Store and send message and notificacion to staff member.
     *
     * @return \Illuminate\Http\Response
     */
    public function newMessage(Request $request)
    {
        $data = $request->all();
        $message = new StaffContact;
        $message->staff_id = $data['staff_id'];
        $message->user_from = $data['user_from'];
        $message->subject = $data['subject'];
        $message->message = $data['message'];
        $message->status = 'pending';
        $message->save();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
        //$clients = Clients::all();
        $data = array(
            'name' => 'Diego',
            'email' => 'Diego@gmail.com',
            'password' => '123456789'
        );
        return view('emails/inviteClient')->with(['data' => $data]);
    }

    /**
     * Invite client to download app mobile
     *
     * @return \Illuminate\Http\Response
     */
    public function clientsInvite(Request $request)
    {
        $input = $request->all();
        $client = Clients::where('id', $input['email'])->first();
        if( !User::where('email', $client->email)->exists() ){            
            $pass = uniqid();
            $user = new User;
            $user->name = $client->first_name . ' ' . $client->last_name;
            $user->email = $client->email;
            $user->password = bcrypt($pass);
            $user->remember_token = 1;        

            $email = $client->email;
            $name = $client->first_name . ' ' . $client->last_name;            
            if ( $user->save() ) {
                $data = array(
                    'name' => $name,
                    'email' => $email, 
                    'password' => $pass
                );
                
                $template_path = 'emails/inviteClient';

                Mail::send(['html'=> $template_path ], $data, function($message) use ($email, $name) {
                    $message->to($email, $name)->subject('Download Our App from Mobile Store');
                    $message->from('diego@motionlaw.com', 'Motion Law Inmigration Group');
                });

            } else {
                $response = array(
                    'error' => true,
                    'message' => 'Error has ocurred in system.'
                );
                echo json_encode($response);
            }
        } else {
            $response = array(
                'error' => true,
                'message' => 'The client already was invited!'
            );
            echo json_encode($response);
        }        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
