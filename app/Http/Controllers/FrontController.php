<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use File;
use App\Http\Controllers\Schema;
use Mail;
use Input;
use App\ShopUser;
use App\Message;
use App\Content;
use App\Blog;
use App\ShopContent;
use App\DynamicContent;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    public function index(){
        $cms_header = Content::where('section','header')->first();
        $footer = Content::where('section','footer')->first(); $terms = Content::where('section','terms_conditions')->first();
        $cms_boxes = Content::whereBetween('id', [2, 4])->get();
        $social1 = Content::where('id', 6)->first(); $social2 = Content::where('id', 7)->first();
        $social3 = Content::where('id', 13)->first(); $social4 = Content::where('id', 14)->first();
        $categories = DynamicContent::where('section','=',null)->get(); $countries = DynamicContent::where('section','cc')->get();
        $cms_end = Content::where('section', 'end')->first();
        return view('front.home',compact('cms_header','cms_boxes','cms_end','social1','social2','categories',
            'social3','social4','countries','footer','terms'));
    }
    public function contact(){
        $footer = Content::where('section','footer')->first(); $terms = Content::where('section','terms_conditions')->first();
        $social1 = Content::where('id', 6)->first(); $social2 = Content::where('id', 7)->first();
        $social3 = Content::where('id', 13)->first(); $social4 = Content::where('id', 14)->first();
        return view('front.contact',compact('social1','social2','social3','social4','footer','terms'));
    }

    public function about(){
        $footer = Content::where('section','footer')->first(); $terms = Content::where('section','terms_conditions')->first();
        $about = Content::where('section','about')->first();
        $social1 = Content::where('id', 6)->first(); $social2 = Content::where('id', 7)->first();
        $social3 = Content::where('id', 13)->first(); $social4 = Content::where('id', 14)->first();
        return view('front.about',compact('social1','social2','social3','social4','footer','terms','about'));
    }

    public function app(){
        $footer = Content::where('section','footer')->first(); $terms = Content::where('section','terms_conditions')->first();
        $app = Content::where('section','app')->first();
        $social1 = Content::where('id', 6)->first(); $social2 = Content::where('id', 7)->first();
        $social3 = Content::where('id', 13)->first(); $social4 = Content::where('id', 14)->first();
        return view('front.app',compact('social1','social2','social3','social4','footer','terms','app'));
    }

    public function shop(){
        $footer = Content::where('section','footer')->first(); $terms = Content::where('section','terms_conditions')->first();
        $shop = Content::where('section','shop')->first();
        $social1 = Content::where('id', 6)->first(); $social2 = Content::where('id', 7)->first();
        $social3 = Content::where('id', 13)->first(); $social4 = Content::where('id', 14)->first();
        return view('front.shop',compact('social1','social2','social3','social4','footer','terms','shop'));
    }

    public function blog(){
        $footer = Content::where('section','footer')->first(); $terms = Content::where('section','terms_conditions')->first();
        $blogs = Blog::paginate(6);
        $social1 = Content::where('id', 6)->first(); $social2 = Content::where('id', 7)->first();
        $social3 = Content::where('id', 13)->first(); $social4 = Content::where('id', 14)->first();
        return view('front.blog',compact('social1','social2','social3','social4','footer','terms','blogs'));
    }

    public function link($slug)
    {
        $footer = Content::where('section','footer')->first(); $terms = Content::where('section','terms_conditions')->first();
        $social1 = Content::where('id', 6)->first(); $social2 = Content::where('id', 7)->first();
        $social3 = Content::where('id', 13)->first(); $social4 = Content::where('id', 14)->first();
        $url_data = $slug;
        $name = str_replace('-', ' ', $slug); $show = Blog::where('title', $name)->first();
        return view('front.blog_link',compact('footer','terms','social1','social2','social3','social4','show','url_data'));
    }

    public function login(){
        return view('front.login');
    }

    public function register(){
        $footer = Content::where('section','footer')->first();
        $terms = Content::where('section','terms_conditions')->first();
        $social1 = Content::where('id', 6)->first();$social2 = Content::where('id', 7)->first();
        $social3 = Content::where('id', 13)->first(); $social4 = Content::where('id', 14)->first();
        $categories = DynamicContent::where('section','=',null)->get();
        $countries = DynamicContent::where('section','cc')->get();
        return view('front.register',compact('social1','social2','social3','social4','categories','countries','footer','terms'));
    }

    public function emailCheck(Request $request){
        if($request->get('email')) {
            $email = $request->get('email'); $data = ShopUser::where('email', $email)->count();
            if($data > 0) { echo 'not_unique'; }
            else { echo 'unique'; }
        }
    }

    public function store(Request $request)
    {
        
         $validator = Validator::make($request->all(), [
            'role' => 'required', 'type' => 'required', 'shopname' => 'required|regex:/^[0-9A-Za-z .-_~`!%^&*={}()#;:?><’"@$+-,\\/]+$/',
            'fname' => 'required|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/',
            'lname' => 'required|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/',
            'mobile' => 'required|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/', 'industry' => 'required',
            'postcode' => 'nullable|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/', 'country' => 'required', 
            'email' => 'required|email|unique:shop_users', 'password' => 'required|min:6'
        ]);
        

        if ($validator->fails()) {
            $notification = array('message' => 'Use English Language Only', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        if ($request->type == 'shop'){ $role = 'sales,product,stock,expired,expense,stuff,customer,loan,report,setting'; }
        else { $role = 'sales,product,stock,expired,expense,order,branch,stuff,customer,loan,report,setting'; }
        $cntry = DynamicContent::where('id',$request->country)->first(['country','currency']);
        $data = [
            'ring' => rand(10000, 99999), 'type' => $request->type, 'role' => $role, 'usertype' => 'Admin',
            'shopname' => $request->shopname, 'fname' => $request->fname, 'lname' => $request->lname,
            'mobile' => $request->mobile, 'industry' => $request->industry, 'postcode' => $request->postcode,
            'country' => $cntry->country, 'email' => $request->email, 'password' => Hash::make($request->password),
            'email_verified_at'=>'verified','created_at' => now(), 'updated_at' => now()
        ];
        $new_id = ShopUser::insertGetId($data);
        $shopid = ShopUser::where('id', $new_id)->first(['ring','email_verified_at']);
        $value = [
            'shop_id' => $shopid->ring, 'currency'=> $cntry->currency, 'vat_amount' => 0, 'service_amount' => 0,
            'created_at' => now(), 'updated_at' => now()
        ];
        ShopContent::insert($value);
        return redirect()->route('email_verify');
    }

    public function verify(Request $request){
        $validator = Validator::make($request->all(), [ 'email' => 'required', 'password' => 'required|min:6', ]);
        
        $user = ShopUser::where('email', $request->email)->first();
        if ($validator->fails()){ return back()->withErrors($validator)->withInput(); }

        if ($user != null && Hash::check($request->password, $user->password) && $user->permission == 'blocked'){
            return redirect()->route('error', ['id' => $user->ring]);
        }
        else if ($user != null && $user->ring == '10011' && $user->shopname == 'CMS Panel' && Hash::check($request->password, $user->password)){
            $request->session()->put('loggedCms', $user);
            $notification = array('message' => 'Log In Successfully', 'alert-type' => 'success');
            return redirect()->route('cms')->with($notification);
        }
        else if ($user != null && Hash::check($request->password, $user->password)) {
            $request->session()->put('loggedUser', $user);
            $notification = array('message' => 'Log In Successfully', 'alert-type' => 'success');
            return redirect()->route('dashboard')->with($notification);
        }
        else{
            $notification = array('message' => 'Wrong Email/Password!', 'alert-type' => 'error');
            return back()->with($notification);
        }
    }

    public function email_verify(){
        return view('company.email_verify');
    }

    public function email_verified(Request $request){
        $user = ShopUser::where('email_verified_at',$request->token)->first();
        if($user){
            /* mail send part */
            $mail = [ 'fname' => $user->fname, 'lname' => $user->lname ];
            Mail::send(['text'=>'msg_template.welcomeSMS'],$mail,function($message) use ($user) {
                $message->to($user->email)->subject('Welcome!');$message->from('noreply@sozashop.com','Soza Shop');
            });
            ShopUser::where('id',$user->id)->update(['email_verified_at' => "verified"]);
            $request->session()->put('loggedUser', $user);
            $notification = array('message' => 'Log In Successfully', 'alert-type' => 'success');
            return redirect()->route('dashboard')->with($notification);
        }
        else{ $notification = array('message' => 'Wrong Email Verified Token', 'alert-type' => 'error');
            return back()->with($notification);}
    }

    public function error($id){
        $data = Message::where([ ['user_id', $id],['send_to', $id],['reason','block'] ])->get(['msg']);
        $user = ShopUser::where('ring', $id)->first();
        return view('company.error',compact('data','user'));
    }
    public function message(Request $request){
        $validator = Validator::make($request->all(), ['ring' => 'required', 'shopname' => 'required', 'msg' => 'required',]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back() ->withErrors($validator) ->withInput()->with($notification);
        }
        $data = [
            'user_id' => $request->ring, 'user_name' => $request->fname.' '.$request->lname, 'shop_name' => $request->shopname,
            'reason' => 'block reply', 'send_to' => 'admin', 'msg' => $request->msg, 'created_at' => now(), 'updated_at' => now()
        ];
        Message::insert($data);
        $notification = array('message' => 'Message was sent to Admin successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }
    public function send_contact(Request $request){
        $validator = Validator::make($request->all(), [ 'user_name' => 'required|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/',
            'email' => 'required', 'shopname' => 'nullable|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/',
            'mobile' => 'required|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/',
            'msg' => 'nullable|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/' ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back() ->withErrors($validator) ->withInput()->with($notification);
        }
        $data = [
            'user_id' => 'to admin', 'user_name' => $request->user_name, 'shop_name' => $request->shopname,
            'reason' => 'contact', 'send_to' => 'admin', 'msg' => $request->msg, 'file' => $request->mobile,
            'email' => $request->email, 'created_at' => now(), 'updated_at' => now()
        ];
        Message::insert($data);
        $notification = array('message' => 'Message was sent successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function password_reset(){
        return view('company.password_reset');
    }

    public function password_reset_mail(Request $request){
        ShopUser::where('email',$request->email)->update(['password_reset' => rand(1000, 9999) ]);
        $user = ShopUser::where('email',$request->email)->first();
        if($user){
            /* mail send part */
            $mail = [ 'fname' => $user->fname, 'lname' => $user->lname, 'code' => $user->password_reset ];
            Mail::send(['html'=>'msg_template.passwordReset'],$mail,function($message) use ($user) {
                $message->to($user->email)->subject('Welcome!');$message->from('noreply@sozashop.com','Soza Shop');
            });
            $notification = array('message' => 'Code was sent. Please check email', 'alert-type' => 'success');
            return back()->with($notification);
        }
        else{ $notification = array('message' => 'Something went wrong!', 'alert-type' => 'error');
            return back()->with($notification);}
    }
    public function password_reset_code($code){
        $user = ShopUser::where('password_reset',$code)->first();
        if($user){
            $token = $code;
            return view('company.password_reset_code',compact('token'));
        }
        else{ return redirect()->route('home');}
    }
    public function password_code_send(Request $request){
        $user = ShopUser::where('password_reset',$request->nmbr)->first();
        if($user){
            $user->password = Hash::make($request->password); $user->password_reset = null;
            $user->updated_at = now(); $user->save();
            $notification = array('message' => 'Password Updated Successfully!', 'alert-type' => 'success');
            return redirect()->route('login')->with($notification);
        }
        else{ return redirect()->route('home');}
    }
}
