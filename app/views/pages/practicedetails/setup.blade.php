@section('title')
Setup Accountant Details
@stop

@section('page_title')
Setup Accountant Details
@stop

@section('app_nav')
@include('pages.practicedetails.menu')
@stop

@section('content')
	{{ Form::open(array('route' => $route, 'method' => 'PUT', 'class' => 'bs-example form-horizontal', 'ng-controller' => 'PPCtrl', 'files' => true)) }}
		@if ($edit)
			{{  Form::hidden('id', $accountant['id']) }}
		@endif	
		<div class="well">
			<fieldset>
			  <legend>Practice Details</legend>
			  <div class="form-group">
			    <label for="accountancy_name" class="col-lg-2 control-label">Accountancy Name	</label>
			    <div class="col-lg-4">
					{{ 
						Form::text('accountancy_name', isset($accountant['accountancy_name']) ? $accountant['accountancy_name'] : '', array(
							'class' => 'form-control', 
							'required' => 'required'
						)) 
					}}
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="accountant_name" class="col-lg-2 control-label">Project Manager</label>
			    <div class="col-lg-4">
					{{ 
						Form::text('accountant_name', isset($accountant['accountant_name']) ? $accountant['accountant_name'] : '', array(
							'class' => 'form-control', 
							'required' => 'required',
						)) 
					}}
			    </div>
			  </div>	
			   <div class="form-group">
			    <label for="logo_filename" class="col-lg-2 control-label">Logo (optional)</label>
			    <div class="col-lg-4">
					@if (isset($accountant['logo_filename']) && ! is_null($accountant['logo_filename']))
						<img src="{{asset('uploads/' . $accountant['logo_filename'])}}" width="100" alt="DRC Sports Race Management" id="DRCS-logo" />
						<br>
					@endif
					{{ 
						Form::file('logo_filename');
					}}
			    </div>
			  </div>
			<legend><h4>Address</h4></legend>
			  <div class="form-group">
			    <label for="street_address" class="col-lg-2 control-label">Street Address</label>
			    <div class="col-lg-4">
					{{ 
						Form::text('street_address', isset($accountant['street_address']) ? $accountant['street_address'] : '', array(
							'class' => 'form-control', 
							'required' => 'required'
						)) 
					}}
			    </div>
			  </div>
			   <div class="form-group">
			    <label for="city_address" class="col-lg-2 control-label">City</label>
			    <div class="col-lg-4">
					{{ 
						Form::text('city_address', isset($accountant['city_address']) ? $accountant['city_address'] : '', array(
							'class' => 'form-control', 
							'required' => 'required'
						)) 
					}}
			    </div>
			  </div>
			   <div class="form-group">
			    <label for="state_address" class="col-lg-2 control-label">State</label>
			    <div class="col-lg-4">
					{{ 
						Form::text('state_address', isset($accountant['state_address']) ? $accountant['state_address'] : '', array(
							'class' => 'form-control'
						)) 
					}}
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="country_address" class="col-lg-2 control-label">Country</label>
			    <div class="col-lg-4">
					{{   
						Form::select(
							'country_address', $countries, isset($accountant['country_address']) ? $accountant['country_address'] : '', [
							'class' => 'form-control',
						]);
					}}
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="zip_address" class="col-lg-2 control-label">Zip Code</label>
			    <div class="col-lg-4">
					{{ 
						Form::text('zip_address', isset($accountant['zip_address']) ? $accountant['zip_address'] : '', array(
							'class' => 'form-control', 
							'numbers-only'	=> 'numbers-only',
							'ng-model' 	=> 'zip_address',
							'ng-init' 	=> "zip_address='" . (isset($accountant['zip_address']) ? $accountant['zip_address'] : '') . "'", 
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
	
@stop
