@extends('layouts.app')

@section('content')
<style>    
    .dataTables_length{
        font-size: 13px;
    }
    th { font-size: 14px; }
    td { font-size: 13px; }
    .paginate_button { font-size: 14px; }
    .page-item.active .page-link{
        background: #141035 !important;
        border-color: #141035 !important;
    }
    td.details-control {
        background: url('public/dist/img/icons/table-plus.png') no-repeat center center;
        background-size: 15px;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('public/dist/img/icons/table-close.png') no-repeat center center;
        background-size: 17px;
    }
</style>
<div class="content-wrapper">  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fa fa-briefcase" aria-hidden="true"></i>
                Cases
                <button class="btn btn-outline-secondary btn-sm ml-3">Open</button>
                <button class="btn btn-outline-secondary btn-sm ml-1">Closed</button>
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
    <section class="content">
        <div class="row bg-white mx-1">
            <div class="col-md-12">
                <div class="box-body px-2 py-2">                    
                    <table id="myTable" class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="20"></th>
                                <th>Case</th>
                                <th>Number</th>
                                <th>Case Stage</th>
                                <th>Firm Members</th>
                                <th>Status Update</th>
                                <th>Added</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>    
<!-- Modal -->
<div class="modal fade" id="newMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Communication - New Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea class="form-control" name="message" id="message" style="max-height: 300px; min-height: 150px;"></textarea>
      </div>
      <div class="modal-footer">
        <a style="text-align: left; width: 328px; font-size: 12px;" id="statusMessage"></a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn" style="background: #141035; color:white;" onclick="newMessage(this)">Save</button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>    
    var table;
    function format ( d ) {
        var communications = "";
        if( d.communication.length > 0 ){
            if( d.communication[0].message == '' ){
                communications += 'No records.<button class="newMessageButton" type="button" data-toggle="modal" data-target="#newMessage" data-id="'+d.id_case+'" style="float:right;">New Message</button>';
            } else {
                communications += '<table border="0" width="100%"><thead><tr><th width="150">Sender</th><th>Subject</th><th width="150">Date</th></tr></thead><tbody>';
                $.each(d.communication, function(index, value){
                    if ( value.message != '' ) {
                        communications += '<tr><td style="vertical-align:middle;">'+value.from_name+'</td><td>'+value.message+'</td><td style="vertical-align:middle;">'+value.created_at+'</td></tr>';
                    }
                });
                communications += '<tr><td class="border" colspan="3" align="right"><button class="newMessageButton" type="button" data-toggle="modal" data-target="#newMessage" data-id="'+d.id_case+'">New Message</button></td></tr></tbody></table>';
            }            
        } else {
            communications += 'No records.<button class="newMessageButton" type="button" data-toggle="modal" data-target="#newMessage" data-id="'+d.id_case+'" style="float:right;">New Message</button>';
        }     
        return '<table width="100%" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<td colspan="7"><b>Case Information</b></td>'+
            '</tr>'+  
            '<tr>'+
                '<td width="30"></td>'+
                '<td><b>Practice Area</b></td>'+
                '<td>'+d.practice_area+'</td>'+
                '<td><b>Date Opened</b></td>'+
                '<td>'+d.created_at+'</td>'+
                '<td><b>Date Closed</b></td>'+
                '<td>'+d.closed+'</td>'+
            '</tr>'+           
            '<tr>'+
                '<td width="30"></td>'+
                '<td><b>Description</b></td>'+
                '<td colspan="5">'+d.description+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td width="30"></td>'+
                '<td style="vertical-align:middle;"><b>Communications</b></td>'+
                '<td colspan="5">'+communications+'</td>'+
            '</tr>'+
        '</table>';
    }
    window.addEventListener('load', function() {
        $(".nav-sidebar .left-menu:eq(2) a").addClass('active');
        var data = {!! $cases !!}        
        table = $('#myTable').DataTable({
            searching: false,
            ajax: "cases/ajax",
            dom: '<"lfrt"lfrt<"#active">p>',            
            pagingType: "full_numbers",
            language: {
                "lengthMenu": "Rows Per Page: _MENU_",              
            },
            createdRow: function( row, data, dataIndex ) {
                $(row).children('td:first-child').attr('data-id', data.id);
            },
            info: true,
            columns: [
                {
                    className:      'details-control',
                    orderable:      false,
                    data:           false,
                    defaultContent: ''
                },
                {data : 'name'},
                {data : 'number'},
                {data : 'status'},
                {data : 'attorney'},
                {data : 'updated_at'},
                {data : 'created_at'}
            ]
        });        
        $('#myTable tbody').on('click', 'td.details-control', function (x) {
            var tr = $(this).closest('tr');
            var row = table.row( tr );

            if ( row.child.isShown() ) {
                row.child.hide();
                tr.removeClass('shown');     
            } else {
                if ( table.row( '.shown' ).length ) {
                        $('.details-control', table.row( '.shown' ).node()).click();
                }            
                $.ajax({
                    url: "case/"+$(x.target).data('id')+"",
                    data: {
                        "_token": $("meta[name='csrf-token']").attr("content")
                    },
                    dataType: "json",
                    method: "POST",
                    success: function(response) {                    
                        if ( row.child.isShown() ) {                        
                            row.child.hide();
                            tr.removeClass('shown');
                        } else {
                            row.child( format(response.data) ).show();
                            tr.addClass('shown');
                        }
                    },
                    error: function () {
                        alert('error');
                    }
                });      
            }                            
        });        
    });    

    function newMessage(x){
        var message = $("#message").val();
        var user = {!! auth()->user()->toJson() !!};
        var idCase = $("tr.shown").next().find('.newMessageButton').data('id');
        if ( message.length > 1 ) {
            $(x).attr('disabled', true);
            $("#statusMessage").empty().html('Wait while your message is saved.').addClass('text-secondary');
            $.ajax({
                url: "case/message/new",
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    "user": user.id,
                    "case": idCase,
                    "message": message
                },
                method: "POST",
                success: function(response, textStatus, xhr) {
                    if( xhr.status == 200 ){
                        $("#statusMessage").empty().html('New message has been created in this case.').addClass('text-success');
                        setTimeout(function(){ 
                            $(x).attr('disabled', false);
                            $('#newMessage').modal('hide');
                            table.ajax.reload();
                            setTimeout(function(){
                                $('#myTable tbody').find('td[data-id='+idCase+']').trigger( "click" );
                            }, 500);                            
                        }, 2000);                        
                    }
                },
                error: function () {
                    alert('error');
                }
            });
        } else {
            $("#statusMessage").empty().html('Must to set up a complete message in this case.').addClass('text-danger');
            setTimeout(function(){ 
                $("#statusMessage").empty()
            }, 5000);
        }
    }
    $(document).ready(function(){
        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).find('textarea').val('');
            $('#statusMessage').text('');
            $('#statusMessage').html('');
        });
    });
</script>
@endsection
