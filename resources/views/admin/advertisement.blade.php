
@extends('admin.layout.adminlayout')

@section('title', 'Advertisement Settings')

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


    <form action="/advertisements" method="post" enctype="multipart/form-data" >
      @csrf
      <div class="form-group">
        <input type="hidden"  name="id" value="@if(isset($edit_data)){{old('id', $edit_data->id)}}@else{{old('id')}}@endif">
        <label for="tagname">Image Name:</label>
        <input type="text" class="form-control"  name="name" placeholder="Enter Tag Name" value="@if(isset($edit_data)){{old('name', $edit_data->name)}}@else{{old('name')}}@endif" id="name">
      </div>
      <div class="form-group">
        <label for="url">URL:</label>
        <input type="url" class="form-control" name="url" placeholder="Enter URL" value="@if(isset($edit_data)){{old('url', $edit_data->url)}}@else{{old('url')}}@endif" id="url">
      </div>
      <div class="form-group">
        <label for="width">Image Width:</label>
        <input type="number" maxlength="4" class="form-control" name="width" placeholder="Image Width" value="@if(isset($edit_data)){{old('width',$edit_data->width)}}@else{{old('width')}}@endif" id="width">
      </div>
      <div class="form-group">
        <label for="height">Image Height:</label>
        <input type="number" maxlength="4" class="form-control" name="height" placeholder="Image height" value="@if(isset($edit_data)){{old('height',$edit_data->height)}}@else{{old('height')}}@endif" id="height">
      </div>
      <div class="row">
        <div class="form-group col-sm-4 float-left">
          <label for="image_name">Image</label>
          <input type="file" class="form-control-file" id="image_name" name="image_name">
        </div>
        <div class="col-sm-8 float-right">
          @if(isset($edit_data))
          <img src= "{{url('storage/images/advertisements/'.$edit_data->image_name) }}" style="width:150px;height:70px" />
          @endif
        </div>
      </div>
      <div class="form-group">
        <label for="position">Position:</label>
          <select class="form-control" id="position" name="position">
            <option value="banner" 
            @if(isset($edit_data))
              @if(@old('position') !== null)
              {{ (old("position") == 'banner' ? "selected":"") }}
              @else
              {{ ($edit_data->position == 'banner' ? "selected":"") }}
              @endif
            @else
              @if(@old('position') !== null)
              {{ (old("position") == 'banner' ? "selected":"") }}
              @endif
            @endif
            >Banner</option>
            <option value="sidepanel_top" @if(isset($edit_data))
              @if(@old('position') !== null)
              {{ (old("position") == 'sidepanel_top' ? "selected":"") }}
              @else
              {{ ($edit_data->position == 'sidepanel_top' ? "selected":"") }}
              @endif
            @else
              @if(@old('position') !== null)
              {{ (old("position") == 'sidepanel_top' ? "selected":"") }}
              @endif
            @endif
            >Sidepanel Top</option>
            <option value="sidepanel_bottom" @if(isset($edit_data))
              @if(@old('position') !== null)
              {{ (old("position") == 'sidepanel_bottom' ? "selected":"") }}
              @else
              {{ ($edit_data->position == 'sidepanel_bottom' ? "selected":"") }}
              @endif
            @else
              @if(@old('position') !== null)
              {{ (old("position") == 'sidepanel_bottom' ? "selected":"") }}
              @endif
            @endif
            >Sidepanel Bottom</option>
          </select>
        </div>
      <div class="form-group">
        <label for="order">Image Order:</label>
        <input type="number" maxlength="2" class="form-control" name="order" placeholder="Image order" value="@if(isset($edit_data)){{old('order',$edit_data->order)}}@else{{old('order')}}@endif" id="order">
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
          <th scope="col">Name</th>
          <th scope="col">Size</th>
          <th scope="col">URL</th>
          <th scope="col">Order</th>
          <th scope="col">Status</th>
          <th scope="col">Priview</th>
          <th scope="col">Edit</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $advertisements)
          <tr>
          <th scope="row">{{$advertisements->id}}</th>
          <td>{{$advertisements->name}}</td>
          <td>{{$advertisements->width}}x{{$advertisements->height}}</td>
          <td>{{$advertisements->url}}</td>
          <td>{{$advertisements->order}}</td>
          <td>
            @if($advertisements->status == '1') 
            Active
            @else
            In-active
            @endif
          </td>
          <td>
            <img src= "{{url('storage/images/advertisements/'.$advertisements->image_name) }}" style="width:150px;height:70px" />
          </td>
          <td><a href="{{url('advertisements/' . $advertisements->id)}}">Edit</a></td>
        </tr>
        @endforeach
        
      </tbody>
    </table>
    {{$data->links()}}
  </div>
</div>
@endsection
