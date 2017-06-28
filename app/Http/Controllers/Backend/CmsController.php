<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Backend\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class CmsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getindex()
    {

    }

    public function getprofile($id)
    {
        $data["title"] = "Admin: Profile";
        $data["user"] = User::find($id);

        return view('backend.profile')->withData($data);
    }

    public function postprofile(request $request,$id)
    {
        $this->validate($request, array(
                'f_name' => 'required|max:50',
                'l_name' => 'required|max:50',
                'email' => 'email|max:80',
                'password' => 'nullable|min:6|max:100',
                'password_confirmation' => 'same:password',
            ));

        $user = User::find($id);

        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->email = $request->email;

        if ($request->password) 
            $user->password = Hash::make($request->password);
        
        $user->save();

        $request->session()->flash('success_msg','User Profile Updated successfully!');

        return redirect()->route('CmsController.getprofile',$id);
    }

    public function getusers()
    {
        if (!is_superadmin()) dd("Unauthorize Area");

        $users = User::where('role','>',0)->get();
        
        return view('backend.users')->withUsers($users);
    }


    public function getupdate_userstatus(request $request,$id)
    {
        if (!is_superadmin()) dd("Unauthorize Area");

        if (empty($id)) return redirect()->route('CmsController.getusers');

        $user = User::find($id);

        if ($user->status==0)
            $user->status = 1;
        else
            $user->status = 0;

        $user->save();

        $request->session()->flash('success_msg','User Status Updated successfully!');

        return redirect()->route('CmsController.getusers');
    }

    public function getupdate_userrole(request $request,$id)
    {
        if (!is_superadmin()) dd("Unauthorize Area");

        if (empty($id)) return redirect()->route('CmsController.getusers');

        $user = User::find($id);

        if ($user->role==1)
            $user->role = 2;
        else
            $user->role = 1;

        $user->save();

        $request->session()->flash('success_msg','User Role Updated successfully!');

        return redirect()->route('CmsController.getusers');
    }

    public function getproxyLogin(request $request,$id)
    {
        if (!is_superadmin()) dd("Unauthorize Area");
        $user = User::find($id);
        if ($user->role===1){
            Auth::guard("admin")->loginUsingId($id);
            return redirect()->route('admin.dashboard');
        }
        elseif ($user->role===2){
            Auth::guard("web")->loginUsingId($id);
            return redirect()->route('home');   
        }
    }

}
