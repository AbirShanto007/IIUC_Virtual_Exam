@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div>
          <div class="col-sm-6">
            
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->
    <section>
      <div class="container-fluid">
        {{-- <div> <h5> {{strtoupper( Auth::user()->name) }}</h5> </div> --}}
        <div class="card text-center"> 
          <h3>ID: {{( Auth::user()->student_id) }}</h3>
          <h3>NAME: {{( Auth::user()->name) }}</h3>
        </div>
        <div class="card-deck justify-content-end">
          <a href="{{route('send_req')}}" type="button" class="mt-2 btn btn-success float-right">Join Exam</a>
        </div>
      </div>
    </section>
    

    <section class="mt-5">
      <div class="container-fluid">
          <div class="row">
            @forelse ($req as $each_req)
            <div class="col-sm-3">
              <div class="card">
                <div class="card-body">
                  <p class="card-text"> <b>Course Name :- {{$each_req->course->course_title}}</b> </p>
                  <p class="card-text">Exam Code :- {{$each_req->exam->xm_id}} </p>
                  <p class="card-text">Exam Name :- {{$each_req->exam->xm_name}}</p>
                  <p><span class="btn btn-success">Start Time - {{$each_req->exam->xm_start_time}}</span></p>
                  <p><span class="btn btn-warning ">End Time - {{$each_req->exam->xm_end_time}}</span> </p>
                  @php
                    $current_time = Carbon\Carbon::parse(Carbon\Carbon::now());
                    // dd($current_time->toDateTimeString());
                    $start_time = Carbon\Carbon::parse($each_req->exam->xm_start_time);
                    $end_time = Carbon\Carbon::parse($each_req->exam->xm_end_time);

                  @endphp  
                  @if ($end_time<$current_time)
                      
                  <a target="blank" href="{{ route('see_result_marks',['stu'=>auth()->user()->id,'exm_id'=>$each_req->exam_id ]) }}" class="btn btn-primary">Show Result</a>
                  @endif 
                  <br>

                  @if (($current_time >= $start_time) && ($current_time < $end_time))
                      
                  <a href="{{route('show_exam_question',['exam_id'=>$each_req->exam_id])}}" onclick="return confirm('are you sure ?')" class="btn btn-success">Enter Exam</a>
                 @else 

                @if($current_time < $start_time)
                  <div class="mt-4 py-2 text-center text-white bg-dark">Exam not start</div>
                @endif

              @if($current_time > $end_time)
                  <div class="mt-4 py-2 text-center text-white bg-dark">Exam over</div>
              @endif


                  @endif
                  
                 
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