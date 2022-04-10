
@extends('layouts.app')

@section('content')


@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="container">
  <div class=" justify-content-center">
<form method="POST" id="new_user" action="{{route('add_new_user_post')}}">
        @csrf
          <div class="form-group w-50" >
          <label for="recipient-name" class="col-form-label ">Doctor:</label>
            <select  required class="browser-default custom-select select" name="usertype" id="usertype">
            <option selected disabled value=""> Select usertype</option>
            <option   value="admin"> Admin</option>
            <option   value="doctor"> Doctor</option>
            <option   value="patient"> Patient</option>
            </select>
          </div>
          <div class="form-group w-50" >
            <label for="recipient-name" class="col-form-label ">Name:</label>
            <input  required name="name" id="Name"  type="text"  class="span4 form-control" value="" >

          </div>
          <div class="form-group w-50" >
            <label for="recipient-name" class="col-form-label ">Email:</label>
            <input  required name="email" id="email"  type="text"  class="span4 form-control" value="" >
          </div>
          
          <div class="form-group w-50" >
            <label for="recipient-name" class="col-form-label ">Password:</label>
            <input  required minlength="8" name="password" id="password"  type="password"  class="span4 form-control" value="" >

          </div>

  <br>

          <input type="submit" class="btn btn-success" id="submit">
        </form>
  </div>
</div>

@endsection