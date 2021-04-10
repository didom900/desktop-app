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
</style>
<div class="content-wrapper">  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                Push Notifications                
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
                              <th>User</th>
                              <th>Platform</th>
                              <th>Browser</th>
                              <th>MAC</th>
                              <th>Added</th>
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
        $(".nav-sidebar li:eq(1)").addClass('menu-open');
        $(".nav-sidebar li:eq(1) ul li:eq(0) a").addClass('active');
        var users = {!! $users !!}
        $('#myTable').DataTable({
            searching: false,
            dom: '<"lfrt"lfrt<"#active">p>',            
            pagingType: "full_numbers",
            language: {
                "lengthMenu": "Rows Per Page: _MENU_",              
            },
            data: users,
            info: true,
            columns: [
                {data : 'user'},
                {data : 'platforma'},
                {data : 'browser'},
                {data : 'mac'},                
                {data : 'created_at'}
            ]
        }); 
    });    
</script>
@endsection
