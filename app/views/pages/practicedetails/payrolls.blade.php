@section('title')
Payroll | Employee & Subcontractor
@stop

@section('page_title')
Payroll | Employee & Subcontractor
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
			  <legend>Payroll Run - Employees</legend>
			  <p class="help-block">Please enter the base fee (if any) you charge clients per payroll run regardless of the number of employees.</p>
			  <br>
			  <div class="form-group">
			    <div class="col-lg-2 control-label"></div>
			    <div class="col-lg-2 text-center"></div>
			  </div>
			  <div class="form-group">
			    <label for="" class="col-lg-2 control-label">Base Fee Per Pay Run</label>
			    <div class="col-lg-2">
					<?php $val =  isset($payruns['employee']) ? $payruns['employee']['value'] : null ?>
					{{ 
						Form::text("payruns[employee][value]", $val, array(
							'class' => 'form-control', 
							'placeholder' => 'amount',
							'ng-model' 	=> 'payrun_emp', 
							'ng-init' 	=> "payrun_emp='{$val}'", 
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required',
						)) 
					}}
			    </div>
			  </div>
			 <br>
			 <legend><h4>Employee Pay Run Processing Charges</h4></legend>
			  <p class="help-block">Please enter the fee that you charge per employee processed per pay run.</p>
			  <div class="form-group">
				    <?php
					$ac_checked = $all_clients_employee_display ? 'checked' : '';
					$to_checked = $turnover_ranges_employee_display ? 'checked' : '';
				    ?>
				    <label for="" class="col-lg-2 control-label">Enter processing based on:</label>
				    <div class="col-lg-2">
					<div class="radio">
					  <label>
					    <input type="radio" class="based_on_employee" name="payruns[employee][based_on]" id="all_client" value="all_clients" {{ $ac_checked }}>
						All Clients		
					  </label>
					</div>
					<div class="radio">
					  <label>
					    <input type="radio" class="based_on_employee" name="payruns[employee][based_on]" id="turnover_ranges" value="turnover_ranges" {{ $to_checked }}>
						Turnover Ranges
					  </label>
					</div>
				    </div>
			  </div>
			  <br>
			    <?php
				$ac_display = $all_clients_employee_display ? 'inline' : 'none';
				$to_display = $turnover_ranges_employee_display ? 'inline' : 'none';
			    ?>
			  <div class="all_clients_employee base_fees_employee" style="display:{{ $ac_display }};">
			  <div class="form-group">
			    <div class="col-lg-2 control-label"></div>
			    <div class="col-lg-2 text-center"></div>
			  </div>
			  <div class="form-group">
			    <label for="" class="col-lg-2 control-label">All Clients</label>
			    <div class="col-lg-2">
					<?php $val =  isset($payruns['employee']) ? $payruns['employee']['allclients_base_fee'] : null ?>
					{{ 
						Form::text("payruns[employee][allclients_base_fee]", $val, array(
							'class' => 'form-control', 
							'placeholder' => 'amount',
							'ng-model' 	=> 'ac_base_fee_emp', 
							'ng-init' 	=> "ac_base_fee_emp='{$val}'", 
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required',
						)) 
					}}
			    </div>
			  </div>

			  </div>
			  <div class="turnover_ranges_employee base_fees_employee" style="display:{{ $to_display }};">
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
							<?php $val = isset($payroll_runs['employee']) ? $payroll_runs['employee'][$id] : 0 ?>
							{{ 
								Form::text("payroll_turnover_ranges[employee][{$id}]", $val, array(
									'class' => 'form-control', 
									'placeholder' => 'amount',
									'ng-model' 	=> 'payroll_turnover_ranges_emp' . $id, 
									'ng-init' 	=> "payroll_turnover_ranges_emp{$id}='{$val}'", 
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
		<div class="well">
			<fieldset>
			  <legend>Payroll Run - Subcontractor</legend>
			  <p class="help-block">Please enter the base fee (if any) you charge clients per payroll run regardless of the number of subcontractor.</p>
			  <br>
			  <div class="form-group">
			    <div class="col-lg-2 control-label"></div>
			    <div class="col-lg-2 text-center"></div>
			  </div>

			  <div class="form-group">
			    <label for="" class="col-lg-2 control-label">Base Fee Per Pay Run</label>
			    <div class="col-lg-2">
					<?php $val =  isset($payruns['subcontractor']) ? $payruns['subcontractor']['value'] : null ?>
					{{ 
						Form::text("payruns[subcontractor][value]", $val, array(
							'class' => 'form-control', 
							'placeholder' => 'amount',
							'ng-model' 	=> 'payrun_sub', 
							'ng-init' 	=> "payrun_sub='{$val}'", 
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required',
						)) 
					}}
			    </div>
			  </div>
			  
			  <br>	 	
			  <legend><h4>Subcontractor Pay Run Processing Charges</h4></legend>
			  <p class="help-block">Please enter the fee that you charge per subcontractor processed per pay run.</p>
			  <div class="form-group">
				    <?php
					$ac_checked = $all_clients_subcontractor_display ? 'checked' : '';
					$to_checked = $turnover_ranges_subcontractor_display ? 'checked' : '';
				    ?>
				    <label for="" class="col-lg-2 control-label">Enter processing based on:</label>
				    <div class="col-lg-2">
					<div class="radio">
					  <label>
					    <input type="radio" class="based_on_subcontractor" name="payruns[subcontractor][based_on]" id="all_client" value="all_clients" {{ $ac_checked }}>
						All Clients		
					  </label>
					</div>
					<div class="radio">
					  <label>
					    <input type="radio" class="based_on_subcontractor" name="payruns[subcontractor][based_on]" id="turnover_ranges" value="turnover_ranges" {{ $to_checked }}>
						Turnover Ranges
					  </label>
					</div>
				    </div>
			  </div>
			 <legend>&nbsp;</legend>
			  <br>
			    <?php
				$ac_display = $all_clients_subcontractor_display ? 'inline' : 'none';
				$to_display = $turnover_ranges_subcontractor_display ? 'inline' : 'none';
			    ?>
			  <div class="all_clients_subcontractor base_fees_subcontractor" style="display:{{ $ac_display }};">
			  <div class="form-group">
			    <div class="col-lg-2 control-label"></div>
			    <div class="col-lg-2 text-center"></div>
			  </div>
			  <div class="form-group">
			    <label for="" class="col-lg-2 control-label">All Clients</label>
			    <div class="col-lg-2">
					<?php $val =  isset($payruns['subcontractor']) ? $payruns['subcontractor']['allclients_base_fee'] : 0 ?>
					{{ 
						Form::text("payruns[subcontractor][allclients_base_fee]", $val, array(
							'class' => 'form-control', 
							'placeholder' => 'amount',
							'ng-model' 	=> 'ac_base_fee_sub', 
							'ng-init' 	=> "ac_base_fee_sub='{$val}'", 
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required',
						)) 
					}}
			    </div>
			  </div>

			  </div>
			  <div class="turnover_ranges_subcontractor base_fees_subcontractor" style="display:{{ $to_display }};">
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
							<?php $val = isset($payroll_runs['subcontractor']) ? $payroll_runs['subcontractor'][$id] : 0 ?>
							{{ 
								Form::text("payroll_turnover_ranges[subcontractor][{$id}]", $val, array(
									'class' => 'form-control', 
									'placeholder' => 'amount',
									'ng-model' 	=> 'payroll_turnover_ranges_sub' . $id, 
									'ng-init' 	=> "payroll_turnover_ranges_sub{$id}='{$val}'", 
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
