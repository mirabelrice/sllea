jQuery(document).ready(function($) {
	var donateOptions = $('.donate-option'),
		donationForm = $("#sllea-make-donation"),
		enteredDonation = $('#entered-donate-amount'),
		finalDonation = $('#final-donation-amount'),
		donateInputs = donationForm.find(".donate-entry input"),
		submitDonation = $('#make-donation');
 donationForm.validate({  errorPlacement: function(error, element) {}});

	donateOptions.on("click", function(){
    	var selectedAmount = $(this).find("a").attr('data-amount');

    	if(selectedAmount === "Other") {
    		enteredDonation.focus();
    	}else{
    		enteredDonation.val(selectedAmount);
    		finalDonation.text('$' + selectedAmount + ".00"); //set final displayed donation amount before submit
    	}
	});

	enteredDonation.on("focusout", function(){
		var otherAmount = $(this).val(),
		finalAmount = '$' + otherAmount;
		if(otherAmount.search(".") === -1) {
			finalAmount += ".00";
		}
		finalDonation.text(finalAmount);
	});

	donateInputs.on("focusout", function(event) {
		var $this = $(this);
		if($this.valid()) {
			if($this.hasClass('invalid')) {
				$this.siblings(".error-subtitle").hide();
				$this.removeClass('invalid');
			}
		}else{
			if($this.not('invalid')) {
				$this.siblings(".error-subtitle").show();
				$this.addClass('invalid');
			}
		}
	});
});