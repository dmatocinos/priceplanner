@section('title')
Setup
@stop

@section('page_title')
Setup
@stop


@section('client')
@if($client_id)
    <li>
	<a href="#"><i class="fa fa-male fa-fw"></i>{{ $client['client_name'] }}</a>
    </li>
@endif
@stop

@section('app_nav')
	<nav id="app-nav" class="navbar navbar-default" role="navigation">
	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="#">Setup</a></li>
	      @if($edit == true)
			  @if($pricing_id)
			  <li class=""><a href="{{ url('feeplanner/edit/' . $pricing_id) }}">Fee Planner</a></li>
			  @else
			  <li class=""><a href="{{ url('feeplanner/' . $client_id) }}">Fee Planner</a></li>
			  @endif
		  @else
	      <li class=""><a href="#" style="color: #000000;">Fee Planner</a></li>
	      @endif
		  @if(isset($pricing_id))
	      <li><a href="{{ url('plansummary/' . $pricing_id) }}">Plan Summary</a></li>
	      @else
	      <li><a href="#" style="color: #000000;">Plan Summary</a></li>
	      @endif
	    </ul>
	  </div><!-- /.navbar-collapse -->
	</nav>
@stop

@section('content')
	{{ Form::open(array('route' => $route, 'method' => 'PUT', 'class' => 'bs-example form-horizontal', 'ng-controller' => 'PPCtrl', 'files' => true)) }}
		@if ($edit)
			{{  Form::hidden('client[id]', $client['id']) }}
			{{  Form::hidden('client[accountant_id]', $client['accountant_id']) }}
			{{  Form::hidden('accountant[id]', $accountant['id']) }}
		@endif	
	<div class="well">
		<fieldset>
		  <legend>Client Information</legend>
		  <div class="form-group">
		    <label for="client[business_name]" class="col-lg-2 control-label">Business Name</label>
		    <div class="col-lg-4">
				{{ 
					Form::text('client[business_name]', isset($client['business_name']) ? $client['business_name'] : '', array(
						'class' => 'form-control', 
						'required' => 'required'
					)) 
				}}
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="" class="col-lg-2 control-label">Client Name</label>
		    <div class="col-lg-4">
				{{ 
					Form::text('client[client_name]', isset($client['client_name']) ? $client['client_name'] : '', array(
						'class' => 'form-control', 
						'required' => 'required',
					)) 
				}}
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="period_start_date" class="col-lg-2 control-label">Accounting Period</label>
		    <div class="col-lg-5">
			<div class="row">
			<span class="col-sm-5">
				{{ 
					Form::text('client[period_start_date]', isset($client['period_start_date']) ? $client['period_start_date'] : '', array(
						'class' => 'form-control', 
						'id' => 'period_start_date',
						'required' => 'required',
						'placeholder' => 'Period Start'
					)) 
				}}
			</span>
			<span class="col-md-1">
				<b>&nbsp;_</b>
			</span>
			<span class="col-sm-5">
				{{ 
					Form::text('client[period_end_date]', isset($client['period_end_date']) ? $client['period_end_date'] : '', array(
						'class' => 'form-control', 
						'id' => 'period_end_date',
						'required' => 'required',
						'placeholder' => 'Period End'
					)) 
				}}
			</span>
		       </div>
		    </div>
		  </div>
		  <legend><h4>Address</h4></legend>
			  <div class="form-group">
			    <label for="client[street_address]" class="col-lg-2 control-label">Street Address</label>
			    <div class="col-lg-4">
					{{ 
						Form::text('client[street_address]', isset($client['street_address']) ? $client['street_address'] : '', array(
							'class' => 'form-control', 
							'required' => 'required'
						)) 
					}}
			    </div>
			  </div>
			   <div class="form-group">
			    <label for="client[city_address]" class="col-lg-2 control-label">City</label>
			    <div class="col-lg-4">
					{{ 
						Form::text('client[city_address]', isset($client['city_address']) ? $client['city_address'] : '', array(
							'class' => 'form-control', 
							'required' => 'required'
						)) 
					}}
			    </div>
			  </div>
			   <div class="form-group">
			    <label for="client[state_address]" class="col-lg-2 control-label">State</label>
			    <div class="col-lg-4">
					{{ 
						Form::text('client[state_address]', isset($client['state_address']) ? $client['state_address'] : '', array(
							'class' => 'form-control'
						)) 
					}}
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="client[country_address]" class="col-lg-2 control-label">Country</label>
			    <div class="col-lg-4">
					{{   
						Form::select(
							'client[country_address]', $countries, isset($client['country_address']) ? $client['country_address'] : '', [
							'class' => 'form-control',
						]);
					}}
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="client[zip_address]" class="col-lg-2 control-label">Zip Code</label>
			    <div class="col-lg-4">
					{{ 
						Form::text('client[zip_address]', isset($client['zip_address']) ? $client['zip_address'] : '', array(
							'class' => 'form-control', 
							'numbers-only'	=> 'numbers-only',
							'ng-model' 	=> 'zip_address',
							'ng-init' 	=> "zip_address='" . (isset($client['zip_address']) ? $client['zip_address'] : '') . "'", 
						)) 
					}}
			    </div>
			  </div>
		</fieldset>
	</div>
	<div class="col-lg-12 pull-right well">
		<div class="pull-right">
			<button  class="btn btn-info btn-save" type="submit" name="save_next_page" id="save_next_page">Save & Next </button>
			<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">Save </button>
		</div>
	</div>
	{{ Form::close() }}
	
@stop
