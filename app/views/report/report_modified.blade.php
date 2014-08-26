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
</table>
<div class="report-container">
	<p>
		<b>Client:</b> {{ $client->client_name }}
	</p>
	<p>
		<b>Period Covered:</b> {{ $client->accounting_period }}
	</p>
	<p>
		<b>Anticipated Turnover:</b> {{ NumFormatter::money($pricing->turnovers, '&pound;') }}
	</p>
	<p>
	</p>
	<p>
		<b>Fees & Service Agreement</b>
	</p>
		<p>
			This agreement between us summarises the services {{ $accountant->accountancy_name }} will carry on your behalf.
		</p>
		<p>
			<b style="font-size: 14px;">THE FIXED FEE</b>
		</p>
		<p>
			The total fees agreed will be payable by direct debit at a rate of <span class="num-val">{{ NumFormatter::money($calc->total_monthly_cost, '£') }} + VAT per month</span> 
			<br>
			For this fixed fee, the services we will provide are clearly listed in the Appendix below, but the fees will also include ad hoc telephone or email advice as necessary.
		</p>
		<p>
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
		<table class="table" style="line-height: 21.4333px">
			<tbody>
				<tr>
					<td>Net Fee</td><td class="num-val">{{ NumFormatter::money($calc->total_annual_fee, '£') }}</td>
				</tr>
				<tr>
					<td>VAT at current rates ~ 20%</td><td class="num-val">{{ NumFormatter::money($calc->total_annual_fee_tax, '£') }}</td>
				</tr>
				<tr style="background-color: #ECF0F1; color: black;">
					<td>Total Annual Professional Services stated above</td>
					<td class="num-val">{{ NumFormatter::money($calc->taxed_total_annual_fee, '£') }}</td>
				</tr>
			</tbody>
		</table>
		</br>
		<p>
			<b style="font-size: 14px;">SERVICES OUTSIDE OF THIS AGREEMENT</b>
		</p>
		<p>
			Any services required over and above those listed, will be subject to a further Fee Proposal being provided and agreed before such work is undertaken.
			<br>
		</p>
		<p><b>Guarantees and Safeguards</b></p>
		<br>
		<p>
			To make sure that our arrangement continues to be fair with both parties, we will have a contact throughout the year and, if necessary change the scope of services to be provided and the fees to be charged.
		</p>
		<p>
			In addition, either party may terminate the Agreement at any time, by giving 30 days written notice. Any services that have not been paid for at that time will then be settled in full within 7 days.
		</p>
		<p>
			The Fee Proposal is valid for 21 days. The minimum fee payable under this agreement will be an amount equal to 25% of the annual charge.
		</p>
		<p>
			If you are in agreement with the terms and proposed fees, please sign, date and return for our records.
		</p>
		<p>
			Signed: ________________________<br><br>
			Date: __________
		</p>
		<p>
			On behalh of {{ $accountant->accountancy_name }} 
		</p>
		<p>
			<?php $date = new DateTime();  ?>
			Signed: ________________________<br><br>
			Date: {{ $date->format('d-m-Y') }}
		</p>
	</div>

</div>
</div> {{-- .header --}}
