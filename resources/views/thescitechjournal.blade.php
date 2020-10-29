
@extends('layout.layout')

@section('title', 'Home Page')

@section('content')

<div class="row mt-2">
    <!---- Right Side ------->
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12 pr-0">
                <ul class="tab-year">
                    @foreach($coverImageYearMonths as $year => $val)
                    <li class="{{ ($selyear == $year) ? 'active' : '' }}" onclick="selectyear({{$year}})">{{$year}}</li>
                    @endforeach
                </ul>
                <div style="border:2px solid #00b3e5; clear:both;"></div>
                @foreach($coverImageYearMonths as $year => $yearmonth)
                <ul class="tab-month" style="display: none" id="{{$year}}-months">
                    @foreach($yearmonth as $month => $val)
                    <li class="{{ ($selmonth == $month) ? 'active' : '' }}"><a href="{{url('the-scitech-journal/'.$month.'-'.$year)}}">{{$monthname[$month]}}</a></li>
                    @endforeach
                </ul>
                @endforeach
            </div>
        </div>
        <div class="mt-2" style="color:#53cbf1; font-weight:bold;">{{$selyear}} >> {{$monthname[$selmonth]}}</div>
        <br />  
        <div class="row">
            <img src="{{url('public/storage/images/coverimage/'.$coverimage->image_name) }}"  style="display: block; margin-left: auto; margin-right: auto; width: 60%;border: 2px solid #eaeaea;" > 
        </div>

        <div class="row mt-2">
            @foreach($data as $postkey => $postval)
            <div class="title-box mt-2"><span>{{$postkey}}</span></div>
            @foreach($postval as $post)
            <div class="list-news">
                <div class="col-md-4 float-left pr-0 img-hover">
                    <img src="{{url('public/storage/images/thescitechjournalposts/'.$post->image_name) }}" class="image-fit" >
                    @foreach($post->tags as $tag)
                    <span class="news-tag" style="background:#{{$tag->background}};color:#{{$tag->color}};margin-left:5px; position:relative;top:-30px;">{{$tag->name}}</span>
                    @endforeach
                </div>
                <div class="col-md-8 float-right pr-0">
                    <h4><a href="{{url('the-scitech-journal-post/'.$post->slug)}}">{{$post->title}}</a></h4>
                    <div class="list-date"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> {{date('F j, Y', strtotime($post->datefor))}}</div>
                    <div class="list-author"> <span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{$post->author}}</div>
                    <div class="clearfix"></div>
                    <p>{!! $post->short_message !!}</p>
                </div>
                
            </div>
            @endforeach
           
            @endforeach
        </div>
    </div>
    <!---- Left Side ------->
    <div class="col-md-4">
        
        @include('leftsidepanel') 

    </div>
    <div class="clearfix"></div>
</div>
<script>
function 
selectyear($y)
{
   $(".tab-month").hide();
   $("#"+$y+"-months").show();
}
selectyear({{$selyear}})
</script>
@endsection
