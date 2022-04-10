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
                                <th>Date</th>
                                <th>Patient's Name</th>
                                <th>Doctor's Name</th>
                                <th>Time Window</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $ap)
                            <tr>
                                <td>{{$ap->date}}</td>
                                <td>{{$ap->patient_name}}</td>
                                <td>{{$ap->doctor_name}}</td>
                                <td>{{$ap->start}} - {{$ap->end}}</td>
                                <td class="text-capitalize">{{$ap->status}}</td>
                                <td>
                                    @if(AUTH::user()->usertype == 'patient')
                                    
                                    <button type="button" class="btn btn-primary actionbutton" data-toggle="modal" data-target="#delete_appointment"  onclick="document.getElementById('appointment_delete_id').value = {{$ap->id}}"  >Delete</button> 

                                    @elseif(AUTH::user()->usertype == 'doctor')
                                    
                                        @if($ap -> status == 'submitted') <a type="button" class="btn btn-primary actionbutton" data-toggle="modal" data-target="#accept_appointment"onclick="document.getElementById('appointment_accept_id').value = {{$ap->id}}" >Accept</a> 
                                        <a  type="button" class="btn btn-primary" data-toggle="modal" data-target="#reject_appointment"onclick="document.getElementById('appointment_reject_id').value = {{$ap->id}}" >Reject</a> 
                                        @endif 
                                        @if($ap -> status == 'accepted') 
                                        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#finish_appointment" onclick="document.getElementById('appointment_finish_id').value = {{$ap->id}}">Finish</a>  @endif 

                                    @elseif(AUTH::user()->usertype == 'admin')
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete_appointment"  onclick="document.getElementById('appointment_delete_id').value = {{$ap->id}}"  >Delete</button>                                    
                                     @endif
                                </td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-lg btn-info btn-block w-25" id="" href="{{route('add_new_appointment')}}"style="cursor: pointer"  >Add New</a>
                          
</div>



<!-- The Modal -->





<!-- delete Appointment Modal -->
<div class="modal" id="delete_appointment">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Appintment?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form action="{{route('delete_appointment')}}" method="post">
      @csrf

      <input type="hidden" class="appointment_id" name="appointment_id" value="" id="appointment_delete_id">

      <div class="modal-footer">

      <button type="submit" class="btn btn-danger" >Yes</button>

        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Accept Appointment Modal -->
<div class="modal" id="accept_appointment">
<div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Accept Appintment?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form action="{{route('accept_appointment')}}"  method="POST">
      @csrf

      <input type="hidden" class="appointment_id" name="appointment_id" value="" id="appointment_accept_id">

      <div class="modal-footer">
      <button type="submit" n class="btn btn-primary" >Yes</button>

        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- Finish Appointment Modal -->
<div class="modal" id="finish_appointment">
<div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Finish Appintment?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form action="{{route('finish_appointment')}}" method="post">
      @csrf

      <input type="hidden" class="appointment_id" name="appointment_id" value="" id="appointment_finish_id">

      <div class="modal-footer">
      <button type="submit" class="btn btn-primary" >Yes</button>

        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal" id="reject_appointment">
<div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Reject Appintment?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form action="{{route('reject_appointment')}}" method="post">
          @csrf
      <input type="hidden" class="appointment_id" name="appointment_id" value="" id="appointment_reject_id">

      <div class="modal-footer">
      <button type="submit" class="btn btn-primary" >Yes</button>

        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection


<script>
    
</script>
