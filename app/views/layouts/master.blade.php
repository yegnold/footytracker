<!DOCTYPE html>
<html>
  <head>
    <title>{{ $page_title or 'FootyTracker - Track casual football attendance and payments' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="{{ url('/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

	<div class="container">

	<!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}">FootyTracker</a>
        </div>
        <div class="navbar-collapse collapse">
          @if(Auth::check())
          <ul class="nav navbar-nav">
            <li><a href="{{ url('/player') }}">Players <span class="badge">{{{ $players_count }}}</span></a></li>
            <li><a href="{{ url('/match') }}">Meetups</a></li>
            <li><a href="#">Payment Status</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="{{ url('/about') }}">About</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="{{ url('/logout') }}">Log Out</a></li>
          </ul>
          @else
          <ul class="nav navbar-nav  navbar-right">
            <li><a href="{{ url('/about') }}">About FootyTracker</a></li>
          </ul>
          @endif
          
        </div><!--/.nav-collapse -->
      </div>

	@yield('main_content', 'error_main_content_not_defined')

	</div><!--/.container -->

	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ url('/js/bootstrap.min.js') }}"></script>
</body>
</html>
