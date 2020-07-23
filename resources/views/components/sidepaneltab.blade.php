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
