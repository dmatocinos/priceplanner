	<div style="">
		<legend>
			<span class="text-left">Itemised Fixed Price Fee Quotation</span>
		</legend>
	</div>
	<div>
		<table class="table table-striped">
			<tr>
				<td class="text-right col-legend emphasize" style="width: 280px;">
					Type of Business
				</td>
				<td class="col-val" style="width: 180px;">
					{{ $select_data['business_types'][$pricing['business_type_id']] }}
				</td>
				<td class="text-right col-total" style="width: 180px;">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Turnovers
				</td>
				<td class="col-val">
					{{ $pricing['turnovers'] }}
				</td>
				<td class="text-right col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Type of Records
				</td>
				<td class="col-val">
					{{ $select_data['record_types'][$pricing['accounting_type_id']] }}
				</td>
				<td class="text-right col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Quality of Records
				</td>
				<td class="col-val">
					{{ $select_data['record_qualities'][$pricing['record_quality_id']] }}
				</td>
				<td class="text-right col-total">
					{{ $calc->i11 }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Audit Requirements
				</td>
				<td class="col-val">
					{{ $select_data['audit_requirements'][$pricing['audit_requirement_id']] }}
				</td>
				<td class="text-right col-total">
					{{ $calc->g13 }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Audit Risk
				</td>
				<td class="col-val">
					{{ $select_data['audit_risks'][$pricing['audit_risk_id']] }}
				</td>
				<td class="text-right col-total">
					{{ $calc->g15 }}
				</td>
			</tr>
			<tr>
				<td colspan="3"> </td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Tax Returns
				</td>
				<td class="col-val">
				</td>
				<td class="text-right col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend">
					Corporate Tax Returns
				</td>
				<td class="col-val">
					<?php $val = $pricing['corporate_tax_return'] ? 'Yes' : 'No'; ?>
					{{ $val }}
				</td>
				<td class="text-right col-total">
					{{ $calc->g18 }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend">
					Partnership Tax Returns
				</td>
				<td class="col-val">
					<?php $val = $pricing['partnership_tax_return'] ? 'Yes' : 'No'; ?>
					{{ $val }}
				</td>
				<td class="text-right col-total">
					{{ $calc->g19 }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend">
					Self-Assessment Tax Returns
				</td>
				<td class="col-val">
					{{ $pricing['self_assessment_tax_return'] }}
				</td>
				<td class="text-right col-total">
					{{ $calc->g20 }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					VAT Returns
				</td>
				<td class="col-val">
					{{ $pricing['vat_return'] }}
				</td>
				<td class="text-right col-total">
					{{ $calc->g22 }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Book Keeping <br>
					<em style="font-weight: normal;">if we do the book keeping don't forget to adjust the quality of records</em>
				</td>
				<td class="col-val">
					<div>{{ $pricing['bookkeeping_hours'] . ' (hours)' }}</div>

					<div>{{ $pricing['bookkeeping_days'] . ' (days)' }}</div>
				</td>
				<td class="text-right col-total">
					<div>{{ $calc->g24 }}</div>
					<div>{{ $calc->g25 }}</div>
				</td>
			</tr>
			<tr>
				<td colspan="3"> </td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Employee Payroll
				</td>
				<td class="col-val">
					<em>no. of employees</em>
				</td>
				<td class="text-right col-total">
				</td>
			</tr>
			@foreach($calc->employee_payroll as $ep)
			<tr>
				<td class="text-right col-legend">
					{{ $ep->name }}
				</td>
				<td class="col-val">
					{{ $ep->range }}
				</td>
				<td class="text-right col-total">
					{{ $ep->value }}
				</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="3"> </td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Subcontractors Payroll
				</td>
				<td class="col-val">
					<em>no. of employees</em>
				</td>
				<td class="text-right col-total">
				</td>
			</tr>
			@foreach($calc->sc_payroll as $sp)
			<tr>
				<td class="text-right col-legend">
					{{ $sp->name }}
				</td>
				<td class="col-val">
					{{ $sp->range }}
				</td>
				<td class="text-right col-total">
					{{ $sp->value }}
				</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="3"> </td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Modules
				</td>
				<td class="col-val">
				</td>
				<td class="text-right col-total">
				</td>
			</tr>
			@foreach($calc->modules as $mod)
			<tr>
				<td class="text-right col-legend">
					{{ $mod->name }}
				</td>
				<td class="col-val">
					<?php $val = $mod->value ? 'Yes' : 'No'; ?>
					{{ $val }}
				</td>
				<td class="text-right col-total">
					{{ $mod->value }}
				</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="3"> </td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Other Services
				</td>
				<td class="col-val">
					<em>qty</em>
				</td>
				<td class="text-right col-total">
				</td>
			</tr>
			<?php $num = 47; ?>
			@foreach($calc->other_services as $os)
			<tr>
				<td class="text-right col-legend">
					{{ $os->name }}
				</td>
				<td class="col-val">
					{{ $os->qty }}
				</td>
				<td class="text-right col-total">
					{{ $os->value }}
				</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="3"> </td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Annual Fee
				</td>
				<td class="col-val">
				</td>
				<td class="text-right col-total emphasize">
					{{ NumFormatter::money($calc->annual_fee, '£') }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Monthly Cost
				</td>
				<td class="col-val">
				</td>
				<td class="text-right col-total emphasize">
					{{ NumFormatter::money($calc->monthly_cost, '£') }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Discount
				</td>
				<td class="col-val">
				</td>
				<td class="text-right col-total emphasize">
					{{ NumFormatter::percent($calc->discount * 100) }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Total Annual Fee
				</td>
				<td class="col-val">
				</td>
				<td class="text-right col-total emphasize">
					{{ NumFormatter::money($calc->total_annual_fee, '£') }}
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Total Monthly Cost
				</td>
				<td class="col-val">
				</td>
				<td class="text-right col-total emphasize">
					{{ NumFormatter::money($calc->total_monthly_cost, '£') }}
				</td>
			</tr>
		</table>
	</div>
