<div class="header-banner">
	@foreach($advertisementdetails as $advertisements)
		<a href="{{$advertisements->url}}" target="blank">
			<div style="position: relative; width:{{$advertisements->width}}px;height:{{$advertisements->height}}px; margin: 0 auto;">
				<img src= "{{url('public/storage/images/advertisements/'.$advertisements->image_name) }}" style="width:{{$advertisements->width}}px;height:{{$advertisements->height}}px" />
				<h3 style="position: absolute; margin-top:-30px; text-align: center; display: inline-block; width: 100%">{{$advertisements->name}}</h3>
			</div>
		</a>
	@endforeach
</div>
