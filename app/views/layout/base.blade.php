<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Price Planner Pro</title>
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
                <a class="navbar-brand" href="index.html">Price Planner Pro</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
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
                    <li>
                        <a href="{{ url('setup') }}"><i class="fa fa-briefcase fa-fw"></i> Start Planning</a>
                    </li>
                    <li>
                        <a href="{{ url('home')  }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->

	@yield('app_nav')

        <div id="page-wrapper">
		@if (Session::get('message'))
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
					<b>{{ Session::get('message') }}</b>
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

    {{ Asset::container('footer')->scripts() }}

</body>

</html>
