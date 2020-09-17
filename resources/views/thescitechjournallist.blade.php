
@extends('layout.layout')

@section('title', 'Home Page')

@section('content')

<div class="row mt-2">
    <!---- Right Side ------->
     <div class="col-md-12 pr-0">
        <ul class="tab-year">
        @foreach($coverImageYearMonths as $year => $val)
        <li class="{{ ($selyear == $year) ? 'active' : '' }}" onclick="selectyear({{$year}})">{{$year}}</li>
        @endforeach
       </ul>
       <br />
       
        @foreach($coverImageYearMonths as $year => $yearmonth)
            <ul class="tab-month" style="display: none" id="{{$year}}-months">
            @foreach($yearmonth as $month => $val)
                <li class="{{ ($selmonth == $month) ? 'active' : '' }}"><a href="{{url('the-scitech-journal-list/'.$year.'-'.$month)}}">{{$monthname[$month]}}</a></li>
            @endforeach
             </ul>
        @endforeach
      

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
