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

    <title>Course List</title>
</head>
<body>
    <nav class="navbar fixed-top shadow-sm navbar-light bg-light">
        <div class="container-fluid">
        <a id="NavMenuBar" class="navbar-brand NavMenuBar" href="#"><i class="fa fa-bars"></i></a>
        </div>
    </nav>
    

    <div id="SideNavId" class="sideNavClose mt-5">
        <a href="{{route('admin.index')}}" class="nav-menu-item"> <abbr title="Home"><i class="fas fa-home m-2"></i></abbr>  <span class="menuText d-none">Home</span> </a><br>
        <a href="{{route('admin.teacher_list')}}" class="nav-menu-item"> <abbr title="Teachers"><i class="fas fa-chalkboard-teacher m-2"></i></abbr>  <span class="menuText d-none">Teachers</span> </a><br>
        <a href="{{route('admin.student_list')}}" class="nav-menu-item"> <abbr title="Students"><i class="fas fa-users m-2"></i></abbr>  <span class="menuText d-none">Students</span> </a><br>
        <a href="{{route('admin.courses')}}" class="nav-menu-item"> <abbr title="Courses"><i class="fas fa-book m-2"></i></abbr>  <span class="menuText d-none">Courses</span> </a><br>
        <a href="{{route('admin.grade_point')}}" class="nav-menu-item"> <abbr title="Grade Points"><i class="fas fa-graduation-cap m-2"></i></abbr>  <span class="menuText d-none">Grade Points</span> </a><br>
    </div>

    <div id="ContentOverlayId" class="ContentOverlayClose">

    </div>

    <div id="content" class="content" style="margin-bottom: 70px !important;">
        <div class="container">
            <div class="d-flex justify-content-end mb-3">
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="" >
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Logout">
                </form>
            </div>
            
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ((session('success')))
        <div class="alert alert-success">
            <ul>
                    <li>{{ session('success') }}</li>
            </ul>
        </div>
    @endif
            <div class="row mb-5 mt-3 form-border">
                <div class="mb-3 mt-3">
                    <h5 class="card-title text-white text-center"><i class="fas fa-folder-plus"></i> Enter The Course Information</h5>
                    <form action="{{route('admin.courses_add')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="course_title">Course Title:</label>
                                <input type="text" class="form-control" id="course_title" placeholder="Enter Course Title" name="course_title" required>
                                <div class="valid-feedback">Valid.</div>
                                {{-- <div class="invalid-feedback">Please fill out this field.</div> --}}
                              </div>
                              <div class="col">
                                <label for="course_code">Course Code:</label>
                                <input type="text" class="form-control" id="course_code" placeholder="Enter Course Code" name="course_code" required>
                                <div class="valid-feedback">Valid.</div>
                                {{-- <div class="invalid-feedback">Please fill out this field.</div> --}}
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="credit">Course Credit:</label>
                                <input type="number" class="form-control" id="credit" placeholder="Enter Course Credit" name="credit" required>
                                <div class="valid-feedback">Valid.</div>
                                {{-- <div class="invalid-feedback">Please fill out this field.</div> --}}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Submit</button>
                      </form>
                </div>
            </div>
            <div class="row">
                <h5 class="card-title text-white text-center"><i class="fas fa-book m-2"></i>Courses Info.</h5>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Course Title</th>
                        <th scope="col">Course Code</th>
                        <th scope="col">Credit</th>
                        <th scope="col" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $eachCourse)        
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td>{{ $eachCourse->course_title??null }}</td>
                          <td>{{$eachCourse->course_code??null}}</td>
                          <td>{{$eachCourse->credit??null}}</td>
                          <td class="d-flex justify-content-evenly">
                              <form action="{{route('admin.course_delete',['id'=>$eachCourse->id])}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                             </form>
                          </td>
                        </tr>
                        @empty
                            
                        @endforelse
                      
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    {{$courses->links()}}
                  </nav>
                
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