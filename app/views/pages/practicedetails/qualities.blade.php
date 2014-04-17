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
		  <legend>Accounting System Qualities</legend>
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
						<?php $val = isset($accountant_record_qualities[$ac_id][$id]) ? $accountant_record_qualities[$ac_id][$id] : '' ?>
						<div class="col-lg-4">
							{{ 
								Form::text("record_qualities[$ac_id][{$id}]", $val, array(
									'class' => 'form-control', 
									'placeholder' => 'percentage',
									'ng-model' 	=> "record_quality_{$ac_id}_{$id}", 
									'ng-init' 	=> "record_quality_{$ac_id}_{$id}='{$val}'", 
									'numbers-only'	=> 'numbers-only',
								)) 
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
			<div class="pull-right">
				<button  class="btn btn-info btn-save" type="submit" name="save_next_page" id="save_next_page">Save & Next </button>
				<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">Save </button>
			</div>
		</div>
	{{ Form::close() }}
	</div>
	
@stop
