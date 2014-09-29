@section('page_title')
Clients
@stop

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
						<th width="300">Date Created</th>
						<th width="100"><span style="padding-right: 10px">Delete</span></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($clients as $item)
						<tr style="">
							<td>{{ $item->client_name . ':::' . url('setup/edit/' . $item->id) }}</td>
							<td>{{ $item->business_name }}</td>
							<td>{{ $item->created_at }}</td>
							<td style="text-align: right; padding-right: 25px"><a href="{{ url('delete_client', array($item->id)) }}" class="delete-client-btn btn btn-danger btn-sm"><i class="fa fa-times"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
