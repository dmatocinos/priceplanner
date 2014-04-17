@section('title')
Modules & Other Services
@stop

@section('page_title')
Modules & Other Services
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
		  <legend>Modules</legend>
		  <div class="form-group">
		    <div class="col-lg-2 control-label"></div>
		    <div class="col-lg-2 text-center">Base Fee</div>
		  </div>
		  @foreach($modules as $id => $name)
		  <div class="form-group">
		    <label for="modules[{{ $id }}]" class="col-lg-2 control-label">{{ $name }}</label>
		    <div class="col-lg-2">
				<?php $val = isset($accountant_modules[$id]) ? $accountant_modules[$id] : ''; ?>
				{{ 
					Form::text("modules[{$id}]", $val, array(
						'class' => 'form-control', 
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
		  @foreach($other_services as $id => $name)
		  <div class="form-group">
		    <label for="other_service[{{ $id }}]" class="col-lg-2 control-label">{{ $name }}</label>
		    <div class="col-lg-2">
				<?php $val = isset($accountant_other_services[$id]) ? $accountant_other_services[$id] : ''; ?>
				{{ 
					Form::text("other_services[{$id}]", $val, array(
						'class' => 'form-control', 
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
				<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">Save </button>
			</div>
		</div>
	{{ Form::close() }}
	</div>
	
@stop
