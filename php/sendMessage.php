<?php

$messageAbout = "";
$full_name = "";
$email = "";
$phone = "";
$message = "";
$msg = '';

$response = array(
    "Error" => true,
    "ErrorType" => array("errorMessage")
);

$to = "kashanshah@hotmail.com";
$subject = "A new contact form submission at www.kashanshah.tk about ".$messageAbout;
$message = "A new contact form submission has been recieved on www.kashanshah.tk. Following are the details: <br/>Name: ".$full_name."<br/>Email: ".$email."<br/>Phone: ".$phone."<br/>Message: ".$msg."<br/>";
$headers = "from: do-not-reply@kashanshah.tk\r\n";
$headers .= "Content-type: text/html\r\n";

$mail = @mail($to, $subject, $message, $headers);
if($mail){
    $response = array(
        "SuccessMessage" => "SuccessMessage"
    );
}
else{
    $response = array(
        "Error" => true,
        "ErrorType" => array("errorMessage")
    );
}

echo json_encode($response);