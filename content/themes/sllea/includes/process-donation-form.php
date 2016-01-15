<?php
	session_start();
	if(isset($_POST['submit'])) {
		process_donation();
	}

	function process_donation() {
		$donate_fields = array();
		$errors = array();

		$donate_fields['donation'] = trim($_POST['donation']);
		$donate_fields['first-name'] = trim($_POST['first-name']);
		$donate_fields['last-name'] = trim($_POST['last-name']);
		$donate_fields['email'] = trim($_POST['email']);

		$errors['donation'] = ((empty($donate_fields['donation']) == 0) ? "" : "Please enter a donation amount");
		$errors['first-name'] = ((empty($donate_fields['first-name']) == 0) ? "" : "Please enter your first name");
		$errors['last-name'] = ((empty($donate_fields['last-name']) == 0) ? "" : "Please enter your last name");
		$errors['email']   = (((empty($donate_fields['email']) == 0) && (filter_var($donate_fields['email'], FILTER_VALIDATE_EMAIL))) ? "" : "Please enter a valid email address");


		$_SESSION['donation_fields'] = $donate_fields;
		$_SESSION['form_errors'] = $errors;

    	if(count(array_filter($errors, 'strlen')) === 0) {
    		$query_str = get_query_str($donate_fields);
			header("Location: https://www.paypal.com/cgi-bin/webscr?" . $query_str);
    	} else {
			$_SESSION['has_errors'] = true;
    	}
	}

	function get_query_str($donate_fields) {
		//send prepopulated data to paypal
		$data = array();
		$data["cmd"] = "_donations";
		$data["business"] = "paypal@sllea.org";
		$data["item_type"] = "donation";
		$data["amount"] = $donate_fields['donation'];
		$data["item_name"] = "Donation to SLLEA";
		$data["currency_code"] = "USD";
		$data["return"] = WP_SITEURL . "/donate";
		$data["cancel_return"] = WP_SITEURL . "/donate";
		$data["first_name"] = $donate_fields['first-name'];
		$data["last_name"] = $donate_fields['last-name'];
		$data["email"] = $donate_fields['email'];

		return http_build_query($data);
	}
?>