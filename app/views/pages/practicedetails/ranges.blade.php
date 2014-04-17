@section('title')
Turnover Ranges
@stop

@section('page_title')
Turnover Ranges
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
		  <legend>Turnover Ranges</legend>
		  <div class="form-group">
		    <div class="col-lg-2 control-label"></div>
		    <div class="col-lg-2 text-center">Modifier</div>
		  </div>
		  @foreach ($turnover_ranges as $id => $name)
		  <div class="form-group">
		    <label for="turnover_ranges[{{ $id }}]" class="col-lg-2 control-label">{{ $name }}</label>
		    <div class="col-lg-2">
				<?php $val = isset($accountant_turnover_ranges[$id]) ? $accountant_turnover_ranges[$id] : ''; ?>
				{{ 
					Form::text("turnover_ranges[{$id}]", $val, array(
						'class' => 'form-control', 
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
		<div class="col-lg-12 pull-right well">
			<div class="pull-right">
				<button  class="btn btn-info btn-save" type="submit" name="save_next_page" id="save_next_page">Save & Next </button>
				<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">Save </button>
			</div>
		</div>
	{{ Form::close() }}
	</div>
	
@stop
