@section('Title')
'Subscription
@stop

@section('client')
@stop

@section('content')
	<legend><h3>You are required to pay to continue.</a></h3></legend>
	<div class="form-group">
	  <!-- <a class="pull-right" href="#">Forgot password?</a> -->
	  <label>{{ $msg }} </label>
	</div>
@foreach ($discounted as $period => $text)
	<a href="{{ url('start_payment', array($period)) }}" class="btn btn-primary btn-lg btn-block">Pay {{ $text }}</a>
@endforeach
	<a href="{{ url('logout') }}" class="btn btn-default btn-block">Logout</a>
@stop
