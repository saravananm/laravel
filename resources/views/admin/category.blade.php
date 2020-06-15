
@extends('admin.layout.adminlayout')

@section('title', 'Categories Settings')

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
    <form action="/categories" method="post">
      @csrf
      <div class="form-group">
        <input type="hidden"  name="id" value="@if(isset($edit_data)){{old('id', $edit_data->id)}}@else{{old('id')}}@endif">
        <label for="category">Category:</label>
        <input type="text" class="form-control"  name="category" placeholder="Enter category Name" value="@if(isset($edit_data)){{old('category', $edit_data->category)}}@else{{old('category')}}@endif" id="category">
      </div>
      <div class="form-group">
        <label for="order">Order:</label>
        <input type="number" maxlength="2" class="form-control" name="order" placeholder="Category order" value="@if(isset($edit_data)){{old('order',$edit_data->order)}}@else{{old('order')}}@endif" id="order">
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
          <th scope="col">Category</th>
          <th scope="col">Order</th>
          <th scope="col">Status</th>
          <th scope="col">Edit</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $categories)
          <tr>
          <th scope="row">{{$categories->id}}</th>
          <td>{{$categories->category}}</td>
          <td>{{$categories->order}}</td>
          <td>
            @if($categories->status == '1') 
            Active
            @else
            In-active
            @endif
          </td>
          <td><a href="{{url('categories/' . $categories->id)}}">Edit</a></td>
        </tr>
        @endforeach
        
      </tbody>
    </table>
    {{$data->links()}}
  </div>
</div>
@endsection
