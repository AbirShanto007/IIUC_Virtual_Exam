@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
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

    <a href="{{route('send_req')}}" class="mt-5 btn btn-success">Join Classroom</a>
    {{-- <div class="container ">

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

    {{-- <div class="card">
        <div class="card-header">
          <h3 class="card-title">Course List</h3>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr class="text-center">
                <th scope="col">SL</th>
                <th scope="col">Exam Id</th>
                <th scope="col">Exam Name</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
                <th class="text-center" colspan="4">Action</th>
            </tr>
            </thead>
            <tbody>
              
                    <tr class="text-center">
                        <td>{{"1"}}</td>
                        <td>{{$active_exam->xm_id}}</td>
                        <td>{{$active_exam->xm_name}}</td>
                        <td>{{$active_exam->xm_start_time}}</td>
                        <td>{{$active_exam->xm_end_time}}</td>
                       
                        <td><a href="{{route('show_exam_question',['exam_id'=>$active_exam->id])}}" onclick="return confirm('are you sure ?')" class="btn btn-danger">Current Exam</a></td>
                    </tr>
            
            </tbody>
          </table>
        </div>
    </div> --}}

    <section class="mt-5">
      <div class="container-fluid">
          <div class="row">
            @forelse ($req as $each_req)
            <div class="col-sm-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Course Name :- {{$each_req->course->course_title}} </h5>
                  <h5 class="card-title">Exam Code :- {{$each_req->exam->xm_id}} </h5>
                  <p class="card-text">Exam Name :- {{$each_req->exam->xm_name}}</p>
                  @php
                    $current_time = Carbon\Carbon::parse(Carbon\Carbon::now());
                    $start_time = Carbon\Carbon::parse($each_req->exam->xm_start_time);
                    $end_time = Carbon\Carbon::parse($each_req->exam->xm_end_time);

                  @endphp  
                  @if ($end_time<$current_time)
                      
                  <a target="blank" href="{{ route('see_result_marks',['stu'=>auth()->user()->id,'exm_id'=>$each_req->exam_id ]) }}">Show Result</a>
                  @endif 
                  <br>

                  @if (($current_time >= $start_time) && ($current_time < $end_time))
                      
                  <a href="{{route('show_exam_question',['exam_id'=>$each_req->exam_id])}}" onclick="return confirm('are you sure ?')" class="btn btn-danger">Enter Exam</a>
                 @else 

                @if($current_time < $start_time)
                  <div>Exam not start</div>
                @endif

              @if($current_time > $end_time)
                  <div>Exam over</div>
              @endif


                  @endif
                  {{-- <p class="card-text">Currently active :- @if($exam->xm_status ==1) Active @else Not Active   @endif </p>
                  @if($exam->xm_status ==1)
                  
                  <form id="logout-form" action="{{ route('teacher.exam_status') }}" method="POST" style="">
                    @csrf
                    <input type="hidden" name="xm_course"  value="{{$exam->xm_course}}">
                    <input type="hidden" name="id"  value="{{$exam->id}}">
                    <input type="hidden" name="status" value="0">
                    <input type="submit" class="btn btn-md btn-danger" value="Deactive">
                </form>
                  
                  @else
                  <form id="logout-form" action="{{ route('teacher.exam_status') }}" method="POST" style="">
                    @csrf
                    <input type="hidden" name="xm_course"  value="{{$exam->xm_course}}">
                    <input type="hidden" name="id" value="{{$exam->id}}">
                    <input type="hidden" name="status" value="1">
                    <input type="submit" value="Active" class="btn btn-md btn-danger">
                </form>
                   
                  @endif --}}
                 
                </div>
              </div>
            </div>
            @empty
                
            @endforelse
           
            </div>
      </div>
  </section>

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