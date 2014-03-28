<h4>Other services available:</h4>
@foreach ($other_service_pricings as $other_service_pricing)
@if ($other_service_pricing->qty)
	<p>
		<b>{{ $other_service_pricing->other_service->name }} - &pound;{{ $other_service_pricing->other_service->value }}</b><br>
		{{ $other_service_pricing->other_service->description }}
	</p>
@endif
@endforeach
