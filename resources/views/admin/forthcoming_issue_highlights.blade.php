
@extends('admin.layout.adminlayout')

@section('title', 'Forthcoming issue Highlights')

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
    <form action="/highlights" method="post" enctype="multipart/form-data" >
      @csrf
      <div class="form-group">
        <label for="highlights">Highlights:</label>
        <textarea   class="form-control" name="highlights" placeholder="Enter highlights" id="highlights">@if(isset($data)){{old('highlights', $data->highlights)}}@else{{old('highlights')}}@endif</textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
@push('head')
<!-- Scripts -->
<script src="{{ asset('js/ckeditor/ckeditor.js')}}"></script>
@endpush
<script>
      CKEDITOR.replace( 'highlights' );
</script>
@endsection
