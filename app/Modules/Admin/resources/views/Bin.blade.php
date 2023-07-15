@extends('Admin::welcome')
@section('content')

<link rel="stylesheet" href="/css/userdata.css">

<div class="container">
  <div class="divhead">
    <h1><span class = "heading">Recycle Bin<span></h1>
      <a href="./userdata"><button class="btn btn-secondary binbutton"><<- Go back</button></a>
  </div>
  <div class="divtable" >
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">User ID</th>
        <th scope="col">User Name</th>
        <th scope="col">Email Id</th>
        <th scope="col" >Actions</th>
      </tr>
    </thead>
    @foreach($data as $items)
    <tbody>
      <tr>
        <td>{{$items->id}}</td>
        <td>{{$items->name}}</td>
        <td>{{$items->email}}</td>  
        <td>
          <a href="./restore/{{$items->id}}"><button class="btn btn-primary">Restore</button></a>&nbsp; 
          <a href="./delete/{{$items->id}}"><button class="btn btn-danger">Permanent Delete</button></a>
        </td>
      </tr>
    </tbody>
    @endforeach
  </table>
</div>
</div>

@endsection