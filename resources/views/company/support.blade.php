@extends('layout.company.masterpage')
@section('title', 'Customer Support')
@section('masterpage')

<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Customer Support</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Customer Support</a>
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
                        <form action="{{route('support-contact')}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <input type="hidden" name="ring" value="{{Session::get('loggedUser')['ring']}}">
                            <input type="hidden" name="user_name" value="{{Session::get('loggedUser')['fname']}} {{Session::get('loggedUser')['lname']}}">
                            <input type="hidden" name="shopname" value="{{Session::get('loggedUser')['shopname']}}">

                            <div class="col-md-6 mb-4">
                                <input type="text" name="user_name"
                                       value="{{Session::get('loggedUser')['fname']}} {{Session::get('loggedUser')['lname']}}" class="form-control" disabled>
                            </div>
                            <div class="col-md-6 mb-4">
                                <input type="text" name="shopname" value="{{ Session::get('loggedUser')['shopname']}}" class="form-control" disabled>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" value="{{ Session::get('loggedUser')['email']}}" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="mobile" class="form-control" value="{{ Session::get('loggedUser')['mobile']}}">
                            </div>

                            <div class="col-md-12 mt-4 mb-4">
                                <textarea name="msg" id="" cols="30" rows="5" class="form-control" placeholder="Details" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-secondary green-button" style="padding: 5px 20px; font-size: 20px">Submit</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('custom_plugin.js_files')
@endsection
