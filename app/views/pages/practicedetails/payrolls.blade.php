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
			  <legend>Pay Run</legend>
			  <p class="help-block">Please enter the base fee you charge clients for payroll.</p>
			  <br>
			  <div class="form-group">
			    <div class="col-lg-2 control-label"></div>
			    <div class="col-lg-2 text-center">Base Fee</div>
			  </div>
			  <div class="form-group">
			    <label for="" class="col-lg-2 control-label">Per Pay Run</label>
			    <div class="col-lg-2">
					<?php $val =  $payrun ? $payrun['value'] : null ?>
					{{ 
						Form::text("payrun[value]", $val, array(
							'class' => 'form-control', 
							'placeholder' => 'amount',
							'ng-model' 	=> 'payrun', 
							'ng-init' 	=> "payrun='{$val}'", 
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required',
						)) 
					}}
			    </div>
			  </div>
			</fieldset>
		</div>
		<div class="well">
			<fieldset>
			  <legend>Employee/Subcontractor - Payroll Run</legend>
			  <p class="help-block">Please enter the base rate per employee/subcontractor per payroll run based on all clients or turnover ranges.</p>
			  <br>
			  <div class="form-group">
				    <?php
					$ac_checked = $all_clients_display ? 'checked' : '';
					$to_checked = $turnover_ranges_display ? 'checked' : '';
				    ?>
				    <label for="" class="col-lg-2 control-label">Enter base fee based on:</label>
				    <div class="col-lg-2">
					<div class="radio">
					  <label>
					    <input type="radio" class="based_on" name="payrun[based_on]" id="all_client" value="all_clients" {{ $ac_checked }}>
						All Clients		
					  </label>
					</div>
					<div class="radio">
					  <label>
					    <input type="radio" class="based_on" name="payrun[based_on]" id="turnover_ranges" value="turnover_ranges" {{ $to_checked }}>
						Turnover Ranges
					  </label>
					</div>
				    </div>
			  </div>
			  <br>
			  <legend></legend>
			    <?php
				$ac_display = $all_clients_display ? 'inline' : 'none';
				$to_display = $turnover_ranges_display ? 'inline' : 'none';
			    ?>
			  <div class="all_clients base_fees" style="display:{{ $ac_display }};">
			  <div class="form-group">
			    <div class="col-lg-2 control-label"></div>
			    <div class="col-lg-2 text-center"><b>Base Fee</b></div>
			  </div>
			  <div class="form-group">
			    <label for="" class="col-lg-2 control-label">All Clients</label>
			    <div class="col-lg-2">
					<?php $val =  $payrun ? $payrun['allclients_base_fee'] : null ?>
					{{ 
						Form::text("payrun[allclients_base_fee]", $val, array(
							'class' => 'form-control', 
							'placeholder' => 'amount',
							'ng-model' 	=> 'ac_base_fee', 
							'ng-init' 	=> "ac_base_fee='{$val}'", 
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required',
						)) 
					}}
			    </div>
			  </div>

			  </div>
			  <div class="turnover_ranges base_fees" style="display:{{ $to_display }};">
				  <div class="form-group">
				    <div class="col-lg-2 control-label"><b>Turnover Ranges</b></div>
				    <div class="col-lg-2 text-center"><b>Base Fee</b></div>
				  </div>
				  @foreach (range(1,15) as $num)
				  <?php 
					if ( isset($turnover_ranges[$num]) && is_array($turnover_ranges[$num]) && ! is_null($turnover_ranges[$num])) {
						$id = key($turnover_ranges[$num]);
					}
					else {
						continue;
					}
					
				  ?>
				  <div class="form-group">
					<?php $lower = isset($turnover_ranges[$num][$id]['lower']) ? $turnover_ranges[$num][$id]['lower'] : ''; ?>
					<?php $upper = isset($turnover_ranges[$num][$id]['upper']) ? $turnover_ranges[$num][$id]['upper'] : ''; ?>
					    <label for="" class="col-lg-2 control-label">{{ $lower . ' - ' . $upper }}</label>
					    <div class="col-lg-2">
							<?php $val = $payroll_runs[$id]; ?>
							{{ 
								Form::text("payroll_turnover_ranges[{$id}]", $val, array(
									'class' => 'form-control', 
									'placeholder' => 'amount',
									'ng-model' 	=> 'payroll_turnover_ranges_' . $id, 
									'ng-init' 	=> "payroll_turnover_ranges_{$id}='{$val}'", 
									'numbers-only'	=> 'numbers-only',
									'required'	=> 'required',
								)) 
							}}
					    </div>
				  </div>
				  @endforeach
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
