
@extends('layout.layout')

@section('title', 'Home Page')

@section('content')

<div class="row mt-2">
    <!---- Right Side ------->
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-8 pb-1">
                <div class="graybox img-hover" style="position:relative">
                    <img src="{{url('public/storage/images/posts/'.$postcoverimage->image_name) }}" class="image-fit">    
                    <div class="featured-image-wrapper pt-2">
                         <h3 class="featured-image-title"><a href="">{{$postcoverimage->title}}</a></h3>
                    </div>
                </div>
            </div>
             <div class="col-md-4  pl-0 pr-0 pb-1" >
                <div class="graybox img-hover">
                    <img src="{{url('public/storage/images/coverimage/'.$coverimage->image_name) }}"  class="image-fit">                         
                </div>                               
            </div>
        </div>  
        <div class="title-box mt-2"><span>Latest News & Features</span></div>
        <div class="row">
            @foreach($data as $post)
            <div class="list-news">
                <div class="col-md-4 float-left pr-0 img-hover">
                    <img src="{{url('public/storage/images/posts/'.$post->image_name) }}" class="image-fit" >  
                    @foreach($post->tags as $tag)
                    <span class="news-tag" style="background:#{{$tag->background}};color:#{{$tag->color}};margin-left:5px; position:relative;top:-30px;">{{$tag->name}}</span>
                    @endforeach
                </div>
                <div class="col-md-8 float-right pr-0">
                    <h4><a href="/post/{{$post->slug}}">{{$post->title}}</a></h4>
                    <div class="list-date"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> {{date('F j, Y', strtotime($post->datefor))}}</div>
                    <div class="list-author"> <span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{$post->author}}</div>
                    <div class="clearfix"></div>
                    <p>{!! $post->short_message !!}</p>
                </div>
            </div>
            <div class="bottom-line pt-1"></div>
            @endforeach
        </div>
    </div>
    <!---- Left Side ------->
    <div class="col-md-4">
        @include('leftsidepanel') 
    </div>
    <div class="clearfix"></div>
</div>

@endsection
