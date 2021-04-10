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
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">
            <i class="fa fa-users" aria-hidden="true"></i>
              Staff       
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
                            <th>Name</th>
                            <th>Title</th>
                            <th>Active Cases</th>
                            <th>Status</th>
                            <th>Last Login</th>
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
      var data = {!! $staff !!}        
      $('#myTable').DataTable({
          searching: false,
          dom: '<"lfrt"lfrt<"#active">p>',            
          pagingType: "full_numbers",
          language: {
              "lengthMenu": "Rows Per Page: _MENU_",              
          },
          data: data,
          info: true,
          columns: [
              {data : 'name'},
              {data : 'title'},
              {data : 'active_cases'},
              {data : 'status'},
              {data : 'last_login'}            
          ]
      });
      $(".nav-sidebar li:eq(0) a").addClass('active');
  });
</script>
@endsection