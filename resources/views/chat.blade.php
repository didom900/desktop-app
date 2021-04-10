@extends('layouts.app')

@section('content')
<style>
    img{
      max-width:100%;
    }
    .inbox_people {
      background: #f8f8f8 none repeat scroll 0 0;
      float: left;
      overflow: hidden;
      width: 30%; border-right:1px solid #c4c4c4;
    }
    .inbox_msg {
      border: 1px solid #c4c4c4;
      clear: both;
      overflow: hidden;
    }
    .top_spac{ margin: 20px 0 0;}
    .recent_heading {float: left; width:40%;}
    .srch_bar {
      display: inline-block;
      text-align: right;
      width: 60%; padding:
    }
    .headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

    .recent_heading h4 {
      color: #151136;
      font-size: 21px;
      margin: auto;
    }
    .srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
    .srch_bar .input-group-addon button {
      background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
      border: medium none;
      padding: 0;
      color: #707070;
      font-size: 18px;
    }
    .srch_bar .input-group-addon { margin: 0 0 0 -27px;}

    .chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
    .chat_ib h5 span{ font-size:13px; float:right;}
    .chat_ib p{ font-size:14px; color:#989898; margin:auto}
    .chat_img {
      float: left;
      width: 11%;
    }
    .chat_ib {
      float: left;
      padding: 0 0 0 15px;
      width: 88%;
    }

    .chat_people{ overflow:hidden; clear:both;}
    .chat_list {
      border-bottom: 1px solid #c4c4c4;
      margin: 0;
      padding: 18px 16px 10px;
    }
    .chat_list:hover{
      cursor: pointer;
    }
    .inbox_chat { height: 550px; overflow-y: scroll;}

    .active_chat{ background:#ebebeb;}

    .incoming_msg_img {
      display: inline-block;
      width: 4%;
    }
    .received_msg {
      display: inline-block;
      padding: 0 0 0 10px;
      vertical-align: top;
      width: 92%;
    }
    .received_withd_msg p {
      background: #ebebeb none repeat scroll 0 0;
      border-radius: 3px;
      color: #646464;
      font-size: 14px;
      margin: 0;
      padding: 5px 10px 5px 12px;
      width: 100%;
    }
    .time_date {
      color: #747474;
      display: block;
      font-size: 12px;
      margin: 8px 0 0;
    }
    .received_withd_msg { width: 57%;}
    .mesgs {
      float: left;
      padding: 15px 0 0 15px;
      width: 70%;
    }

    .sent_msg p {
      background: #151136 none repeat scroll 0 0;
      border-radius: 3px;
      font-size: 14px;
      margin: 0; color:#fff;
      padding: 5px 10px 5px 12px;
      width:100%;
    }
    .outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
    .sent_msg {
      float: right;
      width: 46%;
    }
    .input_msg_write input {
      background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
      border: medium none;
      color: #4c4c4c;
      font-size: 15px;
      min-height: 48px;
      width: 100%;
    }

    .type_msg {border-top: 1px solid #c4c4c4;position: relative;}
    .msg_send_btn {
      background: #151136 none repeat scroll 0 0;
      border: medium none;
      border-radius: 50%;
      color: #fff;
      cursor: pointer;
      font-size: 17px;
      height: 33px;
      position: absolute;
      right: 0;
      top: 8px;
      width: 33px;
      margin-right: 10px;
    }
    .messaging {
      padding: 0;      
    }
    .msg_history {
      height: 516px;
      overflow-y: auto;
    }
    .system_msg {
      text-align: center;
      font-size: 10px;
      width: 100%;
    }
    .write_msg {
      background: white !important;
      padding-left: 10px;
      padding-right: 60px;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              <i class="fa fa-comments" aria-hidden="true"></i>
              Chat
            </h1>
          </div><!-- /.col -->
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div> /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="messaging">
            <div class="inbox_msg">
              <div class="inbox_people">
                <div class="headind_srch">
                  <div class="recent_heading">
                    <h4>Recent</h4>
                  </div>
                  <div class="srch_bar">
                    <div class="stylish-input-group">
                      <input type="text" class="search-bar" placeholder="Search" />
                      <span class="input-group-addon">
                        <button type="button">
                          <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="inbox_chat">
                    @foreach( $messages as $chat )
                        <div class="chat_list"><!-- active_chat -->
                            <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                            <div class="chat_ib">
                              <h5>{{ $chat->users->name }}<span class="chat_date">{{ $chat->created_at->format('j F, Y') }}</span></h5>
                              <p>{{ $chat->message }}</p>
                            </div>
                            </div>
                        </div>
                    @endforeach                                    
                </div>
              </div>
              <div class="mesgs">
                <div class="msg_history">
                  @foreach( $chatList as $list )
                    @if( $list->from == auth()->user()->id )
                    <div class="incoming_msg">
                      <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                      <div class="received_msg my-2">
                        <div class="received_withd_msg">
                          <p>{{ $list->message }}</p>
                          <span class="time_date"> {{ $list->created_at->format('H:i:s') }}    |    {{ $list->created_at->format('j F') }}</span></div>
                      </div>
                    </div>
                    @else
                    <div class="outgoing_msg">
                      <div class="sent_msg">
                        <p>{{ $list->message }}</p>
                        <span class="time_date"> {{ $list->created_at->format('H:i:s') }}    |    {{ $list->created_at->format('j F') }}</span></div>
                    </div>
                    @endif
                  @endforeach
                </div>
                <div class="type_msg">
                  <div class="input_msg_write">
                    <input id="newmessage" type="text" class="write_msg" placeholder="Type a message" />
                    <button class="msg_send_btn" type="button" onclick="typeMessage(document.getElementById('newmessage').value)">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
                        
          </div>
    </section>
    <!-- /.content -->
  </div>
  <script src="{{asset('js/app.js')}}"></script>
  <script>
    $(".nav-sidebar li:eq(1)").addClass('menu-open');
    $(".nav-sidebar li:eq(1) ul li:eq(1) a").addClass('active');
    var auth = {!! auth()->user()->id !!};
    var wsUri = `ws://qqv.oex.mybluehost.me:8080/agent/${auth}`;

    function init()
    {
      output = document.getElementById("output");
      testWebSocket();
    }

    function testWebSocket()
    {
      websocket1 = new WebSocket(wsUri);
      websocket1.onopen = function(evt) { onOpen(evt) };
      websocket1.onclose = function(evt) { onClose(evt) };
      websocket1.onmessage = function(evt) { onMessage(evt) };
      websocket1.onerror = function(evt) { onError(evt) };
    }

    function onOpen(evt)
    {
      var prueba = {
          message : 'Agent Conected',
      };
      doSend(JSON.stringify(prueba));
    }

    function onMessage(evt)
    {      
      var response = JSON.parse(evt.data);    
      addMessageDisplay(response, response.type);
    }

    function doSend(message)
    {
      websocket1.send(message);
    }

    function onError(evt)
    {
      console.log(evt.data);
    }

    function typeMessage(value){      
      var data = {
        message: value,
      }
      addMessageDisplay(data, 'AGENT');
      var message = {
          type : 'Agent',
          command : 'MESSAGE',
          message : value
      };
      doSend(JSON.stringify(message));
      document.getElementById('newmessage').value = '';
    }

    function addMessageDisplay(data, where){
      var html;
      switch(where){
        case 'CLIENT':
          html = '<div class="outgoing_msg">'+
                    '<div class="sent_msg">'+
                      '<p>'+data.message+'</p>'+
                      '<span class="time_date">'+moment().format("HH:mm:ss      |      D MMMM, YYYY")+'</span></div>'+
                  '</div>';
        break;
        case 'AGENT':
          html = '<div class="incoming_msg">'+
                    '<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>'+
                    '<div class="received_msg my-2">'+
                      '<div class="received_withd_msg">'+
                        '<p>'+data.message+'</p>'+
                        '<span class="time_date">'+moment().format("HH:mm:ss      |      D MMMM, YYYY")+'</span></div>'+
                    '</div>'+
                  '</div>';
        break;
        case 'SYSTEM':
        html = '<div class="system_msg">'+
                  '<div class="msg_msg">'+
                    '<p>'+data.message+'</p>'+
                    '<span class="time_date">'+moment().format("HH:mm:ss      |      D MMMM, YYYY")+'</span></div>'+
                '</div>';
        break;
      }
      $('.msg_history').append(html);
      $(".msg_history").animate({ scrollTop: 1000 }, "fast");
    }

    window.addEventListener("load", init, false);
    
  </script>
@endsection
