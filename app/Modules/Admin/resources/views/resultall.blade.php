@extends('Admin::welcome')
@section('content')


<link rel="stylesheet" href="/css/userdata.css">
<link rel="stylesheet" href="/css/table.css">

<div class="container">
  <div class="">
      <a href="{{route('adminhome')}}"><button class="btn btn-secondary binbutton"><<- Go back</button></a>
  </div>
  <div class="divhead">
    <h1><span class = "heading">Result of All users<span></h1>
  </div>
  <div class="divtable" >
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Sr.No.</th>
        <th scope="col">User name</th>
        <th scope="col">Score</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    @php
    $num = 1;
    @endphp
    @foreach($data1 as $items)
    <tbody>
      <tr>
        <td>{{$num++}}</td>
        <td>{{$items->name}}</td>
        <td>{{$items->score}}</td>
        <td>
          <a href="./deleteres/{{$items->test_token}}"><button class="btn btn-danger">Delete</button></a>
        </td>
      </tr>
    </tbody>
    @endforeach
  </table>
</div>
</div>

@endsection