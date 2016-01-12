<?php
	if(isset($_POST)) {
        $errors = array();
        //validate amount
        if ("" == trim($_POST['donation'])) {
            $errors['donation'] = 'Donation amount is missing';
        }
        //validate first name
		if ("" == trim($_POST['first-name'])) {
			$errors['first-name'] = 'First name is missing';
        }

        //validate last name
        if ("" == trim($_POST['last-name'])) {
            $errors['last-name'] = 'Last name is invalid';
        }

        //validate email
        if (!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
            $errors['email'] = 'e-mail is invalid';
        }

        if (count($errors) > 0) {
	    //This is for ajax requests:
        	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                echo json_encode($errors);
                exit;
            }
        }
        else{
             //$_SESSION['isValid'] = true;
             //json_encode($_SESSION['isValid']);
             echo json_encode(array("isValid" =>true));
             exit;
        }
	}
