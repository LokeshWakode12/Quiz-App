@extends('User::welcome')
@section('content')

<link rel="stylesheet" href="/css/userdashboard.css">
<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top mask-custom shadow-0">
      <div class="container">
        <a class="navbar-brand" href="./dashboard"><span style="color: #5e9693;">Quiz</span><span style="color: #fff;">Time</span></a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
          data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link" href="#modal">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./myresult">My Result</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#!">Hint</a>
            </li>
          </ul>
          <ul class="navbar-nav d-flex flex-row">
            <li class="nav-item me-3 me-lg-0 " style="text-transform:uppercase;">
              <a class="nav-link text-light" href="">Welcome to window! &nbsp; {{$data}}</a>
            </li>
            <li class="nav-item me-3 me-lg-0 " style="text-transform:uppercase;">
              <a class="nav-link text-light" href="/logoutuser">Log Out <i class="fa-solid fa-right-from-bracket"></i> </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar -->
    <!--Section: Design Block-->
   
    <section>
      <!-- Intro -->
      <div id="intro" class="bg-image vh-100">
        <div class="mask" style="background-color: rgba(250, 182, 162, 0.15);"></div>
      </div>
      <!-- Intro -->
       <div id="intro" class="bg-image shadow-2-strong" style="position: relative;top: -288px;">
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.4); margin-top: -156px;padding: 55px 0px;">
          <div class="container d-flex align-items-center justify-content-center text-center h-100">
            <div class="text-white">
              <h1 class="mb-3 anim-typewriter line-1"  >!! Welcome to the Quiz Festival !!</h1>
              <h5 class="mb-4 anim-typewriter line-1">Best of luck :) </h5>
              <a class="btn btn-outline-light btn-lg m-2" href="./startquiz" role="button"
                rel="nofollow">Start Quiz</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal -->
  <div class="modal-wrapper" id="modal">
    <div class="modal-body card">
      <div class="modal-header text-justify">
        <h2 class="heading"># Features of quiz </h2><br><br>
        <a href="#!" role="button" class="close" aria-label="close this modal">
          <button class="btn btn-light btn-lg" style="margin-left:-50px;padding:30px 20px; "><b>X</b></button>
        </a>
      </div>
      <ol>
        <li>Test Consist of 10 question.</li>
        <li>Test first 5 are easy question.</li>
        <li>Test second 3 are intermediate question..</li>
        <li>Test second 2 are hard question.</li>
      </ol>
    </div>
    <a href="#!" class="outside-trigger"></a>
  </div>

    <script>
        var i = 0;
        var txt = 'Lorem ipsum dummy text blabla.';
        var speed = 50;
        
        function typeWriter() {
          if (i < txt.length) {
            document.getElementById("demo").innerHTML += txt.charAt(i);
            i++;
            setTimeout(typeWriter, speed);
          }
        }
    </script>
{{-- <i class="fa-solid fa-user"></i> --}}
@endsection 