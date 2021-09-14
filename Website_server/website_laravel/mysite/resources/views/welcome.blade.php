<!DOCTYPE html>
<html lang="en">
<SCRIPT LANGUAGE="JavaScript">
  function reP() {
    document.getElementById('oImg').style.display = "block";
  }
</SCRIPT>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Recommend System</title>
  <link rel="icon" type="image/x-icon" href="{{asset('assets/favicon.ico')}}" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
</head>

<body id="page-top" style="background-color:black;">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container px-4 px-lg-5">
        @if ($recommend_list_exist==NULL)
            <a class="navbar-brand" href="/recommend_insert">Recommend</a>
        @else
            <a class="navbar-brand" href="#">Recommend</a>
        @endif
      <div class="container px-4 px-lg-5">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
          aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ms-auto">
              @if ($movie_data_exist==NULL)
                <li class="nav-item"><a class="nav-link" href="/insert">導入數據</a></li>
              @else
                <li class="nav-item"><a class="nav-link" href="/kill">刪除所有資料</a></li>
                <li class="nav-item"><a class="nav-link" href="/index">查看資料庫</a></li>
              @endif
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Masthead-->
  <header class="masthead">
    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
      <div class="d-flex justify-content-center">
        <div class="text-center">
            <h1 class="mx-auto my-0 text-uppercase">Movie Night</h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5">Not today.</h2>
            <form method="POST" action="/recommend_movie">
                @csrf
                <div class="input-group" style="width: 300px;">
                <input type="text" name="username" class="form-control" placeholder="目標user">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-secondary" onclick="reP()">推薦</button>
                </span>
                </div>
                <p Align="Left" style="color:red;">{{ $recommend_error}}</p>
                @foreach($top_movie as $movie)
                  <p Align="Left" style="color:white;">Recommend : {{$movie['top1_movie']}},{{$movie['top2_movie']}}</p>
                @endforeach
            </form>
        </div>

      </div>
    </div>
    
  </header>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <!-- * *                               SB Forms JS                               * *-->
  <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>