@section('content')
<div style="">
	<div class="panel-heading" style="margin-top: 10px;">
		<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> My Clients</h3>
	 </div>
	 <div class="panel-body">
		<div class="clients-list-div">
			<table id="clients-list" style="float: left; width: 100%; display: none;">
				<thead>
					<tr>
						<th>Client</th>
						<th>Business Name</th>
						<th>Date Created</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($clients as $item)
						<tr style="">
							<td>{{ $item->client_name . ':::' . url('setup/edit/' . $item->id) }}</td>
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
