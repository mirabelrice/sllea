jQuery(document).ready(function($) {
	var donateOptions = $('.donate-option'),
		donationForm = $("#sllea-make-donation"),
		enteredDonation = $('#entered-donate-amount'),
		finalDonation = $('#final-donation-amount'),
		submitDonation = $('#make-donation');

	donateOptions.on("click", function(){
    	var selectedAmount = $(this).children("a").attr('data-amount');
    	if(selectedAmount === "Other") {
    		enteredDonation.focus();
    	}else{
    		enteredDonation.val(selectedAmount);
    		finalDonation.text('$' + selectedAmount + ".00"); //set final displayed donation amount before submit
    	}
	});

	enteredDonation.on("blur", function(){
		var otherAmount = $(this).val(),
		finalAmount = '$' + otherAmount;
		if(otherAmount.search(".") === -1) {
			finalAmount += ".00";
		}
		finalDonation.text(finalAmount);
	});


	$("#make-donation").on("click", function(e) {
		e.preventDefault();
		resetErrors();
		var donateInputs = donationForm.find("input[type='text'], input[type='number']");
		var donateSelects = donationForm.find("select");
		var data = {};

		$.each(donateInputs, function(i, v) {
			data[v.name] = v.value;
	    });

	    $.each(donateSelects, function(i, v) {
			data[v.name] = v.options[v.selectedIndex].text;
	    });

	 	$.ajax({
			url: '/wordpress/wp-content/themes/sllea/sllea-process-donation.php',
			type: 'POST',
			dataType: 'json',
			data: data,
			success: function(response) {
				if (response.isValid) {
					var fields = donationForm.find("input[type='hidden'][name='amount'], input[type='hidden'][name='item_name'], input[type='hidden'][name='first_name'], input[type='hidden'][name='last_name']");
					populatePaypalFields(fields, data);
					donationForm.submit();
                    return false;
                } else { 
                	var errorDisplay = $("#form-error-display");
                	var errorList = errorDisplay.find("#form-errors ul");
                	
               		$.each(response, function(i, v) {
		        		console.log(i + " => " + v); // view in console for error messages 
		        		errorList.append('<li>'+v+'</li>');
		        		invalidInput = $('input[name="'+i+'"], select[name="'+i+'"]');
		        		invalidInput.addClass("invalid");
		        		//invalidInput.next('p').addClass("invalid");
               		});	 
               		errorDisplay.show();
					$('html, body').animate({ scrollTop: 0 }, 'slow');
               	}
               	return false;
			},
			error: function(xhr, status, error) {
    			alert(xhr.responseText);
 			}
		});
	});

	function resetErrors() {
    	$('input').removeClass('invalid');
    	$('select').removeClass('invalid');
    	$('p').removeClass('invalid');
    	$("#form-error-display").hide();
    	$("#form-errors ul").empty();
	}

	function populatePaypalFields(fields, data) {
		fields.eq(0).val(data['donation']);
		console.log(fields.eq(0).val(data['donation']));
		/*
		if(donationFrequency.is(':checked')) {
			console.log("if");
			fields.eq(1).val("One time donation");
		}else{
			console.log("else");
			fields.eq(1).val("Monthly donation");
		}
*/
		fields.eq(1).val(data['first-name']);
		fields.eq(2).val(data['last-name']);
	}
});