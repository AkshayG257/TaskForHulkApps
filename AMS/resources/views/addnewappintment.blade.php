

@extends('layouts.app')

@section('content')


<div class="container">
  <div class=" justify-content-center">
<form method="POST" id="new_appointment" action="{{route('add_new_appointment_post')}}">
        @csrf
          <div class="form-group w-50" >
            @if(AUTH::user()->usertype == 'doctor')
            <input type="hidden" name="doctor_id" id="doctor_id" value="{{AUTH::user()->id}}">
            @else
            <label for="recipient-name" class="col-form-label ">Doctor:</label>

            <select  required class="browser-default custom-select select" name="doctor_id" id="doctor_id">
            <option selected disabled value=""> Select Doctor</option>

              @foreach($data['doctors'] as $doc)
                    <option value="{{$doc->id}}">{{$doc->name}}</option>
                   
              @endforeach
            </select>
            @endif
          
          </div>

          <div class="form-group w-50" >

          @if(AUTH::user()->usertype == 'patient')
          <input type="hidden" name="patient_id" id="patient_id" value="{{AUTH::user()->id}}">

          @else
          <label for="recipient-name" class="col-form-label ">Patient:</label>
            <select required class="browser-default custom-select select" name="patient_id" id="patient_id">
                    <option selected disabled value="">Select Patient</option>
                    @foreach($data['patients'] as $patient)
                    <option value="{{$patient->id}}">{{$patient->name}}</option>
                   @endforeach
            </select>
          @endif
           
          </div>
          <div class="control-group form-horizontal calendar  w-50">
              <label class="control-label">Select Date </label>
              <div class="controls" style="position: relative">
                 <input  required name="date" id="datepicker"  type="text" id="date" class="span4 form-control" value="" >
              </div>
          </div>
          <br>
          <div class="control-group form-horizontal calendar  w-50">
              <label class="control-label">Select start time </label>
              <div class="controls" style="position: relative">
                 <input  required name="start_time" id="timepickerstart"  type="text"  class="span4 form-control" value="" >
              </div>
          </div>
          <div class="control-group form-horizontal calendar  w-50">
              <label class="control-label">Select start end </label>
              <div class="controls" style="position: relative">
                 <input  required name="end_time" id="timepickerend"  type="text"  class="span4 form-control" value="" >
              </div>
          </div>
  <br>
          <input type="submit" class="btn btn-success" id="submit">
        </form>
  </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type="text/javascript">
   $(document).ready(function () {

    $('.select').change(function() {

        if(document.getElementById('patient_id').value != ''  && document.getElementById('doctor_id').value != ''){
          $('.calendar').show();
        }
    })


    jQuery.noConflict()
  $('#timepickerstart').timepicker({
    timeFormat: 'HH:mm:ss',
    change: function() {
      checkvalidtime()
    }
  });

  $('#timepickerend').timepicker({
              timeFormat: 'HH:mm:ss',
              change: function() {
                checkvalidtime()
    }
  });

  $(function() {  
          $( "#datepicker" ).datepicker({  
              appendText:"(yy-mm-dd)",  
              dateFormat:"yy-mm-dd",  
              altField: "#datepick-2",  
              altFormat: "DD, d MM, yy" ,
              minDate: new Date()
          });  
        });  
        $('.calendar').hide();
     
})
function checkvalidtime(){
  if(document.getElementById('timepickerstart').value != '' && document.getElementById('timepickerstart').value != ''){
                  var startTime = minFromMidnight(document.getElementById('timepickerstart').value) ;
                  var endTime = minFromMidnight(document.getElementById('timepickerend').value) ;
                  if(document.getElementById('timepickerend').value <=  document.getElementById('timepickerstart').value ){
                    alert('Invalid Time Selected')

                    $('#timepickerend').val('');
                  }
                  if(endTime - startTime >120){
                    alert('Appointment Cannot be more than 2 hours')

                    $('#timepickerend').val('');
                  }
                  var doc_id = document.getElementById('doctor_id').value;
                  var start = document.getElementById('timepickerstart').value;
                  var end = document.getElementById('timepickerend').value
                  var date = document.getElementById('datepicker').value;
                  if(start != '' && end != ''){
                    checkAvailibility(doc_id,date,start,end );
                  } 
  }   
}
function minFromMidnight(tm){
 var ampm= tm.substr(-2)
 var clk = tm.substr(0, 5);
 var m  = parseInt(clk.match(/\d+$/)[0], 10);
 var h  = parseInt(clk.match(/^\d+/)[0], 10);
 h += (ampm.match(/pm/i))? 12: 0;
 return h*60+m;
}

function checkAvailibility(doctor_id, date, start,end){
  $.ajax({
        type: "GET",
        datatype:"json",
        url: '<?= route('checkavailability')?>',
       
        dataType: 'json',
        data:({
          doctor_id :doctor_id,
          date : date,
          start : start,
          end : end,

        }),
        success: function(response)
        {
            console.log(response);
                  if(response == 1){
                    alert('Selected Time Window Not available')
                    $('#timepickerend').val('');
                  }
        },
        error: function(result)
        {
          alert('Something is very very wrong .');
        }
    });
}

    </script>
    