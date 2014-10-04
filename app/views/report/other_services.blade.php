<?php $i = 0; ?>
@foreach ($other_service_pricings as $other_service_pricing)
@if ($other_service_pricing->qty)
	@if($i == 0) <h4>Other services available:</h4>@endif 
	<p>
		<?php 
			$val = (integer) DB::table('accountant_other_services')
				->where('accountant_id', $accountant->id)
				->where('other_service_id', $other_service_pricing->other_service_id)
				->pluck('value');
		?>
		<b>{{ $other_service_pricing->other_service->name }} - {{ NumFormatter::money(($other_service_pricing->qty * $val), '&pound;') }}</b><br>
		{{ $other_service_pricing->other_service->description }}
	</p>
	<?php $i++; ?>
@endif
@endforeach
