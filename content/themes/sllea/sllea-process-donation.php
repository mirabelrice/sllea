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
        /*
        //validate address
        if("Please Select a Country" === $_POST['country']) {
            $errors['country'] = 'country is invalid'; 
        }
        if("" == trim($_POST['billing-addr-1'])) {
             $errors['billing-addr-1'] = 'address line 1 is missing'; 
        }

        if("" == trim($_POST['billing-city'])) {
            $errors['billing-city'] = 'city is missing';
        }
        if("Please Select a State" === $_POST['state']) {
            $errors['state'] = 'state is invalid';
        }
        if("" == trim($_POST['billing-zip'])) {
            $errors['billing-zip'] = 'zip code is missing';
        }
*/
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
