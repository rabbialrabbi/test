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

    <div class="container">
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-sm-6 col-md-4">
                <div class="single-blog-post">
                    <div class="single-blog-post-top">
                        <div class="blog-post-img">
                            <img src="{{asset('public/cms_panel/'.$blog->image)}}" alt="">
                            <div class="blog-post-date">
                                <div class="blog-date">
                                    <span class="blog-date-color">{{ $blog->date->format('d')}}</span><br>
                                    <span>{{ $blog->date->format('M')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-blog-post-middle">
                        <a href=""><i class="fas fa-user-alt mr-2"></i>admin</a>
                    </div>
                    <div class="single-blog-post-bottom">
                        <h3><a href="{{url('blog/'.str_slug($blog->title))}}" target="_blank" style="text-decoration: none !important;">
                                {{$blog->title}}</a></h3>

                        <p>{!!str_limit($blog->description,250)!!}</p>
                    </div>
                </div>
            </div>
           @endforeach
        </div>
        <div class="row mb-5 mt-2">
            <div class="col-md-12">
				<ul class="pagination justify-content-center">
					{{ $blogs->links() }}
				</ul>
            </div>
        </div>
    </div>
</div>
<br><br>

<style>
    .facebook {
        padding: 9px;
        font-size: 16px;
        width: 25px;
        height: 5px;
        border-radius: 50%;
        text-align: center;
        text-decoration: none;
        color: #3B5998;
        /*background: #3B5998;*/
    }
    .twitter {
        padding: 9px;
        font-size: 16px;
        width: 25px;
        height: 5px;
        border-radius: 50%;
        text-align: center;
        text-decoration: none;
        color: #55acee;
        /*background: #55acee;*/
    }
</style>
@include('layout.front.footer')
@endsection
