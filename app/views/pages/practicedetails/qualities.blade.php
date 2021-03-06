@section('title')
Record Qualities
@stop

@section('page_title')
Record Qualities
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
		  <legend>Accounting System Qualities - % Increase/Decrease</legend>
		  <p class="help-block">Please enter the percentage increase or decrease over base fee that you charge clients based on the quality of their records. <br>Average will always be 0%, with the values entered in ‘Good’ and better being discounts against the average base fee.</p>
		  <br>
		  <div class="row">
			<div class="col-lg-6">
			  <div class="form-group">
			    <div class="col-lg-4 control-label"></div>
			    <div class="col-lg-4 text-center">Manual</div>
			    <div class="col-lg-4 text-center">Computerised</div>
			  </div>
			  @foreach($record_qualities as $id => $name)
				  <div class="form-group">
						<label class="col-lg-4 control-label">{{ $name }}</label>
					@foreach([1,2] as $ac_id)
						<?php $val = isset($accountant_record_qualities[$ac_id][$id]) ? $accountant_record_qualities[$ac_id][$id] : $defaults['accounting_types'][$name][$ac_id]; ?>
						<?php 
							$attrs = [
								'class' => 'form-control', 
								'placeholder' => 'percentage',
								'ng-model' 	=> "record_quality_{$ac_id}_{$id}", 
								'ng-init' 	=> "record_quality_{$ac_id}_{$id}='{$val}'", 
								//'numbers-only'  => 'numbers-only'
							];
							
							if (in_array($name, ['Good', 'Very Good', 'Excellent', 'Full Accounts'])) {
								$attrs['numbers-negative'] = 'numbers-negative'; 
							}

						?>
						<div class="col-lg-4">
							{{ 
								Form::text("record_qualities[$ac_id][{$id}]", $val, $attrs) 
							}}
						</div>
					@endforeach
				  </div>
			  @endforeach
		  	</div>
		  </div>
		</fieldset>
	</div>
		<div class="col-lg-12 pull-right well">
			<div class="pull-left">
				<a class="btn btn-primary btn-reset" id="reset" href="{{ route('practicedetails.taxes.reset', [$accountant_id]) }}">Reset</a>
			</div>
			<div class="pull-right">
				<button  class="btn btn-info btn-save" type="submit" name="save_next_page" id="save_next_page">Save & Next </button>
				<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">Save </button>
			</div>
		</div>
	{{ Form::close() }}
	</div>
	
@stop
