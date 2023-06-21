<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once 'contact/Exception.php';
require_once 'contact/PHPMailer.php';
require_once 'contact/SMTP.php';

$alert = '';

$mail = new PHPMailer(true);

if (isset($_POST['submit'])) {
    
    $name = $_POST['name'];
    $emel = $_POST['emel'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    try {
        $mail-> isSMTP();
        $mail-> Host ='smtp.gmail.com';
        $mail-> SMTPAuth = true;
        $mail-> Username = 'a181342@siswa.ukm.edu.my';
        $mail-> Password = 'mimi1705';
        $mail-> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail-> Port = '587';

        $mail-> setFrom('a181342@siswa.ukm.edu.my');
        $mail-> addAddress('a181342@siswa.ukm.edu.my');

        $mail-> isHTML(true);
        $mail-> Subject = "Message Received (Contact Page)";
        $mail-> Body = '<h3>Name : '.$name. '<br>Email: '.$emel. '<br>Phone Number: '.$phone. '<br>Message:' .$message.'</h3>';

        $mail->send();
        $alert = '<div class="alert-success"> 
                 <span> Message Sent! </span>
                 </div>';
        

    } catch (Exception $e) {
        $alert = '<div class="alert-error"> 
                 <span>Message Not Send</span>
                 </div>';
    }

}

?>
