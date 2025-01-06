<?php

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

$mail = require __DIR__ . "/mailer.php";

$mail->setFrom("noreply@cocol.gr");
$mail->addAddress("info@cocol.gr");

$mail->Subject = $subject;
$mail->Body = $name." <br>".$email." <br><br>".$message;


try {

    $mail->send();

} catch (Exception $e) {

    echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

}
//echo "Thank you for sending us an email.";

header("Location: ../sent_mail.html");