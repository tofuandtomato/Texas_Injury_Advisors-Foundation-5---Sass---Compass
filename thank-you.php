<?php include('partials/header.php'); ?>

    <section id="background-top"></section>

    <section id="page" class="row" data-equalizer>
	
		<?php include('partials/header-call.php'); ?>

		<div class="page-content large-12 columns container-box box">
			<h2 class="page-title">Thank you</h2>		
			<?php

			date_default_timezone_set('America/Los_Angeles');

			if(isset($_REQUEST['submit'])) {

					$eol="\r\n";

					$name  = trim($_REQUEST['name']);
					$email = trim($_REQUEST['email']);
					$phone = trim($_REQUEST['phone']);
					$body  = trim($_REQUEST['dropdown']);
					$case = trim($_REQUEST['details']);

					$adgroup = trim($_REQUEST['adgroup']);
					$keyword = trim($_REQUEST['keyword']);
					$campaign = trim($_REQUEST['campaign']);


					$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
					$CURRENT_PAGE = $_SERVER['HTTP_REFERER'];

					$message  = "Lead Generated on: " . date('l dS \of F Y - h:i:s A') . $eol . $eol;
					$message .= "IP: $REMOTE_ADDR" . $eol . $eol;
					$message .= "Name: $name" . $eol;
					$message .= "Email: $email" . $eol;
					$message .= "Phone: $phone" . $eol;
					$message .= "Dropdown: $dropdown" . $eol;
					$message .= "Case: $details" . $eol;
					$message .= "Current Page: $CURRENT_PAGE" . $eol;

					$message .= "Adgroup: $adgroup" . $eol;
					$message .= "Keyword: $keyword" . $eol;
					$message .= "Campaign: $campaign" . $eol;


					$ip = $REMOTE_ADDR;
					$current_page = $CURRENT_PAGE;
					$data = "name=$name&email=$email&phone=$phone&body=$body&adgroup=$adgroup&keyword=$keyword&campaign=$campaign&ip=$ip&current_page=$current_page";
					$message .= "\n";
					$subject = "TexasInjuryAdvisors - $campaign Case Request - " . date('h:i:s A');

					//send_mail("jared@juicyshops.com", "TexasInjuryAdvisors.com");
					if(send_mail("tien@tofuandtomato.com", $message, $subject, 'info@tofuandtomato.com', 'TexasInjuryAdvisors.com')) {
						?>
							<div data-alert class="alert-box success radius">
							  	Your message has been sent to administator. Thank you for contacting us.
							  <a href="#" class="close">&times;</a>
							</div>
							 <?php include('includes/thank-you-conversion.php'); ?>

						<?php
					} else {
						?>
							<div data-alert class="alert-box error radius">
							  	An error occurred. Please try again later.
							  <a href="#" class="close">&times;</a>
							</div>
						<?php
					}

			}

			function send_mail($to, $body, $subject, $fromaddress, $fromname)
			{
				  $eol="\r\n";
				  $mime_boundary=md5(time());

				  # Common Headers
				//  $headers .= "From: ".$fromname."<".$fromaddress.">".$eol; Appending values to newly create variable leads to runtime error

				  $headers = "From: ".$fromname."<".$fromaddress.">".$eol;
				  $headers .= "Reply-To: ".$fromname."<".$fromaddress.">".$eol;
				  $headers .= "Return-Path: ".$fromname."<".$fromaddress.">".$eol;    // these two to set reply address
				  $headers .= "Message-ID: <".time()."-".$fromaddress.">".$eol;
				  $headers .= "X-Mailer: PHP v".phpversion().$eol;          // These two to help avoid spam-filters
				  $headers .= 'MIME-Version: 1.0'.$eol.$eol;


				  # Text Version
				  //$msg .= $body.$eol.$eol; Appending values to newly create variable leads to runtime error
				   $msg = $body.$eol.$eol;

				  # SEND THE EMAIL
				  //ini_set(sendmail_from,$fromaddress); Incorrect format
				  ini_set('sendmail_from',$fromaddress);  // the INI lines are to force the >From Address to be used !
				  $mail_sent = mail($to, $subject, $msg, $headers);
				  //ini_restore(sendmail_from); Incorrect format
				  ini_restore('sendmail_from');

				  return $mail_sent;
			}
			?>
		
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		</div><!-- end .page-content -->
    </section> 
    <br>
    <br>
    <br>

<?php include('partials/footer.php'); ?>