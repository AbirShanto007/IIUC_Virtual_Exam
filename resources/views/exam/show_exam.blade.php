@extends('layouts.app')

@section('content')
<h1>{{ $exam_row->xm_name }}</h1>
<h1>start time {{ $exam_row->xm_start_time }}</h1>
<h1> end time {{ $exam_row->xm_end_time }}</h1>
<a href="{{ route('show_exam_question',['exam_id'=>$exam_row->id]) }}">see question</a>
@endsection