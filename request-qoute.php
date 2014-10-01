<html>
<head>
 <style type="text/css">
#container{
 width: 100%;
 height: 100%;
 background: rgba(0, 0, 0, 0.75);
}
#errorContainer{
 text-align: center;
 position: relative;
 top: 40%;
 vertical-align: middle;
 background: #FFF;
 padding: 20px 0;
}
#blueButton{
 background: #00ADFF;
 color: #FFF;
 text-decoration: blink;
 padding: 10px;
}
 </style>
</head>
 <body>
<?php
 
require_once('recaptchalib.php');
 
// Get a key from https://www.google.com/recaptcha/admin/create
$publickey = "";
$privatekey = "";
 
# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;
 
# was there a reCAPTCHA response?
if ($_POST["recaptcha_response_field"]) {
 $resp = recaptcha_check_answer ($privatekey,
 $_SERVER["REMOTE_ADDR"],
 $_POST["recaptcha_challenge_field"],
 $_POST["recaptcha_response_field"]);
 
if ($resp->is_valid) {
 if(isset($_POST['email'])) {
 $email_to = "";
 $email_subject = "";
 
function died($error) {
 echo '<div id="container"><div id="errorContainer">';
 echo $error."<br />";
 echo '<a href="javascript:history.go(-1)" id="blueButton">Go Back And Fix It!</a>';
 echo '</div></div>';
 die();
 }
 }
 
$first_name = $_POST['name']; // required
 $email_from = $_POST['email']; // required
 $telephone = $_POST['telephone']; // not required
 $comments = $_POST['comment']; // required
 $error_message = "";
 $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+.[A-Za-z]{2,4}$/';
 if(!preg_match($email_exp,$email_from)) {
 $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 }
 
 $string_exp = "/^[A-Za-z .'-]+$/";
 if(!preg_match($string_exp,$first_name)) {
 $error_message .= 'The First Name you entered does not appear to be valid.<br />';
 }
 if(strlen($comments) < 2) {
 $error_message .= 'The Comments you entered do not appear to be valid.<br />';
 }
 if(strlen($error_message) > 0) {
 died($error_message);
 }
 
$email_message = "Form details below.nn";
 function clean_string($string) {
 $bad = array("content-type","bcc:","to:","cc:","href");
 return str_replace($bad,"",$string);
 }
 
 $email_message .= "First Name: ".clean_string($first_name)."n";
 $email_message .= "Email: ".clean_string($email_from)."n";
 $email_message .= "Telephone: ".clean_string($telephone)."n";
 $email_message .= "Comments: ".clean_string($comments)."n";
 // create email headers
 $headers = 'From: '.$email_from."rn".
 'Reply-To: '.$email_from."rn" .
 'X-Mailer: PHP/' . phpversion();
 @mail($email_to, $email_subject, $email_message, $headers);
 ?>
 
 <!-- include your own success html here -->
 
 Thank you for contacting us. We will be in touch with you soon.
 <?php
 } else {
 ?>
 <div id="container">
 <div id="errorContainer">
 <p>Wrong Captcha Answer! Are you sure you're not a robot?</p>
 <a href="javascript:history.go(-1)" id="blueButton">Go Back And Prove It!</a>
 </div>
 </div>
 <?php
 }
}
echo recaptcha_get_html($publickey, $error);
?>
 
</body>
</html>