@extends('User::welcome')
@section('content')

<link rel="stylesheet" href="/css/quizpanel.css">

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="">
                    <div class="card bg-dark text-white" id="divblack"style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <span value="0" max="10" id="progressBar" style="float:right;font-size:20px;"></span>
                            <span id="qelement">Q.<span id="num" ></span></span> 
                            <h3 id="question" class="element1"></h3><br>

                            <div class="row">
                            <div class="col-sm-6 element1" id = "color1" onclick = "val1()" style="background-color:#212529;">
                            <span id="option1" ></span><br>
                            </div>
                            <div class="element1 col-sm-6" id = "color2" onclick = "val2()" style="background-color:#212529;">
                            <span id="option2" ></span><br>
                            </div>
                            <div class="element1 col-sm-6" id = "color3" onclick = "val3()" style="background-color:#212529;">
                            <span id="option3" ></span><br>
                            </div>
                            <div class="element1 col-sm-6" id = "color4" onclick = "val4()" style="background-color:#212529;">
                            <span id="option4" ></span><br><br>
                            </div>
                            </div>

                            <button id="btnsubmit" onclick="submit()" class="btn btn-primary btn-lg" style="visibility:hidden">Submit</button><br>
                            <button id="btnnext" onclick="next()" class="btn btn-primary btn-lg">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        // if(location.reload()){
        //     console.log("pagerefresh");
        // }
        // location.reload(function(){
            
        // });
        var arr = {!! json_encode($data) !!};
        var i=1; // count of data taking
        let html= "";
        let user_ans = [] ;
        let que_id = [arr[0]['id']];

        var timeleft = 10;
        var downloadTimer = setInterval(function(){
        if(timeleft <= 0){
            clearInterval(downloadTimer);
        }

        document.getElementById("progressBar").innerHTML = timeleft;
        timeleft -= 1;
            if(timeleft == 0 && i != 10 ){
                next();
            }else if(i == 10 && timeleft == 0){
                    submit();
            }
        }, 1000); 

    run();

    function next(){  

            empt();
            timeleft = 10;
            i++;
            run();
            user_ans.push(html);
            html = "";
            que_id.push(arr[i-1]['id']);
            removecolor();

    }
        
    function run(){
        
        if(i < 10){
            document.getElementById("num").innerHTML = i;
            document.getElementById("question").innerHTML = arr[i-1]['question'];
            document.getElementById("option1").innerHTML = arr[i-1]['option1'];
            document.getElementById("option2").innerHTML = arr[i-1]['option2'];
            document.getElementById("option3").innerHTML = arr[i-1]['option3'];
            document.getElementById("option4").innerHTML = arr[i-1]['option4'];

        }else if( i == 10){
            document.getElementById("num").innerHTML = i;
            document.getElementById("question").innerHTML = arr[i-1]['question'];
            document.getElementById("option1").innerHTML = arr[i-1]['option1'];
            document.getElementById("option2").innerHTML = arr[i-1]['option2'];
            document.getElementById("option3").innerHTML = arr[i-1]['option3'];
            document.getElementById("option4").innerHTML = arr[i-1]['option4'];
            document.getElementById("btnnext").style.visibility = "hidden";
            document.getElementById("btnsubmit").style.removeProperty("visibility");
        }
        else{
            document.getElementById("question").innerHTML = "error";
            document.getElementById("qelement").innerHTML = ""; 
            document.getElementById("btnnext").style.visibility = "hidden";
            document.getElementById("btnsubmit").style.visibility = "hidden";
            document.getElementById("divblack").classList.remove("bg-dark");
        }
    }

        function empt(){
        document.getElementById("num").innerHTML = "";
        document.getElementById("question").innerHTML = "";
        document.getElementById("option1").innerHTML = "";
        document.getElementById("option2").innerHTML = "";
        document.getElementById("option3").innerHTML = "";
        document.getElementById("option4").innerHTML = "";
    }

    function val1(){
        html = "";
        html += document.getElementById("option1").innerHTML;
        removecolor();
        document.getElementById("color1").style.backgroundColor = "#4fa973";

    }
    function val2(){
        html = "";
        html = document.getElementById("option2").innerHTML;
        removecolor();
        document.getElementById("color2").style.backgroundColor = "#4fa973";

    }
    function val3(){
        html = "";
        html = document.getElementById("option3").innerHTML;
        removecolor();
        document.getElementById("color3").style.backgroundColor = "#4fa973";

    }
    function val4(){
        html = "";
        html = document.getElementById("option4").innerHTML;
        removecolor();
        document.getElementById("color4").style.backgroundColor = "#4fa973";

    }



    function submit(){

    user_ans.push(html);

        $.ajax({
                    type: 'post',
                    url: '{{ route('datasend') }}',
                    data:{
                        _token: '{{csrf_token()}}',
                        user_ans:user_ans,
                        que_id:que_id

                    },
                    success:function(data){
                        console.log(data.success);
                        window.location="{{route('result')}}";
                    }
            });
        }

    function removecolor(){
        document.getElementById("color1").style.backgroundColor  = "#212529";
        document.getElementById("color2").style.backgroundColor  = "#212529";
        document.getElementById("color3").style.backgroundColor  = "#212529";
        document.getElementById("color4").style.backgroundColor  = "#212529";
    }

    </script>
@endsection
