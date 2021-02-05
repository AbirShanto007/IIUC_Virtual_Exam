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
<section class="mt-5">
    <div class="container-fluid">
        <div class="card-deck justify-content-end">
            <a href="{{route('teacher.create_subject_exam')}}" type="button" class="btn btn-success float-right"><i class="fas fa-plus"></i> Create Class Room</a>
            <a href="{{route('teacher.show_exam_list')}}" class="btn btn-danger">View Exam list</a>
        </div>
    </div>     
</section>
<!-- Create Class Room End -->

<h2>{{ $exam_row->xm_id }} -- {{ $exam_row->xm_name }}</h2>
<!-- View Class Room Start-->
<section class="mt-5">
    <div class="container-fluid">
        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Course Name</th>
                    <th class="text-center" colspan="2">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($studentReq as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->student->name}}</td>
                            <td>{{$item->course->course_title}}</td>
                          <td>

                             @if($item->status ==1)
                
          <form id="logout-form" action="{{ route('teacher.req_status') }}" method="POST" style="">
            @csrf
            <input type="hidden" name="id"  value="{{$item->id}}">
            <input type="hidden" name="status" value="0">
            <input type="submit" value="Not Approve">
        </form>
          
          @else
          <form id="logout-form" action="{{ route('teacher.req_status') }}" method="POST" style="">
            @csrf
            <input type="hidden" name="id" value="{{$item->id}}">
            <input type="hidden" name="status" value="1">
            <input type="submit" value="Approve">
        </form>
           
          @endif
                          </td>
                        </tr>
                @endforeach
                </tbody>
              </table>
       
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

</body>
</html>
