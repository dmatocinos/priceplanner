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
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::select(
						'pricing[business_type_id]', $select_data['business_types'], $pricing['business_type_id'], [
						'class' => 'form-control input-sm',
						'required'	=> 'required'
					]);
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Turnover
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::text('pricing[turnover]', $pricing['turnover'], array(
						'class' => 'form-control input-sm', 
						'required'	=> 'required'
					));
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Type of Records
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::select(
						'pricing[record_type_id]', $select_data['record_types'], $pricing['record_type_id'], [
						'class' => 'form-control input-sm',
						'required'	=> 'required'
					]);
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Quality of Records
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::select(
						'pricing[record_quality_id]', $select_data['record_qualities'], $pricing['record_quality_id'], [
						'class' => 'form-control input-sm',
						'required'	=> 'required'
					]);
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Audit Requirements
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::select(
						'pricing[audit_requirement_id]', $select_data['audit_requirements'], $pricing['audit_requirement_id'], [
						'class' => 'form-control input-sm',
						'required'	=> 'required'
					]);
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Audit Risk
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::select(
						'pricing[audit_risk_id]', $select_data['audit_risks'], $pricing['audit_risk_id'], [
						'class' => 'form-control input-sm',
						'required'	=> 'required'
					]);
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Tax Returns
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			@foreach($tax_returns as $id => $name)
			<tr>
				<td class="text-right col-legend">
					{{ $name }}
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::text('pricing[tax_return_pricing][$id]', $tax_return_pricing[$id], array(
						'class' => 'form-control input-sm', 
						'required'	=> 'required'
					));
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
				
			@endforeach
			<tr>
				<td class="text-right col-legend emphasize">
					VAT Returns
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Book Keeping <br>
					<em>if we do the book keeping don't forget to adjust the quality of records</em>
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Payroll
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend">
					Employees
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td class="col-extra">
					Weekly
				</td>
				<td class="col-val">
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td class="col-extra">
					Forthnightly
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td class="col-extra">
					Four Weekly
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td class="col-extra">
					Monthly
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td>
					Annually
				</td>
				<td class="col-val">
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend">
					Subcontractors
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td class="col-extra">
					Weekly
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td class="col-extra">
					Monthly
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Modules
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Other Services
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Annual Fee
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Monthly Cost
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Discount
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Total Annual Fee
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Total Monthly Cost
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
		</table>
	{{ Form::close() }}
	</div>
    </div>
@stop
