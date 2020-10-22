
@extends('admin.layout.adminlayout')

@section('title', 'Post Settings')

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


    <form action="{{url('/thescitechjournalposts')}}" method="post" enctype="multipart/form-data" >
      @csrf
      <div class="form-group">
         <input type="hidden"  name="id" value="@if(isset($edit_data)){{old('id', $edit_data->id)}}@else{{old('id')}}@endif">
            <label for="coverimages_id">Select Cover Image</label>
            <select class="form-control" id="coverimages_id" name="coverimages_id">
                @foreach($coverimages as $cimages)
                <option value="{{$cimages->id}}"
                @if(isset($edit_data))
                  @if(old('coverimages_id') !== null)
                  {{ (old("coverimages_id") == $cimages->id ? "selected":"") }}
                  @else
                  {{ ($edit_data->coverimages_id == $cimages->id ? "selected":"") }}
                  @endif
                @else
                  @if(old('coverimages_id') !== null)
                  {{ (old("coverimages_id") == $cimages->id ? "selected":"") }}
                  @endif
                @endif
                >{{$cimages->month}}-{{$cimages->year}}</option>
                @endforeach
            </select>
      </div>
      
      <div class="form-group">
        <input type="hidden"  name="id" value="@if(isset($edit_data)){{old('id', $edit_data->id)}}@else{{old('id')}}@endif">
        <label for="title">Post Title:</label>
        <input type="text" class="form-control"  name="title" placeholder="Post Title" value="@if(isset($edit_data)){{old('title', $edit_data->title)}}@else{{old('title')}}@endif" id="title">
      </div>
      <div class="form-group">
        <label for="short_message">Short Message:</label>
        <textarea   class="form-control" name="short_message" placeholder="Enter Short Message" id="short_message">@if(isset($edit_data)){{old('short_message', $edit_data->short_message)}}@else{{old('short_message')}}@endif</textarea>
      </div>
      <div class="form-group">
        <label for="message">Long Message:</label>
        <textarea   class="form-control" name="message" placeholder="Image Message"  id="message">@if(isset($edit_data)){{old('message',$edit_data->message)}}@else{{old('message')}}@endif</textarea>
      </div>
      <div class="row">
        <div class="form-group col-sm-4 float-left">
          <label for="image_name">Image</label>
          <input type="file" class="form-control-file" id="image_name" name="image_name">
        </div>
        <div class="col-sm-8 float-right">
          @if(isset($edit_data))
          <img src= "{{url('public/storage/images/thescitechjournalposts/'.$edit_data->image_name) }}" style="width:150px;height:70px" />
          @endif
        </div>
      </div>
      <div class="form-group">
        <label for="datefor">Date:</label>
        <input type="date" style="width:250px;"  class="form-control" name="datefor" placeholder="Select Date" value="@if(isset($edit_data)){{old('datefor',$edit_data->datefor)}}@else{{old('datefor')}}@endif" id="datefor">
      </div>
      <div class="form-group">
        <label for="author">Author:</label>
        <input type="author"  class="form-control" name="author" placeholder="Author" value="@if(isset($edit_data)){{old('author',$edit_data->author)}}@else{{old('author')}}@endif" id="author">
      </div>
      Tags:
      <br />
      @foreach($tags as $tag)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="tag{{$tag->id}}" name="tag_id"
            @if(isset($edit_data))
                @if(old('tag_id') !== null)
                {{ (old("tag_id") == $tag->id ? "checked":"") }}
                @else
                  {{ ($edit_data->tag_id == $tag->id ? "checked":"") }}
                @endif
            @else
                @if(old('tag_id') !== null)
                {{ (old("tag_id") == $tag->id ? "checked":"") }}
                @endif
            @endif
             value="{{$tag->id}}">
            <label class="form-check-label" for="tag{{$tag->id}}">{{$tag->name}}</label>
        </div>
        @endforeach
        <br  class="clear-fix"/>
        <br  class="clear-fix"/>
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
          <th scope="col">CoverImage</th>
          <th scope="col">Title</th>
          <th scope="col">Status</th>
          <th scope="col">Edit</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $post)
          <tr>
          <th scope="row">{{$post->id}}</th>
          <td>{{$post->month}}-{{$post->year}}</td>
          <td>{{$post->title}}</td>
          <td>
            @if($post->status == '1') 
            Active
            @else
            In-active
            @endif
          </td>
          <td><a href="{{url('thescitechjournalposts/' . $post->id)}}">Edit</a></td>
        </tr>
        @endforeach
        
      </tbody>
    </table>
    {{$data->links()}}
  </div>
</div>
@push('head')
<!-- Scripts -->
<script src="{{ asset('public/js/ckeditor/ckeditor.js')}}"></script>
@endpush
<script>
      CKEDITOR.replace( 'short_message' );
      CKEDITOR.replace( 'message' );
</script>
@endsection
