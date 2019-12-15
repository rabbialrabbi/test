@extends('layout.front.masterpage')
@section('title', 'About')
@section('front_masterpage')
<style>
    html, body {
        height: inherit;
    }
    .header-area {
        height: inherit;
    }
    #map {
        width: 100%;
    }
</style>

<div class="header-area" style="border-bottom: 3px solid #e90e6994; margin-bottom: 50px;">
    @include('layout.front.header')
</div>

<div class="contact-us-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>About</h2><br>
            </div>
        </div>
    </div>

    <div class="single-blog-content-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-post-image mb-3">
                        <img height="60%" width="100%" src="{{asset('public/cms_panel/'.$about->image)}}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-4">{{$about->title}}</h2>
                    <p>{!! html_entity_decode($about->description)!!}</p>
                </div>
            </div>
        </div>
    </div>

</div>
<br><br>

@include('layout.front.footer')
@endsection
