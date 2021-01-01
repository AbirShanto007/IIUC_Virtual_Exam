@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
@section('content')
    
   

    <div class="container-fluid mt-3">
        <h1 class="text-center">Choose the correct answer</h1>
            @foreach ($questions as $key => $item)
            <form action="{{ route('student_answer_submit') }}" method="POST">
                <input type="hidden" name="exam_id" value="{{ request('exam_id') }}">
                <input type="hidden" name="ques_id" value="{{ $item->id }}">
                @csrf
                <div class="m-1 card">
                    <div class="card-body">

                        <a style="text-align: left" class="mt-1 btn btn-primary"  data-bs-toggle="collapse" data-bs-target="#collapseExample-{{$key}}" aria-expanded="false" aria-controls="collapseExample-{{$key}}">
                            <h5><b>Question-{{$key+1}} :</b> &nbsp; <i>{{ wordwrap($item->ques_name, 20, "\n") }}</i> &nbsp;<i class="fa fa-arrow-down" aria-hidden="true"></i></h5>
                        </a>
                        <h3>{{ $item->ques_mark }}</h3>
                        @forelse ($item->options_list as $each_option)
                        <div class="mt-2 collapse" id="collapseExample-{{$key}}">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selected_ans"
                                @if (App\StudentSubmittedAnswer::check_selected($auth_student,request('exam_id'),$item->id,$each_option->id))
                                    checked
                                @endif
                                value="{{ $each_option->id }}">
                                <label class="form-check-label">A. {{ $each_option->option_name }}</label>
                            </div>
                        </div>
                        @empty
                            
                        @endforelse

                     

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-lg btn-outline-success" type="button">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
            @endforeach

            <a target="blank" href="{{ route('see_result_marks',['stu'=>$auth_student,'exm_id'=>request('exam_id') ]) }}">Show Result</a>
    </div>


@endsection
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/16d921efae.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  