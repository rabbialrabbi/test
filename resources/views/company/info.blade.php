@extends('layout.company.masterpage')
@section('title', 'Company Information')
@section('masterpage')
@if(in_array('setting', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Company Information</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Company Information</a>
                    </div>
                </div>
                <div class="col-md-9">
                    @if($ads1->status == 'on')
                    {!! html_entity_decode($ads1->code)!!}
                    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                    @endif
                </div>
            </div>
            <div class="row new-sales-table-bg">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <br><br>
                            <div class="row">
                                <div class="d-sm-none col-md-3 d-md-block d-lg-block d-none">
                                    <label for="">Name</label><br><br><br><br>
                                    <label for="">Logo</label><br><br><br><br><br>
                                    <label for="">Change Logo</label><br><br>
                                    <label for="">Currency</label><br><br>
                                    <label for="">Address</label><br><br>
                                    <label for="">City</label><br><br>
                                    <label for="">Country</label><br><br>
                                    <label for="">Phone</label><br><br>
                                    <label for="">Fax</label><br><br>
                                    <label for="">Website</label>
                                </div>
                                <div class="col-md-5">
                                    <form action="{{route('info_update')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                    <input type="text" class="form-control" name="shopname" value="{{$user->shopname}}"><br>
                                    <input type="hidden" name="cms_id" value="{{$cms->id}}">
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    @if(!$cms->logo)
                                    <img src="{{asset('public/shop_logo/blank.jpg')}}" alt="" class="logo-change" style="width: 150px;height: 150px;" title="Logo">
                                    @else
                                    <img src="{{asset('public/shop_logo/'.$cms->logo)}}" alt="" class="logo-change" style="width: 135px;height: 135px;" title="Logo">
                                    @endif
                                    <br><br>
                                    <input type="file" class="mt-2" name="logo" title="Upload Logo"><br><br>
                                    <input type="text" class="form-control mb-3" name="currency" value="{{$cms->currency}}">
                                    <input type="text" class="form-control mb-3" name="address" value="{{$cms->address}}">
                                    <input type="text" class="form-control mb-3" name="city" value="{{$cms->city}}">
                                    <input type="text" class="form-control mb-3" name="country" value="{{$user->country}}" readonly>
                                    <input type="text" class="form-control mb-3" name="mobile" value="{{$user->mobile}}">
                                    <input type="text" class="form-control mb-3" name="fax" value="{{$cms->fax}}">
                                    <input type="text" class="form-control mb-3" name="website" value="{{$cms->website}}">
                                    <button type="submit" class="btn btn-primary">Update Setting</button>
                                </div>
                                <div class="col-md-4">
                                    @if($ads2->status == 'on')
                                    {!! html_entity_decode($ads2->code)!!}
                                    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('custom_plugin.js_files')
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection
