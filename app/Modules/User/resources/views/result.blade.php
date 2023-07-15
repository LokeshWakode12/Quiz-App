@extends('User::welcome')
@section('content')
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="container" style="margin-top: 50px;">
            <div class='row'>
                <div class="col-sm-12">
                    @php 
                    $qcount= 1;
                    $sum = 0;
                    @endphp
                    @foreach($data as $items)
                    <ul style="list-style-type: none;">
                        <li class="col-sm-12">Q{{$qcount++}}.</li>
                        @if(empty($items->user_ans))
                        <li class="col-sm-6 ">Your answer: <span class="text-danger">No Selection<span></li>
                        @else
                        <li class="col-sm-6">Your answer : {{$items->user_ans}}</li>
                        @endif
                        <li class="col-sm-6">Correct answer: {{$items->correct_ans}}</li>
                        <li class="col-sm-6" style="visibility: hidden;">{{$sum += $items->score}}</li>
                    </ul><br>
                    @endforeach
                    <span class="col-sm-6" style="font-size: 30px"><b>Score : {{$sum}}/10</b></span>&nbsp;&nbsp;
                    @if($sum < 4 )
                    <span class="col-sm-6" style="font-size: 30px"><b>Result :<span class="text-success">FAIL</span></b></span><br>
                    @else
                    <span class="col-sm-6" style="font-size: 30px"><b>Result :<span class="text-danger">PASS</span></b></span><br>
                    @endif
                    
                    <a href="./endtest"><button type="submit" class="btn btn-danger btn-lg">End Test</button></a>
                </div>
            </div>
        </div>
    </div>


@endsection
