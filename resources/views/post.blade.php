
@extends('layout.layout')

@section('title', 'Home Page')

@section('content')

<div class="row mt-2">
    <!---- Right Side ------->
     <div class="col-md-8 pr-0">
        <div class="title-box mt-2"><span>{{$post->division}}</span></div>
        <div class="clearfix">&nbsp;</div>
        @foreach($post->tags as $tag)
        <span class="news-tag" style="background:#{{$tag->background}};color:#{{$tag->color}};">{{$tag->name}}</span>
        @endforeach
        <h1 class="list-news-title mt-2">{{$post->title}}</h1>
        <p class="list-news-short-description">{!! $post->short_message !!}</p>
        <div class="list-date"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>{{date('F j, Y', strtotime($post->datefor))}}</div>
        <div class="list-author"> <span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{$post->author}}</div>
        <div class="clearfix">&nbsp;</div>

        <img src="{{url('public/storage/images/posts/'.$post->image_name) }}" style="width: 100%" class=" mt-1">                              
        <div class="news-content mt-2">
            {!! $post->message !!}
        </div>
    </div>
    <!---- Left Side ------->
    <div class="col-md-4">
        @include('leftsidepanel') 
    </div>
    <div class="clearfix"></div>
</div>

@endsection
