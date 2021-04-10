<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Cases;
use App\Staff;
use Validator;
use App\Communication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cases = cases::all();
        return view('cases')->with([ 'cases' => $cases ]);
    }

    /**
     * Reload ajax data of cases to datatables
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax()
    {
        $cases = cases::all();        
        $data = array(
            'data' => $cases
        );
        return $data;
    }

    /**
     * Display a listing of the resource of specific id.
     *
     * @return \Illuminate\Http\Response
     */
    public function caseId($id)
    {
        $case = cases::find($id);
        $case_communication = $case->communication;      
        foreach( $case_communication as $index => $value ){
            $case_communication[$index]['from'] = user::find($value->from);
        }
        $case['communication'] = $case_communication;
        $data = array(
            'data' => $case,
            'result' => true
        );
        echo json_encode($data);
    }

    /**
     * Display a listing of the resource of specific id.
     *
     * @return \Illuminate\Http\Response
     */
    public function message(Request $request)
    {        
        $data = $request->all();
        $user = Staff::where('id_user', $data['user'])->first();     
        $record = new Communication;
        $record->cases_id = $data['case'];
        $record->from = $user->id_mycase;
        $record->from_name = $user->name;
        $record->message =  $data['message'];
        $record->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function show(cases $cases)
    {        
        $find = User::where('id', Auth::id())->first();
        $user = strtolower($find->name);
        $cases = cases::where('name', 'like', '%'.$user.'%')->get();
        if( !$cases ){
            $data = array(
                'error' => true,
                'message' => 'No records found!'
            );
            
        } else {
            return $cases;       
        }     
        //echo json_encode($data);
    }

    /**
     * Upload file to dropbox.
     *
     * @param  \App\cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function uploadFile(Request $request)
    {
        $data = $request->all();        
        $validator = Validator::make($request->all(),
        [
            'user_id' => 'required',
            'path' => 'required',
            'file' => 'required',
        ]);
 
        if ($validator->fails()) {          
            return response()->json(['error'=>$validator->errors()], 401);
        }
  
        if ($files = $request->file('file')) {
             
            //store file into document folder
            $file = $request->file->store('public/documents');                          

            $api_url = 'https://content.dropboxapi.com/2/files/upload';
            $token = "Authorization: Bearer ".env('DROPBOX_TOKEN')."";       

            $headers = array($token,
                'Content-Type: application/octet-stream',
                'Dropbox-API-Arg: '.
                json_encode(
                    array(
                        "path"=> '/MyCase/Cases/'.$data['path'].'/'. basename($file),                        
                        "mode" => "add",
                        "autorename" => false,
                        "mute" => false
                    )
                )

            );

            $ch = curl_init($api_url);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, true);
            
            $fp = fopen(Storage::path($file), 'rb');            
            $filesize = Storage::size($file);

            curl_setopt($ch, CURLOPT_POSTFIELDS, fread($fp, $filesize));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                        

            try {
                $response = curl_exec($ch);
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                
                return response()->json([
                    "success" => true,
                    "message" => "File successfully uploaded",
                    "file" => $file
                ]);

            } catch (Exception $e) {
                return response()->json([
                    "success" => false,
                    "message" => $e->getMessage(),
                ]);
            }

            curl_close($ch);
  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function files($case)
    {
        $folder;
        $files_name;
        $query = $case;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.dropboxapi.com/2/files/search_v2");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"query\": \"".$query."\",\"options\": {\"path\": \"/MyCase\",\"max_results\": 1,\"file_status\": \"active\",\"filename_only\": false},\"match_field_options\": {\"include_highlights\": false}}");
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
        
        $json = json_decode($result, true);
        
        //print_r($json['matches'][0]['metadata']['metadata']['name']);
        //die();

        if( isset($json['matches'][0]['metadata']['metadata']['name']) ){
            /* Searching inside folder */
                $chh = curl_init();

                curl_setopt($chh, CURLOPT_URL, "https://api.dropboxapi.com/2/files/list_folder");
                curl_setopt($chh, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($chh, CURLOPT_CAINFO, "cacert.pem");
                curl_setopt($chh, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($chh, CURLOPT_SSL_VERIFYPEER, 0);        
                curl_setopt($chh, CURLOPT_POSTFIELDS, "{\"path\":\"".$json['matches'][0]['metadata']['metadata']['path_display']."\", \"recursive\": true}");        
                curl_setopt($chh, CURLOPT_POST, 1);

                $headerss = array();
                $headerss[] = "Authorization: Bearer ".env('DROPBOX_TOKEN')."";
                $headerss[] = "Content-Type: application/json";
                curl_setopt($chh, CURLOPT_HTTPHEADER, $headerss);

                $resultt = curl_exec($chh);
                if (curl_errno($chh)) {            
                    echo 'Error:' . curl_error($chh);
                }
                curl_close ($chh);              
                
                $count = 0;
                $jsonn = json_decode($resultt, true);                
                foreach ($jsonn['entries'] as $datas) {
                    if( $datas['.tag'] == 'file' ){                        
                        $folder['files'][$count] = array(
                            'id' => $datas['id'],
                            'name' => $datas['name'],
                            'size' => $datas['size'],
                            'path_display' => $datas['path_display']
                        );
                        $count++;
                    }                    
                }
            /* End Searching inside folder */
            $folder['folder'] = array(
                'tag' => $json['matches'][0]['metadata']['metadata']['.tag'],
                'id' => $json['matches'][0]['metadata']['metadata']['id'],
                'name' => $json['matches'][0]['metadata']['metadata']['name'],
                'path' => $json['matches'][0]['metadata']['metadata']['path_display']
            );

            if( isset($folder['files']) ){
                foreach( $folder['files'] as $link => $files ){
                    /* Temp Link of files */
                    $ch3 = curl_init();
                    curl_setopt($ch3, CURLOPT_URL, "https://api.dropboxapi.com/2/files/get_temporary_link");
                    curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);        
                    curl_setopt($ch3, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, 0);        
                    curl_setopt($ch3, CURLOPT_POSTFIELDS, "{\"path\":\"".$files['path_display']."\"}");
                    curl_setopt($ch3, CURLOPT_POST, 1);
            
                    $headers3 = array();
                    $headers3[] = "Authorization: Bearer ".env('DROPBOX_TOKEN')."";
                    $headers3[] = "Content-Type: application/json";
                    curl_setopt($ch3, CURLOPT_HTTPHEADER, $headers3);
            
                    $result3 = curl_exec($ch3);
                    if (curl_errno($ch3)) {
                        echo 'Error:' . curl_error($ch3);
                    }
                    curl_close ($ch3); 
                    $json3 = json_decode($result3, true);
                    $folder['files'][$link]['url'] = $json3['link'];

                    /* End temp link of files. */
                }
            } else {
                return response()->json(['error' => 'Not Found!'], 404);
            }

            if( isset($folder) ){
                echo json_encode(array(
                    'error' => false,
                    'data' => $folder
                ));
            }

        } else {
            return response()->json(['error' => 'Not Found!'], 404);
        }
    }

}
