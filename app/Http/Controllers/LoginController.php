<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Custom Models
use App\Models\User;
use App\Models\Password_reset;
use App\Mail\CommonMail;

//Core Classes
use Auth;
use Mail;

class LoginController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function login(Request $request)
    {
        $data["title"] = "Carib Sources : Login";
        return view('frontend/authentication/login')->withData($data);
    }

    public function authlogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:80',
            'password' => 'required|min:6|max:100',
        ]);
        $user = User::where('email', $request->email)->first();
        if ( !empty($user) ) {
            if ( empty($user->status) ) {
                $request->session()->flash('error_msg', 'You are not an active user.Please contact to administrator.');
            }
            else{
                if ( Auth::guard("web")->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember) ){
                    return redirect()->intended(route('dashboard'));
                }
                else{
                    $request->session()->flash('error_msg', 'Incorrect Password.');
                }
            }
        }
        else{
            $request->session()->flash('error_msg', 'No such user exists.');
        }

        return redirect()->back()->withInput($request->only('email','remember')); 
    }

    public function register(Request $request)
    {
        $data["title"] = "Carib Sources : Register";
        return view('frontend/authentication/register')->withData($data);
    }

    public function authregister(Request $request)
    {
        $validate = $this->validate($request, [
            'f_name' => 'required|max:50',
            'l_name' => 'required|max:50',
            'email' => 'required|max:80|unique:users',
            'mobile' => 'nullable|digits:10',
            'password' => 'required|min:6|max:100',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = new User;

        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
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
    
    public function fogotpassword(Request $request)
    {
        $data["title"] = "Carib Sources : Forgot Password";
        return view('frontend/authentication/forgot')->withData($data);
    }

    public function authfogotpassword(Request $request)
    {
        $this->validate($request, array(
            'email'=>'required|email',
        ));
        $user = User::where('email', $request->email)->first();

        if ( !empty($user) ) {
            if ( empty($user->status) ) {
                $request->session()->flash('error_msg', 'You are not an active user.Please contact to administrator.');
            }
            else{
                $hash = str_random(120);

                $reset = new Password_reset();
                $find_reset = $reset->where('email', $request->email)->first();
                if ($find_reset) {
                    $find_reset->where('email', $user->email)->update(['token' => $hash]);
                }
                else{
                    $reset->insert(['email' => $user->email,'token' => $hash]);
                }

                $link = route('passwordreset',array($user->email,$hash));
                $data = array( 
                    'from_name'     =>  "Admin",
                    'from_email'    =>  "admin@cartstat.com",
                    'to_name'       =>  $user->f_name." ".$user->l_name,
                    'to_email'      =>  $user->email,
                    'subject'       =>  "Password Reset Link",
                    'link'          =>  $link,
                    'template'      =>  'emails.forgot',
                );
                
                Mail::queue(new CommonMail($data));

                $request->session()->flash('success_msg','Message Sent successfully!');
            }
        }
        else{
            $request->session()->flash('error_msg', 'No such user exists.');
        }
        return redirect()->back();
    }

    public function passwordreset(Request $request,$email,$token)
    {
        if (empty($email) || empty($token) || !$data["reset"] = Password_reset::where('email', $email)->where('token',$token)->first()) 
        return redirect()->route('login');

        $data["title"] = "Carib Sources : Password Reset";
        return view('frontend/authentication/passwordreset')->withData($data);
    }

    public function authpasswordreset(Request $request,$email,$token)
    {
        $this->validate($request, array(
            'password' => 'required|min:6|max:100',
            'password_confirmation' => 'required|same:password',
        ));

        $user = User::where('email', $email)->first();
        $reset = Password_reset::where('email', $email)->where('token',$token)->first();

        if ( !empty($user) ) {
            if ( empty($user->status) ) {
                $request->session()->flash('error_msg', 'You are not an active user.Please contact to administrator.');
            }
            else{
                $user->password = bcrypt($request->password);
                $user->save();

                $reset->where('email', $user->email)->update(['token' => '']);

                $request->session()->flash('success_msg','Password updated successfully!');
                return redirect()->route('login');
            }
        }
        else{
            $request->session()->flash('error_msg', 'No such user exists.');
        }


        return redirect()->back();
    }

}