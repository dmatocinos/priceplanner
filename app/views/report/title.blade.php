@if ($accountant->logo_filename  && file_exists('uploads/' . $accountant->logo_filename))
	<img style="width: 100px; float: left;" src="{{ asset('uploads/' . $accountant->logo_filename) }}"/>
@endif
<h2>Appendices To Pricing Modules</h2>
<p></p>
