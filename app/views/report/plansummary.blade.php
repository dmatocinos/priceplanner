<table style="border: 1px solid white;">
	<tr>
		@if ($accountant->logo_filename)
		<td width="200px;">
			<img style="width: 150px; height: 60px; float: left;" src="{{ asset('uploads/' . $accountant->logo_filename) }}"/>
		</td>
		<td width="680px;">
			<p style="float:right;" class="text-right"><h4>{{ $accountant->accountancy_name }}</h4></p>
		</td>
		@else
		<td width="650px;">
			<h4>{{ $accountant->accountancy_name }}</h4>
		</td>
		@endif
	</tr>
	<tr>
		<td width="650px;"></td>
	</tr>
	<tr>
		<td width="650px;">
			<div class="header text-center">Fixed Price Fee Quotation</div>
		</td>
	</tr>
</table>
	<p>
		<b>Business Name:</b> {{ $client->business_name }}
	</p>
	<p>
		<b>Proprietors/Owners:</b> {{ $client->client_name }}
	</p>
	<p>
		<b>Accounting Period:</b> {{ $client->accounting_period }}
	</p>
	<p>
		<b>Anticipated Turnover:</b> {{ NumFormatter::money($pricing->turnovers, '&pound;') }}
	</p>

<div class="">
	<div>
		<p></p>
		<p>
			To provide any misunderstanding, this Itemised Fixed Price Fee Quotation defines the services <span class="emphasize">{{ $accountant->accountancy_name }}</span> will perform for you.
			Your current service level will be <span class="num-val">{{ NumFormatter::money($calc->total_monthly_cost, '£') }} + VAT per month</span>.
			This includes:
			<ol>
				<li>All general accountancy compliance work as requested</li>
				@foreach ($calc->modules as $module)
					@if ($module->value)
						<li>{{ $module->name }} will be {{ NumFormatter::money($module->value, '£') }} + VAT per month</li>
					@endif
				@endforeach
				<li>
					Additional Services
					<ul>
					@foreach ($calc->other_services as $other_service)
						@if ($other_service->value)
							<li>{{ $other_service->name }} will be at {{ NumFormatter::money($other_service->value, '£') }} + VAT per month.</li>
						@endif
					@endforeach
					</ul>
				</li>
			</ol>
		</p>
		<table class="table" style="line-height: 20.4333px">
			<tbody>
				<tr>
					<td style="width: 80%;" class="text-left">Base Fee (*)</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->i11, '£') }}</td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">Audit</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->g15, '£') }}</td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">Corporation Tax Returns</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->g18, '£') }}</td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">Partnership Tax Returns</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->g19, '£') }}</td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">Self-Assessment Tax Returns</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->g20, '£') }}</td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">VAT Returns</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->g22, '£') }}</td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">Bookkeeping (daily rate)</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->g25, '£') }}</td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">Bookkeeping (hourly rate)</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->g24, '£') }}</td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">Employee Base Fee per Pay Run</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->annual_base_fee_per_emp_pay_run, '£') }}</td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">Base Fee per Employee per Payroll Run</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->annual_base_fee_per_emp_per_payroll_run, '£') }}</td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">Subcontractor Base Fee per Pay Run</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->annual_base_fee_per_sub_pay_run, '£') }}</td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">Base Fee per Subcontractor per Payroll Run</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->annual_base_fee_per_sub_per_payroll_run, '£') }}</td>
				</tr>
				@foreach ($calc->other_services as $other_service)
					@if ($other_service->value)
					<tr>
						<td style="width: 80%;" class="text-left">{{ $other_service->name }}</td><td style="width: 20%;" class="text-left">{{ NumFormatter::money($other_service->value, '£') }}</td>
					</tr>
					@endif
				@endforeach
				<tr>
					<td style="width: 80%;" class="text-left"></td><td style="width:20%;" class="text-left"></td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">Annual Fee</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->annual_fee, '£') }}</td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left"></td><td style="width:20%;" class="text-left"></td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">Discount</td><td style="width:20%;" class="text-left">{{ NumFormatter::percent($calc->discount * 100) }}</td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left"></td><td style="width:20%;" class="text-left"></td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">Net Fee</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->total_annual_fee, '£') }}</td>
				</tr>
				<tr>
					<td style="width: 80%;" class="text-left">VAT at current rates ~ 20%</td><td style="width:20%;" class="text-left">{{ NumFormatter::money($calc->total_annual_fee_tax, '£') }}</td>
				</tr>
				<tr style="background-color: #ECF0F1; color: black;">
					<td style="width: 80%;" class="text-left">Total Annual Professional Services stated above</td>
					<td class="num-val" style="width:20%;" class="text-left">{{ NumFormatter::money($calc->taxed_total_annual_fee, '£') }}</td>
				</tr>
			</tbody>
		</table>
		<p>*"Base Fee" is the figure from the ‘Quality of Records’ data</p>
	</div>
	<div>
		<p>In order to assist with your business cash flow, we have the following payment option available:
			<ul>
				<li>
					Option 1 – Monthly standing order: <span class="num-val">{{ NumFormatter::money($calc->taxed_total_monthly_cost, '£') }}</span>
				</li>
			</ul>
			This quotation is valid for 21 days. The minimum fee payable under this agreement will be an amount equal to 25% of the annual charge.
		</p>
	</div>
	<div>
		Guarantees and Safeguards
		<p>
			To make sure that our arrangement continues to be fair to both parties, we will meet throughout the year and, if necessary, change the scope of services to be provided and the prices to be charged in light of mutual experience.
		</p>
		<p>
			In addition, either party may terminate the Agreement at any time, for any reason, by giving 10 days written notice. Any services that have not been paid for at that time will then be settled in full within 10 days.
		</p>
		<p>
			If you are in agreement to this quotation please sign, date and return this agreement.
		</p>
		<p>
		</p>
		<p>
			Signed: ________________________<br><br>
			Date: __________
		</p>
	</div>

</div>
</div> {{-- .header --}}
