@extends('User::welcome')
@section('content')


<link rel="stylesheet" href="/css/userdata.css">
<link rel="stylesheet" href="/css/table.css">

<div class="container">
  <div class="">
      <a href="./dashboard"><button class="btn btn-secondary binbutton"><<- Go back</button></a>
  </div>
  <div class="divhead">
    <h1><span class = "heading">My Results<span></h1>
  </div>
  <div class="divtable" >
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Sr No.</th>
        <th scope="col">Test Number</th>
        <th scope="col">Score</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    @php
    $num = 1;
    @endphp
    @foreach($data as $items)
    <tbody>
      <tr>
        <td>{{$num}}</td>
        <td>Test{{$num++}}</td>
        <td>{{$items->score}}/10</td>
        @if($items->score < 4)
        <td class="text-danger"><b>Fail</b></td>            
        @else
        <td ><b>Pass</b></td>            
        @endif
      </tr>
    </tbody>
    @endforeach
  </table>
</div>
</div>

@endsection