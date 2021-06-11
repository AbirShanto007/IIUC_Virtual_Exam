<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Teaacher View Exam List</title>
  <!-- Tell the browser to be responsive to screen width -->
 <!-- Tell the browser to be responsive to screen width -->
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- Font Awesome -->
 <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
 <!-- Ionicons -->
 <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 <!-- icheck bootstrap -->
 <link rel="stylesheet" href="{{ asset("/plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">
 <!-- Theme style -->
 <link rel="stylesheet" href="{{ asset("/dist/css/adminlte.min.css") }}">
 <!-- Google Font: Source Sans Pro -->
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="{{ asset("/css/bootstrap.min.css") }}">
</head>
<body>
<!-- Navbaar Start -->
@include('teacher_panel.nav')
<!-- Navbar End -->

<!-- Create Class Room Start -->
<section class="mt-3">
    <div class="container-fluid">
        <div class="card-deck justify-content-end mr-2">
            <a href="{{route('teacher.create_subject_exam')}}" type="button" class="btn btn-success float-right d-inline-block"><i class="fas fa-plus"></i> Create Exam</a>
        </div>
    </div>     
</section>
<!-- Create Class Room End -->

<!-- View Class Room Start-->
<section class="mt-2">
    <div class="container-fluid">
        <div class="row">
          @forelse ($exams as $exam)
          <div class="col-md-3 col-sm-12 p-2">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Course Name :- {{$exam->course->course_title}} </h5>
                <h5 class="card-title">Exam Code :- {{$exam->xm_id}} </h5>
                <p class="card-text">Exam Name :- {{$exam->xm_name}}</p>
                <p class="card-text">Currently active :- @if($exam->xm_status ==1) Active @else Not Active   @endif </p>
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
                 
                @endif
                <br>
                <br>
                <a href="{{ route('teacher.see_request',['teacher_id'=>$exam->teacher_id,'course_id'=>$exam->xm_course,'exam_id'=>$exam->id]) }}" class="btn btn-primary">Request List</a>
              <br>
              <br>
                <a href="{{ route('teacher.set_exam_question',['exam_id'=>$exam->id]) }}" class="btn btn-success">Set Question</a>
                <br>
                <br>
                <a href="{{ route('teacher.approved_student_marks',['teacher_id'=>$exam->teacher_id,'course_id'=>$exam->xm_course,'exam_id'=>$exam->id]) }}" class="btn btn-primary">Total Student List and Marks</a>
              </div>
            </div>
          </div>
          @empty
              
          @endforelse
         
          </div>
    </div>
</section>
<!-- View Class Room End -->

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>

<!-- Bootstarap js -->
<script src="../assets/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>
