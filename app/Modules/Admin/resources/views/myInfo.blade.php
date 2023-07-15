@extends('Admin::welcome')
@section('content')
    <link rel="stylesheet" href="/css/update.css">

    <div class="container h-100">
        <div class="container">
            <a href="./dashboard"><span class="back">
                    <button class="btn btn-danger ">
                        <<-GO Back</button>
                            <span>
            </a>
        </div>
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="row justify-content-center">
                        <div class="col-md-10 order-2 order-lg-1">

                            <p class="text-center h2 fw-bold mb-5 mx-1 mx-md-4 mt-4">MY Info :)</p>

                            <div class="mx-1 mx-md-4">
                                <span class="text-info msg"></span>
                                <div class="row">

                                    <div class="d-flex flex-row align-items-center mb-4 col-md-12">
                                        <div class="form-outline flex-fill mb-0">
                                            <span><b>ID </b>: <span> <span>{{$data['id']}} <span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4 col-md-12">
                                        <div class="form-outline flex-fill mb-0">
                                            <span><b>Name </b>: <span> <span>{{$data['name']}} <span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4 col-md-12">
                                        <div class="form-outline flex-fill mb-0">
                                            <span><b>Email </b>: <span> <span>{{$data['email']}} <span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4 col-md-12">
                                        <div class="form-outline flex-fill mb-0">
                                            <a href="./updatemyinfo" ><button type="submit" class="btn btn-primary">Update My Info</button></a>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
