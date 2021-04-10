@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  .dataTables_length{
        font-size: 13px;
    }
    th { font-size: 14px; }
    td { font-size: 13px; text-transform: capitalize; }
    .paginate_button { font-size: 14px; }
    .page-item.active .page-link{
        background: #141035 !important;
        border-color: #141035 !important;
    }
    table td:last-child {
      text-align: center;
    }
    table td:last-child i {
      cursor: pointer;
    }
    table td:last-child i:hover {
      color: gray;      
    }
</style>
<div class="content-wrapper">  
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">
            <i class="fa fa-child" aria-hidden="true"></i>
              Clients
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
  <section class="content">
    <div class="row bg-white mx-1">
        <div class="col-md-12">
            <div class="box-body px-2 py-2">                    
                <table id="myTable" class="table table-sm table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Home Street</th>
                            <th>City</th>
                            <th>Mobile Phone</th>
                            <th>Email</th>
                            <th width="50">Invite</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
</div>
<script>
  window.addEventListener('load', function() {
      var data = {!! $clients !!}        
      $('#myTable').DataTable({
          searching: true,
          dom: '<"lfrt"lfrt<"#active">p>',            
          pagingType: "full_numbers",
          language: {
              "lengthMenu": "Rows Per Page: _MENU_",              
          },
          data: data,
          info: true,
          columns: [
              {data : 'first_name'},
              {data : 'last_name'},
              {data : 'address'},
              {data : 'city'},
              {data : 'mobile_phone'},
              {data : 'email'},
              {"render": function ( data, type, row, meta ) {
                return '<i style="font-size:18px" data-email="'+row.id+'" onclick="sendEmail(this)" title="Send invitation to Client to join motion law Mobile App" class="fa fa-envelope-o"></i>';
              }}
          ]
      });
      $(".nav-sidebar li:eq(1) a").addClass('active');
  });

  function sendEmail(x) {
    var email = $(x).attr('data-email');
    $.ajax({
        url: "clients/invite",
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            "email": email
        },
        dataType: "json",
        method: "POST",
        complete: function(xhr, textStatus) {
          if( xhr.status == 200 ){
            alert('Client invited succesfully!');
          } else {
            alert('Error!');
          }
        },
        success: function(data, textStatus, xhr) {
          console.log(xhr);
            
        }     
    });     
  }
</script>
@endsection