<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Approve student and marks</title>
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
    @include('teacher_panel.nav')
<div class="card text-center"> 
    <h3>ID: {{( $student_data->student_id??null) }}</h3>
    <h3>NAME: {{ $student_data->name ?? null}}</h3>
   
    <div class="card-body">
        <h1>Student Marks:  {{ isset($total_marks)?$total_marks:null }}</h1>
    </div>
</div>
<div class="card-body">
    @php
        $i = 1
    @endphp
    @forelse ($questions as $each_question)
    <div>
    <a style="text-align: left" class="mt-1 btn btn-primary text-white"  data-bs-toggle="collapse" data-bs-target="#collapseExample{{$i}}" aria-expanded="false" aria-controls="collapseExample">
        <h5><b>{{ $loop->iteration.". ". $each_question->ques_name."                          -marks ".$each_question->ques_mark }}</b><i class="fa fa-arrow-down" aria-hidden="true"></i></h5>
    </a>
    <div class="mt-2" id="collapseExample{{$i}}">
    @forelse ($each_question->options_list as $each_option)
    <div class="form-check">
        <input class="" type="checkbox"  @if (App\StudentSubmittedAnswer::check_selected($auth_student,request('exam_id'),$each_question->id,$each_option->id))
        checked
    @endif readonly disabled >
        <span class="@if(App\Answer::currect_answer_check($each_question->id,$each_option->id)) bg-success text-white @endif">{{ $each_option->option_name }}</span>
    </div>
    @empty
        
    @endforelse
</div>
@php
    $i++
@endphp
</div>
    @empty
        
    @endforelse
</div>
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>

<!-- Bootstarap js -->
<script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>