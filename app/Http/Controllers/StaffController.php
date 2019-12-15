<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\ShopUser;
use App\ShopContent;
use App\Advertisement;
use Illuminate\Support\Facades\Hash;
use Mail;
use Session;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads1 = Advertisement::where('id',1)->first(); $ads2 = Advertisement::where('id',2)->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.staff.add',compact('logo','ads1','ads2'));
    }

    public function manage()
    {
        $ads1 = Advertisement::where('id',1)->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.staff.manage',compact('shows','logo','ads1'));
    }

    public function staff_getData()
    {
        $show = ShopUser::where('ring', Session::get('loggedUser')['ring'])->get();
        return DataTables::of($show)->addColumn('option',function ($show){
            if(Session::get('loggedUser')['type'] == 'shop' || Session::get('loggedUser')['type'] == 'shop'){
                return '<button type="button" class="new-customer-button" data-id="'.$show->id.'" data-fname="'.$show->fname.'" 
                data-lname="'.$show->lname.'" data-mobile="'.$show->mobile.'" data-usertype="'.$show->usertype.'" data-email="'.$show->email.'"
                        data-role="'.$show->role.'" data-toggle="modal" data-target="#edit"> <i class="far fa-edit margin-right-css"></i>Edit</button>
                <button type="button" class="new-customer-button red-button" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete">
                    <i class="far fa-trash-alt margin-right-css"></i>Delete</button>';
            }
            else { return 'No Access'; }
        })->addColumn('name',function ($show){ return $show->fname.' '.$show->lname;
        })->setRowAttr(['align' => 'center'])->rawColumns(['option','name'])->make(true);
    }

    public function emailCheck(Request $request){
        if($request->get('email')) {
            $email = $request->get('email'); $data = ShopUser::where('email', $email)->count();
            if($data > 0) { echo 'not_unique'; }
            else { echo 'unique'; }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required', 'usertype' => 'required', 'fname' => 'required', 'lname' => 'required',
            'mobile' => 'required|min:11|numeric', 'email' => 'required|unique:shop_users', 'password' => 'required|min:3'
        ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $data = [
            'ring' => $request->ring, 'role' => implode(",", $request->role),
            'type' => $request->type, 'usertype' => $request->usertype, 'shopname' => $request->shopname,
            'fname' => $request->fname, 'lname' => $request->lname, 'mobile' => $request->mobile,
            'industry' => $request->industry, 'postcode' => $request->postcode, 'country' => $request->country,
            'email' => $request->email, 'password' => Hash::make($request->password), 'email_verified_at' => 'verified',
            'created_at' => now(), 'updated_at' => now()
        ];
        ShopUser::insert($data);
        $mail = [ 'fname' => $request->fname, 'lname' => $request->lname ];
        Mail::send(['text'=>'msg_template.welcomeSMS'],$mail,function($message) use ($request) {
            $message->to($request->email)->subject('Welcome!');$message->from('noreply@sozashop.com','Soza Shop');
        });
        $notification = array('message' => 'New Staff Added Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'email' => 'required' ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Email Exists! Please Enter Unique Email Address', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $update = ShopUser::find($request->id);
        $update->fname = $request->fname; $update->lname = $request->lname; $update->mobile = $request->mobile; $update->email = $request->email;
        if($request->password) $update->password = Hash::make($request->password);
        $update->usertype = $request->usertype;
        if($request->role) $update->role = implode(",", $request->role);
        $update->updated_at = now(); $update->save();
        $notification = array('message' => 'Staff Information Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        ShopUser::where('id', $request->id)->update(['deleted_at' => now()]);
        $notification = array('message' => 'Admin/Staff Deleted Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }
}
