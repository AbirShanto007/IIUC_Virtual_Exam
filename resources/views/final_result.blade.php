@extends('layouts.app')

@section('content')
<h1>Total Marks:  {{ isset($total_marks)?$total_marks:null }}</h1>
@endsection