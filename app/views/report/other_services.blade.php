<h4>Other services available:</h4>
@foreach ($other_service_pricings as $other_service_pricing)
@if ($other_service_pricing->qty)
	<p>
		<?php 
			$val = (integer) DB::table('accountant_other_services')
				->where('accountant_id', $accountant->id)
				->where('other_service_id', $other_service_pricing->other_service_id)
				->pluck('value');
		?>
		<b>{{ $other_service_pricing->other_service->name }} - &pound;{{ $other_service_pricing->qty * $val }}</b><br>
		{{ $other_service_pricing->other_service->description }}
	</p>
@endif
@endforeach
