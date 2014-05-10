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
		  <p class="help-block">Please enter the percentage increase over base fee that you charge clients based on their turnover.</p>
		  <br>
		  <div class="form-group">
			<div class="col-md-8">
			    <div class="col-lg-3 text-center">From - Rate</div>
			    <div class="col-lg-3 text-center">To - Rate</div>
			    <div class="col-lg-3 text-center">Modifier - % Increase</div>
			</div>
		  </div>
		  @foreach (range(1,15) as $num)
		  <?php 
			if ( isset($turnover_ranges[$num]) && is_array($turnover_ranges[$num]) && ! is_null($turnover_ranges[$num])) {
				$id = key($turnover_ranges[$num]);
			}
			else {
				$id = $num;
			}
			
		  ?>
		  <div class="form-group">
		    <div class="col-md-8">
			    <div class="col-lg-3">
				<?php $lower = isset($turnover_ranges[$num][$id]['lower']) ? $turnover_ranges[$num][$id]['lower'] : ''; ?>
					{{ 
						Form::text("turnover_ranges[{$id}][lower]", $lower, array(
							'class' => 'form-control', 
							'placeholder'  => 'amount',
							'ng-model'     => 'turnover_range_lower' . $id, 
							'ng-init'      => "turnover_range_lower{$id}='{$lower}'", 
							'numbers-only' => 'numbers-only',
						)) 
					}}
			    </div>
			    <div class="col-lg-3">
				<?php $upper = isset($turnover_ranges[$num][$id]['upper']) ? $turnover_ranges[$num][$id]['upper'] : ''; ?>
					{{ 
						Form::text("turnover_ranges[{$id}][upper]", $upper, array(
							'class' => 'form-control', 
							'placeholder'  => 'amount',
							'ng-model'     => 'turnover_range_upper' . $id, 
							'ng-init'      => "turnover_range_upper{$id}='{$upper}'", 
							'numbers-only' => 'numbers-only',
						)) 
					}}
			    </div>
			    <div class="col-lg-3">
				<?php $val = isset($turnover_ranges[$num][$id]['modifier']) ? $turnover_ranges[$num][$id]['modifier'] : ''; ?>
					{{ 
						Form::text("turnover_ranges[{$id}][modifier]", $val, array(
							'class' => 'form-control', 
							'placeholder' => 'percentage',
							'ng-model' 	=> 'turnover_range_mod' . $id, 
							'ng-init' 	=> "turnover_range_mod{$id}='{$val}'", 
							'numbers-only'	=> 'numbers-only',
						)) 
					}}
			    </div>
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
