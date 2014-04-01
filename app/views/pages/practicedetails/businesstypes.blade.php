@section('title')
Business Types
@stop

@section('page_title')
Business Types
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
			  <legend>Types of Business</legend>
			  <div class="form-group">
			    <div class="col-lg-2 control-label"></div>
			    <div class="col-lg-2 text-center">Base Fee</div>
			  </div>
			  @foreach($business_types as $id => $name)
			  <div class="form-group">
			    <label for="business_type[{{ $id }}]" class="col-lg-2 control-label">{{ $name }}</label>
			    <div class="col-lg-2">
					<?php $val = isset($accountant_business_types[$id]) ? $accountant_business_types[$id] : ''; ?>
					{{ 
						Form::text("business_types[{$id}]", $val, array(
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
		<div class="col-lg-12 pull-right well">
			<div class="pull-right">
				<button  class="btn btn-info btn-save" type="submit" name="save_next_page" id="save_next_page">Save & Next </button>
				<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">Save </button>
			</div>
		</div>
	{{ Form::close() }}
	</div>
	
@stop
