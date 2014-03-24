@section('title')
Setup
@stop

@section('page_title')
Setup
@stop

@section('app_nav')
	<nav id="app-nav" class="navbar navbar-default" role="navigation">
	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="#">Setup</a></li>
	      @if ($edit)
	      <li class=""><a href="{{ url('feeplanner/' . $client['id']) }}">Fee Planner</a></li>
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
		    <label for="" class="col-lg-2 control-label">Person Name</label>
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
		    <label for="client[address]" class="col-lg-2 control-label">Address</label>
		    <div class="col-lg-4">
				{{ 
					Form::text('client[address]', isset($client['address']) ? $client['address'] : '', array(
						'class' => 'form-control', 
						'required' => 'required'
					)) 
				}}
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="period_start_date" class="col-lg-2 control-label">Accounting Period</label>
		    <div class="col-lg-5">
			<div class="row">
			<span class="col-sm-3">
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
			<span class="col-sm-3">
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
		</fieldset>
	</div>
	<div class="well">
		<fieldset>
		  <legend>Accountancy Details</legend>
		  <div class="form-group">
		    <label for="accountant[accountancy_name]" class="col-lg-2 control-label">Accountancy Name	</label>
		    <div class="col-lg-4">
				{{ 
					Form::text('accountant[accountancy_name]', isset($accountant['accountancy_name']) ? $accountant['accountancy_name'] : '', array(
						'class' => 'form-control', 
						'required' => 'required'
					)) 
				}}
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="" class="col-lg-2 control-label">Person Name</label>
		    <div class="col-lg-4">
				{{ 
					Form::text('accountant[accountant_name]', isset($accountant['accountant_name']) ? $accountant['accountant_name'] : '', array(
						'class' => 'form-control', 
						'required' => 'required',
					)) 
				}}
		    </div>
		  </div>	
		  <div class="form-group">
		    <label for="accountant[address]" class="col-lg-2 control-label">Address</label>
		    <div class="col-lg-4">
				{{ 
					Form::text('accountant[address]', isset($accountant['address']) ? $accountant['address'] : '', array(
						'class' => 'form-control', 
						'required' => 'required'
					)) 
				}}
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="accountant[logo_filename]" class="col-lg-2 control-label">Logo (optional)</label>
		    <div class="col-lg-4">
				{{ 
					Form::file('accountant[logo_filename]');
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