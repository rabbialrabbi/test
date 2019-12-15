@extends('layout.company.masterpage')
@section('title', 'Password Change')
@section('masterpage')

<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Change Password</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Change Password</a>
                    </div>
                </div>
                @if($ads1->status == 'on')
                <div class="col-md-8" id="Ads">
                    {!! html_entity_decode($ads1->code)!!}
                </div>
                <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                @endif
            </div>
            <div class="row new-sales-table-bg">
                <div class="col-md-12">
                    <div class="product-form">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{route('update_password')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="old_email" value="{{ Session::get('loggedUser')['email']}}">
                                    <input type="text" name="email" placeholder="email..." class="form-control" required>
                                    <input type="text" name="old_pass" placeholder="old password..." class="form-control" required>
                                    <input type="text" name="password" placeholder="new password..." class="form-control" required>
                                    <button type="submit" class="green-button" style="padding: 5px 10px; color: #fff;">
                                        Submit
                                    </button>
                                </form>
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
@include('custom_plugin.js_files')
@endsection
