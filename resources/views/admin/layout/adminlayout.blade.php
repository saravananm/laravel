<!DOCTYPE html>
<html lang="en">
<head>
  <title> @yield('title') - page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('/css/bootstrap/4.5.0/css/bootstrap.min.css') }}">
  <!-- Custom CSS -->  
  <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
  @stack('head')
</head>
<body>
<div calss="row">
    <div class="col-sm-2 side-blue-panel float-left">
      <h2 class="avatar">Hi {{Session('user_name')}}</h2>
      <h3 class="menu-title">Main Menu</h3>
      <ul class="side-menu">
        <li ><a  href="/tags">Tags Module</a></li>
        <li ><a  href="/advertisements">Advertisements Module</a></li>
        <li ><a  href="/coverimages">Cover Image Module</a></li>
        <li ><a  href="/categories">Categories Module</a></li>
        <li ><a  href="/posts">Post Module</a></li>
        <li ><a  href="/thescitechjournalposts">The ScitechJournal Post Module</a></li>
        <li ><a  href="/highlights">Highlight Module</a></li>
      </ul>
    </div>
    <div class="col-sm-10 float-left ml-0 mr-0 pr-0 pl-0">
      <div class="header">
        <h4 class="pagetitle">@yield('title') - page</h4>
        <a  class="btn btn-danger btn-sm float-right" style="margin-top: 10px; margin-right:10px;" href="/logout">logout</a>
      </div>
      @yield('content')
    </div>
</div>
<script src="{{ asset('/css/bootstrap/4.5.0/js/bootstrap.min.js') }}"></script>
</body>
</html>
