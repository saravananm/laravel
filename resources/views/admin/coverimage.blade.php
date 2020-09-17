
@extends('admin.layout.adminlayout')

@section('title', 'Cover Image Settings')

@section('content')
<div class="contentarea">
  <div class="col-sm-12">
    @if($errors->any())
    <div class="alert alert-danger" role="alert">
      <ul class="error-list">
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
    </ul>
    </div>
    @endif
    @if(session('message'))
     <div class="alert alert-success" role="alert"> {{session('message')}}</div>
    @endif


    <form action="{{url('/coverimages')}}" method="post" enctype="multipart/form-data" >
      @csrf
      <div class="form-group">
        <input type="hidden"  name="id" value="@if(isset($edit_data)){{old('id', $edit_data->id)}}@else{{old('id')}}@endif">
        <label for="month">Month:</label>
        <input type="number" maxlength="2" class="form-control"  name="month" placeholder="Enter Month" value="@if(isset($edit_data)){{old('month', $edit_data->month)}}@else{{old('month')}}@endif" id="month">
      </div>
      <div class="form-group">
        <label for="year">Year:</label>
        <input type="number" maxlength="4" class="form-control" name="year" placeholder="Enter Year" value="@if(isset($edit_data)){{old('year',$edit_data->year)}}@else{{old('year')}}@endif" id="year">
      </div>
      <div class="row">
        <div class="form-group col-sm-4 float-left">
          <label for="image_name">Image</label>
          <input type="file" class="form-control-file" id="image_name" name="image_name">
        </div>
        <div class="col-sm-8 float-right">
          @if(isset($edit_data))
          <img src= "{{url('storage/images/coverimage/'.$edit_data->image_name) }}" style="width:150px;height:70px" />
          @endif
        </div>
      </div>
      <div class="form-group">
        <label for="status">Status:</label>
          <select class="form-control" id="status" name="status">
            <option value="1" 
            @if(isset($edit_data))
              @if(@old('status') !== null)
              {{ (old("status") == 1 ? "selected":"") }}
              @else
              {{ ($edit_data->status == 1 ? "selected":"") }}
              @endif
            @else
              @if(@old('status') !== null)
              {{ (old("status") == 1 ? "selected":"") }}
              @endif
            @endif
            >Active</option>
            <option value="0" @if(isset($edit_data))
              @if(@old('status') !== null)
              {{ (old("status") == 0 ? "selected":"") }}
              @else
              {{ ($edit_data->status == 0 ? "selected":"") }}
              @endif
            @else
              @if(@old('status') !== null)
              {{ (old("status") == 0 ? "selected":"") }}
              @endif
            @endif>In-active</option>
          </select>
        </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<div class="contentarea">
  <div class="col-sm-12">
    <table class="table table-hover mt-2">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Month-Year</th>
          <th scope="col">Image</th>
          <th scope="col">Status</th>
          <th scope="col">Edit</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $coverimage)
          <tr>
          <th scope="row">{{$coverimage->id}}</th>
          <td>{{$coverimage->month}}- {{$coverimage->year}}</td>
          <td>
            @if($coverimage->status == '1') 
            Active
            @else
            In-active
            @endif
          </td>
          <td>
            <img src= "{{url('storage/images/coverimage/'.$coverimage->image_name) }}" style="width:150px;height:70px" />
          </td>
          <td><a href="{{url('coverimages/' . $coverimage->id)}}">Edit</a></td>
        </tr>
        @endforeach
        
      </tbody>
    </table>
    {{$data->links()}}
  </div>
</div>
@endsection
