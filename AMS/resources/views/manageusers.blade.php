@extends('layouts.app')

@section('content')

@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="">
                        <h2>Appointments List</h2>
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Email</th>
                               
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                            <tr>
                                <td>{{$d->name}}</td>
                                <td>{{$d->usertype}}</td>
                                <td>{{$d->email}}</td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete_user"  onclick="document.getElementById('user_id').value = {{$d->id}}"  >Delete</button></td>

                            </tr>
                            @endforeach
                      
                            </tbody>
                        </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-lg btn-info btn-block w-25" id="" href="{{route('add_new_user')}}"style="cursor: pointer"  >Add New</a>

</div>

<!-- delete Appointment Modal -->
<div class="modal" id="delete_user">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete User?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form action="{{route('delete_user')}}" method="post">
      @csrf

      <input type="hidden" class="user_id" name="user_id" value="" id="user_id">

      <div class="modal-footer">

      <button type="submit" class="btn btn-danger" >Yes</button>

        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
