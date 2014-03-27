@section('title')
Plan Summary
@stop

@section('page_title')
Plan Summary
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
			<span style="margin-top: -15px; margin-left: 5px;" class="pull-right text-right"><a href="#" class="btn btn-info">Download Appendices to Pricing Modules</a></span>
			<span style="margin-top: -15px;" class="pull-right text-right"><a href="#" class="btn btn-info">Download Fixed Price Fee Quotation</a></span>
		</legend>
	</div>
	<div>
		<?php $boolean_select = ['1' => 'Yes', '0' => 'No']; ?>
		<table class="table table-striped">
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
					Turnovers
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
					{{ $calc->i13 }}
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
					{{ $calc->i15 }}
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
					{{ $pricing['corporate_tax_return'] }}
				</td>
				<td class="col-total">
					{{ $calc->i18 }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend">
					Partnership Tax Returns
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					{{ $pricing['partnership_tax_return'] }}
				</td>
				<td class="col-total">
					{{ $calc->i19 }}
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
					{{ $calc->i20 }}
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
					{{ $calc->i22 }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Book Keeping <br>
					<em style="font-weight: normal;">if we do the book keeping don't forget to adjust the quality of records</em>
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					<div>{{ $pricing['bookkeeping_hours'] . ' (hours) x  ' . $pricing['bookkeeping_hour_val'] }}</div>

					<div>{{ $pricing['bookkeeping_days'] . ' (days) x  ' . $pricing['bookkeeping_day_val'] }}</div>
				</td>
				<td class="col-total">
					<div>{{ $calc->i24 }}</div>
					<div>{{ $calc->i25 }}</div>
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
					Employee Payroll
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<?php $num = 30; ?>
			@foreach($periods as $id => $period)
			<tr>
				<td class="text-right col-legend">
					{{ $period }}
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					{{ $select_data['ranges'][$employee_period_ranges[$id]['range_id']] }}
				</td>
				<td class="col-total">
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
					Subcontractors Payroll
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<?php $num = 38; ?>
			@foreach($periods as $id => $period)
			@if ($period == 'Weekly' || $period == 'Monthly')
			<tr>
				<td class="text-right col-legend">
					{{ $period }}
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					{{ $select_data['ranges'][$sc_period_ranges[$id]['range_id']] }}
				</td>
				<td class="col-total">
				</td>
			</tr>
			@endif
			@endforeach
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
			<?php $num = 41; ?>
			@foreach($modules as $id => $module)
			<tr>
				<td class="text-right col-legend">
					{{ $module }}
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					{{ $boolean_select[$module_pricings[$id]] }}
				</td>
				<td class="col-total">
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
				</td>
				<td class="col-total">
				</td>
			</tr>
			<?php $num = 47; ?>
			@foreach($other_services as $id => $other_service)
			<tr>
				<td class="text-right col-legend">
					{{ $other_service }}
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
					{{ $other_service_pricings[$id] }}
				</td>
				<td class="col-total">
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
@stop
