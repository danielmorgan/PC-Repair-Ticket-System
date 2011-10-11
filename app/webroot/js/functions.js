$(document).ready(function() {
	
	/*
	* Customer autofill
	*/
	options = {
		serviceUrl: '/customers/ajax_names',
		onSelect: function (value){
			$.get(
				"/customers/ajax_contact_details",
				"query="+value+"",
				function(response){
					$.each(response, function(){
						$('#CustomerId').val(this.id);
						$('#CustomerEmail').val(this.email).prop('disabled', true);
						$('#CustomerPhone').val(this.phone).prop('disabled', true);
						$('#CustomerAddress').val(this.address).prop('disabled', true);
					});
					$('input#CustomerName').blur(function(){
						if (this.value !== value) {
							$('#CustomerName').val('');
							$('#CustomerEmail').val('').prop('disabled', false);
							$('#CustomerPhone').val('').prop('disabled', false);
							$('#CustomerAddress').val('').prop('disabled', false);
						}
					});
				},
				"json"
			);
		}
	};
	a = $('#CustomerName').autocomplete(options);
	
	
	/*
	* Customer autofill
	*/
	$('#amountInputs input').keyup(function() {
		price = $('#TicketAmountOwed').val();
		paid = $('#TicketAmountPaid').val();
		balance = (price - paid).toFixed(2);
		$('#amountDue .amount').html(balance);
	});
	
});