<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('page_title') | Price Planner Pro</title>
    {{ Asset::container('header')->styles() }}

</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Price Planner Pro</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>{{ $user->email }}&nbsp;<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
			<!--
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
			-->
                        <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

        </nav>
        <!-- /.navbar-static-top -->

        <nav class="navbar-inverse navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
		    @yield('client')
                    <li>
                        <a href="{{ url('setup') }}"><i class="fa fa-briefcase fa-fw"></i> Start Planning</a>
                    </li>
                    <li>
                        <a href="{{ url('home')  }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    @show
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->

	@yield('app_nav')

        <div id="page-wrapper">
		@if ( ! $errors->any() && Session::get('message'))
		<div class="row">
                	<div class="col-lg-12">
				<div class="alert alert-info alert-block">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<b>{{ Session::get('message') }}</b>
				</div>
			</div>
		</div>
		@endif
		@if ($errors->any())
		<div class="row">
                	<div class="col-lg-12">
				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<h4>Error</h4>
					{{ implode('', $errors->all('<li class="error">:message</li>')) }}
				</div>
			</div>
		</div>
		@endif
            <div class="row">
                <div class="col-lg-12">
			@yield('content')
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <div class='notifications bottom-left'>
	    <div style="float:left; width: 350px;">
			<div style="width: 230px;">
				<a href="http://app.bizvaluation.co.uk" class="thumbnail" title=" Create a professional business valuation in just 15 minutes"><img src="{{ asset('images/app-logos/bizvaluation_logo.png') }}" style="width: 200px; padding: 10px 0;"/></a>
			</div>
			<div style="width: 230px;">
				<a href="http://practicepro.co.uk/incorporation/public/" class="thumbnail" title="Show your clients the potential tax savings of incorporating their business"><img src="{{ asset('images/app-logos/incorporationplannerpro_logo.png') }}" style="width: 95%;"/></a>
			</div>
			<div style="width: 230px;">
				<a href="http://remunerationpro.practicepro.co.uk/" class="thumbnail" title="Maximise your clients' personal income"><img src="{{ asset('images/app-logos/remuneration_logo.png') }}" style="width: 80%;"/></a>
			</div>
			<div style="width: 230px;">
				<a href="http://virtualfdpro.practicepro.co.uk/" class="thumbnail" title="Help your clients achieve their goals"><img src="{{ asset('images/app-logos/virtualfdpro_logo.jpg') }}" style="width: 100%; padding: 5px;"/></a>
			</div>
	    </div>
    </div>

    {{ Asset::container('footer')->scripts() }}

</body>

</html>
