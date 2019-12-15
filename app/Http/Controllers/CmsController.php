<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\DynamicContent;
use App\ShopUser;
use App\Blog;
use App\Content;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shows = Content::get();
        $countries = DynamicContent::where('section','cc')->orderBy('country','ASC')->get();
        $categories = DynamicContent::where('section','=',null)->get();
        $units = DynamicContent::where('section','unit')->get();
        return view('cms.index',compact('shows','countries','categories','units'));
    }

    public function blog()
    {
        $shows = Blog::get();
        return view('cms.blog',compact('shows'));
    }

    public function cms_password(){
        return view('cms.password');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $notification = array('message' => 'Log Out Successfully', 'alert-type' => 'success');
        return redirect()->route('home')->with($notification);
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
            'section' => 'required', 'country' => 'required', 'currency' => 'required'
        ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back() ->withErrors($validator) ->withInput()->with($notification);
        }
        $data = [
            'section' => $request->section, 'country' => $request->country, 'currency' => $request->currency,
            'created_at' => now(), 'updated_at' => now()
        ];
        DynamicContent::insert($data);
        $notification = array('message' => 'Country & Currency Added successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function blog_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required', 'date' => 'required',
        ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back() ->withErrors($validator) ->withInput()->with($notification);
        }
        $image = "";
        if ($request->hasFile('image')) {
            $destinationPath = "public/cms_panel"; $file = $request->image;
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . "." . $extension;
            $file->move($destinationPath, $fileName);
            $image = $fileName;
        }

        $data = [
            'title' => $request->title, 'description' => $request->description, 'image' => $image, 'date' => $request->date,
            'created_at' => now(), 'updated_at' => now()
        ];
        Blog::insert($data);
        $notification = array('message' => 'New Blog Added successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function category_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required'
        ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back() ->withErrors($validator) ->withInput()->with($notification);
        }
        $data = [
            'currency' => $request->category,
            'created_at' => now(), 'updated_at' => now()
        ];
        DynamicContent::insert($data);
        $notification = array('message' => 'Category Added successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function unit_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unit' => 'required'
        ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back() ->withErrors($validator) ->withInput()->with($notification);
        }
        $data = [
            'section' => 'unit', 'currency' => $request->unit,
            'created_at' => now(), 'updated_at' => now()
        ];
        DynamicContent::insert($data);
        $notification = array('message' => 'Unit Added successfully', 'alert-type' => 'success');
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
       $edit =  Content::where('id',$id)->first();
       return view('cms.cms_edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request){
        $update = Content::find($request->id);
        $update->title = $request->title; $update->description = $request->description; $update->title = $request->title;
        $image = "";
        if ($request->hasFile('image')) {
            $destinationPath = "public/cms_panel"; $file = $request->image; $extension = $file->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . "." . $extension; $file->move($destinationPath, $fileName);
            $image = $fileName; $update->image = $image;
        }
        $update->updated_at = now(); $update->save();
        $notification = array('message' => 'CMS Information Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function blog_update(Request $request){
        $update = Blog::find($request->id);
        $update->title = $request->title;
        if($request->description2) $update->description = $request->description2;
        $update->date = $request->date;
        $image = "";
        if ($request->hasFile('image')) {
            $destinationPath = "public/cms_panel"; $file = $request->image;$extension = $file->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . "." . $extension;$file->move($destinationPath, $fileName);
            $image = $fileName;$update->image = $image;
        }
        $update->updated_at = now(); $update->save();
        $notification = array('message' => 'Blog Information Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function cms_password_update(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required', 'old_pass' => 'required', 'password' => 'required',
        ]);
        if ($validator->fails()){ return back()->withErrors($validator)->withInput(); }
        $user = ShopUser::where('email', $request->email)->first();
        if ($request->old_email == $request->email && Hash::check($request->old_pass, $user->password)) {
            ShopUser::where('email', $request->old_email)->update(['password' => Hash::make($request->password) ]);
            $notification = array('message' => 'Password Changed Successfully', 'alert-type' => 'success');
            return back()->with($notification);
        }
        else{
            $notification = array('message' => 'Wrong Email/Password!', 'alert-type' => 'error');
            return back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DynamicContent::where('id',$request->id)->delete();
        $notification = array('message' => 'Information Deleted Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function blog_destroy(Request $request)
    {
        Blog::where('id',$request->id)->update(['deleted_at' => now()]);
        $notification = array('message' => 'Information Deleted Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }
}
