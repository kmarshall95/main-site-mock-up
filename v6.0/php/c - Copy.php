<?php
//define variables and set to empty values
$fname = $lname = $email = $num = $site = $dev = $gdev = $graph = $sdate = $mes = "";
$fnameErr = $lnameErr = $emailErr = $numErr = $siteErr = $devErr = $gdevErr = $graphErr = $dateErr = $mesErr = "";

$email_to = "kylemarshall@bluebrothersdesigns.com";
$subject = 'BBD New Client Email';

//Validation to see if form has been completed fully
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["firstname"])){
        $fnameErr = "First Name is Required";
    }else{
        $fname = $_POST["firstname"];
    }
    if(empty($_POST["lastname"])){
        $lnameErr = "Last Name is Required";
    }else{
        $lname = $_POST["lastname"];
    }
    if(empty($_POST["email"])){
        $emailErr = "Email is Required";
    }else{
        $email = $_POST["email"];
    }
    if(empty($_POST["phone"])){
        $numErr = "Phone is Required";
    }else{
        $num = $_POST["phone"];
    }
    if(empty($_POST["curSite"])){
        $siteErr = "Website is Required";
    }else{
        $site = $_POST["curSite"];
    }
    if(empty($_POST["developmentType"])){
        $devErr = "Development Type is Required";
    }else{
        $dev = $_POST["developmentType"];
    }
    if(empty($_POST["gdevelopmentType"])){
        $gdevErr = "Graphic Development Type is Required";
    }else{
        $gdev = $_POST["gdevelopmentType"];
    }
    if(empty($_POST["sdate"])){
        $dateErr = "Date is Required";
    }else{
        $sdate = $_POST["sdate"];
    }
}

    function died($error){
        echo "We are very sorry, but there were error(s) with the form you submitted. ";
        echo "Please Fix The Errors";
        echo $error."<br/><br/>";
        echo "Please go back and fix these errors<br/><br/>";
        die();
    }
    
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    
if(!preg_match($email_exp,$email)){
    $error_message .= 'Please Enter a Valid Email Address.<br />';
}
$string_exp = "/^[A-Za-z .'-]+$/";

if(!preg_match($string_exp,$fname)){
    $error_message .= 'First Name is not a valid name.<br />';
}if(!preg_match($string_exp,$lname)){
    $error_message .= 'Last Name is not a valid name.<br />';
}
if(strlen($mes) > 3){
    $error_message .= "Message must be longer than 3 characters";
}
if(strlen($error_message) > 0) {
    died($error_message);
}

    $email_message ="Form details below. \n\n";

    function clean_string($string){
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad,"",$string);
    }

$email_message .= "First Name: ".clean_string($fname)."\n";
$email_message .= "Last Name: ".clean_string($lname)."\n";
$email_message .= "Email: ".clean_string($email)."\n";
$email_message .= "Telephone: ".clean_string($num)."\n";
$email_message .= "Message: ".clean_string($mes)."\n";

//headers
$headers = 'From: ' .$email."\r\n".
    'Reply-To: '.$email ."\r\n" .
    'X-Mailer: PHP/' . phpversion();
mail($email_to, $subject, $email_message, $headers);
//<!-- include your own success html here -->
 
echo "Thank you for contacting us. We will be in touch with you very soon.";
 
?>