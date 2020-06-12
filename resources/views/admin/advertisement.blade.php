
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


    <form action="/advertisements" method="post">
      @csrf
      <div class="form-group">
        <input type="hidden"  name="id" value="@if(isset($edit_data)){{old('id', $edit_data->id)}}@else{{old('id')}}@endif">
        <label for="tagname">Tag Name:</label>
        <input type="text" class="form-control"  name="name" placeholder="Enter Tag Name" value="@if(isset($edit_data)){{old('name', $edit_data->name)}}@else{{old('name')}}@endif" id="name">
      </div>
      <div class="form-group">
        <label for="url">URL:</label>
        <input type="text" class="form-control" name="url" placeholder="Enter URL" value="@if(isset($edit_data)){{old('url', $edit_data->url)}}@else{{old('url')}}@endif" id="url">
      </div>
      <div class="form-group">
        <label for="width">Image Width:</label>
        <input type="text" class="form-control" name="width" placeholder="Image Width" value="@if(isset($edit_data)){{old('width',$edit_data->width)}}@else{{old('width')}}@endif" id="width">
      </div>
      <div class="form-group">
        <label for="height">Image Height:</label>
        <input type="text" class="form-control" name="height" placeholder="Image height" value="@if(isset($edit_data)){{old('height',$edit_data->height)}}@else{{old('height')}}@endif" id="height">
      </div>
      <div class="form-group">
        <label for="advertisementimage">Image</label>
        <input type="file" class="form-control-file" id="advertisementimage" name="advertisementimage">
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
            <option value="sidepanel" @if(isset($edit_data))
              @if(@old('position') !== null)
              {{ (old("position") == 'sidepanel' ? "selected":"") }}
              @else
              {{ ($edit_data->position == 'sidepanel' ? "selected":"") }}
              @endif
            @else
              @if(@old('position') !== null)
              {{ (old("position") == 'sidepanel' ? "selected":"") }}
              @endif
            @endif
            >Sidepanel</option>
          </select>
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
          <th scope="col">Tag</th>
          <th scope="col">Color</th>
          <th scope="col">Background</th>
          <th scope="col">Status</th>
          <th scope="col">Priview</th>
          <th scope="col">Edit</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $tags)
          <tr>
          <th scope="row">{{$tags->id}}</th>
          <td>{{$tags->name}}</td>
          <td>{{$tags->color}}</td>
          <td>{{$tags->background}}</td>
          <td>
            @if($tags->status == '1') 
            Active
            @else
            In-active
            @endif
          </td>
          <td><div class="btn btn-sm" style="background: #{{$tags->background}}; color: #{{$tags->color}}">{{$tags->name}}</div></td>
          <td><a href="{{url('tags/' . $tags->id)}}">Edit</a></td>
        </tr>
        @endforeach
        
      </tbody>
    </table>
    {{$data->links()}}
  </div>
</div>
@endsection
