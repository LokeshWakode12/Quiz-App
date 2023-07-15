@extends('Admin::welcome')
@section('content')

<link rel="stylesheet" href="/css/admindashboard.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script type="text/javascript" src="/js/admindashboard.js"></script>
<nav>
<section id="sidebar">
       
    <div class="sidebar-brand" style="margin-left: -9px;">
        <h2><i class="fa-solid fa-house"></i><span><b>ADMIN<br> DASHBOARD<br></b></span></h2>
    </div>
    <div class="sidebar-menu">
        <ul style="overflow:scroll; height:400px; margin-left:-26px; overflow-x:hidden; ">
            <li><a id="" href="./userdata"><i class="fa-solid fa-database"></i><span>USER DATA </span></a></li>

            <li><a id="Uibtn" href="#"><i class="fa-regular fa-file"></i><span>QUESTIONS ?</span></a></li>
                <ul id="ui-basic" class="nav flex-column sub-menu"></li>
                    <li class="downlist"> <a  href="./easyquestions">Easy</a></li>
                    <li class="downlist"> <a  href="./mediumquestions">Medium</a></li>
                    <li class="downlist"> <a  href="./hardquestions">Hard</a></li>
                    <li class="downlist"> <a  href="./importView">Import Data by Excel file</a></li>
                </ul>
            <li><a  href="./addquestion"><i class="fa-solid fa-plus"></i><span>ADD QUESTIONS</span></a></li>
            <li><a  href="./resultall"><i class="fa-solid fa-comment"></i><span>RESULT</span></a></li>
            <li><a  href="./statistics"><i class="fa-solid fa-chart-column"></i><span>Statistics</span></a></li>
            <li><a  href="./logout"><i class="fa-solid fa-right-from-bracket"></i><span>LOGOUT</span></a></li>

            

        </ul>
    </div>
</section>
<nav>
<section id="main-content">
    <header class="main-header">
   <div class="header-left navbar">
    <h4></i><span ><i class="fa-solid fa-house"></i></span></h4>
   </div>
   
   <div class="header-left navbar">
    <a href="./myinfoview">
   <img src="" class="img-responsive">
   <h3><span style="text-transform:uppercase;" ><i class="fa-solid fa-user"></i>  {{$data}}</span></h3>
    </a>
    </div>
    </header>
</section>
</nav>
<div class="content bg-image" >
    
        {{-- <h1> hii <h1> --}}
    
</div>


<script>
    $(document).ready(function(){
        $("#Uibtn").click(function(){
            $("#ui-basic").toggle();
        });
    });
</script>


@endsection