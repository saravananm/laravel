@foreach($advertisementdetails as $advertisements)
<div class="graybox-advertisement">
	<a href="{{$advertisements->url}}" target="blank"><img src= "{{url('public/storage/images/advertisements/'.$advertisements->image_name) }}" style="width:100%;height:{{$advertisements->height}}px" /></a>
</div>
@endforeach
<div class="clearfix"></div>