@extends('Admin::welcome')
@section('content')
    <link rel="stylesheet" href="/css/update.css">
    <div class="container">
        <a href="./myinfoview"><span class="back">
            <button class="btn btn-danger "><<-GO Back</button>
            <span>
        </a>        
    </div><br>
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Update Page</p>
                            <form class="mx-1 mx-md-4" action= "./changeinfo" method="POST">
                                @csrf
                                <input type="hidden" name="updateid" value="{{$data['id']}}"/>
                                
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="form3Example1c">Your Name</label>
                                        <input type="text" id="form3Example1c" class="form-control" name="name" value="{{$data['name']}}" />
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="form3Example3c">Your Email</label>
                                        <input type="email" id="form3Example3c" class="form-control" name="email" value="{{$data['email']}}"/>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4" id="hidediv">
                                    <div class="form-outline flex-fill mb-0">
                                        <span> To Change Password&nbsp;&nbsp;</span><span onclick="password()" class="cursor: pointer;"><b> Click me :))) </b></span>
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <div class="form-outline flex-fill mb-0">
                                        <span id="pwd" style="visibility: hidden;">
                                        <label class="form-label" for="form3Example3c">Enter New Password</label>
                                        <input type="password" id="form3Example3c" class="form-control" name="password" value="" />
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Update</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function password(){
            document.getElementById("hidediv").style.visibility = "hidden";
            document.getElementById("pwd").style.removeProperty("visibility");
        }
    </script>
@endsection