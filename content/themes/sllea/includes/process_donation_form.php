<?php
	if(isset($_POST['submit'])) {
			process_donation();
	}

	function process_donation() {
		session_start();
		$donation_fields = array();
		$form_errors = array();

		$donate_fields['donation'] = trim($_POST['donation']);
		$donate_fields['first-name'] = trim($_POST['first-name']);
		$donate_fields['last-name'] = trim($_POST['last-name']);
		$donate_fields['email'] = trim($_POST['email']);

		$form_errors['donation'] = ((empty($donate_fields['donation']) == 0) ? "" : "Please enter a donation amount");
		$form_errors['first-name'] = ((empty($donate_fields['first-name']) == 0) ? "" : "Please enter your first name");
		$form_errors['last-name'] = ((empty($donate_fields['last-name']) == 0) ? "" : "Please enter your last name");
		$form_errors['email']   = (((empty($donate_fields['email']) == 0) && (filter_var($donate_fields['email'], FILTER_VALIDATE_EMAIL))) ? "" : "Please enter a valid email address");


		$_SESSION['donation_fields'] = $donate_fields;
		$_SESSION['form_errors'] = $form_errors;

		if(count(array_filter($form_errors, 'strlen')) === 0) {
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

			$query_str = http_build_query($data);

			header("Location: https://www.paypal.com/cgi-bin/webscr?" . $query_str);
			exit();
		}

		$_SESSION['has_errors'] = true;
	}
?>