<?php

namespace App\Logic;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailSender {
    
    static public function send($emails, $content){

        $from = 'noreply@smartseminarsuit.com';
        $subject = 'SmartSeminar Suit';
        $message = 'Good Day! Attached file is the certificate from the event.';
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth   = true; 
            $mail->Username   = 'caramelmacchiato209@gmail.com'; // SMTP username
            $mail->Password   = 'sbph tbsn aufm wbai'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port       = 587; // TCP port to connect to
    
            // Recipients
            $mail->setFrom($from, 'Mailer');        

            $to_list = explode(",", $emails);
            foreach ($to_list as $key => $email) {
                $mail->addAddress($email); // Add a recipient
            }

            // Content            
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AddStringAttachment($content, "certificate.pdf", 'base64', 'application/pdf');
            $mail->isHTML(true); // Set email format to HTML

            $mail->send();
            return true;
        } catch (Exception $e) {
            // Handle error
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            // return false;
        }
    }

}

?>