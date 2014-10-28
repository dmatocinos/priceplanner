$(document).ready(function () {

	$('#period_end_date').datepicker({ 
            format: 'dd-mm-yy' 
    });
	$('#period_start_date').datepicker({ 
            format: 'dd-mm-yy' 
    });

	$('#year_end').datepicker({
		format: "dd, M"
	});
});
