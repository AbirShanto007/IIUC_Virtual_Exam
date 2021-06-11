@extends('layouts.app')

@section('content')
<div class="card text-center"> 
    <h3>ID: {{( Auth::user()->student_id) }}</h3>
    <h3>NAME: {{( Auth::user()->name) }}</h3>
   
    <div class="card-body">
        <h1>Total Exam Marks:  {{ isset($total_exam_marks_grand)?$total_exam_marks_grand:null }}</h1>
    </div>
    <div class="card-body">
        <h1>Your Marks:  {{ isset($total_marks)?$total_marks:null }}</h1>
    </div>
    <div class="card-body">
        <h1>Your Grade:  {{ isset($gradePointInfo->grade)?$gradePointInfo->grade:null }}</h1>
    </div>
    <div class="card-body">
        <h1>Your Point:  {{ isset($gradePointInfo->grade_point)?$gradePointInfo->grade_point:null }}</h1>
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
        <input class="" type="checkbox"  @if (App\StudentSubmittedAnswer::check_selected($auth_student,request('exm_id'),$each_question->id,$each_option->id))
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
{{-- <div class="card text-center">
    <div class="card-body">
        <h1>Your Marks:  {{ isset($total_marks)?$total_marks:null }}</h1>
    </div>
</div> --}}
@endsection