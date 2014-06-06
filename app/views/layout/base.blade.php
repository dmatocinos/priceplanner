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
                    <a class="dropdown-toggle" data-toggle="modal" data-target="#myModal" href="#">
                        <i class="fa fa-comments-o fa-fw"></i> Support 
                    </a>
		</li>
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
		            @if ($user->accountant && $user->accountant->last_tab == 'completed')
						@yield('client')
						<li>
							<a href="#" data-toggle="modal" data-target="#clientModal"><i class="fa fa-briefcase fa-fw"></i> Start Planning</a>
						</li>
						<li>
							<a href="{{ route('practicedetails.setup') }}"><i class="fa fa-leaf fa-fw"></i> Practice Details</a>
						</li>
						<li>
							<a href="{{ url('home')  }}"><i class="fa fa-dashboard fa-fw"></i> Clients</a>
						</li>
					@else
						<li>
							<a href="{{ route('practicedetails.setup') }}"><i class="fa fa-leaf fa-fw"></i> Practice Details</a>
						</li>
					@endif
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
	    <div style="float:left; width: 100%; max-width: 350px;">
			<div style="width: 230px;">
				<a href="http://bizvaluationpro.practicepro.co.uk" class="thumbnail" title=" Create a professional business valuation in just 15 minutes"><img src="{{ asset('images/app-logos/bizvaluation_logo.png') }}" style="width: 200px; padding: 10px 0;"/></a>
			</div>
			<div style="width: 230px;">
				<a href="http://incorporationplannerpro.practicepro.co.uk" class="thumbnail" title="Show your clients the potential tax savings of incorporating their business"><img src="{{ asset('images/app-logos/incorporationplannerpro_logo.png') }}" style="width: 95%;"/></a>
			</div>
			<div style="width: 230px;">
				<a href="http://remunerationpro.practicepro.co.uk/" class="thumbnail" title="Maximise your clients' personal income"><img src="{{ asset('images/app-logos/remuneration_logo.png') }}" style="width: 80%;"/></a>
			</div>
			<div style="width: 230px;">
				<a href="http://virtualfdpro.practicepro.co.uk/" class="thumbnail" title="Help your clients achieve their goals"><img src="{{ asset('images/app-logos/vfd.png') }}" style="width: 100%; padding: 5px;"/></a>
			</div>
	    </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      {{ Form::open(array('route' => 'email_support')) }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Contact Support</h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="span12" style="padding: 15px;">
				<h4>We aim to make you feel comfortable with our service, please let us know how we can help you further.</h4>
				<br>
				<fieldset>
					{{ Form::token() }}
					<div class="form-group">
						<label for="msg_subject">Subject</label>
						<input name="subject" type="text" class="form-control" id="msg_subject" placeholder="What is it about?" required="required">
					</div>
					<div class="form-group">
						<label for="msg_message">Message</label>
						<textarea name="msg" class="form-control" row="3" style="height: 120px;" id="msg_message" placeholder="Please provide more details." required="required"></textarea>
					</div>
				</fieldset>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button class="btn btn-success" type="submit">Submit</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<!-- Client Select Modal -->
<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      {{ Form::open(array('route' => 'add_client')) }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Client Details</h4>
      </div>
      <div class="modal-body">
	<div class="row">
		<div class="col-lg-12" style="padding: 15px;">
		<fieldset>
			{{ Form::token() }}
			  <div class="form-group">
				    <label for="" class="col-lg-12 control-label">Add client details for the new price plan. Choose which one you prefer to retrieve client details.</label>
				    <div class="col-lg-12">
					<div class="radio">
					  <label>
					    <input type="radio" name="select_by" id="existing" value="existing" checked>
						From Existing Clients		
						{{ 
							Form::select(
								'client_id', $current_clients, 
								null,
								array(
									'class' => 'form-control', 
							)) 
						}}
					  </label>
					</div>
				    </div>
				    <br>
				    <div class="col-lg-12">
					<div class="radio">
					  <label>
					    <input type="radio" name="select_by" id="new_client" value="new_client">
						Add New Client
					  </label>
					</div>
				    </div>
			  </div>
		</fieldset>
		</div>
	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button class="btn btn-success" type="submit">Submit</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
<!-- Modal -->

    {{ Asset::container('footer')->scripts() }}

</body>

</html>
