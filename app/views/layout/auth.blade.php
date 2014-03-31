<!DOCTYPE html>

<html class="full" lang="en"><!-- The full page image background will only work if the html has the custom class set to it! Don't delete it! -->

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dixie Philamerah Atay">

    <title>Price Planner Pro</title>

    <!-- Custom CSS for the 'Full' Template -->
    {{ Asset::container('header')->styles() }}
  </head>

  <body>

    <div class="container">
      <div class="row">
		<div class="col-md-8 col-sm-8 blob">
			<h1 class="text-success">Price Planner Pro</h1>
			<h3> Price professionally and create additional fees.</h3>
		</div>

		<div class="col-md-4 pull-right">
			<div class="main well">
				@yield('content')
			</div>
		</div>
      </div>
	<div class="row" style="height: 170px;">
		
	</div>
	<div class="row">
		<div class="col-md-8 col-sm-8 blob">
			<h1>See other services we offer</h1>
			<br/>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-sm-4" style="margin-left: 20px; margin-bottom: 0">
			<div>
				<a href="http://app.bizvaluation.co.uk" class="thumbnail" title=" Create a professional business valuation in just 15 minutes"><img src="{{ url('../images/app-logos/bizvaluation_logo.png') }}" style="width: 100%; padding: 10px 0;"/></a>
			</div>
			<div>
				<a href="http://practicepro.co.uk/incorporation/public/" class="thumbnail" title="Show your clients the potential tax savings of incorporating their business"><img src="{{ url('../images/app-logos/incorporationplannerpro_logo.png') }}" style="width: 70%;"/></a>
			</div>
		</div>
		<div class="col-md-4 col-sm-4 " style="margin-left: 20px;">
			<div>
				<a href="http://virtualfdpro.practicepro.co.uk/" class="thumbnail" title="Help your clients achieve their goals"><img src="{{ url('../images/app-logos/virtualfdpro_logo.jpg') }}" style="width: 100%; padding: 5px;"/></a>
			</div>
			<div>
				<a href="http://remunerationpro.practicepro.co.uk/" class="thumbnail" title="Maximise your clients' personal income"><img src="{{ url('../images/app-logos/remuneration_logo.png') }}" style="width: 50%;"/></a>
			</div>
		</div>
	</div>
    </div>

    <!-- JavaScript -->
    {{ Asset::container('footer')->scripts() }}

  </body>

</html>
