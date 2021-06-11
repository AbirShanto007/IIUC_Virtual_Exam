<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link of css -->
    <link rel="stylesheet" href="{{asset("admin_panel/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("admin_panel/css/fontawesome.css")}}">
    <link rel="stylesheet" href="{{asset("admin_panel/css/responsive.css")}}">
    <link rel="stylesheet" href="{{asset("admin_panel/css/style.css")}}">

    <title>Admin Login</title>
</head>
<body>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 m-auto login-body">
                <h3 class="mb-5 mt-3 text-center login-heading text-white">Admin Login</h3>
                <form action="{{route('admin.login.store')}}" method="post">
                    @csrf
                    <div class="form-group mt-2">
                        <label for="username">User Name :</label>
                        <input type="text" id="username" name="user_name" class="form-control" placeholder="Your Username *" value="" />
                    </div>
                    <div class="form-group mt-2">
                        <label for="pass">Password :</label>
                        <input type="password" id="pass" class="form-control" placeholder="Your Password *" name="password" value="" />
                    </div>
                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-lg btn-success" value="Login" />
                    </div>
                </form>
            </div>
        </div>
    </div>


    <nav class="navbar fixed-bottom navbar-light bg-light">
        <div class="container-fluid justify-content-center mt">
            <div>
                <p class="text-black-50 mt-2"><i class="fa fa-copyright" aria-hidden="true">Abir Shanto</i></p>
            </div>
        </div>
    </nav>
    



    <script type="text/javascript" src="{{asset("admin_panel/js/jquery-3.5.1.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("admin_panel/js/bootstrap.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("admin_panel/js/popper.min.js")}}"></script>

</body>
</html>