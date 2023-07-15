@extends('Admin::welcome')
@section('content')

<link rel="stylesheet" href="/css/admin.css">


<div class="container custom-login" style="border-radius: 50px;">
    <div class = "row">
        <div class="col-sm-12 text-centre">
            <span style="margin-left: 480px;font-size:40px;"><b>Reset Password </b></span><br><br>
        </div><br>

        <div class = "col-sm-5 col-sm-offset-3" style="margin-left: 390px;">
                    <span class="text-danger err"></span>
                    <span class="text-danger success_err"></span>
                    <input type="text" id="token" name="token" value = "{{ $token }}">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" aria-describedby="emailHelp" value="{{ $email ?? old('email') }}"/>
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
                <button  class="btn btn-primary" id="reset_btn" >Reset Password</button>
        </div>
    </div>
</div>

<script>
        $(document).ready(function(){
            $("#reset_btn").on('click',function(e){

                var email = $("#email").val();
                var password = $("#password").val();
                var newpassword = $("#newpassword").val();
                var token = $("#token").val();

                    $.ajax({
                                type: 'post',
                                url: '{{ route('reset-password') }}',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    token:token,
                                    email:email,
                                    password:password,
                                    newpassword:newpassword,
                                },
                        
                                success:function(data){
                                    if($.isEmptyObject(data.error)){
                                        if(data.success){
                                            clearerror();
                                            $('.err').html(data.success);
                                            window.location="{{route('userloginview')}}";
                                        }
                                        else{
                                            clearerror();
                                            $('.success_err').html('***'+data.token+'***');
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

                    $('.'+key+'_err').html('***'+value+'***');
                });
            }
            function clearerror()
            {
                $('.newpassword_err').html('');
                $('.err').html('');
                $('.password_err').html('');
                $('.success_err').html('');
            }
            
        });


</script>
@endsection

