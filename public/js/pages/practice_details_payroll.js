$(document).ready(function () {
	$('.based_on').change(function() {
		var based_on = $(this).val();
		$('.base_fees').hide();
		$('.' + based_on).show();
	});	
});
