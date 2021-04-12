<?php
if(isset($_POST['email']))
{
    $email_to = "kyle28marshall@gmail.com";
    $email_subject = 'BBD New Client Email';
    
    function died($error){
        echo "We are very sorry, but there were error(s) found with the form<br />";
        echo "There errors appeared below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors<br /><br />";
        die();
    }
    
    if(!isset($_POST['firstname']) || 
       !isset($_POST['lastname']) || 
       !isset($_POST['email']) || 
       !isset($_POST['phone']) ||
       !isset($_POST['message'])) {
        died('We are very sorry, but there were error(s) found with the form');
    } 
    
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $num = $_POST['phone'];
    $mes = $_POST['message'];
    $cur = $_POST['curSite'];
    $devType = $_POST['developmentType'];
    $gdevType = $_POST['gdevelopmentType'];
    $finishDate = $_POST['startdate'];
    
    
    
    
    $error_message ="";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error_message .= "Email is not valid" .$email."\n";
        died('We are very sorry, but there were error(s) found with the form');
		
	}
    if(strlen($mes) < 2 ){
        $error_message .= 'The Message does not appear to be valid. Length must be greater than 2 characters.<br />';
    }
    if(strlen($error_message) > 0 ){
        died($error_message);
    }
    $email_message = "Form details below.\n\n";
    
    function clean_string($string){
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }
    
    $email_message .= "First Name: ".clean_string($fname)."\n";
    $email_message .= "Last Name: ".clean_string($lname)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Message: ".clean_string($mes)."\n";
    $email_message .= "Current Website Link: ".clean_string($cur)."\n";
    $email_message .= "Development Type: ".clean_string($devType)."\n";
    $email_message .= "Graphic Design: ".clean_string($gdevType)."\n";
    $email_message .= "Expected Finish Date: ".clean_string($finishDate)."\n";
    
    $headers = 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n".
    'X-Mailer:PHP/'.phpversion();
    mail($email_to,$email_subject,$email_message, $headers);
echo "Thank you for contacting us. We will be in touch with you very soon.";
?>
<?php
}
?>
