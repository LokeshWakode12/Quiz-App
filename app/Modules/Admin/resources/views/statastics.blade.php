@extends('Admin::welcome')
@section('content')

<link rel="stylesheet" href="/css/userdata.css">

<div class="container">
  <div class="">
      <a href="{{route('adminhome')}}"><button class="btn btn-secondary binbutton"><<- Go back</button></a>
  </div>
  <div class="container">
    <h1 style="margin-left: 240px;">Welcome to Graphical World !! </h1>
  </div><br><br>
  <div class="container">
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
  </div>
</div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        
<script>
    window.onload = function() {

    var data1 = {!! json_encode($data1) !!};
    var data2 = {!! json_encode($data2) !!};
    
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title:{
          text: "Total Quiz completed these month"
        },
        axisY: {
          title: "Reserves(MMbbl)"
        },
        data: [{
            type: "column",
            showInLegend: true, 
            legendMarkerColor: "grey",
            legendText: "MMbbl = one million barrels",
            dataPoints: [
                {y: data1, label: "Quiz Completed in these month"},
                {y: data2, label: "Total quiz held"},
            ]
        }]
    });
    chart.render();
    
    }
    </script>

@endsection