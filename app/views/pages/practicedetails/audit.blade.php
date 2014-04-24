@section('title')
Audit Risks
@stop

@section('page_title')
Audit Risks
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
		  <legend>Audit Requirements</legend>
		  <div class="form-group">
		    <div class="col-lg-2 control-label"></div>
		    <div class="col-lg-2 text-center">Base Fee</div>
		  </div>
		  @foreach($audit_requirements as $id => $name)
		  <div class="form-group">
		    <label for="fee_levels[audit_requirements][{{ $id }}]" class="col-lg-2 control-label">{{ $name }}</label>
		    <div class="col-lg-2">
				<?php $val = isset($accountant_audit_requirements[$id]) ? $accountant_audit_requirements[$id] : ''; ?>
				{{ 
					Form::text("audit_requirements[{$id}]", $val, array(
						'class' => 'form-control', 
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
		    <div class="col-lg-2 text-center">Base Fee - % Increase</div>
		  </div>
		  @foreach($audit_risks as $id => $name)
		  <div class="form-group">
		    <label for="audit_risks[{{ $id }}]" class="col-lg-2 control-label">{{ $name }}</label>
		    <div class="col-lg-2">
				<?php $val = isset($accountant_audit_risks[$id]) ? $accountant_audit_risks[$id] : ''; ?>
				{{ 
					Form::text("audit_risks[{$id}]", $val, array(
						'class' => 'form-control', 
						'placeholder' => 'percentage',
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

		<div class="col-lg-12 pull-right well">
			<div class="pull-right">
				<button  class="btn btn-info btn-save" type="submit" name="save_next_page" id="save_next_page">Save & Next </button>
				<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">Save </button>
			</div>
		</div>
	{{ Form::close() }}
	</div>
	
@stop
