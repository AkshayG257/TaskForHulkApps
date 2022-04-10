<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\User;

use Illuminate\Http\Request;
use Session;
use AUTH;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = AUTH::user();
        

        if($user->usertype == 'patient'){
            $data =  Appointments::where('user_id', $user->id)->get();
        }
        else if($user->usertype == 'doctor'){
            $data =  Appointments::where('doc_id', $user->id)->get();

        }
        else{
            $data =  Appointments::get();
        }
        foreach($data as $d){
            $d->patient_name = User::where('id', $d->user_id)->value('name');
            $d->doctor_name = User::where('id', $d->doc_id)->value('name');
        }


            return view('home',['data'=>$data]);


    }
    public function add_new_appointment( Request $request)
    {
        $doctors = User::where('usertype', 'doctor')->get();
        $patients = User::where('usertype', 'patient')->get();
        $data['doctors'] = $doctors;
        $data['patients'] = $patients;

        return view('addnewappintment',['data'=>$data]);

    }
     
    public function add_new_appointment_post( Request $request)
    {
        $user = AUTH::user();

        $ap = new Appointments();
        $ap->user_id = $request->patient_id;
        $ap->doc_id = $request->doctor_id;
        $ap->date = $request->date;
        $ap->start = $request->start_time;
        $ap->end = $request->end_time;
        $ap->status = 'submitted';
        $ap->save();
        Session::flash('message', "Appointment Created");

       return redirect()->route('home');
    }
    public function checkavailability( Request $request)
    {
        $data = Appointments::where([['doc_id', $request->doctor_id],['date', $request->date], ['start','>=', $request->start],['end','<=', $request->end], ['status', '!=', 'rejected']])->get();       
       
        if($data->count() > 0){
            return 1;

        }
        else{
            return 0;

        }

    }
    public function delete_appointment( Request $request)
    {
        $data = Appointments::where('id',$request->appointment_id)->delete();       

        Session::flash('message', "Appointment Deleted");

        return redirect()->route('home');

    }
    public function finish_appointment( Request $request)
    {
        $data = Appointments::where('id',$request->appointment_id)->update(['status'=>'finished']);       

        Session::flash('message', "Appointment Updated");

        return redirect()->route('home')->with('success', 'your message,here');

    }
    public function accept_appointment( Request $request)
    {
        $data = Appointments::where('id',$request->appointment_id)->update(['status'=>'accepted']);       

        Session::flash('message', "Appointment Updated");

        return redirect()->route('home');

    }
    public function reject_appointment( Request $request)
    {
        $data = Appointments::where('id',$request->appointment_id)->update(['status'=>'rejected']);       

        Session::flash('message', "Appointment Updated");

        return redirect()->route('home');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointments  $appointments
     * @return \Illuminate\Http\Response
     */
    public function show(Appointments $appointments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointments  $appointments
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointments $appointments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointments  $appointments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointments $appointments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointments  $appointments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointments $appointments)
    {
        //
    }



}
