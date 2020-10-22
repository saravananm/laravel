
@extends('admin.layout.adminlayout')

@section('title', 'Config Settings')

@section('content')
<div class="contentarea">
  <div class="col-sm-12">
    @if(isset($error))
    <div class="alert alert-danger" role="alert">
    {{$error}}
    </div>
    @endif
    @if(session('message'))
     <div class="alert alert-success" role="alert"> {{session('message')}}</div>
    @endif
    <form action="{{url('/configs')}}" method="post">
      @csrf
      <div class="contentarea">
        <div class="col-sm-12">
          <table class="table table-hover mt-2">
            <thead>
              <tr>
                <th scope="col">Key</th>
                <th scope="col">Value</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $config)
                <tr>
                  <td><input type="text" class="form-control" name="configkey{{$config->id}}" value="{{$config->config_key}}" id="configkey{{$config->id}}"></td>
                  <td><input type="text" class="form-control" name="configvalue{{$config->id}}" value="{{$config->config_value}}" id="configvalue{{$config->id}}"></td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
        
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
@endsection
