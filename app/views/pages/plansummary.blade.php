@section('title')
Plan Summary
@stop

@section('page_title')
Plan Summary
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
	      <li><a href="{{ url('setup/edit/' . $client_id) }}">Setup</a></li>
	      <li><a href="{{ url('feeplanner/edit/' . $pricing_id) }}">Fee Planner</a></li>
	      <li class="active"><a href="#">Plan Summary</a></li>
	    </ul>
	  </div><!-- /.navbar-collapse -->
	</nav>
@stop

@section('content')
	<div style="padding-top: 20px;">
		<legend>
			<span class="text-left">Plan Summary</span>
			<span style="margin-top: -15px; margin-left: 5px;" class="pull-right text-right"><a href="{{ route('appendix', array($pricing_id)) }}" class="btn btn-info">Download Appendices to Pricing Modules</a></span>
			<span style="margin-top: -15px;" class="pull-right text-right"><a href="{{ route('fixedprice', array($pricing_id)) }}" class="btn btn-info">Download Fixed Price Fee Quotation</a></span>
			<span style="margin-top: -15px;" class="pull-right text-right"><a href="{{ route('plansummary', array($pricing_id)) }}" class="btn btn-info">Download Itemised Fixed Price Fee Quotation</a>&nbsp;</span>
		</legend>
	</div>
	<div>
		<table class="table table-striped">
			<tr>
				<td class="text-right col-legend emphasize">
					
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total emphasize">
					Total Per Rate
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Type of Business
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					{{ $select_data['business_types'][$pricing['business_type_id']] }}
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
					{{ $pricing['turnovers'] }}
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
					{{ $select_data['record_types'][$pricing['accounting_type_id']] }}
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
					{{ $select_data['record_qualities'][$pricing['record_quality_id']] }}
				</td>
				<td class="col-total">
					{{ $calc->i11 }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Audit Requirements
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					{{ $select_data['audit_requirements'][$pricing['audit_requirement_id']] }}
				</td>
				<td class="col-total">
					{{ $calc->g13 }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Audit Risk
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					{{ $select_data['audit_risks'][$pricing['audit_risk_id']] }}
				</td>
				<td class="col-total">
					{{ $calc->g15 }}
				</td>
			</tr>
			<tr>
				<td colspan="4"> </td>
			</tr>
			<tr>
				<td colspan="4"> </td>
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
			<tr>
				<td class="text-right col-legend">
					Corporate Tax Returns
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					<?php $val = $pricing['corporate_tax_return'] ? 'Yes' : 'No'; ?>
					{{ $val }}
				</td>
				<td class="col-total">
					{{ $calc->g18 }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend">
					Partnership Tax Returns
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					<?php $val = $pricing['partnership_tax_return'] ? 'Yes' : 'No'; ?>
					{{ $val }}
				</td>
				<td class="col-total">
					{{ $calc->g19 }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend">
					Self-Assessment Tax Returns
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					{{ $pricing['self_assessment_tax_return'] }}
				</td>
				<td class="col-total">
					{{ $calc->g20 }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					VAT Returns
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					{{ $pricing['vat_return'] }}
				</td>
				<td class="col-total">
					{{ $calc->g22 }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Bookkeeping <br>
					<em style="font-weight: normal;">if we do the book keeping don't forget to adjust the quality of records</em>
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					<div>{{ $pricing['bookkeeping_hours'] . ' (hours)' }}</div>

					<div>{{ $pricing['bookkeeping_days'] . ' (days)' }}</div>
				</td>
				<td class="col-total">
					<div>{{ $calc->g24 }}</div>
					<div>{{ $calc->g25 }}</div>
				</td>
			</tr>
			<tr>
				<td colspan="4"> </td>
			</tr>
			<tr>
				<td colspan="4"> </td>
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
					Number of Employees/Subcontractors
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					<div>{{ $pricing['no_of_employees'] }}</div>
				</td>
				<td class="col-total">
					<div>{{ $calc->annual_base_fee_per_pay_run }}</div>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend">
					Payroll Run Frequency
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					<div>{{ $pricing['payroll_run_frequency'] }}</div>
				</td>
				<td class="col-total">
					<div>{{ $calc->annual_base_fee_per_employee_per_payroll_run }}</div>
				</td>
			</tr>
			<!--
			<tr>
				<td class="text-right col-legend">
					Total Annual Employee/Subcontractor Payroll
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					<div>{{ $calc->annual_base_fee_per_pay_run }}  + {{ $calc->annual_base_fee_per_employee_per_payroll_run }}</div>
				</td>
				<td class="col-total">
					<div>{{ $calc->total_annual_employee_payroll }}</div>
				</td>
			</tr>
			-->
			<tr>
				<td colspan="4"> </td>
			</tr>
			<tr>
				<td colspan="4"> </td>
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
			@foreach($calc->modules as $mod)
			<tr>
				<td class="text-right col-legend">
					{{ $mod->name }}
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					<?php $val = $mod->value ? 'Yes' : 'No'; ?>
					{{ $val }}
				</td>
				<td class="col-total">
					{{ $mod->value }}
				</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="4"> </td>
			</tr>
			<tr>
				<td colspan="4"> </td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Other Services
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					<em>qty</em>
				</td>
				<td class="col-total">
				</td>
			</tr>
			<?php $num = 47; ?>
			@foreach($calc->other_services as $os)
			<tr>
				<td class="text-right col-legend">
					{{ $os->name }}
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					{{ $os->qty }}
				</td>
				<td class="col-total">
					{{ $os->value }}
				</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="4"> </td>
			</tr>
			<tr>
				<td colspan="4"> </td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Annual Fee
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total emphasize">
					{{ NumFormatter::money($calc->annual_fee, '£') }}
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
				<td class="col-total emphasize">
					{{ NumFormatter::money($calc->monthly_cost, '£') }}
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
				<td class="col-total emphasize">
					{{ NumFormatter::percent($calc->discount * 100) }}
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
				<td class="col-total emphasize">
					{{ NumFormatter::money($calc->total_annual_fee, '£') }}
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
				<td class="col-total emphasize">
					{{ NumFormatter::money($calc->total_monthly_cost, '£') }}
				</td>
			</tr>
		</table>
	</div>
@stop
