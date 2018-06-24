<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use App\Timesheet;
use Auth;    
class LoginController extends Controller
{   

	public function __construct()
	{
		$this->middleware('guest',['except' => 'logout']);
	}

    public function index()
    {
        return view('login');
    }    

    public function verify(Request $request)
    {
        $credentials = $request->only('username', 'password');    
        if (Auth::attempt($credentials)) 
        {
            $timesheet = new Timesheet;
            $timesheet->user_id = Auth::user()->id;
            $timesheet->time_in = Carbon::now();
            $timesheet->save();
            if(Auth::user()->role == 'admin')
            {
                return redirect('/dashboard');
            }
            else
            {
                return redirect('/staff/sales');  
            }
        }
        else
        {
        	$request->session()->flash('message', 'The username and password you entered did not match our records. Please double-check and try again.');
            return redirect('/');
        }
    }

    public function logout()
    {
        if (Auth::check()) 
        {
            $timesheet = Timesheet::where('user_id', Auth::user()->id)->whereNull('time_out')->first();
            $timesheet->time_out = Carbon::now();
            $timesheet->save();
        }

        Auth::logout();
        return redirect('/');
    }
}
