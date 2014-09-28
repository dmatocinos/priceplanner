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
		  <legend>Tax Returns</legend>
		  <p class="help-block">Please enter the base fee you charge clients per tax return.</p>
		  <br>
		  <div class="form-group">
		    <div class="col-lg-2 control-label"></div>
		    <div class="col-lg-2 text-center">Base Fee</div>
		  </div>
		  @foreach($tax_returns as $id => $name)
		  <div class="form-group">
		    <label for="tax_returns[{{ $id }}]" class="col-lg-2 control-label">{{ $name }}</label>
		    <div class="col-lg-2">
				<?php $val = isset($accountant_tax_returns[$id]) ? $accountant_tax_returns[$id] : $defaults['tax_returns'][$name]; ?>
				{{ 
					Form::text("tax_returns[{$id}]", $val, array(
						'class' => 'form-control', 
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
		  <p class="help-block">Please enter the base fee you charge clients per VAT return.</p>
		  <br>
		  <div class="form-group">
		    <label for="standard_rate" class="col-lg-2 control-label">Standard Rate</label>
		    <div class="col-lg-2">
				<?php $val = isset($accountant_vat_returns) ? $accountant_vat_returns->std_rate : $defaults['vat_returns']['standard_rate']; ?>
				{{ 
					Form::text("std_rate", $val, array(
						'class' => 'form-control', 
						'placeholder' => 'amount',
						'ng-model' 	=> 'std_rate', 
						'ng-init' 	=> "std_rate='{$val}'", 
						'numbers-only'	=> 'numbers-only',
					)) 
				}}
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="flat_rate" class="col-lg-2 control-label">Flat Rate</label>
		    <div class="col-lg-2">
				<?php $val = isset($accountant_vat_returns) ? $accountant_vat_returns->flat_rate : $defaults['vat_returns']['flat_rate']; ?>
				{{ 
					Form::text("flat_rate", $val, array(
						'class' => 'form-control', 
						'placeholder' => 'amount',
						'ng-model' 	=> 'flat_rate', 
						'ng-init' 	=> "flat_rate='{$val}'", 
						'numbers-only'	=> 'numbers-only',
					)) 
				}}
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
