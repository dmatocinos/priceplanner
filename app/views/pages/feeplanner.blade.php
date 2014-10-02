@section('title')
Fee Planner
@stop

@section('page_title')
Fee Planner
@stop

@section('client')
@if($client_id)
    <li>
	<a href="#"><i class="fa fa-male fa-fw"></i>{{ $client_name }}</a>
    </li>
@endif
@stop

@section('app_nav')
	<nav id="app-nav" class="navbar navbar-default" role="navigation">
	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    <ul class="nav navbar-nav">
	      <li class=""><a href="{{ url('setup/edit/' . $client_id) }}">Client Details</a></li>
	      <li class="active"><a href="#">Fee Planner</a></li>
	      @if(isset($pricing_id))
	      <li><a href="{{ url('plansummary/' . $pricing_id) }}">Plan Summary</a></li>
	      @else
	      <li><a href="#" style="color: #000000;">Plan Summary</a></li>
	      @endif
	    </ul>
	  </div><!-- /.navbar-collapse -->
	</nav>
@stop

@section('content')
	<div ng-app="PPApp">
	{{ Form::open(array('route' => $route, 'method' => 'PUT', 'class' => 'bs-example form-horizontal', 'ng-controller' => 'PPCtrl')) }}
		@if ($edit)
			{{  Form::hidden('pricing[id]', $pricing['id']) }}
		@endif	
		{{  Form::hidden('pricing[client_id]', $client_id) }}
		<div class="well">
			<legend>Business Details</legend>
			<table class="table">
				<tr>
					<td class="text-right col-legend ">
						Type of Business
					</td>
					<td class="col-extra">
					</td>
					<td class="col-val">
					{{   
						Form::select(
							'pricing[business_type_id]', $select_data['business_types'], $pricing['business_type_id'], [
							'class' => 'form-control input-sm',
							//'ng-model' 	=> 'E5', 
							//'ng-init' 	=> "E5='{$pricing['business_type_id']}'", 
						]);
					}}
					</td>
					<td class="col-total">
					</td>
				</tr>
				<tr>
					<td class="text-right col-legend ">
						Turnover
					</td>
					<td class="col-extra">
					</td>
					<td class="col-val">
					{{   
						Form::text('pricing[turnovers]', $pricing['turnovers'], array(
							'class' => 'form-control input-sm',
							'ng-model' 	=> 'E7', 
							'ng-init' 	=> "E7='{$pricing['turnovers']}'", 
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required',
						));
					}}
					</td>
					<td class="col-total">
					</td>
				</tr>
				<tr>
					<td class="text-right col-legend ">
						Type of Records
					</td>
					<td class="col-extra">
					</td>
					<td class="col-val">
					{{   
						Form::select(
							'pricing[accounting_type_id]', $select_data['record_types'], $pricing['accounting_type_id'], [
							'class' => 'form-control input-sm',
							//'ng-model' 	=> 'E7', 
							//'ng-init' 	=> "E7='{$pricing['turnover']}'", 
						]);
					}}
					</td>
					<td class="col-total">
					</td>
				</tr>
				<tr>
					<td class="text-right col-legend ">
						Quality of Records
					</td>
					<td class="col-extra">
					</td>
					<td class="col-val">
					{{   
						Form::select(
							'pricing[record_quality_id]', $select_data['record_qualities'], $pricing['record_quality_id'], [
							'class' => 'form-control input-sm',
							//'ng-model' 	=> 'E9', 
							//'ng-init' 	=> "E9='{$pricing['record_quality_id']}'", 
						]);
					}}
					</td>
					<td class="col-total">
					</td>
				</tr>
				<tr>
					<td class="text-right col-legend ">
						Audit Requirements
					</td>
					<td class="col-extra">
					</td>
					<td class="col-val">
					{{   
						Form::select(
							'pricing[audit_requirement_id]', $select_data['audit_requirements'], $pricing['audit_requirement_id'], [
							'class' => 'form-control input-sm',
							//'ng-model' 	=> 'E13', 
							//'ng-init' 	=> "E13='{$pricing['audit_requirement_id']}'", 
						]);
					}}
					</td>
					<td class="col-total">
					</td>
				</tr>
				<tr>
					<td class="text-right col-legend ">
						Audit Risk
					</td>
					<td class="col-extra">
					</td>
					<td class="col-val">
					{{   
						Form::select(
							'pricing[audit_risk_id]', $select_data['audit_risks'], $pricing['audit_risk_id'], [
							'class' => 'form-control input-sm',
							//'ng-model' 	=> 'E15', 
							//'ng-init' 	=> "E15='{$pricing['audit_risk_id']}'", 
						]);
					}}
					</td>
					<td class="col-total">
					</td>
				</tr>
			</table>
		</div>
		<div class="well">
			<legend>Tax Returns</legend>
			  <p class="help-block">Please select which tax returns you produce for the client and how many self-assessment tax returns you produce for the staff and directors annually.</p>
			  <br>
			<table class="table">
			<tr>
				<td class="text-right col-legend ">
					Corporate Tax Return
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::select('pricing[corporate_tax_return]', [1 => 'Yes', 0 => 'No'], $pricing['corporate_tax_return'], array(
						'class' => 'form-control input-sm', 
						//'ng-model' 	=> 'E18', 
						//'ng-init' 	=> "E18='{$pricing['corporate_tax_return']}'", 
					));
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend ">
					Partnership Tax Return
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::select('pricing[partnership_tax_return]', [1 => 'Yes', 0 => 'No'], $pricing['partnership_tax_return'], array(
						'class' => 'form-control input-sm', 
						//'ng-model' 	=> 'E19', 
						//'ng-init' 	=> "E19='{$pricing['partnership_tax_return']}'", 
					));
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend ">
					Self-Assessment Return
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::text('pricing[self_assessment_tax_return]',$pricing['self_assessment_tax_return'], array(
						'class' => 'form-control input-sm', 
						'ng-model' 	=> 'E20', 
						'ng-init' 	=> "E20='{$pricing['self_assessment_tax_return']}'", 
						'numbers-only'	=> 'numbers-only',
						'placeholder'	=> 'qty',
						'required'	=> 'required',
					));
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			@foreach ($tax_returns as $id => $name) 
			<tr>
				<td class="text-right col-legend ">
					{{ $name }}
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				<?php $val = isset($tax_return_pricings[$id]) ? $tax_return_pricings[$id] : ''; ?>
					{{   
						Form::text("tax_return_pricings[{$id}]", $val, array(
							'class' => 'form-control input-sm', 
							'ng-model' 	=> 'tax_returns' . $id, 
							'ng-init' 	=> "tax_returns{$id}='{$val}'", 
							'numbers-only'	=> 'numbers-only',
							'placeholder'	=> 'qty',

						));
					}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			@endforeach
			<tr>
				<td class="text-right col-legend ">
					VAT Returns
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				<small class="help-block">Scheme</small>
				{{   
					Form::select('pricing[vat_rate_type]', ['std_rate' => 'Standard', 'flat_rate' => 'Flat'], $pricing['vat_rate_type'], array(
						'class' => 'form-control input-sm', 
					));
				}}
				<small class="help-block">No. of Returns</small>
				{{   
					Form::select('pricing[vat_return]', [0 => 0, 4 => 4, 12 => 12], $pricing['vat_return'], array(
						'class' => 'form-control input-sm', 
					));
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
		</table>
		</div>
		<div class="well">
			<legend>Bookkeeping <em style="font-weight: normal; font-size: 16px;">(if we do the book keeping don't forget to adjust the quality of records)</em></legend>
			  <p class="help-block">Please enter the average hours or days spent working on bookkeeping and other financial services that don’t fall into the other categories for this client</p>
			  <br>
			<table class="table">
			<tr>
				<td class="text-right col-legend ">
					Number of Hours
				<td class="col-extra">
				</td>
				<td class="col-val">
						{{   
							Form::text('pricing[bookkeeping_hours]',$pricing['bookkeeping_hours'], array(
								'class' => 'form-control input-sm', 
								'ng-model' 	=> 'C24', 
								'ng-init' 	=> "C24='{$pricing['bookkeeping_hours']}'", 
								'numbers-only'	=> 'numbers-only',
								'placeholder' => 'hrs',
								'required'	=> 'required',
							));
							
						}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend ">
					Number of Days
				<td class="col-extra">
				</td>
				<td class="col-val">
						{{   
							Form::text('pricing[bookkeeping_days]',$pricing['bookkeeping_days'], array(
								'class' => 'form-control input-sm', 
								'ng-model' 	=> 'C25', 
								'ng-init' 	=> "C25='{$pricing['bookkeeping_days']}'", 
								'numbers-only'	=> 'numbers-only',
								'placeholder' => 'days',
								'required'	=> 'required',
							));
							
						}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			</table>
		</div>
		<div class="well">
			<legend>Payroll</legend>
			  <p class="help-block">Please select the number of employees and subcontractors that you process payroll runs for this client against the relevant periods.</p>
			  <br>

			<table class="table">
				<tr>
					<td class="text-right col-legend emphasize">
						Pay Run - Employees
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
						Number of Employees
					</td>
					<td class="col-extra">
					</td>
					<td class="col-val">
						{{   
							Form::text('pricing[no_of_employees]',$pricing['no_of_employees'], array(
								'class' => 'form-control input-sm', 
								'ng-model' 	=> 'C26', 
								'ng-init' 	=> "C26='{$pricing['no_of_employees']}'", 
								'numbers-only'	=> 'numbers-only',
								'placeholder' => 'number',
								'required'	=> 'required',
							));
							
						}}
					</td>
					<td class="col-total">
					</td>
				</tr>
				<tr>
					<td class="text-right col-legend">
						Payroll Run Frequency
					</td>
					<td class="col-extra">
					</td>
					<td class="col-val">
						{{   
							
							Form::select("pricing[employee_pay_run_frequency]", $periods, $pricing['employee_pay_run_frequency'], array(
								'class' => 'form-control input-sm', 
							));
						
						}}
					</td>
					<td class="col-total">
					</td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<td class="text-right col-legend emphasize">
						Pay Run - Subcontractors
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
						Number of Subcontractors
					</td>
					<td class="col-extra">
					</td>
					<td class="col-val">
						{{   
							Form::text('pricing[no_of_subcontractors]',$pricing['no_of_subcontractors'], array(
								'class' => 'form-control input-sm', 
								'ng-model' 	=> 'C27', 
								'ng-init' 	=> "C27='{$pricing['no_of_subcontractors']}'", 
								'numbers-only'	=> 'numbers-only',
								'placeholder'   => 'number',
								'required'	=> 'required',
							));
							
						}}
					</td>
					<td class="col-total">
					</td>
				</tr>
				<tr>
					<td class="text-right col-legend">
						Payroll Run Frequency
					</td>
					<td class="col-extra">
					</td>
					<td class="col-val">
						{{   
							
							Form::select("pricing[subcontractor_pay_run_frequency]", $periods, $pricing['subcontractor_pay_run_frequency'], array(
								'class' => 'form-control input-sm', 
							));
						
						}}
					</td>
					<td class="col-total">
					</td>
				</tr>
			</table>
		</div>
		<div class="well">
			<legend>Modules</legend>
			<p class="help-block">Please specify which modules (if any) you supply to this client</p>
			<br>
			<table class="table">
				@foreach($modules as $id => $module)
				<tr>
					<td class="text-right col-legend">
						{{ $module }}
					</td>
					<td class="col-extra">
					</td>
					<td class="col-val">
					{{   
						Form::select("module_pricings[{$id}]", [1 => 'Yes', 0 => 'No'], $module_pricings[$id], array(
							'class' => 'form-control input-sm', 
						));
					}}
					</td>
					<td class="col-total">
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		<div class="well">
			<legend>Other Services</legend>
			<p class="help-block">Please enter the quantity of other services that you supply to this client.</p>
			<br>
			<table class="table">
				@foreach($other_services as $id => $other_service)
				<tr>
					<td class="text-right col-legend">
						{{ $other_service }}
					</td>
					<td class="col-extra">
					</td>
					<td class="col-val">
					<?php $val = isset($other_service_pricings[$id]) ? $other_service_pricings[$id] : ''; ?>
					{{   
						Form::text("other_service_pricings[{$id}]", $val, array(
							'class' => 'form-control input-sm', 
							'ng-model' 	=> 'other_services' . $id, 
							'ng-init' 	=> "other_services{$id}='{$val}'", 
							'numbers-only'	=> 'numbers-only',
							'placeholder'	=> 'qty',

						));
					}}
					</td>
					<td class="col-total">
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		<div class="well">
			<legend>Discount</legend>
			<p class="help-block">Please enter an across-the-board discount (if any) against all services for this client.</p>
			<table class="table">
				<tr>
					<td class="text-right col-legend">
						Discount
					</td>
					<td class="col-extra">
					</td>
					<td class="col-val">
					{{   
						Form::text("pricing[discount]", $pricing['discount'], array(
							'class' => 'form-control input-sm', 
							'ng-model' 	=> 'discount', 
							'ng-init' 	=> "discount='{$pricing['discount']}'", 
							'numbers-only'	=> 'numbers-only',
							'placeholder'	=> 'percentage',
							'required'	=> 'required',

						));
					}}
					</td>
					<td class="col-total">
					</td>
				</tr>
			</table>
		</div>
		<div class="col-lg-12 pull-right well">
			<div class="pull-right">
				<button  class="btn btn-info btn-save" type="submit" name="save_next_page" id="save_next_page">Save & View Plan Summary</button>
				<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">Save </button>
			</div>
		</div>
	{{ Form::close() }}
    </div>
@stop
