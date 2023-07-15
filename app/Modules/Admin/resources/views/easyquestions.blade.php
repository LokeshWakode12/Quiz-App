@extends('Admin::welcome')
@section('content')


<link rel="stylesheet" href="/css/userdata.css">
<link rel="stylesheet" href="/css/table.css">

<div class="container">
  <div class="">
      <a href="{{route('adminhome')}}"><button class="btn btn-secondary binbutton"><<- Go back</button></a>
  </div>
  <div class="divhead">
    <h1><span class = "heading">Easy Questions<span></h1>
  </div>
  <div class="divtable" >
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Questions</th>
        <th scope="col">Category</th>
        <th scope="col">Correct option</th>
        <th scope="col" colspan="2">Actions</th>
      </tr>
    </thead>
    @php
    $num = 1;
    @endphp
    @foreach($data as $items)
    <span style="display:none">{{$val = $items->answer}}</span> 
    <tbody>
      <tr>
        <td>{{$num++}}</td>
        <td>{{$items->question}}</td>
        <td>{{$items->category}}</td>
        <td>{{$items->$val}}</td>
        <td style="width:0px;padding: 8px 33px;">
          <form action="./updateque" method="POST">
            @csrf
            <input type="hidden" name="updateid" value="{{$items->id}}"/>
            <button class="form btn btn-primary" type="submit" >Update</button>
          </form>

        </td><td>
          <a href="./deleteque/{{$items->id}}"><button class="btn btn-danger">Delete</button></a>
        </td>
      </tr>
    </tbody>
    @endforeach
  </table>
</div>
</div>

@endsection