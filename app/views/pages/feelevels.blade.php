@section('title')
Fee Levels
@stop

@section('page_title')
Fee Levels
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
	      <li class=""><a href="{{ url('setup/edit/' . $client_id) }}">Client Details</a></li>
	      <li class="active"><a href="{{ url('feelevels/' . $client_id) }}">Fee Levels</a></li>
	      @if(isset($pricing_id))
	      <li class=""><a href="{{ url('feeplanner/edit/' . $pricing_id) }}">Fee Planner</a></li>
	      <li><a href="{{ url('plansummary/' . $pricing_id) }}">Plan Summary</a></li>
	      @elseif ($edit && $has_fee_levels)
	      <li class=""><a href="{{ url('feeplanner/' . $client_id) }}">Fee Planner</a></li>
	      @endif
	    </ul>
	  </div><!-- /.navbar-collapse -->
	</nav>
@stop

@section('content')
	<div ng-app="PPApp">
	{{ Form::open(array('route' => $route, 'method' => 'PUT', 'class' => 'bs-example form-horizontal', 'ng-controller' => 'PPCtrl', 'files' => true)) }}
	{{  Form::hidden('client_id', $client['id']) }}
	{{  Form::hidden('accountant_id', $client['accountant_id']) }}
	@if ($edit)
	@endif	
	<legend>Fee Levels</legend>
	<div class="well">
		<fieldset>
		  <legend>Types of Business</legend>
		  <div class="form-group">
		    <div class="col-lg-2 control-label"></div>
		    <div class="col-lg-2 text-center">Base Fee</div>
		  </div>
		  @foreach($fee_levels['business_types'] as $id => $name)
		  <div class="form-group">
		    <label for="fee_levels[business_type][{{ $id }}]" class="col-lg-2 control-label">{{ $name }}</label>
		    <div class="col-lg-2">
				<?php $val = isset($client['business_types'][$id]) ? $client['business_types'][$id] : ''; ?>
				{{ 
					Form::text("fee_levels[business_types][{$id}]", $val, array(
						'class' => 'form-control', 
						'required' => 'required',
						'placeholder' => 'amount',
						'ng-model' 	=> 'business_type' . $id, 
						'ng-init' 	=> "business_type{$id}='{$val}'", 
						'numbers-only'	=> 'numbers-only',
					)) 
				}}
		    </div>
		  </div>
		  @endforeach
		</fieldset>
	</div>
	<div class="well">
		<fieldset>
		  <legend>Turnover Ranges</legend>
		  <div class="form-group">
		    <div class="col-lg-2 control-label"></div>
		    <div class="col-lg-2 text-center">Modifier</div>
		  </div>
		  @foreach($fee_levels['turnover_ranges'] as $id => $name)
		  <div class="form-group">
		    <label for="fee_levels[turnover_ranges][{{ $id }}]" class="col-lg-2 control-label">{{ $name }}</label>
		    <div class="col-lg-2">
				<?php $val = isset($client['turnover_ranges'][$id]) ? $client['turnover_ranges'][$id] : ''; ?>
				{{ 
					Form::text("fee_levels[turnover_ranges][{$id}]", isset($client['turnover_ranges'][$id]) ? $client['turnover_ranges'][$id] : '', array(
						'class' => 'form-control', 
						'required' => 'required',
						'placeholder' => 'percentage',
						'ng-model' 	=> 'turnover_range' . $id, 
						'ng-init' 	=> "turnover_range{$id}='{$val}'", 
						'numbers-only'	=> 'numbers-only',
					)) 
				}}
		    </div>
		  </div>
		  @endforeach
		</fieldset>
	</div>
	<div class="well">
		<fieldset>
		  <legend>Accounting System Qualities</legend>
		  <div class="row">
			<div class="col-lg-6">
			  <div class="form-group">
			    <div class="col-lg-4 control-label"></div>
			    <div class="col-lg-4 text-center">Manual</div>
			    <div class="col-lg-4 text-center">Computerised</div>
			  </div>
			  @foreach($fee_levels['record_qualities'] as $id => $name)
			  <div class="form-group">
		    	    <label class="col-lg-4 control-label">{{ $name }}</label>
			  @foreach([1,2] as $ac_id)
			    <?php $val = isset($client['record_qualities'][$ac_id][$id]) ? $client['record_qualities'][$ac_id][$id] : '' ?>
			    <div class="col-lg-4">
					{{ 
						Form::text("fee_levels[record_qualities][$ac_id][{$id}]", $val, array(
							'class' => 'form-control', 
							'required' => 'required',
							'placeholder' => 'percentage',
							'ng-model' 	=> "record_quality_{$ac_id}_{$id}", 
							'ng-init' 	=> "record_quality_{$ac_id}_{$id}='{$val}'", 
							'numbers-only'	=> 'numbers-only',
						)) 
					}}
			    </div>
			  @endforeach
			  </div>
			  @endforeach
		  	</div>
		  </div>
		</fieldset>
	</div>
	<div class="well">
		<fieldset>
		  <legend>Audit Requirements</legend>
		  <div class="form-group">
		    <div class="col-lg-2 control-label"></div>
		    <div class="col-lg-2 text-center">Base Fee</div>
		  </div>
		  @foreach($fee_levels['audit_requirements'] as $id => $name)
		  <div class="form-group">
		    <label for="fee_levels[audit_requirements][{{ $id }}]" class="col-lg-2 control-label">{{ $name }}</label>
		    <div class="col-lg-2">
				<?php $val = isset($client['audit_requirements'][$id]) ? $client['audit_requirements'][$id] : ''; ?>
				{{ 
					Form::text("fee_levels[audit_requirements][{$id}]", $val, array(
						'class' => 'form-control', 
						'required' => 'required',
						'placeholder' => 'amount',
						'ng-model' 	=> 'audit_requirement' . $id, 
						'ng-init' 	=> "audit_requirement{$id}='{$val}'", 
						'numbers-only'	=> 'numbers-only',
					)) 
				}}
		    </div>
		  </div>
		  @endforeach
		</fieldset>
	</div>
	<div class="well">
		<fieldset>
		  <legend>Audit Risks</legend>
		  <div class="form-group">
		    <div class="col-lg-2 control-label"></div>
		    <div class="col-lg-2 text-center">Percentage</div>
		  </div>
		  @foreach($fee_levels['audit_risks'] as $id => $name)
		  <div class="form-group">
		    <label for="fee_levels[audit_risks][{{ $id }}]" class="col-lg-2 control-label">{{ $name }}</label>
		    <div class="col-lg-2">
				<?php $val = isset($client['audit_risks'][$id]) ? $client['audit_risks'][$id] : ''; ?>
				{{ 
					Form::text("fee_levels[audit_risks][{$id}]", $val, array(
						'class' => 'form-control', 
						'required' => 'required',
						'placeholder' => 'amount',
						'ng-model' 	=> 'audit_risk' . $id, 
						'ng-init' 	=> "audit_risk{$id}='{$val}'", 
						'numbers-only'	=> 'numbers-only',
					)) 
				}}
		    </div>
		  </div>
		  @endforeach
		</fieldset>
	</div>
	<div class="well">
		<fieldset>
		  <legend>Tax Returns</legend>
		  <div class="form-group">
		    <div class="col-lg-2 control-label"></div>
		    <div class="col-lg-2 text-center">Base Fee</div>
		  </div>
		  @foreach($fee_levels['tax_returns'] as $id => $name)
		  <div class="form-group">
		    <label for="fee_levels[tax_returns][{{ $id }}]" class="col-lg-2 control-label">{{ $name }}</label>
		    <div class="col-lg-2">
				<?php $val = isset($client['tax_returns'][$id]) ? $client['tax_returns'][$id] : ''; ?>
				{{ 
					Form::text("fee_levels[tax_returns][{$id}]", $val, array(
						'class' => 'form-control', 
						'required' => 'required',
						'placeholder' => 'amount',
						'ng-model' 	=> 'tax_returns' . $id, 
						'ng-init' 	=> "tax_returns{$id}='{$val}'", 
						'numbers-only'	=> 'numbers-only',
					)) 
				}}
		    </div>
		  </div>
		  @endforeach
		</fieldset>
	</div>
	<div class="well">
		<fieldset>
		  <legend>VAT Returns</legend>
		  <div class="form-group">
		    <label for="fee_levels[vat_returns]" class="col-lg-2 control-label">Per Return</label>
		    <div class="col-lg-2">
				<?php $val = isset($client['vat_returns']) ? $client['vat_returns'] : ''; ?>
				{{ 
					Form::text("fee_levels[vat_returns]", $val, array(
						'class' => 'form-control', 
						'required' => 'required',
						'placeholder' => 'amount',
						'ng-model' 	=> 'vat_returns', 
						'ng-init' 	=> "vat_returns='{$val}'", 
						'numbers-only'	=> 'numbers-only',
					)) 
				}}
		    </div>
		  </div>
		</fieldset>
	</div>
	<div class="well">
		<fieldset>
		  <legend>Employee Payroll Table</legend>
			<div class="row">
				<div class="col-lg-12">
					<div class="col-lg-2 text-right"></div>
					@foreach($fee_levels['periods'] as $id => $name)
					<div class="col-lg-2 text-center">{{ $name }}</div>
					@endforeach
				</div>
			</div>
		  	@foreach($fee_levels['ranges'] as $rid => $range)
			    <div class="row">
				<div class="col-lg-12">
					<div class="col-lg-2 text-right emphasize">{{ $range }}</div>
					@foreach($fee_levels['periods'] as $pid => $name)
					<?php $val = isset($client['employee_period_ranges'][$rid][$pid]) ? $client['employee_period_ranges'][$rid][$pid] : '' ?>
					<div class="col-lg-2">
						{{ 
							Form::text("fee_levels[employee_period_ranges][$rid][{$pid}]", $val, array(
								'class' => 'form-control', 
								'required' => 'required',
								'placeholder' => 'amount',
								'ng-model' 	=> 'epr_' . $rid . '_' . $pid, 
								'ng-init' 	=> "epr_{$rid}_{$pid}='{$val}'", 
								'numbers-only'	=> 'numbers-only',
							)) 
						}}
					</div>
					@endforeach
				</div>
			    </div>
		  	@endforeach
		</fieldset>
	</div>
	<div class="well">
		<fieldset>
		  <legend>Subcontractor Payroll Table</legend>
			<div class="row">
				<div class="col-lg-12">
					<div class="col-lg-2 text-right"></div>
					@foreach($fee_levels['periods'] as $id => $name)
					@if ($name == 'Weekly' || $name == 'Monthly')
					<div class="col-lg-2 text-center">{{ $name }}</div>
					@endif
					@endforeach
				</div>
			</div>
		  	@foreach($fee_levels['ranges'] as $rid => $range)
			    <div class="row">
				<div class="col-lg-12">
					<div class="col-lg-2 text-right emphasize">{{ $range }}</div>
					@foreach($fee_levels['periods'] as $pid => $name)
					@if ($name == 'Weekly' || $name == 'Monthly')
					<?php $val = isset($client['subcontractor_period_ranges'][$rid][$pid]) ? $client['subcontractor_period_ranges'][$rid][$pid] : '' ?>
					<div class="col-lg-2">
						{{ 
							Form::text("fee_levels[subcontractor_period_ranges][$rid][{$pid}]", $val, array(
								'class' => 'form-control', 
								'required' => 'required',
								'placeholder' => 'amount',
								'ng-model' 	=> 'spr_' . $rid . '_' . $pid, 
								'ng-init' 	=> "spr_{$rid}_{$pid}='{$val}'", 
								'numbers-only'	=> 'numbers-only',
							)) 
						}}
					</div>
					@endif
					@endforeach
				</div>
			    </div>
		  	@endforeach
		</fieldset>
	</div>
	<div class="well">
		<fieldset>
		  <legend>Modules</legend>
		  <div class="form-group">
		    <div class="col-lg-2 control-label"></div>
		    <div class="col-lg-2 text-center">Base Fee</div>
		  </div>
		  @foreach($fee_levels['modules'] as $id => $name)
		  <div class="form-group">
		    <label for="fee_levels[modules][{{ $id }}]" class="col-lg-2 control-label">{{ $name }}</label>
		    <div class="col-lg-2">
				<?php $val = isset($client['modules'][$id]) ? $client['modules'][$id] : ''; ?>
				{{ 
					Form::text("fee_levels[modules][{$id}]", $val, array(
						'class' => 'form-control', 
						'required' => 'required',
						'placeholder' => 'amount',
						'numbers-only'	=> 'numbers-only',
						'ng-model' 	=> 'modules' . $id, 
						'ng-init' 	=> "modules{$id}='{$val}'", 
						'numbers-only'	=> 'numbers-only',
						
					)) 
				}}
		    </div>
		  </div>
		  @endforeach
		</fieldset>
	</div>
	<div class="well">
		<fieldset>
		  <legend>Other Services</legend>
		  <div class="form-group">
		    <div class="col-lg-2 control-label"></div>
		    <div class="col-lg-2 text-center">Base Fee</div>
		  </div>
		  @foreach($fee_levels['other_services'] as $id => $name)
		  <div class="form-group">
		    <label for="fee_levels[other_services][{{ $id }}]" class="col-lg-2 control-label">{{ $name }}</label>
		    <div class="col-lg-2">
				<?php $val = isset($client['other_services'][$id]) ? $client['other_services'][$id] : ''; ?>
				{{ 
					Form::text("fee_levels[other_services][{$id}]", $val, array(
						'class' => 'form-control', 
						'required' => 'required',
						'placeholder' => 'amount',
						'numbers-only'	=> 'numbers-only',
						'ng-model' 	=> 'other_services' . $id, 
						'ng-init' 	=> "other_services{$id}='{$val}'", 
						'numbers-only'	=> 'numbers-only',
						
					)) 
				}}
		    </div>
		  </div>
		  @endforeach
		</fieldset>
	</div>
	<div class="col-lg-12 pull-right well">
		<div class="pull-right">
			<button  class="btn btn-info btn-save" type="submit" name="save_next_page" id="save_next_page">Save & Next </button>
			<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">Save </button>
		</div>
	</div>
	{{ Form::close() }}
	</div>
	
@stop
