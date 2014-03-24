@section('title')
Fee Planner
@stop

@section('page_title')
Fee Planner
@stop

@section('app_nav')
	<nav id="app-nav" class="navbar navbar-default" role="navigation">
	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    <ul class="nav navbar-nav">
	      <li class=""><a href="{{ url('setup/edit/' . $client_id) }}">Setup</a></li>
	      <li class="active"><a href="#">Fee Planner</a></li>
	    </ul>
	  </div><!-- /.navbar-collapse -->
	</nav>
@stop

