@section('title')
Tax and VAT Returns
@stop

@section('page_title')
Tax and VAT Returns
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
			  <legend>Bookkeeping Base Fee</legend>

			  <div class="form-group">
			    <label for="hour_val" class="col-lg-2 control-label">Per Hour</label>
			    <div class="col-lg-2">
					{{ 
						Form::text("hour_val", $hour_val, array(
							'class' => 'form-control', 
							'placeholder' => 'amount',
							'ng-model' 	=> 'hour_val', 
							'ng-init' 	=> "hour_val='{$hour_val}'", 
							'numbers-only'	=> 'numbers-only',
						)) 
					}}
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="vat_returns" class="col-lg-2 control-label">Per Day</label>
			    <div class="col-lg-2">
					{{ 
						Form::text("day_val", $day_val, array(
							'class' => 'form-control', 
							'placeholder' => 'amount',
							'ng-model' 	=> 'day_val', 
							'ng-init' 	=> "day_val='{$day_val}'", 
							'numbers-only'	=> 'numbers-only',
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
	</div>
	
@stop
