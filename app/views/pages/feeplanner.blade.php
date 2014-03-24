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

@section('content')
    <div class="panel panel-default">
	<div class="panel-heading">
		Fee Planner
	</div>
	<div class="panel-body">
	{{ Form::open(array('route' => $route, 'method' => 'PUT', 'class' => 'bs-example form-horizontal', 'ng-controller' => 'PPCtrl')) }}
		@if ($edit)
		@endif	
		<table class="table">
			<tr>
				<td class="text-right col-legend emphasize">
					Type of Business
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Turnover
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Quality of Records
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Audit Requirements
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Audit Risk
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Tax Returns
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					VAT Returns
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Book Keeping <br>
					<em>if we do the book keeping don't forget to adjust the quality of records</em>
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Payroll
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend">
					Employees
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td>
					Weekly
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td>
					Forthnightly
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td>
					Four Weekly
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td>
					Monthly
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td>
					Annually
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend">
					Subcontractors
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td>
					Weekly
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td>
					Monthly
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Modules
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Other Services
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Annual Fee
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Monthly Cost
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Discount
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Total Annual Fee
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Total Monthly Cost
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
		</table>
	{{ Form::close() }}
	</div>
    </div>
@stop
