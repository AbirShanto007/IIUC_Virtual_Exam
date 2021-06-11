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

    <title>Students Info.</title>
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
            <div class="row">
                <h5 class="card-title text-white text-center"><i class="fas fa-users m-2"></i>Students Info.</h5>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Student Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col" class="text-center">Courses</th>
                      </tr>
                    </thead>
                    <tbody>

                        @forelse ($students as $eachstudent)
                        
                        @php
                            $course_ids = App\StudentRequest::select('course_id')->where('student_id',$eachstudent->id)->distinct('course_id')->get();
                        @endphp
                       
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td>{{ $eachstudent->student_id??null }}</td>
                          <td>{{$eachstudent->name??null}}</td>
                          <td>{{$eachstudent->email??null}}</td>
                          <td>
                              <table>
                                  @forelse ($course_ids as $item)
                                  @php
                                       $course_name = App\Course::select('course_title')->where('id',$item->course_id)->first();
                                  @endphp
                                      <tr>
                                          <td>
                                              {{$course_name->course_title??null}}
                                          </td>
                                      </tr>
                                  @empty
                                      
                                  @endforelse
                              </table>
                          </td>
                          
                        </tr>
                        @empty
                            
                        @endforelse






                      
                      
                      
                    </tbody> 
                  </table>
                  <nav aria-label="Page navigation example">
                    {{$students->links()}}
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
    



    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>


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