@foreach($advertisementdetails_top as $advertisements_top)
<div class="graybox-advertisement">
	<a href="{{$advertisements_top->url}}" target="blank"><img src= "{{url('public/storage/images/advertisements/'.$advertisements_top->image_name) }}" style="width:100%;height:{{$advertisements_top->height}}px" /></a>
</div>
@endforeach
<div class="clearfix"></div>

<ul class="tab-head">
    <li class="leftpaneltab1" onclick="leftPanelTab(1)">Discoveries <br/>&<br/> Innovations</li>
    <li class="leftpaneltab2" onclick="leftPanelTab(2)">Applications <br/>&<br/> Impacts</li>
    <li class="mr-0 leftpaneltab3" onclick="leftPanelTab(3)">Science<br/>&<br/>Society</li>
</ul>
<div class="clearfix"></div>
<div style="border-bottom: 3px solid #00b3e5;"></div>
<div class="clearfix"></div>
@foreach($sidepaneltabdetails as $sidepaneltabskey => $sidepaneltabsval)
	@foreach($sidepaneltabsval as $sidepaneltabs)
	<div class="tab-content leftpanelcontent{{$sidepaneltabskey+1}}">
    	<h2><a href="#">{{$sidepaneltabs['title']}}</a></h2>
	</div>
	@endforeach
@endforeach


<div class="clearfix pt-1"></div>

@foreach($advertisementdetails_bottom as $advertisements_bottom)
<div class="graybox-advertisement">
	<a href="{{$advertisements_bottom->url}}" target="blank"><img src= "{{url('public/storage/images/advertisements/'.$advertisements_bottom->image_name) }}" style="width:100%;height:{{$advertisements_bottom->height}}px" /></a>
</div>
@endforeach
<div class="clearfix"></div>