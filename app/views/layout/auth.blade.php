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
		<div class="col-md-7 col-sm-7 blob">
			<h1>The Next Big Thing in the Cloud</h1>

		</div>

		<div class="col-md-4 pull-right">
			<div class="main well">
				@yield('content')
			</div>
		</div>
      </div>
	<div class="row" style="height: 180px;">
		
	</div>
	<div class="row">
		<div class="col-md-8 col-sm-8 blob">
			<h1>See other services we offer:</h1>
			<br/>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-sm-4" style="margin-left: 20px; margin-bottom: 0">
			<div>
				<a href="http://app.bizvaluation.co.uk" class="thumbnail" ><img src="{{ url('../images/bizvaluation_logo.png') }}" style="width: 100%; padding: 10px 0;"/></a>
			</div>
			<div>
				<a href="http://www.bizplannerpro.co.uk/" class="thumbnail" title=""><img src="{{ url('../images/bizplannerpro_logo.png') }}" style="width: 80%;"/></a>
			</div>
		</div>
		<div class="col-md-4 col-sm-4 " style="margin-left: 20px;">
			<div>
				<a href="http://virtualfdpro.practicepro.co.uk/" class="thumbnail" title="Help your clients achieve their goals"><img src="{{ url('../images/virtualfdpro_logo.jpg') }}" style="width: 100%; padding: 5px;"/></a>
			</div>
		</div>
	</div>
    </div>

    <!-- JavaScript -->
    {{ Asset::container('footer')->scripts() }}

  </body>

</html>
