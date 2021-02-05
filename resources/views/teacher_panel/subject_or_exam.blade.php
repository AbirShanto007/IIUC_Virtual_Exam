<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Teaacher Create Exam</title>
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

<!-- Create Classroom Start -->

{{-- Start view Course List --}}
<section>
  <a href="{{route('teacher.show_exam_list')}}" class="btn btn-danger">View Exam list</a>
</section>
{{-- End view Course List --}}

<section>
  @if ((session('success')))
      {{ session('success') }}
  @endif
  <div class="row mt-5">
        <div class="col-md-6 m-auto">
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Create Class {{ auth('teachers_web')->id() }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{ route('teacher.create_subject_exam_store') }}" method="POST">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="subject_name">Exam Name</label>
                      <input type="text" class="form-control" id="subject_name" name="subject_name" required placeholder="Exam Name">
                      <input type="text" class="form-control" id="subject_name" name="subject_code" value="E-{{ App\Exam::generateRandomString(8) }}">
                    <select name="xm_course" class="form-control">
                      <option value="">Select Course</option>
                        @forelse ($all_course as $item)
                            <option value="{{ $item->id }}">{{ $item->course_title." - ".$item->course_code }}</option>
                        @empty
                            
                        @endforelse
                    </select>
                    <input type="checkbox" id="data" name="active_or_not">
                      <label for="data"> is Currently active exam?</label><br>
                    </div>

                    {{-- <div class="form-group">
                        <label for="subject_code">Subject Code</label>
                        <input type="text" class="form-control" id="subject_code" placeholder="Subject Code">
                    </div> --}}
                    {{-- <div class="form-group">
                        <label>Semester (Dropdown)</label>
                        <select class="form-select" style="width: 100%;">
                          <option selected="selected">1st</option>
                          <option>2nd</option>
                          <option>3rd</option>
                          <option>4th</option>
                          <option>5th</option>
                          <option>6th</option>
                          <option>7th</option>
                          <option>8th</option>
                        </select>
                    </div> --}}
                    {{-- <div class="form-group">
                        <label>Section(Dropdown)</label>
                        <select class="form-select" style="width: 100%;">
                          <option selected="selected">AM</option>
                          <option>BM</option>
                          <option>CM</option>
                          <option>AF</option>
                          <option>BF</option>
                          <option>CF</option>
                        </select>
                    </div> --}}
                  <!-- /.card-body -->
                    {{-- <div>
                      
                    </div> --}}
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

</body>
</html>
