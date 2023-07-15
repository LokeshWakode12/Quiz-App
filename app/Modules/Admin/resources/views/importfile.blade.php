@extends('Admin::welcome')
@section('content')
    <div class="row d-flex justify-content-center align-items-center h-100" style="margin-top: 120px;">
        <div class="col-md-10 order-2 order-lg-1">
            <form action="./importque" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- <input type="text" name="name" value="hii"><br><br> --}}
                <input type="file" name="myfile" ><br><br>

                @if(count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">*** {{ $error }} ***</p>
                    @endforeach
                @endif

                <button class="btn btn-primary btn-lg" type="submit">Import Data</button>
                
            </form>
        </div>
    </div>
@endsection
