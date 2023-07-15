@extends('Admin::welcome')
@section('content')

<link rel="stylesheet" href="/css/admin.css">

<div class = "back" style="margin-right: 170px;">
    <a href="/"><button class="btn btn-info bt-lg">Dashboard</button></a>
</div>

<div class = "back">
    <a href="./login"><button class="btn btn-dark bt-lg">User LOGIN</button></a>
</div>

<div class="container custom-login" style="border-radius: 50px;">
    <div class = "row">
        <div class="col-sm-12 text-centre">
            <span style="margin-left: 480px;font-size:40px;"><b>User Register ? </b></span><br><br>
        </div><br>

        <div class = "col-sm-5 col-sm-offset-3" style="margin-left: 390px;">
                    <span class="text-danger err"></span>
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="username" aria-describedby="emailHelp"  />
                    <span class="text-danger name_err"></span>
                </div><br>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" aria-describedby="emailHelp" required/>
                    <span class="text-danger email_err"></span>
                </div><br>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="password" id="exampleInputPassword1">
                    <span class="text-danger password_err"></span>
                </div><br>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="enter password" value="{{ old('newpassword') }}">
                    <span class="text-danger newpassword_err"></span>
                </div><br>
                <button  class="btn btn-primary" id="save_form" >Register</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
    $("#save_form").on('click',function(e){

        var name = $('#name').val();
        var email = $("#email").val();
        var password = $("#password").val();
        var newpassword = $("#newpassword").val();

            $.ajax({
                        type: 'post',
                        url: '/user-register',
                        dataType: 'JSON',
                        data: {
                            _token: '{{csrf_token()}}',
                            name:name,
                            email:email,
                            password:password,
                            newpassword:newpassword,
                        },
                
                        success:function(data){
                            console.log(data.success);
                            if($.isEmptyObject(data.error)){
                                if(data.success){
                                    clearerror()
                                    alert("Sucessfully registered");
                                    window.location="{{route('userloginview')}}";
                                }else{
                                    clearerror()
                                    $('.err').html(data.exists);
                                }
                            }
                            else{
                                clearerror()
                                printErrorMsg(data.error);
                            }
                        }

            });          
    });
    function printErrorMsg(msg)
    {
        $.each(msg,function(key,value){
            $('.'+key+'_err').html('***'+value+'***');
        });
    }
    function clearerror()
    {
        $('.err').html('');
        $('.name_err').html('');
        $('.email_err').html('');
        $('.password_err').html('');
    }
});

</script>
@endsection