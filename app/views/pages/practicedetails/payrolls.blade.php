@section('title')
Employee & Subcontractor Payroll Tables
@stop

@section('page_title')
Employee & Subcontractor Payroll Tables
@stop

@section('app_nav')
@include('pages.practicedetails.menu')
@stop

@section('content')
	<div ng-app="PPApp">
	{{ Form::open(array('route' => $route, 'method' => 'PUT', 'class' => 'bs-example form-horizontal', 'ng-controller' => 'PPCtrl', 'files' => true)) }}
		{{  Form::hidden('accountant_id', $accountant_id) }}
		<div class="well">
		<fieldset>
		  <legend>Employee Payroll Table</legend>
			<div class="row">
				<div class="col-lg-12">
					<div class="col-lg-2 text-right"></div>
					@foreach($periods as $id => $name)
					<div class="col-lg-2 text-center">{{ $name }}</div>
					@endforeach
				</div>
			</div>
		  	@foreach($ranges as $rid => $range)
			    <div class="row">
				<div class="col-lg-12">
					<div class="col-lg-2 text-right emphasize">{{ $range }}</div>
					@foreach($periods as $pid => $name)
					<?php $val = isset($accountant_employee_period_ranges[$rid][$pid]) ? $accountant_employee_period_ranges[$rid][$pid] : '' ?>
					<div class="col-lg-2">
						{{ 
							Form::text("employee_period_ranges[$rid][{$pid}]", $val, array(
								'class' => 'form-control', 
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
					@foreach($periods as $id => $name)
					@if ($name == 'Weekly' || $name == 'Monthly')
					<div class="col-lg-2 text-center">{{ $name }}</div>
					@endif
					@endforeach
				</div>
			</div>
		  	@foreach($ranges as $rid => $range)
			    <div class="row">
				<div class="col-lg-12">
					<div class="col-lg-2 text-right emphasize">{{ $range }}</div>
					@foreach($periods as $pid => $name)
					@if ($name == 'Weekly' || $name == 'Monthly')
					<?php $val = isset($accountant_subcontractor_period_ranges[$rid][$pid]) ? $accountant_subcontractor_period_ranges[$rid][$pid] : '' ?>
					<div class="col-lg-2">
						{{ 
							Form::text("subcontractor_period_ranges[$rid][{$pid}]", $val, array(
								'class' => 'form-control', 
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
		<div class="col-lg-12 pull-right well">
			<div class="pull-right">
				<button  class="btn btn-info btn-save" type="submit" name="save_next_page" id="save_next_page">Save & Next </button>
				<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">Save </button>
			</div>
		</div>
	{{ Form::close() }}
	</div>
	
@stop
