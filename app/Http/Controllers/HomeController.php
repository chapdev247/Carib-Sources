<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Backend\Post;
use App\Models\Form;
use App\Models\Cusform;
use App\Models\Ftag;
use App\Mail\TestMail;
use Mail;
use Auth;
use Paypal;
use Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));
        
        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->limit(4)->get();
        return view('frontend/home')->with('posts',$posts);
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
        Mail::queue(new TestMail($data));

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

    /**
     * Show the Form page.
     *
     * @return \Illuminate\Http\Response
     */
    public function cusform()
    {
        $ftags = Ftag::all();
        //print_r($ftags);die;
        return view('frontend/form')->withFtags($ftags);
    }
    /**
     * Post Form data.
     *
     * @return \Illuminate\Http\Response
     */
    public function postcusform(Request $request)
    {
        if ($request->input("step")=="tag_name"){
            $validate_error = $this->validate($request, array(
                'tag_name'=>'required|min:2|max:50|unique:ftags,name'
            ),
            array(
                'tag_name.required'=>'Tag name required',
                'tag_name.min'=>'Tag name must be at least 2 characters long',
                'tag_name.max'=>'Tag name must be max 50 characters long',
                'tag_name.unique'=>'Tag name must be unique',
            ));
            if (!$validate_error) {
                $ftag = new Ftag;
                $ftag->name = $request->tag_name;

                $ftag->save();
                $data["id"] = $ftag->id;
                $data["name"] = $ftag->name;
                $data["message"] = "Tag inserted successfully.";
                return response()->json(array('data'=> $data, 200));
            }
        }
        else{
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
                'ftags'=>'required_with:c_zip',
                'daily_from'=>'required|numeric|min:1|max:'.$request->daily_to,
                'daily_to'=>'required|numeric|min:'.$request->daily_from.'|max:'.$request->monthly_from,
                'monthly_from'=>'required|numeric|min:'.$request->daily_to.'|max:'.$request->monthly_to,
                'monthly_to'=>'required|numeric|min:'.$request->daily_to.'|max:'.$request->yearly_from,
                'yearly_from'=>'required|numeric|min:'.$request->monthly_to.'|max:'.$request->yearly_to,
                'yearly_to'=>'required|numeric|min:'.$request->year_from.'|max:99999999999',
                'start'=>'required|date',
                'end'=>'required|date',
                'image'=>'required|image|dimensions:min_width=300,min_height=300,max_width=1600,max_height=1000',
            ),
            array(
                'f_name.required'=>'First name required',
                'f_name.min'=>'First name must be at least 2 character long',
                'f_name.max'=>'First name must be max 50 character long',
                'l_name.required'=>'Last name required',
                'l_name.min'=>'Last name must be at least 2 character long',
                'l_name.max'=>'Last name must be max 50 character long',
                'email.required'=>'Email required',
                'email.email'=>'Email must be valid',
                'email.max'=>'Email must be max 100 character long',
                'address.required'=>'Address required',
                'address.min'=>'Address must be at least 5 character long',
                'address.max'=>'Address must be max 500 character long',
                'city.required'=>'City required',
                'city.min'=>'City must be at least 5 character long',
                'city.max'=>'City must be max 20 character long',
                'zip.required'=>'Zip Code required',
                'zip.numeric'=>'Zip Code must be numeric',
                'zip.max'=>'Zip Code must be max 10 character long',
                'c_name.required'=>'Company name required',
                'c_name.min'=>'Company name must be at least 2 character long',
                'c_name.max'=>'Company name must be max 50 character long',
                'c_address.required'=>'Company Address required',
                'c_address.min'=>'Company Address must be at least 8 character long',
                'c_address.max'=>'Company Address must be max 500 character long',
                'c_city.required'=>'Company Address required',
                'c_city.min'=>'Company Address must be at least 5 character long',
                'c_city.max'=>'Company Address must be max 20 character long',
                'c_zip.required'=>'Zip Code required',
                'c_zip.numeric'=>'Zip Code must be numeric',
                'c_zip.max'=>'Zip Code must be max 10 character long',
                'ftags.required_with'=>'Tags are required',
                'daily_from.required'=>'From Daily Price required',
                'daily_from.numeric'=>'From Daily Price must be numeric',
                'daily_from.min'=>'From Daily Price must be min 1 digit',
                'daily_from.max'=>'From Daily Price must be less than To Daily Price',
                'daily_to.required'=>'To Daily Price required',
                'daily_to.numeric'=>'To Daily Price must be numeric',
                'daily_to.min'=>'To Daily Price must be greater than From Daily Price',
                'daily_to.max'=>'To Daily Price must be less than From Monthly Price',
                'monthly_from.required'=>'From Monthly Price required',
                'monthly_from.numeric'=>'From Monthly Price must be numeric',
                'monthly_from.max'=>'From Monthly Price must be less than To Monthly Price',
                'monthly_to.required'=>'To Monthly Price required',
                'monthly_to.numeric'=>'To Monthly Price must be numeric',
                'monthly_to.min'=>'To Monthly Price must be greater than From Monthly Price',
                'monthly_to.max'=>'To Monthly Price must be less than From Yearly Price',
                'yearly_from.required'=>'From Yearly Price required',
                'yearly_from.numeric'=>'From Yearly Price must be numeric',
                'yearly_from.min'=>'From Yearly Price must be greater than To Monthly Price',
                'yearly_from.max'=>'From Yearly Price must be less than To Yearly Price',
                'yearly_to.required'=>'To Yearly Price required',
                'yearly_to.numeric'=>'To Yearly Price must be numeric',
                'yearly_to.min'=>'To Yearly Price must be greater than From Yearly Price',
                'yearly_to.max'=>'To Yearly Price must be max 10 digits long',
                'start.required'=>'From Date required',
                'start.date'=>'From Date must be valid date',
                'end.required'=>'End Date required',
                'end.date'=>'End Date must be valid date',
                'image.required'=>'Image required',
                'image.image'=>'Image type must be valid',
                'image.dimensions'=>'Image size min_width=300,min_height=300,max_width=1600,max_height=1000',
            ));
            if (empty($validate_error) && $request->step=='last') {
                $image_path = $request->image->store('uploads/images');

                $form = new Cusform;

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
                $form->ftags = json_encode($request->ftags);
                $form->daily_from = $request->daily_from;
                $form->daily_to = $request->daily_to;
                $form->month_from = $request->monthly_from;
                $form->month_to = $request->monthly_to;
                $form->year_from = $request->yearly_from;
                $form->year_to = $request->yearly_to;
                $form->start = $request->start;
                $form->end = $request->end;

                $form->i_file = $image_path;

                $form->save();
                return response()->json(array('data'=> "Data Submitted successfully.", 200));
            }
        }
    }

    public function postcusform2(Request $request)
    {
        if ($request->input("step")=="tag_name"){
            $validate_error = $this->validate($request, array(
                'tag_name'=>'required|min:2|max:50|unique:ftags,name'
            ),
            array(
                'tag_name.required'=>'Tag name required',
                'tag_name.min'=>'Tag name must be at least 2 characters long',
                'tag_name.max'=>'Tag name must be max 50 characters long',
                'tag_name.unique'=>'Tag name must be unique',
            ));
            if (!$validate_error) {
                $ftag = new Ftag;
                $ftag->name = $request->tag_name;

                $ftag->save();
                $data["id"] = $ftag->id;
                $data["name"] = $ftag->name;
                $data["message"] = "Tag inserted successfully.";
                return response()->json(array('data'=> $data, 200));
            }
        }
        else{
            if ($request->step==1) {
                $validation_rules = array(
                    'f_name'=>'required|min:2|max:50',
                    'l_name'=>'required|min:2|max:50',
                    'email'=>'required|email|max:100',
                    'address'=>'required|min:5|max:500',
                    'city'=>'required|min:5|max:20',
                    'zip'=>'required|numeric|max:9999999999',
                );
            }
            if ($request->step==2) {
                $validation_rules = array(
                    'c_name'=>'required|min:5|max:50',
                    'c_address'=>'required|min:8|max:500',
                    'c_city'=>'required|min:5|max:20',
                    'c_zip'=>'required|numeric|max:9999999999',
                    'ftags'=>'required',
                );
            }
            if ($request->step==3) {
                $validation_rules = array(
                    'daily_from'=>'required|numeric|min:1|max:'.$request->daily_to,
                    'daily_to'=>'required|numeric|min:'.$request->daily_from.'|max:'.$request->monthly_from,
                    'monthly_from'=>'required|numeric|min:'.$request->daily_to.'|max:'.$request->monthly_to,
                    'monthly_to'=>'required|numeric|min:'.$request->daily_to.'|max:'.$request->yearly_from,
                    'yearly_from'=>'required|numeric|min:'.$request->monthly_to.'|max:'.$request->yearly_to,
                    'yearly_to'=>'required|numeric|min:'.$request->year_from.'|max:99999999999',
                    'start'=>'required|date',
                    'end'=>'required|date',
                );
            }
            if ($request->step==4) {
                $validation_rules = array(
                    'image'=>'required|image|dimensions:min_width=300,min_height=300,max_width=1600,max_height=1000',
                );
            }
            $validate_error = $this->validate($request, $validation_rules,
            array(
                'f_name.required'=>'First name required',
                'f_name.min'=>'First name must be at least 2 character long',
                'f_name.max'=>'First name must be max 50 character long',
                'l_name.required'=>'Last name required',
                'l_name.min'=>'Last name must be at least 2 character long',
                'l_name.max'=>'Last name must be max 50 character long',
                'email.required'=>'Email required',
                'email.email'=>'Email must be valid',
                'email.max'=>'Email must be max 100 character long',
                'address.required'=>'Address required',
                'address.min'=>'Address must be at least 5 character long',
                'address.max'=>'Address must be max 500 character long',
                'city.required'=>'City required',
                'city.min'=>'City must be at least 5 character long',
                'city.max'=>'City must be max 20 character long',
                'zip.required'=>'Zip Code required',
                'zip.numeric'=>'Zip Code must be numeric',
                'zip.max'=>'Zip Code must be max 10 character long',
                'c_name.required'=>'Company name required',
                'c_name.min'=>'Company name must be at least 2 character long',
                'c_name.max'=>'Company name must be max 50 character long',
                'c_address.required'=>'Company Address required',
                'c_address.min'=>'Company Address must be at least 8 character long',
                'c_address.max'=>'Company Address must be max 500 character long',
                'c_city.required'=>'Company Address required',
                'c_city.min'=>'Company Address must be at least 5 character long',
                'c_city.max'=>'Company Address must be max 20 character long',
                'c_zip.required'=>'Zip Code required',
                'c_zip.numeric'=>'Zip Code must be numeric',
                'c_zip.max'=>'Zip Code must be max 10 character long',
                'ftags.required_with'=>'Tags are required',
                'daily_from.required'=>'From Daily Price required',
                'daily_from.numeric'=>'From Daily Price must be numeric',
                'daily_from.min'=>'From Daily Price must be min 1 digit',
                'daily_from.max'=>'From Daily Price must be less than To Daily Price',
                'daily_to.required'=>'To Daily Price required',
                'daily_to.numeric'=>'To Daily Price must be numeric',
                'daily_to.min'=>'To Daily Price must be greater than From Daily Price',
                'daily_to.max'=>'To Daily Price must be less than From Monthly Price',
                'monthly_from.required'=>'From Monthly Price required',
                'monthly_from.numeric'=>'From Monthly Price must be numeric',
                'monthly_from.max'=>'From Monthly Price must be less than To Monthly Price',
                'monthly_to.required'=>'To Monthly Price required',
                'monthly_to.numeric'=>'To Monthly Price must be numeric',
                'monthly_to.min'=>'To Monthly Price must be greater than From Monthly Price',
                'monthly_to.max'=>'To Monthly Price must be less than From Yearly Price',
                'yearly_from.required'=>'From Yearly Price required',
                'yearly_from.numeric'=>'From Yearly Price must be numeric',
                'yearly_from.min'=>'From Yearly Price must be greater than To Monthly Price',
                'yearly_from.max'=>'From Yearly Price must be less than To Yearly Price',
                'yearly_to.required'=>'To Yearly Price required',
                'yearly_to.numeric'=>'To Yearly Price must be numeric',
                'yearly_to.min'=>'To Yearly Price must be greater than From Yearly Price',
                'yearly_to.max'=>'To Yearly Price must be max 10 digits long',
                'start.required'=>'From Date required',
                'start.date'=>'From Date must be valid date',
                'end.required'=>'End Date required',
                'end.date'=>'End Date must be valid date',
                'image.required'=>'Image required',
                'image.image'=>'Image type must be valid',
                'image.dimensions'=>'Image size min_width=300,min_height=300,max_width=1600,max_height=1000',
            ));
            if (empty($validate_error) && $request->step==5) {
                $image_path = $request->image->store('uploads/images');

                $form = new Cusform;

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
                $form->ftags = json_encode($request->ftags);
                $form->daily_from = $request->daily_from;
                $form->daily_to = $request->daily_to;
                $form->month_from = $request->monthly_from;
                $form->month_to = $request->monthly_to;
                $form->year_from = $request->yearly_from;
                $form->year_to = $request->yearly_to;
                $form->start = $request->start;
                $form->end = $request->end;

                $form->i_file = $image_path;

                $form->save();
                return response()->json(array('data'=> "Data Submitted successfully."),200);
            }
        }
    }

    public function payment_form()
    {
        $custs = Cusform::all();
        return view('frontend/pay_form')->withCusts($custs);
    }

    public function postpayment_form(Request $request)
    {
        echo "<pre>";
        print_r($request->input());
    }

    public function getCheckout()
    {
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $item1 = PayPal::Item();
        $item1->setName('Ground Coffee 40 oz')
            ->setCurrency('CAD')
            ->setQuantity(1)
            ->setPrice(7.5);
        $item2 = PayPal::Item();
        $item2->setName('Granola bars')
            ->setCurrency('CAD')
            ->setQuantity(5)
            ->setPrice(2);

        $itemList = PayPal::ItemList();
        $itemList->setItems(array($item1, $item2));
        
        $details = PayPal::Details();
        $details->setShipping(1.2)
            ->setTax(1.3)
            ->setSubtotal(17.50);

        $amount = PayPal:: Amount();
        $amount->setCurrency("CAD")
            ->setTotal(20)
            ->setDetails($details);

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(action('HomeController@getDone'))
            ->setCancelUrl(action('HomeController@getCancel'));

        $payment = PayPal::Payment();
        $payment->setIntent('order')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;
        
        return Redirect::to( $redirectUrl );
    }

    public function getDone(Request $request)
    {        
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');
        
        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        // Clear the shopping cart, write to database, send notifications, etc.
        echo "<pre>";
        print_r($payment);
        die;
        // Thank the user for the purchase
        return view('checkout.done');
    }

    public function getCancel()
    {
        echo "cancel";die;
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        return view('checkout.cancel');
    }
}
