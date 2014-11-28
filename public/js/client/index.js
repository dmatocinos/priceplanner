$(document).ready(function () {

	$('#period_end_date').datepicker({ 
            format: 'dd/mm/yyyy' 
    });
	$('#period_start_date').datepicker({ 
            format: 'dd/mm/yyyy' 
    });

	$('#year_end').datepicker({
		format: "dd, M"
	});
});
