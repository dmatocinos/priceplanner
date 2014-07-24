@section('title')
Client Details
@stop

@section('page_title')
Client Details
@stop

@section('client')
@if(isset($client_data['client_id']))
    <li>
	<a href="#"><i class="fa fa-male fa-fw"></i>{{ $client_data['contact_name'] }}</a>
    </li>
@endif
@stop

@section('app_nav')
       <nav id="app-nav" class="navbar navbar-default" role="navigation">
         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
           <ul class="nav navbar-nav">
             <li class="active"><a href="#">Client Details</a></li>
             @if($edit == true)
	     		 @if(isset($client_data['pricing_id']))
                         <li class=""><a href="{{ url('feeplanner/edit/' . $client_data['pricing_id']) }}">Fee Planner</a></li>
                         @else
                         <li class=""><a href="{{ url('feeplanner/' . $client_data['client_id']) }}">Fee Planner</a></li>
                         @endif
             @else
             <li class=""><a href="#" style="color: #000000;">Fee Planner</a></li>
             @endif
	     @if(isset($client_data['pricing_id']))
             <li><a href="{{ url('plansummary/' . $client_data['pricing_id']) }}">Plan Summary</a></li>
             @else
             <li><a href="#" style="color: #000000;">Plan Summary</a></li>
             @endif
           </ul>
         </div><!-- /.navbar-collapse -->
       </nav>
@stop


@section('content')
	<?php 
		if (isset($client_data['id'])) {
			$route = 'update_client';
			$client_data['period_start_date'] =  $client_data['period_start_date'] ? date('m/d/Y', strtotime($client_data['period_start_date'])) : '';
			$client_data['period_end_date'] =  $client_data['period_end_date'] ? date('m/d/Y', strtotime($client_data['period_end_date'])) : '';
			$country = $client_data['country'];
		}
		else {
			$route = 'create_client';
			$country = 'United Kingdom';
		}
		
	?>
	
	{{ Form::open(array('route' => $route, 'method' => 'PUT', 'class' => 'form-horizontal', 'ng-controller' => 'PPCtrl', 'files' => true)) }}

            <div class="row">

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Client Details
                        </div>
                        <div class="panel-body">
				
			    <fieldset>

				    <div class="form-group">
					@if(isset($client_data['id']))
					<input type="hidden" name="id" value="{{ $client_data['id'] }}">
					@endif
					@if(isset($client_data['pp_client_id']))
					<input type="hidden" name="pp_client_id" value="{{ $client_data['pp_client_id'] }}">
					@endif
					@if(isset($client_data['client_id']))
					<input type="hidden" name="client_id" value="{{ $client_data['client_id'] }}">
					@endif
				    	<label for="business_name" class="col-sm-2 control-label">Business Name</label>
					<div class="col-sm-4">
						{{ 
							Form::text('business_name', $client_data['business_name'], array(
								'class' => 'form-control',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("business_name"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="contact_name" class="col-sm-2 control-label">Contact Name</label>
					<div class="col-sm-4">
						{{ 
							Form::text('contact_name', $client_data['contact_name'], array(
								'class' => 'form-control',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("contact_name"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="contact_name" class="col-sm-2 control-label">Accounting Period</label>
					<div class="col-sm-4">
					    <div class="row">
						<span class="col-sm-5">
							{{ 
								Form::text('period_start_date', $client_data['period_start_date'], array(
									'class' => 'form-control', 
									'id' => 'period_start_date',
									'placeholder' => 'Period Start'
								)) 
							}}
						</span>
						<span class="col-md-1">
							<b>&nbsp;_</b>
						</span>
						<span class="col-sm-5">
							{{ 
								Form::text('period_end_date', $client_data['period_end_date'], array(
									'class' => 'form-control', 
									'id' => 'period_end_date',
									'placeholder' => 'Period End'
								)) 
							}}
						</span>
					    </div>
				    	</div>
				    </div>

				</fieldset>

			</div>
		    </div>
		</div>

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-suitcase fa-fw"></i> Business Details
                        </div>
                        <div class="panel-body">
				
			    <fieldset>

				  <div class="form-group">
				    	<label for="year_end" class="col-sm-2 control-label">Year End</label>
					<div class="col-sm-4">
						{{ 
							Form::text('year_end', $client_data['year_end'], array(
								'class' => 'form-control input-sm', 
								'id' => 'year_end', 
								'placeholder' => 'day, Month',
							))
						}}
						@if ($error = $errors->first("year_end"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				  </div>

				  <div class="form-group">
				    	<label for="business_status" class="col-sm-2 control-label">Business Status</label>
					<div class="col-sm-4">
						{{ 
							Form::select(
								'business_status', ['' => '', 'Trading' => 'Trading', 'Investment' => 'Investment'], 
								$client_data['business_status'],
								array(
									'class' => 'form-control', 
							)) 
						}}
						@if ($error = $errors->first("business_status"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				  </div>

				  <div class="form-group">
				    	<label for="business_type" class="col-sm-2 control-label">Business Type</label>
					<div class="col-sm-4">
						{{ 
							Form::select(
								'business_type', 
								[
									'' => '', 
									'Limited Company' => 'Limited Company', 
									'Partnership' => 'Partnership', 
									'Sole Trader' => 'Sole Trader', 
									'LLP' => 'LLP'
								], 
								$client_data['business_type'],
								array(
									'class' => 'form-control', 
							)) 
						}}
						@if ($error = $errors->first("business_status"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				  </div>

				  <div class="form-group">
				    	<label for="industry_sector" class="col-sm-2 control-label">Industry Sector</label>
					<div class="col-sm-4">
						{{ 
							Form::select(
								'industry_sector', 
								[
									'' => '', 
									'Accounting Practice' => 'Accounting Practice',
									'Banking' => 'Banking',
									'Business Services' => 'Business Services',
									'Construction' => 'Construction',
									'Education/Training' => 'Education/Training',
									'Financial Services' => 'Financial Services',
									'Health' => 'Health',
									'Insurance' => 'Insurance',
									'IT/Telecomms' => 'IT/Telecomms',
									'Law' => 'Law',
									'Logistics' => 'Logistics',
									'Management Consultancy' => 'Management Consultancy',
									'Manufacturing/Engineering' => 'Manufacturing/Engineering',
									'Marketing/PR' => 'Marketing/PR',
									'Media/Entertainment' => 'Media/Entertainment',
									'Oil, Gas, Mining' => 'Oil, Gas, Mining',
									'Other' => 'Other',
									'Property' => 'Property',
									'Public Sector/Charity' => 'Public Sector/Charity',
									'Retail/Wholesale' => 'Retail/Wholesale',
									'Utilities' => 'Utilities'
								],
								$client_data['industry_sector'],
								array(
									'class' => 'form-control', 
							)) 
						}}
						@if ($error = $errors->first("business_status"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				  </div>

				  <div class="form-group">
				    	<label for="currency" class="col-sm-2 control-label">Currency</label>
					<div class="col-sm-4">
						{{ 
							Form::select(
								'currency', $currencies, 
								$client_data['currency'],
								array(
									'class' => 'form-control', 
							)) 
						}}
						@if ($error = $errors->first("currency"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				  </div>


				</fieldset>

			</div>
		    </div>
		</div>

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-home fa-fw"></i> Contact Details
                        </div>
                        <div class="panel-body">
				
			    <fieldset>

				    <div class="form-group">
				    	<label for="address_1" class="col-sm-2 control-label">Street Address</label>
					<div class="col-sm-4">
						{{ 
							Form::text('address_1', $client_data['address_1'], array(
								'class' => 'form-control',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("address_1"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="city" class="col-sm-2 control-label">Town/City</label>
					<div class="col-sm-4">
						{{ 
							Form::text('city', $client_data['city'],
								array(
									'class' => 'form-control', 
							)) 
						}}
						@if ($error = $errors->first("city"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="countty" class="col-sm-2 control-label">County</label>
					<div class="col-sm-4">
						{{ 
							Form::select('county', $counties,
								$client_data['county'],
								array(
									'class' => 'form-control', 
							)) 
						}}
						@if ($error = $errors->first("county"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="country" class="col-sm-2 control-label">Country</label>
					<div class="col-sm-4">
						{{ 
							Form::select('country', $countries,
								$country,
								array(
									'class' => 'form-control', 
							)) 
						}}
						@if ($error = $errors->first("country"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="postcode" class="col-sm-2 control-label">Postcode</label>
					<div class="col-sm-4">
						{{ 
							Form::text('postcode', $client_data['postcode'], array(
								'class' => 'form-control',
							)) 
						}}
						@if ($error = $errors->first("postcode"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="phone_number" class="col-sm-2 control-label">Phone Number</label>
					<div class="col-sm-4">
						{{ 
							Form::text('phone_number', $client_data['phone_number'], array(
								'class' => 'form-control',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("phone_number"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="mobile_number" class="col-sm-2 control-label">Mobile Number</label>
					<div class="col-sm-4">
						{{ 
							Form::text('mobile_number', $client_data['mobile_number'], array(
								'class' => 'form-control',
							)) 
						}}
						@if ($error = $errors->first("mobile_number"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-4">
						{{ 
							Form::text('email', $client_data['email'], array(
								'class' => 'form-control',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("email"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="website" class="col-sm-2 control-label">Website</label>
					<div class="col-sm-4">
						{{ 
							Form::text('website', $client_data['website'], array(
								'class' => 'form-control',
							)) 
						}}
						@if ($error = $errors->first("website"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>


				</fieldset>

				</div>
			    </div>
			</div>

                </div>

		<div class="col-lg-12 pull-right well">
			<div class="pull-right">
				<button  class="btn btn-primary btn-save" type="submit" name="save_next_page" id="save_next_page" >&nbsp;<i class="fa fa-save"></i> Save & Next </button>
				<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">&nbsp;<i class="fa fa-save"></i> Save </button>
			</div>
		</div>

		{{ Form::close() }}

            </div>
@stop
