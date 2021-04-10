<?php

namespace App\Http\Controllers;

use App\Referal;
use App\Support;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReferCLients;
use Illuminate\Http\Request;

use Spatie\Dropbox\Client;
use Spatie\Dropbox\Exceptions\BadRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function get_temporary_link(){        

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.dropboxapi.com/2/files/get_temporary_link");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"path\":\"/MyCase/Cases/D-10043-20 Amr Farag/calculator-1044172_1280.jpg\"}");
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Authorization: Bearer ".env('DROPBOX_TOKEN')."";
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);

        print_r($result);
        die();
        
        $json = json_decode($result, true);
        foreach ($json['entries'] as $data) {
            //echo $data['.tag'] . ' : ' . 'File Name: ' . $data['name'] . '<br>';
            print_r($data);
        }
 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list_folder()
    {        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.dropboxapi.com/2/files/list_folder");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CAINFO, "cacert.pem");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"path\":\"/MyCase/Cases/D-10043-20 Amr Farag\", \"recursive\": true}");        
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Authorization: Bearer sl.AsNPpJY6xvybh9XojeKGHYuP-QOA56wjanKkpYxtx_lux9daPkunK_yVN2TIHYnjgTyZXVenx-YYWT_Qi2w-AkZPwLOPp3QgmPiFwe8IpkeqCi2_AN-aVzI1ot4KSsJ5aoSMQQxAtZM";
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {            
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);

        /*print_r($result);
        die();*/
        
        $json = json_decode($result, true);
        foreach ($json['entries'] as $data) {
            //echo $data['.tag'] . ' : ' . 'File Name: ' . $data['name'] . '<br>';
            print_r($data);
        }
        //return view('home');
    }

    /**
     * Send message and save records of referals.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function referal(Request $request)
    {
        $data = $request->all();      
        if (filter_var($data['phone_or_email'], FILTER_VALIDATE_EMAIL)) {
            $record = new Referal;
            $record->from = $data['from'];
            $record->name = $data['name'];
            $record->phone_or_email = filter_var($data['phone_or_email'], FILTER_VALIDATE_EMAIL);
            $record->save();
            /* Send Email To Referal */
            $template_path = 'emails/refer';
            $name = $data['name'];
            $email = filter_var($data['phone_or_email'], FILTER_VALIDATE_EMAIL);

            Mail::send(['html'=> $template_path ], $data, function($message) use ($email, $name) {              
                $message->to($email, $name)->subject('Motion Law Inmigration Group');
                $message->from('diego@motionlaw.com', $name . ' has introduced you to Motion Law.');
            });

            $data = array (
                'error' => false,
                'code' => 200,
                'message' => 'Mail has been sent!'
            );
            echo json_encode($data);
        } else {
            $data = array (
                'error' => true,
                'code' => 400,
                'message' => 'Only allowed emails to invite people'
            );
            echo json_encode($data);
        }        
    }

    /**
     * Save and notify message to support
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function support(Request $request)
    {
        $data = $request->all();
        if( $data['message'] != '' ){
            $record = new Support;
            $record->from = $data['from'];
            $record->message = $data['message'];
            $record->device = $data['device'];
            $saved = $record->save();

            if( $saved == 1 ){
                $data = array (
                    'error' => false,
                    'code' => 200,
                    'message' => 'Message sent successfully!'
                );
            } else {
                $data = array (
                    'error' => true,
                    'code' => 500,
                    'message' => 'Error in procedure!'
                );
            }
            echo json_encode($data);
        }
    }
}
