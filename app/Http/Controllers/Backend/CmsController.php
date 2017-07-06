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

    public function getusers(request $request)
    {
        if (!is_superadmin()) dd("Unauthorize Area");
        $data["title"] = "Admin: User List";
        $data["users"] = User::filter_users($request)->orderby('id','desc')->paginate(50);
        
        return view('backend.users')->withData($data);
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
        /*if ($user->role===1){
            Auth::guard("admin")->loginUsingId($id);
            return redirect()->route('admin.dashboard');
        }
        elseif ($user->role===2){*/
            Auth::guard("web")->loginUsingId($id);
            return redirect()->route('home');   
        //}
    }

    public function getaddprofile()
    {
        $data["title"] = "Admin: Add User";

        return view('backend.addprofile')->withData($data);
    }

    public function postaddprofile(request $request)
    {
        $this->validate($request, array(
                'f_name' => 'required|max:50',
                'l_name' => 'required|max:50',
                'role' => 'required',
                'email' => 'email|max:80|unique:users',
                'mobile' => 'nullable|digits:10',
                'password' => 'required|min:6|max:100',
                'password_confirmation' => 'required|same:password',
            ));

        $user = new User;

        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        
        $user->save();

        $request->session()->flash('success_msg','User added successfully!');

        return redirect()->route('CmsController.getusers');
    }
    
    public function getprofile($id)
    {
        $data["title"] = "Admin: Edit Profile";
        $data["user"] = User::find($id);

        return view('backend.profile')->withData($data);
    }

    public function postprofile(request $request,$id)
    {
        $this->validate($request, array(
                'f_name' => 'required|max:50',
                'l_name' => 'required|max:50',
                'email' => 'email|max:80|unique:users,email,'.$id,
                'mobile' => 'nullable|digits:10',
                'password' => 'nullable|min:6|max:100',
                'password_confirmation' => 'same:password',
            ));

        $user = User::find($id);

        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        if ($request->role) 
            $user->role = $request->role;
        $user->email = $request->email;
        $user->mobile = $request->mobile;

        if ($request->password) 
            $user->password = Hash::make($request->password);
        
        $user->save();

        $request->session()->flash('success_msg','User Profile Updated successfully!');

        return redirect()->route('CmsController.getusers');
    }
    
}
