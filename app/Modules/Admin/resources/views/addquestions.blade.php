@extends('Admin::welcome')
@section('content')
    <link rel="stylesheet" href="/css/update.css">

    <div class="container h-100">
        <div class="container">
            <a href="./dashboard"><span class="back">
                <button class="btn btn-danger "><<-GO Back</button>
                <span>
            </a>        
        </div>
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="row justify-content-center">
                        <div class="col-md-10 order-2 order-lg-1">

                            <p class="text-center h2 fw-bold mb-5 mx-1 mx-md-4 mt-4">ADD Questions Page</p>
                            
                            <div class="mx-1 mx-md-4">
                                <span class="text-info msg"></span>
                                <div class="row">

                                <div class="d-flex flex-row align-items-center mb-4 col-md-12">
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="Question">Q. Add Question ?</label>
                                        <input type="text" id="Question" class="form-control" name="name" />
                                        <span class="text-danger Question_err"></span>
                                    </div>
                                </div>

                                <div class="align-items-center mb-4 col-sm-6">
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="Option"> Option 1st</label>
                                        <input type="text" id="Option1" class="form-control" name="Option1" />
                                        <span class="text-danger Option1_err"></span>
                                    </div>
                                </div>

                                <div class="align-items-center mb-4 col-sm-6">
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="Option"> Option 2nd</label>
                                        <input type="text" id="Option2" class="form-control" name="Option2" />
                                        <span class="text-danger Option2_err"></span>
                                    </div>
                                </div>

                                
                                <div class="align-items-center mb-4 col-sm-6">
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="Option"> Option 3rd</label>
                                        <input type="text" id="Option3" class="form-control" name="Option3" />
                                        <span class="text-danger Option3_err"></span>
                                    </div>
                                </div>

                                
                                <div class="align-items-center mb-4 col-sm-6">
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="Option"> Option 4th</label>
                                        <input type="text" id="Option4" class="form-control" name="Option4" value="" />
                                        <span class="text-danger Option4_err"></span>
                                    </div>
                                </div>

                                <div class="align-items-center mb-4 col-sm-6">
                                    <div class="form-outline flex-fill mb-0 ">
                                        <label class="form-label" for="Answer">Correct Option</label>
                                        <select id="Answer" name="Answer" id="Answer" class="form-control">
                                            <option value="option1">Option 1st</option>
                                            <option value="option2">Option 2nd</option>
                                            <option value="option3">Option 3rd</option>
                                            <option value="option4">Option 4th</option>
                                          </select>
                                    </div>
                                </div>

                                <div class="align-items-center mb-4 col-sm-6">
                                    <div class="form-outline flex-fill mb-0 ">
                                        <label class="form-label" for="Answer">Correct Option</label>
                                        <select id="category" name="category" id="category" class="form-control">
                                            <option value="easy">Easy</option>
                                            <option value="medium">Medium</option>
                                            <option value="hard">Hard</option>
                                          </select>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center mb-3 mb-lg-4">
                                    <button type="button" id="submitbtn" class="btn btn-primary btn-lg">Submit</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#submitbtn').click(function(e){
    
            e.preventDefault();
    
            var Question = $("#Question").val();
            var category = $("#category").val();
            var Option1 = $("#Option1").val();
            var Option2 = $("#Option2").val();
            var Option3 = $("#Option3").val();
            var Option4 = $("#Option4").val();
            var Answer = $("#Answer").val();
    
            $.ajax({
                    type: 'post',
                    url: '{{ route('storequestion') }}',
                    data:{
                        _token: '{{csrf_token()}}',
                        Question:Question,
                        category:category,
                        Option1:Option1,
                        Option2:Option2,
                        Option3:Option3,
                        Option4:Option4,
                        Answer:Answer,
                    },
                    success:function(data){
                        if($.isEmptyObject(data.error)){
                            if(data.success){
                                clearerror();
                                clearfield();
                                $('.msg').html(data.success+"->>");
                            }
                        }else{
                            alert(data.error);
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
            $('.Question_err').html('');
            $('.Option1_err').html('');
            $('.Option2_err').html('');
            $('.Option3_err').html('');
            $('.Option4_err').html('');
            $('.msg').html('');
        }

        function clearfield(){
            $('#Question').val('');
            $('#Option1').val('');
            $('#Option2').val('');
            $('#Option3').val('');
            $('#Option4').val('');
        }

    });
    
    </script>
@endsection
