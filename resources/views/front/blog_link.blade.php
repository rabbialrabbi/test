@extends('layout.front.masterpage')
@section('title', 'Blog')
@section('front_masterpage')
<style>
    html, body {
        height: inherit;
    }
    .header-area {
        height: inherit;
    }
</style>

<div class="header-area" style="border-bottom: 3px solid #e90e6994; margin-bottom: 50px;">
    @include('layout.front.header')
</div>

<div class="contact-us-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Blog</h2><br>
            </div>
        </div>
    </div>

    <div class="single-blog-content-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-post-image">
                        <img height="300px" width="800px" src="{{asset('public/cms_panel/'.$show->image)}}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p style="font-weight: bold; margin-top: 30px">{{$show->date->format('d M, Y')}} </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-4">{{$show->title}}</h2>

                    <p> {!!html_entity_decode($show->description)!!}</p>
                </div>
            </div>
            <div class="row mb-5" style="margin-top:30px;">
                <div class="col-md-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{'sozasop.com/blog/'.$url_data}}" target="blank">
                        <div class="social-icon" style="background: #3B5998;"><i class="fab fa-facebook-f"></i></div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="https://twitter.com/intent/tweet?status={{$show->title}}+{{'sozasop.com/blog/'.$url_data}}" target="blank">
                        <div class="social-icon" style="background: #55ACEE;"><i class="fab fa-twitter"></i></div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{'sozasop.com/blog/'.$url_data}}&title={{$show->title}}&source=LinkedIn" target="blank">
                        <div class="social-icon" style="background: #007bb5;"><i class="fab fa-linkedin-in"></i></div>
                    </a>
                </div>
<!--                https://www.linkedin.com/shareArticle?mini=true&url=http://developer.linkedin.com&title=LinkedIn%20Developer%20Network&summary=My%20favorite%20developer%20program&source=LinkedIn-->
                <div class="col-md-2">
                    <a href="">
                        <div class="social-icon" style="background: radial-gradient(circle at 33% 100%, #fed373 4%, #f15245 30%, #d92e7f 62%, #9b36b7 85%, #515ecf);"><i class="fab fa-instagram"></i></div>
                    </a>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>

</div>
<br><br>

@include('layout.front.footer')
@endsection
