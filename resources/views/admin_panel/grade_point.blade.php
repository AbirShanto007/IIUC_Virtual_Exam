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

    <title>Grade Point</title>
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
            <div class="row mb-5 form-border">
                <div class="mb-3 mt-3">
                    <h5 class="card-title text-white text-center"><i class="fas fa-folder-plus"></i> Enter The Grade Point Information</h5>
                    <form action="{{route('admin.grade_point_add')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="starting_number">Starting Number:</label>
                                <input type="number" class="form-control" id="starting_number" placeholder="Enter The Starting Number" name="starting_number" required>
                                <div class="valid-feedback">Valid.</div>
                               
                            </div>
                            <div class="col-md-6">
                                <label for="ending_number">Ending Number:</label>
                                <input type="number" class="form-control" id="ending_number" placeholder="Enter The Ending Number" name="ending_number" required>
                                <div class="valid-feedback">Valid.</div>
                               
                            </div>
                            <div class="col-md-6">
                                <label for="grade">Grade:</label>
                                <input type="text" class="form-control" id="grade" placeholder="Enter The Grade" name="grade" required>
                                <div class="valid-feedback">Valid.</div>
                               
                            </div>
                            <div class="col-md-6">
                                <label for="grading_point">Grading Point:</label>
                                <input type="number" step="0.01" class="form-control" id="grading_point" placeholder="Enter The Grade Point" name="grade_point" required>
                                <div class="valid-feedback">Valid.</div>
                               
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Submit</button>
                      </form>
                </div>
            </div>
            <div class="row">
                <h5 class="card-title text-white text-center"><i class="fas fa-graduation-cap m-2"></i>Grading Point Info.</h5>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Sl</th>
                        <th scope="col">Starting Number</th>
                        <th scope="col">Ending Number</th>
                        <th scope="col">Grade</th>
                        <th scope="col">Grade Point</th>
                        <th scope="col" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($grade_point as $eachgrade_point)        
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td>{{ $eachgrade_point->starting_number??null }}</td>
                          <td>{{$eachgrade_point->ending_number??null}}</td>
                          <td>{{$eachgrade_point->grade??null}}</td>
                          <td>{{$eachgrade_point->grade_point??null}}</td>
                          <td class="d-flex justify-content-evenly">
                              <form action="{{route('admin.grade_point_delete',['id'=>$eachgrade_point->id])}}" method="POST">
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
                    {{$grade_point->links()}}
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