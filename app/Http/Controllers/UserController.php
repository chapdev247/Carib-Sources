<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend/dashboard');
    }

    public function login(Request $request)
    {
        return view('frontend/login')->withLoginerror($request->session()->get('Loginerror'));
    }

    public function authlogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6',
        ]);
        $user = User::where('email', $request->email)->first();
        if ( !empty($user) ) {
            if ( empty($user->status) ) {
                $request->session()->flash('Loginerror', 'You are not an active user.Please contact to administrator.');
            }
            else{
                if ( Auth::guard("web")->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember) ){
                    return redirect()->intended(route('home'));
                }
                else{
                    $request->session()->flash('Loginerror', 'Incorrect Password.');
                }
            }
        }
        else{
            $request->session()->flash('Loginerror', 'No such user exists.');
        }

        return redirect()->back()->withInput($request->only('email','remember')); 
    }

    public function register(Request $request)
    {
        return view('frontend/register')->withLoginerror($request->session()->get('Loginerror'));
    }

    public function authregister(Request $request)
    {
        $validate = $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        //$request->session()->flash('success_msg','User added successfully!');

        Auth::guard("web")->loginUsingId($user->id);

        return redirect()->route("home");
    }

    public function logout()
    {
        Auth::guard("web")->logout();
        return redirect()->route("login");
    }
}
