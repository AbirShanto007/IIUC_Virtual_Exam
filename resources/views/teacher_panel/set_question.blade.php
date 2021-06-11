<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Teacher Set Question</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

 
 <!-- Font Awesome -->
 <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
 <!-- Ionicons -->
 <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 <!-- icheck bootstrap -->

 <!-- Theme style -->
 <link rel="stylesheet" href="{{ asset("/dist/css/adminlte.min.css") }}">
 <!-- Google Font: Source Sans Pro -->
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
 
 <!-- Bootstrap CSS -->
 
 
 
 <link rel="stylesheet" href="{{ asset("/css/bootstrap.min.css") }}">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
 integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <link rel="stylesheet" href="{{ asset("/plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">
</head>
<body>


<!-- Navbaar Start -->
@include('teacher_panel.nav')
<!-- Navbar End -->

<!-- Set Date and Time Start -->
{{-- @if ((session('success')))
{{ session('success') }}
@endif --}}
{{-- <section>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">IIUC Virtual Quiz</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            
            <form class="d-flex justify-content-end">
              
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
</section> --}}

<section>
    <div class="container-fluid mb-4">
        <a href="{{route('teacher.show_exam_list')}}" class="btn btn-danger">View Exam List</a>
    </div>
    @if ((session('success')))
    <h2>{{ session('success') }}</h2>
    @endif
    @if ((session('error')))
    <h2>{{ session('error') }}</h2>
    @endif
</section>


<!-- Set Date and Time End -->
<section>
        <div class="container">
            <div class="card">
              
                
                <div class="card-heade text-center bg-success">
                    <h4>Set or Update Exam Start & End Time</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('teacher.exam.time.update',['exam_id'=>$exam_info->id]) }}" method="post">
                                @csrf
                                    <div class="col-md-5">
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input placeholder="exam start time" type='text' value="{{isset($exam_info->xm_start_time)? $exam_info->xm_start_time:null}}" name="exam_start_time" class="form-control" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class='input-group date' id='datetimepicker2'>
                                            <input placeholder="exam end time"  type='text' value="{{isset($exam_info->xm_end_time)? $exam_info->xm_end_time:null}}"  name="exam_end_time" class="form-control" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mx-4 mt-5">
                                    <input type="submit" class="btn btn-success" value="update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                
            <div class="card">
                <div class="card-heade text-center bg-success">
                    <h4>Set Negative Mark</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('teacher.exam.negative_mark.update',['exam_id'=>$exam_info->id]) }}" method="post">
                                @csrf
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label class="form-label" for="negative"><b>Percentage Of Negative Marking :</b></label>
                                            <input type="number" step="any" id="negative" name="negativeMark" value="{{isset($exam_info->negativeMark)? $exam_info->negativeMark:null}}"  class="form-control" placeholder="Type Your Negative Mark Percentage">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mx-4 mt-5">
                                    <input type="submit" class="btn btn-success" value="update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Question List Start -->

<section>
    <div class="container-fluid mt-3">
        <h1 class="text-center">Question List</h1>


        <form action="" method="POST">
                <div class="m-1 card">
                    <div class="card-body">
                        @php
                            $i = 1
                        @endphp
                        @forelse ($questions as $each_question)
                        <div>
                        <a style="text-align: left" class="mt-1 btn btn-primary text-white"  data-bs-toggle="collapse" data-bs-target="#collapseExample{{$i}}" aria-expanded="false" aria-controls="collapseExample">
                            <h5><b>{{ $loop->iteration.". ". $each_question->ques_name."                          -marks ".$each_question->ques_mark }}</b><i class="fa fa-arrow-down" aria-hidden="true"></i></h5>
                        </a>
                        <div class="mt-2 collapse" id="collapseExample{{$i}}">
                        @forelse ($each_question->options_list as $each_option)
                        <div class="form-check">
                            <input class="" type="checkbox" @if(App\Answer::currect_answer_check($each_question->id,$each_option->id)) checked  @endif readonly disabled >
                            <span class="">{{ $each_option->option_name }}</span>
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
                </div>

            
        </form>
        
    </div>
</section>


<section class="mt-5">
    <div class="container mt-3">
        <h1 class="text-center">Set Question for exam - {{$exam_info->xm_name}} {{-- | code - {{$exam_info->xm_id}} --}} </h1>


        <form action="{{ route('teacher.set_exam_question_store',['exam_id'=>$exam_info->id]) }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                        <!-- <div class="alert alert-{{ Session::get('type') }} alert-dismissible fade show" role="alert">
                            <strong>Alert Message: </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div> -->

                    <div class="mb-3">
                        <h4 class="text-danger"><b>Question-{{ $i }}</b></h4>
                        <textarea name="question_detail" class="form-control" cols="20" required rows="5" placeholder="Write your Question"></textarea>
                            <div class="alert alert-danger mt-2"></div>
                    </div>
                    <div id="details_array">
                        <div id="parent_fieldset">
                            <div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label"><b>Option-1</b></label>
                        <div class="col-sm-11">
                            <div class="input-group mb-3">
                                <div class="row">
                                    <div class="col-1">
                                        <div class="">
                                            <input class="" type="radio" value="1" name="correct_ans">
                                        </div>
                                    </div>
                                    <div class="col-11">
                                        <input type="text" class="form-control" placeholder="Type Your Option" name="options[option_1]">

                                    </div>
                                </div>

                               
                            </div>
                                <div class="alert alert-danger"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label"><b>Option-2</b></label>
                        <div class="col-sm-11">
                            <div class="input-group mb-3">
                                <div class="row">
                                    <div class="col-1">
                                        <div class="">
                                            <input class="" type="radio" value="2" name="correct_ans">
                                        </div>
                                    </div>
                                    <div class="col-11">
                                <input type="text" class="form-control" placeholder="Type Your Option" name="options[option_2]">

                                    </div>
                                </div>
                               
                            </div>
                                <div class="alert alert-danger"></div>
                        </div>
                    </div>
                    
                    </div>
                    </div>
                    </div>
                    
                    <div class="">
                        <div class="text-right mb-1">
                            <button title="Add more field" class="add_field_button btn btn-md bg-success">Add More</button>
                            <div class="clear_fix"></div>
                        </div>
                     </div>
                   
                    {{-- <div class="row mb-3">
                        <label class="col-sm-1 col-form-label"><b>Option-3</b></label>
                        <div class="col-sm-11">
                            <div class="input-group mb-3">
                                <div class="row">
                                    <div class="col-1">
                                        <div class="">
                                            <input class="" type="radio" value="3" name="correct_ans">
                                        </div>
                                    </div>
                                    <div class="col-11">
                                <input type="text" class="form-control" placeholder="Type Your Option" name="option_3">

                                    </div>
                                </div>
                               
                            </div>
                                <div class="alert alert-danger"></div>
                        </div>
                    </div> --}}
                    {{-- <div class="row mb-3">
                        <label class="col-sm-1 col-form-label"><b>Option-4</b></label>
                        <div class="col-sm-11">
                            <div class="input-group mb-3">
                                <div class="row">
                                    <div class="col-1">
                                        <div class="">
                                            <input class="" type="radio" value="4" name="correct_ans">
                                        </div>
                                    </div>
                                    <div class="col-11">
                                <input type="text" class="form-control" placeholder="Type Your Option" name="option_4">

                                    </div>
                                </div>
                               
                            </div>
                                <div class="alert alert-danger"></div>
                        </div>
                    </div> --}}

                    {{-- <div class="row mb-3">
                        <label class="col-sm-1 col-form-label"><b>Option-3</b></label>
                        <div class="col-sm-11">
                            <div class="input-group mb-3">
                                <div class="">
                                    <input class="" type="radio" value="3" name="correct_ans">
                                </div>
                                <input type="text" class="form-control" placeholder="Type Your Option" name="option_3">
                            </div>
                                <div class="alert alert-danger"></div>
                        </div>
                    </div> --}}
                    {{-- <div class="row mb-3">
                        <label class="col-sm-1 col-form-label"><b>Option-4</b></label>
                        <div class="col-sm-11">
                            <div class="input-group mb-3">
                                <div class="">
                                    <input class="" type="radio" value="4" name="correct_ans">
                                </div>
                                <input type="text" class="form-control" placeholder="Type Your Option" name="option_4">
                            </div>
                                <div class="alert alert-danger"></div>
                        </div>
                    </div> --}}

                    <div class="mb-3">
                        <label class="form-label"><b>Mark</b></label>
                        <input type="number" step="any" name="mark" class="form-control" placeholder="Type Your Mark">
                            <div class="alert alert-danger mt-2"></div>
                    </div>

                  

                    
                    <div class="p-3 d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-success mt-2" type="submit">Submit</button>
                    </div>

                </div>
            </div>
        </form>
    </div>    
</section>


<!-- Create Question End -->
<!-- jQuery -->
<script src="{{asset("/plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("dist/js/adminlte.min.js")}}"></script>

<!-- Bootstarap js -->
<script src="{{asset("/js/bootstrap.min.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
</script>

<script type="text/javascript">
$(function() {
    $('#datetimepicker1').datetimepicker();
});
$(function() {
    $('#datetimepicker2').datetimepicker();
});
</script>

<script>

     var max_fields = 100;
        var wrapper = $("#details_array");
        var add_button = $(".add_field_button");
        var x = 2;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                var all_set = document.createElement("div");

                all_set.setAttribute("class","row mb-3");
                var label = document.createElement("label");
                label.setAttribute("class","col-sm-1 col-form-label");
                label.innerHTML = "Option-"+x;
                var div_11 = document.createElement("div");
                div_11.setAttribute("class","col-sm-11");
                var div_input_group = document.createElement("div");
                div_input_group.setAttribute("class","input-group mb-3");
                var div_row = document.createElement("div");
                div_row.setAttribute("class","row");
                var div_col_1 = document.createElement("div");
                div_col_1.setAttribute('class', 'col-1');
                var input = document.createElement("input");
                input.setAttribute("type", "radio")
                input.setAttribute("name", "correct_ans");
                input.setAttribute("value", x);
                div_col_1.append(input)

                var div_col_11 = document.createElement("div");
                div_col_11.setAttribute('class', 'col-11');
                var input_text = document.createElement("input");
                input_text.setAttribute("type", "text")
                input_text.setAttribute("name", "options[option_"+x+"]");
                input_text.setAttribute("class", "form-control");
                // input_text.setAttribute("value", x);
                input_text.setAttribute("placeholder", "Type Your Option");
                div_col_11.append(input_text)

                div_row.append(div_col_1,div_col_11);
                div_input_group.append(div_row);

                var div_alert = document.createElement("div");
                div_alert.setAttribute("class","alert alert-danger");


                div_11.append(div_input_group,div_alert)



                
    
                all_set.append(label,div_11);
                var remove_button = '<button class = remove_field style=float:right;margin-bottom:5px;color:white;background:#ff1f6b;cursor:pointer;border:solid #ff1f6b; title="Delete">Remove</button><div style="clear:both;"></div>'
                $(wrapper).append(all_set,remove_button);

                }
             
            });
    
        $(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).prev('div').remove();
            $(this).remove();
            x--;
        });
    </script>
    
</body>
</html>
