<?php

$messageAbout = "";
$full_name = "";
$email = "";
$phone = "";
$message = "";
$msg = '';
${'g-recaptcha-response'} = '';

$response = array(
    "Error" => true,
    "ErrorType" => array("errorMessage")
);

foreach ($_POST as $key => $val)
    $$key = $val;
$captchaResponse = ${'g-recaptcha-response'};
$url = "https://www.google.com/recaptcha/api/siteverify";
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    "secret=6Ldly6UUAAAAACWdxpK5F5s90_rduyXbCjNvcqnk&response=".$captchaResponse);

// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS,
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);

$res = json_decode($server_output);
if($res->success == true){
    $to = "kashanshah@hotmail.com";
    $subject = "A new contact form submission at www.kashanshah.tk about ".$messageAbout;
    $msg = "A new contact form submission has been recieved on www.kashanshah.tk. Following are the details: <br/>Name: ".$full_name."<br/>Email: ".$email."<br/>Phone: ".$phone."<br/>Message: ".$message."<br/>";
    $headers = "from: do-not-reply@kashanshah.tk\r\n";
    $headers .= "Content-type: text/html\r\n";

    $mail = @mail($to, $subject, $msg, $headers);
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
}
else{
    $response = array(
        "Error" => true,
        "ErrorType" => array("errorCaptcha")
    );
}


echo json_encode($response);