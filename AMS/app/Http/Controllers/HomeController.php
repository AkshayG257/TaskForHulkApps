<?php

namespace App\Http\Controllers;
use App\Models\User;
use AUTH;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function manage_users()
    {
        if(AUTH::user()->usertype == 'admin'){

            
            $data = User::where('id','!=', AUTH::user()->id)->get();
            return view('manageusers', ['data'=>$data]);
        }
        else{
            return redirect()->route('home');

        }
    }

    public function add_new_user()
    {
        if(AUTH::user()->usertype == 'admin'){

            
            
            return view('add_new_user');
        }
        else{
            return redirect()->route('home');

        }
    }
    public function add_new_user_post(Request $request)
    {
        $user = AUTH::user();
        $existing_user = User::where('email', $request->email)->first();
        if($existing_user){
            Session::flash('message', "Email already in use");
            return redirect()->route('add_new_user');
        }
        $ap = new User();
        $ap->usertype = $request->usertype;
        $ap->name = $request->name;
        $ap->password = $request->password;
        $ap->email = $request->email;
        $ap->save();
        Session::flash('message', "Data Updated");

       return redirect()->route('manage_users');
    }


    public function delete_user(Request $request)
    {
        $delete = User::where('id', $request->user_id)->delete();
        Session::flash('message', "Data Updated");

       return redirect()->route('manage_users');
    }


}
