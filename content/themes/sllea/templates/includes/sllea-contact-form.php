<?php
	class SlleaContactForm {
		public $contact_fields;
		public $form_errors;

		function __construct() {
			$contact_fields = array();
			$form_errors = array();
			add_shortcode('sllea_contact_form', array($this, 'shortcode'));
		}

		public function form() {
			ob_start(); ?>
				<form method="post">
					<div id="name" class="field-wrap">
						<label class="title" for="sender-name">Name</label>
						<input name="sender-name" type="text" value="<?php echo $this->contact_fields['sender-name']; ?>" />
					</div>
					<div id="email" class="field-wrap" class="required">
						<label class="title" for="email">Email</label>
						<span class="error"><?php echo $this->form_errors['email']; ?></span><br />
						<input name="email" type="text" value="<?php echo $this->contact_fields['email']; ?>"/>
					</div>
					<div id="subject" class="field-wrap">
						<label class="title" for="subject">Subject</label>
						<input name="subject" type="text" value="<?php echo $this->contact_fields['subject']; ?>" />
					</div>
					<div id="message" class="field-wrap" class="required">
						<span class="error"><?php echo $this->form_errors['message']; ?></span><br />
						<label class="title" for="message">Message</label>
						<textarea id="message" name="message" rows=10 ><?php echo $this->contact_fields['message']; ?></textarea>
					</div>
					<input class="submit red" type="submit" name="submit" value="send" />
				</form>
			<?php return ob_get_clean();
		}

		public function process_form() {
			$this->form_errors['email'] = "";
			$this->form_errors['message'] = "";

			if(isset($_POST['submit'])) {
				$this->contact_fields['sender-name'] = trim($_POST['sender-name']);
				$this->contact_fields['email'] = trim($_POST['email']);
				$this->contact_fields['subject'] = trim($_POST['subject']);
				$this->contact_fields['message'] = trim($_POST['message']);


				$this->form_errors['message'] = ((empty($this->contact_fields['message']) == 0) ? "" : "Please Enter a message to send");
				$this->form_errors['email']   = (((empty($this->contact_fields['email']) == 0) && (filter_var($this->contact_fields['email'], FILTER_VALIDATE_EMAIL))) ? "" : "Please enter a valid email address");

				if ($this->form_errors['email'] == "" && $this->form_errors['message'] == "") {
					$this->send_mail();
				}
			}
			return $this->form();
		}

		public function send_mail() {
			$sllea_email = "Mirabel Rice <rice122@mail.chapman.edu>" . "\r\n"; //change to info@sllea.org
			$sllea_header = "From: " . $this->contact_fields['email'];
			$sllea_body = $this->contact_fields['sender-name'] . " submitted the following message:\n\n" . $this->contact_fields['message'];
			$confirmation_header = "From: SLLEA <rice122@mail.chapman.edu>";
			$confirmation_subj = "SLLEA: Copy of your submission";
			$confirmation_body = "Here is a copy of your message:\n\n" .$this->contact_fields['message'];

			if( wp_mail($sllea_email, $this->contact_fields['subject'], $sllea_body, $sllea_header) ) {
				//wp_mail($this->contact_fields['email'], $confirmation_subj, $confirmation_body, $confirmation_header); // Send a copy of the message to the sender
				echo "<br /><br /><span style='color:#a8b411;text-align;center;'>Your message has been sent. Thank you!</span>";
			}
		}

		public function shortcode() {
			return $this->process_form();
		}

	}

	new SlleaContactForm;
?>