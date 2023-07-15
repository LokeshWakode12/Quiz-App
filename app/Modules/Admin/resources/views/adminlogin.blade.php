@extends('Admin::welcome')
@section('content')

<div class = "back" style="margin-right: 100px;">
    <a href="/"><button class="btn btn-dark bt-lg">Dashboard</button></a>
</div>

<link rel="stylesheet" href="/css/admin.css">

<div class="container custom-login" style="background-color:#1a170d3d;">
    <div class = "row">
        <div class="col-sm-12 text-centre">
            <span style="margin-left: 480px;font-size:40px;"><b>Admin Login ? </b></span><br><br>
        </div><br>
    
        <div class = "col-sm-5 col-sm-offset-3" style="margin-left: 390px;">
            <span class="text-danger err"></span>

                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Enter your Email : </label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Test@gmail.com" />
                    <span class="text-danger email_err"></span>
                </div><br>

                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="password" />
                    <a href="#" style="float:right">Forget Password ?</a>
                    <span class="text-danger password_err"></span>
                </div><br>

                <button  class="btn btn-primary" type="submit" id="login_btn" >Login</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#login_btn').click(function(e){

        e.preventDefault();

        var email = $("#email").val();
        var password = $("#password").val();

        $.ajax({
                type: 'post',
                url: '{{ route('admin-login') }}',
                data:{
                    _token: '{{csrf_token()}}',
                    email:email,
                    password:password,
                },
                success:function(data){
                    if($.isEmptyObject(data.error)){
                        if(data.success){
                            clearerror();
                            window.location="{{route('adminhome')}}";
                        }else{
                            clearerror();
                            $('.err').html(data.notexists);
                        }
                    }else{
                        clearerror();
                        printErrorMsg(data.error);
                    }
                }
        });
    });

    function printErrorMsg(msg)
    {
        $.each(msg,function(key,value){
            $('.'+key+'_err').html('***'+value+"***");
        });
    }
    function clearerror()
    {
        $('.err').html('');
        $('.email_err').html('');
        $('.password_err').html('');
        $('.newpassword_err').html('');
    }
    

});

</script>

@endsection