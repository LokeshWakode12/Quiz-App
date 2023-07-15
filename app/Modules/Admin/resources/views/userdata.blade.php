@extends('Admin::welcome')
@section('content')

<link rel="stylesheet" href="/css/userdata.css">

<div class="container">
  <div class="">
      <a href="{{route('adminhome')}}"><button class="btn btn-secondary binbutton"><<- Go back</button></a>
  </div>
  <div class="divhead">
    <h1><span class = "heading">User's Data<span></h1>
      <a href="./Bin"><button class="btn btn-dark binbutton btn-lg"><i class="bi bi-trash"></i></button></a>
  </div>
  <div class="divtable" >
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">User ID</th>
        <th scope="col">User Name</th>
        <th scope="col">Email Id</th>
        <th scope="col">Status</th>
        <th scope="col" colspan="2">Actions</th>
      </tr>
    </thead>
    @foreach($data as $items)
    <tbody>
      <tr>
        <td>{{$items->id}}</td>
        <td>{{$items->name}}</td>
        <td>{{$items->email}}</td>
        <td><i><b>
        @if($items->status == 0)
        UnBan
        @else
          Ban
        @endif
        </b></i></td>
        <td style="width:0px;">
          <form action="./update" method="POST">
            @csrf
            <input type="hidden" name="updateid" value="{{$items->id}}"/>
            <input type="hidden" name="status" value="{{$items->status}}"/>
            <button class="form btn btn-primary" type="submit" >Update</button>
          </form>

        </td><td>
          <a href="./trash/{{$items->id}}"><button class="btn btn-danger">Trash</button></a>
        </td>
      </tr>
    </tbody>
    @endforeach
  </table>
</div>
</div>



@endsection