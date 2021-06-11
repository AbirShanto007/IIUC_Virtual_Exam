<section>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">IIUC Virtual Quiz</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" style="" class="d-flex justify-content-end">
              @csrf
              <input type="submit" class="btn btn-danger mt-3" value="Logout">
            </form>
        </div>
          {{-- </div> --}}
        </div>
    </nav>
</section>