<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use App\Mail\CommonMail;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*$this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));
        
        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::orderBy('id','desc')->limit(4)->get();
        $data["title"] = "Carib Sources : Home";
        $data["featured"] = Product::featured_products();
        $data["latest"] = Product::latest_products();
        return view('frontend/home')->with('data',$data);
    }

    
    /**
     * Show the Contact Us Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('frontend/about');
    }
    /**
     * Show the Contact Us Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('frontend/contact');
    }

    /**
     * Show the Contact Us Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function postcontact(Request $request)
    {
        $this->validate($request, array(
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required|min:5',
            'message'=>'required|min:10',
        ));
        $data = array( 
            'name' =>  $request->name,
            'email' =>  $request->email,
            'subject' =>  $request->subject,
            'bodyMessage' =>  $request->message,
            );
        
        Mail::queue(new CommonMail($data));

        $request->session()->flash('success_msg','Message Sent successfully!');

        return redirect('contact-us');
    }
    /**
     * Show the Custom Form page.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('frontend/cus_register');
    }
    
    /**
     * Post Custom Form Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function postregister(Request $request)
    {
        $validate_error = $this->validate($request, array(
            'f_name'=>'required|min:2|max:50',
            'l_name'=>'required|min:2|max:50',
            'email'=>'required|email|max:100',
            'address'=>'required|min:5|max:500',
            'city'=>'required|min:5|max:20',
            'zip'=>'required|numeric|max:9999999999',
            'c_name'=>'required|min:5|max:50',
            'c_address'=>'required|min:8|max:500',
            'c_city'=>'required|min:5|max:20',
            'c_zip'=>'required|numeric|max:9999999999',
            'i_file'=>'required|image|dimensions:min_width=300,min_height=300,max_width=1600,max_height=1000',
        ),
        array(
            'f_name.required'=>'First name required',
            'f_name.min'=>'First name must be at least 2 character long',
            'f_name.max'=>'First name must be max 50 character long',
        ));
        if (!$validate_error) {
            $image_path = $request->i_file->store('uploads/images');

            $form = new Form;

            $form->f_name = $request->f_name;
            $form->l_name = $request->l_name;
            $form->email = $request->email;
            $form->address = $request->address;
            $form->city = $request->city;
            $form->zip = $request->zip;
            $form->c_name = $request->c_name;
            $form->c_address = $request->c_address;
            $form->c_city = $request->c_city;
            $form->c_zip = $request->c_zip;
            $form->i_file = $image_path;

            $form->save();
            return response()->json(array('data'=> 'Form data has been Sent.Thank You.', 200));
        }
    }
}
