$(document).ready(function () {
	$('.based_on_employee').change(function() {
		var based_on = $(this).val();
		$('.base_fees_employee').hide();
		$('.' + based_on + '_employee').show();
	});	
	$('.based_on_subcontractor').change(function() {
		var based_on = $(this).val();
		$('.base_fees_subcontractor').hide();
		$('.' + based_on + '_subcontractor').show();
	});	
});
