@extends('User::welcome')
@section('content')

<link rel="stylesheet" href="/css/admin.css">

<div class = "back">
    <a href="user/login"><button class="btn btn-dark bt-lg">User Login</button></a>
</div>

<div class="container custom-login" style="border-radius: 50px;">
    <div class = "row">
        <div class="col-sm-12 text-centre">
            <span style="margin-left: 480px;font-size:40px;"><b>Send Reset Link </b></span><br><br>
        </div><br>
        <div class = "col-sm-5 col-sm-offset-3" style="margin-left: 390px;">
                <span class="text-info email_success"></span>

                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Enter your Email : </label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Test@gmail.com" />
                    <span class="text-danger email_err"></span>
                </div><br>


                <button  class="btn btn-primary" type="submit" id="reset_btn" >Send Mail >></button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#reset_btn').click(function(e){

            var email = $("#email").val();

        $.ajax({
                type: 'post',
                url: '{{ route('newpass') }}',
                data:{
                    _token: '{{csrf_token()}}',
                    email : email,
                },
                success:function(data){
                    if($.isEmptyObject(data.error)){
                        if(data.success){
                            clearerror();
                            $('.email_success').html(data.success);  
                        }
                        else{
                            clearerror();
                            $('.email_err').html(data.notexists); 
                        }  
                    }
                    else{ 
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
        $('.email_err').html('');
        $('.email_success').html('');  
        }
        });

</script>

@endsection