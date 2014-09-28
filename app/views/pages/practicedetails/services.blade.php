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
		  <p class="help-block">Please enter the base price you charge clients for modular services.</p>
		  <br>
			
		  <div class="form-group">
		    <div class="col-lg-3 control-label"></div>
		    <div class="col-lg-2 text-center">Base Fee</div>
		  </div>
		  @foreach($modules as $id => $name)
		  <div class="form-group">
		    <label for="modules[{{ $id }}]" class="col-lg-3 control-label">{{ $name }}</label>
		    <div class="col-lg-2">
				<?php $val = isset($accountant_modules[$id]) ? $accountant_modules[$id] : $defaults['modules'][$name]; ?>
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
		  <p class="help-block">Please enter the base price you charger clients for any other services. You can add your own bespoke services at the bottom of the list.</p>
		  <br>
		  <div class="form-group">
		    <div class="col-lg-3 control-label"></div>
		    <div class="col-lg-2 text-center">Base Fee</div>
		  </div>
		  @foreach($other_services as $id => $name)
		  <div class="form-group">
		    @if (isset($other_services_extra[$id]))
		    	<div class="col-lg-3">
			{{ 
				Form::text("other_services[{$id}][name]", $other_services_extra[$id], array(
					'class' => 'form-control', 
					'placeholder' => 'Service Name',
					'ng-model' 	=> 'other_services_name' . $id, 
					'ng-init' 	=> "other_services_name{$id}='{$other_services_extra[$id]}'", 
					
				)) 
			}}
			</div>
		    @else 
		    	<label for="other_service[{{ $id }}]" class="col-lg-3 control-label">{{ $name }}</label>
			{{ 
				Form::hidden("other_services[{$id}][name]", $name, array(
					'class' => 'form-control', 
				)) 
			}}
		    @endif	
		    <div class="col-lg-2">
				<?php $val = isset($accountant_other_services[$id]) ? $accountant_other_services[$id] : $defaults['other_services'][$name]; ?>

				{{ 
					Form::text("other_services[{$id}][value]", $val, array(
						'class' => 'form-control', 
						'placeholder' => 'amount',
						'numbers-only'	=> 'numbers-only',
						'ng-model' 	=> 'other_services' . $id, 
						'ng-init' 	=> "other_services{$id}='{$val}'", 
					)) 
				}}
		    </div>
		  </div>
		  @endforeach
		  @foreach(range(1,10) as $num)
		  <div class="form-group">
		    <div class="col-lg-3">
				{{ 
					Form::text("other_services_extra[{$num}][name]", '', array(
						'class' => 'form-control', 
						'placeholder' => 'Service Name',
						'ng-model' 	=> 'other_services_extra_name' . $num, 
						'ng-init' 	=> "other_services_extra_name{$num}=''", 
						
					)) 
				}}
		    </div>
		    <div class="col-lg-2">
				{{ 
					Form::text("other_services_extra[{$num}][value]", '', array(
						'class' => 'form-control', 
						'placeholder' => 'amount',
						'numbers-only'	=> 'numbers-only',
						'ng-model' 	=> 'other_services_extra_val' . $num, 
						'ng-init' 	=> "other_services_extra_val{$num}=''", 
						'numbers-only'	=> 'numbers-only',
						
					)) 
				}}
		    </div>
		  </div>
		  @endforeach
		</fieldset>
		</div>
		<div class="col-lg-12 pull-right well">
			<div class="pull-left">
				<a class="btn btn-primary btn-reset" id="reset" href="{{ route('practicedetails.services.reset', [$accountant_id]) }}">Reset</a>
			</div>
			<div class="pull-right">
				<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">Save </button>
			</div>
		</div>
	{{ Form::close() }}
	</div>
	
@stop
