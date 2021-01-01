<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
    <div class="container">

      <a href="{{route('course_all')}}" class="mt-5 btn btn-success mb-3">Go To Course List</a>

      <h4>Create Coure</h4>





      
      <form action="{{route('course_store')}}" method="POST">
        @csrf

        <div class="form-group">
          <label>Course Title</label>
          <input type="text" class="form-control" name="title">
        </div>
        
        <div class="form-group">
          <label>Course Code</label>
          <input type="text" class="form-control" name="code">
        </div>
        
        <div class="form-group">
          <label>Course Credit</label>
          <input type="number" class="form-control" name="credit">
        </div>

        <button type="submit" class="btn btn-info">Save</button>
      </form>
    </div>
    


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>




{{-- <div class="container">
  <form action="" method="post">
      <div class="form-group">
        <label>Course Title</label>
        <input type="text" name="course_title" class="form-control">
      </div>
      <div class="form-group">
        <label>Course Code</label>
        <input type="text" name="course_title" class="form-control">
      </div>
      <div class="form-group">
        <label>Course Credit</label>
        <input type="number" name="course_title" class="form-control">
      </div>
  </form>
</div> --}}