@extends('layouts.app')
@push('css')

<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">

@endpush

@section('content')
@include('layouts.navbar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tasks</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tasks</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @if (count($errors) > 0)
            <div class="alert alert-danger. swalDefaultError">
                <ul>
                  <input type="hidden" class="error" name="error" value="1" />
                  </ul>
              </div>
          @endif

            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#create-task">
                  Create New Task
                </button>
              </div>

              <div class="modal fade" id="create-task">
                <div class="modal-dialog">
                <form method="post" action="{{ route('tasks.store') }}">
                  @csrf
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Create New Task</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                     <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control" />
                     </div>

                     <div class="form-group">
                      <label>description</label>
                      <textarea rows="3" name="description" class="form-control" ></textarea>
                     </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </form>
                </div>
              </div>
              <!-- /.modal -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Action</th>                   
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($tasks as $item)
                  <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>                  
                    <td>
                     
                      <form action="{{ route('tasks.destroy', [$item->id]) }}" method="POST">
                        @csrf                    
                        @method('DELETE')                    
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                      <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit{{ $item->id }}">
                        <i class="fas fa-edit"></i>
                      </a>                     
                    </td>
                  </tr>

                  <div class="modal fade" id="edit{{ $item->id }}">
                    <div class="modal-dialog">
                    <form method="POST" action="{{ route('tasks.update', [$item->id]) }}">
                      @csrf
                      @method('PUT')
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Task</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                         <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="name" class="form-control"  value="{{ $item->name }}"/>
                         </div>
    
                         <div class="form-group">
                          <label>description</label>
                          <textarea rows="3" name="description" class="form-control" >{{ $item->description }}</textarea>
                         </div>
    
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>

                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@push('js')
<!-- Bootstrap 4 -->
<!-- DataTables  & Plugins -->

<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


<script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>



<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

  
    $(document).ready(function(){
    if($('.error').val() == 1){      
      Toast.fire({
        icon: 'error',
        title: 'Please Enter a Valid Name of Task.'
      })
    }
    });
   
  });


</script>
@endpush

@endsection
