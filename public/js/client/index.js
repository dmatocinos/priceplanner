$(document).ready(function () {

	$('#period_end_date').datepicker();
	$('#period_start_date').datepicker();

	$('#year_end').datepicker({
		format: "dd, M"
	});
});
