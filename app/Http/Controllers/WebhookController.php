<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\BlogPost;

class WebhookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    /**
     * Handle the incoming Dropbox webhook request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dropbox(Request $request)
    {
        $response = $request->input('challenge');
        return $response;
    }

    /**
     * Handle the incoming Dropbox webhook request data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dropboxData(Request $request)
    {
        $data = $request->request->get('data');
        DB::insert('insert into prueba (texto) values (?)', [json_encode($request->all())]);
    }   

    /**
     * Handle the incoming post blog data from wordpress site
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function blog(Request $request)
    {
        $data = $request->all();        
        $record = new BlogPost;
        $record->post_id = $data['post_id'];
        $record->post_author = $data['post']['post_author'];
        $record->post_date = $data['post']['post_date'];
        $record->post_content = $data['post']['post_content'];
        $record->post_title = $data['post']['post_title'];
        $record->post_status = $data['post']['post_status'];
        $record->post_name = $data['post']['post_name'];
        $record->post_thumbnail = $data['post_thumbnail'];
        $record->post_permalink = $data['post_permalink'];
        $record->save();
    }  
}
