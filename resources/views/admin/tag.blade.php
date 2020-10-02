
@extends('admin.layout.adminlayout')

@section('title', 'Tags Settings')

@section('content')
<div class="contentarea">
  <div class="col-sm-12">
    <a class="float-right" href="https://html-color-codes.info/" target="_blank">Get the Color Code</a>
    <br />
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
    <form action="{{url('/tags')}}" method="post">
      @csrf
      <div class="form-group">
        <input type="hidden"  name="id" value="@if(isset($edit_data)){{old('id', $edit_data->id)}}@else{{old('id')}}@endif">
        <label for="tagname">Tag Name:</label>
        <input type="text" class="form-control"  name="name" placeholder="Enter Tag Name" value="@if(isset($edit_data)){{old('name', $edit_data->name)}}@else{{old('name')}}@endif" id="name">
      </div>
      <div class="form-group">
        <label for="color">Text Color:</label>
        <input type="text" maxlength="6" class="form-control" name="color" placeholder="Enter Text Color" value="@if(isset($edit_data)){{old('color', $edit_data->color)}}@else{{old('color')}}@endif" id="color">
        <small>Don't include the #</small>
      </div>
      <div class="form-group">
        <label for="background">Background color:</label>
        <input type="text" maxlength="6" class="form-control" name="background" placeholder="Enter background Color" value="@if(isset($edit_data)){{old('background',$edit_data->background)}}@else{{old('background')}}@endif" id="background">
        <small>Don't include the #</small>
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
