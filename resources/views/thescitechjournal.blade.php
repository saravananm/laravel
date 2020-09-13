
@extends('layout.layout')

@section('title', 'Home Page')

@section('content')

<div class="row mt-2">
    <!---- Right Side ------->
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-8 pb-1">
                <div style="position:relative;border: 2px solid #eaeaea"> 
                    <img src="{{url('public/storage/images/coverimage/'.$coverimage->image_name) }}"  class="image-fit"> 
                </div>
            </div>
             <div class="col-md-4  pl-0 pr-0 pb-1" >
                <div class="content-tag" style="color:#8bc34a;">Feature</div>
                 <h2 class="content-heading">You have five appetites, not one, and they are the key to your health</h2>
                 
                 <div class="content-tag" style="color:#ff0000;">News</div>
                 <h2 class="content-heading">Coronavirus and covid-19: Your questions answered</h2>
                 
                 <div class="content-tag" style="color:#ff0000;">News</div>
                 <h2 class="content-heading">ESA spacecraft might accidentally fly through the tail of a comet</h2>
                 
                 <div class="content-tag" style="color:#ff0000;">News</div>
                 <h2 class="content-heading">'Zombie' fires are burning the Arctic after smouldering under snow</h2>
                 
                 <div class="content-tag" style="color:#ff0000;">News</div>
                 <h2 class="content-heading">Mouse embryos that are 4 per cent human are step towards spare organs</h2>
                 
                 <div class="content-tag" style="color:#ff0000">News</div>
                 <h2 class="content-heading">Shock therapy temporarily improves woman’s colour blindness</h2>
                            
            </div>
        </div>  
        <div class="title-box mt-2"><span>Features</span></div>
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
    <div class="col-md-3">
        <div class="title-box-full pl-1 "><span>Forthcoming issue Highlights</span></div>
        <h2 class="content-heading mt-1">We have seen hints of a new fundamental force of nature</h2>
        {!! $highlight->highlights !!}
        
        <div class="title-box-full pl-1 "><span>PAST ISSUES</span></div>
        
        @foreach($coverimagesecongandthired as $cimage)
        <div class="graybox img-hover mt-1">
            <a href="{{url('the-scitech-journal/'.$cimage->month.'-'.$cimage->year)}}"><img src="{{url('public/storage/images/coverimage/'.$cimage->image_name) }}" class="image-fit"></a>;                             
        </div> 
        
        @endforeach
    </div>
    <div class="clearfix"></div>
</div>

@endsection
