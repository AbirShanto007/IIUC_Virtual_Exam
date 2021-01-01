@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Abir</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    {{-- <div class="container ">

        <a href="{{route('course_create')}}" class="mt-5 btn btn-success">Go To Create</a>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">SL</th>
                <th scope="col">Course Title</th>
                <th scope="col">Course Code</th>
                <th scope="col">Credit</th>
                <th class="text-center" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($all_course_list as $key=>$item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->course_title}}</td>
                        <td>{{$item->course_code}}</td>
                        <td>{{$item->credit}}</td>
                        <td><a href="{{route('course_show_by_id',$item->id)}}" class="btn btn-dark">Show</a></td>
                        <td><a href="{{route('course_edit_by_id',$item->id)}}" class="btn btn-info">Edit</a></td>
                        <td><a href="{{route('course_delete_by_id',$item->id)}}" onclick="return confirm('are you sure ?')" class="btn btn-danger">Delete</a></td>
                    </tr>
            @endforeach
            </tbody>
          </table>
    </div> --}}

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Course List</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr class="text-center">
                <th scope="col">SL</th>
                <th scope="col">Course Title</th>
                <th scope="col">Course Code</th>
                <th scope="col">Credit</th>
                <th class="text-center" colspan="4">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($all_course_list as $key=>$item)
                    <tr class="text-center">
                        <td>{{$key+1}}</td>
                        <td>{{$item->course_title}}</td>
                        <td>{{$item->course_code}}</td>
                        <td>{{$item->credit}}</td>
                        <td><a href="{{route('course_show_by_id',$item->id)}}" class="btn btn-dark">Show</a></td>
                        <td><a href="{{route('course_edit_by_id',$item->id)}}" class="btn btn-info">Edit</a></td>
                        <td><a href="{{route('course_delete_by_id',$item->id)}}" onclick="return confirm('are you sure ?')" class="btn btn-danger">Delete</a></td>
                        <td><a href="{{route('exam.show_current_exam',['course_id'=>$item->id])}}" onclick="return confirm('are you sure ?')" class="btn btn-danger">Current Exam</a></td>
                    </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>

</div>

<!-- DataTables -->
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example1').DataTable({
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

@endsection