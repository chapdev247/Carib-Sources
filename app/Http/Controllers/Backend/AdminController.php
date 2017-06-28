<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Auth;
use App\Models\Backend\User;

class AdminController extends Controller
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
        $data["title"] = "Admin: Dashboard";
        return view('backend/dashboard')->withData($data);
    }

    public function login(Request $request)
    {
        return view('backend/login')->withLoginerror($request->session()->get('Loginerror'));
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
            elseif ( $user->role > 1 ) {
                $request->session()->flash('Loginerror', 'You are not an admin.');
            }
            else{
                if ( Auth::guard("admin")->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember) ){
                    return redirect()->intended(route('admin.dashboard'));
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

    public function logout()
    {
        Auth::guard("admin")->logout();
        return redirect()->route("admin.login");
    }
}
