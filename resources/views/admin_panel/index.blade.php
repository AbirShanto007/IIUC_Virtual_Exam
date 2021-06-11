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

    <title>Admin Index</title>
</head>
<body>
    <nav class="navbar fixed-top shadow-sm navbar-light bg-light">
        <div class="container-fluid">
           
        <a id="NavMenuBar" class="navbar-brand NavMenuBar" href="#"><i class="fa fa-bars"></i></a>
        </div>
    </nav>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="">
        @csrf
        <input type="submit" class="btn btn-danger" value="Logout">
    </form>
    <div id="SideNavId" class="sideNavClose mt-5">
        <a href="{{route('admin.index')}}" class="nav-menu-item"> <abbr title="Home"><i class="fas fa-home m-2"></i></abbr>  <span class="menuText d-none">Home</span> </a><br>
        <a href="{{route('admin.teacher_list')}}" class="nav-menu-item"> <abbr title="Teachers"><i class="fas fa-chalkboard-teacher m-2"></i></abbr>  <span class="menuText d-none">Teachers</span> </a><br>
        <a href="{{route('admin.student_list')}}" class="nav-menu-item"> <abbr title="Students"><i class="fas fa-users m-2"></i></abbr>  <span class="menuText d-none">Students</span> </a><br>
        <a href="{{route('admin.courses')}}" class="nav-menu-item"> <abbr title="Courses"><i class="fas fa-book m-2"></i></abbr>  <span class="menuText d-none">Courses</span> </a><br>
        <a href="{{route('admin.grade_point')}}" class="nav-menu-item"> <abbr title="Grade Points"><i class="fas fa-graduation-cap m-2"></i></abbr>  <span class="menuText d-none">Grade Points</span> </a><br>
    </div>

    <div id="ContentOverlayId" class="ContentOverlayClose">

    </div>

    <div id="index_content" class="content" style="margin-bottom: 70px !important;">
        <div class="container">
            <div class="d-flex justify-content-end mb-3">
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="" >
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Logout">
                </form>
            </div>

            <div class="row">
                <div class="col-md-6 p-2">
                    <div class="card w-100">
                        <!-- <img src="images/teachers.jpg" class="card-img-top w-100" alt="..."> -->
                        <div class="card-body">
                          <h5 class="card-title text-white text-center"><i class="fas fa-chalkboard-teacher m-2"></i>Teachers</h5>
                          <p class="card-text">In this section All the teachers information Stored. The list of courses taken by him is also included here.</p>
                          <a href="{{route('admin.teacher_list')}}" class="btn btn-info">Enter Here <i class="fas fa-sign-in-alt"></i></a>
                        </div>
                      </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card w-100">
                        <!-- <img src="images/demo.jpg" class="card-img-top w-100" alt="..."> -->
                        <div class="card-body">
                          <h5 class="card-title text-white text-center"><i class="fas fa-users m-2"></i>Students</h5>
                          <p class="card-text">In this section All the students information Stored. The list of courses enroll by him is also included here.</p>
                          <a href="{{route('admin.student_list')}}" class="btn btn-info">Enter Here <i class="fas fa-sign-in-alt"></i></a>
                        </div>
                      </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card w-100">
                        <!-- <img src="images/demo.jpg" class="card-img-top w-100" alt="..."> -->
                        <div class="card-body">
                          <h5 class="card-title text-white text-center"><i class="fas fa-book m-2"></i>Courses</h5>
                          <p class="card-text">In this Section you insert all the courses information. You also get all the courses information in this section and you can remove courses if needed.</p>
                          <a href="{{route('admin.courses')}}" class="btn btn-info">Enter Here <i class="fas fa-sign-in-alt"></i></a>
                        </div>
                      </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card w-100">
                        <!-- <img src="images/demo.jpg" class="card-img-top w-100" alt="..."> -->
                        <div class="card-body">
                          <h5 class="card-title text-white text-center"><i class="fas fa-graduation-cap m-2"></i>Grade Points</h5>
                          <p class="card-text">In this Section you insert all the Grade point information. You also get all the Grade point information in this section and you can remove Grade scale if needed.</p>
                          <a href="{{route('admin.grade_point')}}" class="btn btn-info">Enter Here <i class="fas fa-sign-in-alt"></i></a>
                        </div>
                      </div>
                </div>
                
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <div class="container-fluid justify-content-center mt">
            <!-- <a class="navbar-brand" href="#"></a> -->
            <div>
                <p class="text-black-50 mt-2"><i class="fa fa-copyright" aria-hidden="true">Abir Shanto</i></p>
            </div>
        </div>
    </nav>
    



    <script type="text/javascript" src="{{asset("admin_panel/js/jquery-3.5.1.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("admin_panel/js/bootstrap.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("admin_panel/js/popper.min.js")}}"></script>


    <script type="text/javascript">
        $('#NavMenuBar').click(function(){
            sideNabOpenClose();
        });

        $('#ContentOverlayId').click(function(){
            sideNabOpenClose();
        });

        function sideNabOpenClose(){
            let SideNavId = $('#SideNavId');
            let ContentOverlayId = $('#ContentOverlayId');
            let menuText = $('.menuText');

            if(SideNavId.hasClass('sideNavClose'))
            {
                SideNavId.removeClass('sideNavClose')
                SideNavId.addClass('sideNavOpen')

                menuText.removeClass('d-none');

                ContentOverlayId.removeClass('ContentOverlayClose')
                ContentOverlayId.addClass('ContentOverlay')
                
            }else{
                SideNavId.removeClass('sideNavOpen')
                SideNavId.addClass('sideNavClose')

                menuText.addClass('d-none');

                ContentOverlayId.removeClass('ContentOverlay')
                ContentOverlayId.addClass('ContentOverlayClose')
            }
        }


    </script>
</body>
</html>