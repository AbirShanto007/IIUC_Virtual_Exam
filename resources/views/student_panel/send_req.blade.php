<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Student Join Exam</title>
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

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
      </a>
      {{-- <a href="#" class="navbar-brand">IIUC Virtual Exam</a> --}}
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          {{-- <ul class="navbar-nav mr-auto">

          </ul> --}}

          <!-- Right Side Of Navbar -->
              <ul class="navbar-nav mx-auto">
                  <!-- Authentication Links -->
                  @guest
                      <li class="nav-item mx-2">
                          <a class="nav-link btn btn-success text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                      </li>
                      @if (Route::has('register'))
                          <li class="nav-item ">
                              <a class="nav-link btn btn-primary text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                          </li>
                      @endif
                  @else
                      {{-- <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>

                      </li> --}}
                      <div style="display: block;
                      padding-left: 850px;">
                      <li class="">
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="">
                              @csrf
                              <input type="submit" class="btn btn-danger" value="Logout">
                          </form>
                          
                      </li>
                  </div>
                      
                  @endguest
              </ul>
      </div>
  </div>
</nav>
<!-- Navbar End -->



{{-- Start view Course List --}}
<section>
      <div class="container-fluid mt-5">
        <div class="card text-center"> 
          <h3>ID: {{( Auth::user()->student_id) }}</h3>
          <h3>NAME: {{( Auth::user()->name) }}</h3>
         </div>
        <a href="{{route('course.frontend')}}" type="button" class="btn btn-danger"><i class="fas fa-plus"></i> See Your Exam List</a>
      </div>
</section>
{{-- End view Course List --}}

<section>
 {{--  @if ((session('success')))
      {{ session('success') }}
  @endif
  @if ((session('errors')))
      {{ session('errors') }}
  @endif --}}
  <div class="row mt-5">
        <div class="col-md-6 m-auto">
            @if ((session('success')))
            {{ session('success') }}
            @endif
            @if ((session('errors')))
            {{ session('errors') }}
            @endif
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Request for attending Exam</h3>
                </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form" action="{{ route('send_req.store') }}" method="POST">
                    @csrf
                    <div class="card card-body">
                      <div class="form-group">
                      <select name="course_id" id="course_id" data-set_url = "{{ url("/") }}" class="form-control mb-2">
                        <option value="">Select Course</option>
                          @forelse ($all_course as $item)
                              <option value="{{ $item->id }}">{{ $item->course_title." - ".$item->course_code }}</option>
                          @empty 
                          @endforelse
                      </select>
                        <select name="teachers_id" id="teachers_id"  class="form-control">
                          <option value="">Select Teacher</option>
                        </select>
                      </div>
                    </div>
  
                    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </form>
            </div>

        </div>

    </div>
</section>
<!-- Create Classroom End -->




<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>

<!-- Bootstarap js -->
<script src="../assets/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    $("#course_id").change(function(){
        var course_id = $("#course_id").val();
        var url =   $(this).data('set_url');
        var teachers = document.getElementById("teachers_id");
        var option = "";
        option += "<option value=''>"+ "Select Teacher." +"</option>";
        $.get( url+"/get_teacher_by_course_id/"+course_id, function( data ) {
      
        data.forEach( function(element) { 
        option += "<option value='"+ element.teacher_id+"sep"+element.id+"'>"+ element.teacher_name+" - "+element.xm_name +"</option>";
        });
        teachers.innerHTML = option
        //ggggggg
        });
    

    })
</script>

</body>
</html>
