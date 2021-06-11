<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Teacher Registration</title>
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


<body class="hold-transition register-page">

  @if ((session('success')))
  {{ session('success') }}
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="register-box">
  <div class="register-logo">
    Teacher Registration
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      {{-- <p class="login-box-msg">Register a new membership</p> --}}

      <form action="{{route('teacher.register.store')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        {{-- <div class="raw input-group mb-3">
            <div class="col-6">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Department</option>
                    <option value="1">CSE</option>
                    <option value="2">EEE</option>
                    <option value="3">ETE</option>
                  </select>
            </div>
            <div class="col-6">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Designation</option>
                    <option value="1">Professor</option>
                    <option value="2">Asst. Professoor</option>
                    <option value="3">Lecturer</option>
                  </select>
            </div>
        </div> --}}
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          {{-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div> --}}
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="{{route('teacher.login')}}" class="btn btn-success text-center mt-2">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

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
