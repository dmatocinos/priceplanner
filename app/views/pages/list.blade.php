@section('content')
<div style="">
	<div class="panel-heading" style="margin-top: 10px;">
		<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> My Price Plans</h3>
	 </div>
	 <div class="panel-body">
		<div class="pricings-list-div">
			<table id="pricings-list" style="float: left; width: 100%; display: none;">
				<thead>
					<tr>
						<th>Client</th>
						<th>Business Name</th>
						<th>Date Created</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($pricings as $item)
						<tr style="">
							<td>{{ $item->first_name . ' ' . $item->last_name . ':::' . url('/edit/' . $item->id) }}</td>
							<td>{{ $item->business_name }}</td>
							<td>{{ $item->created_at }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
