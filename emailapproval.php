<?php

require_once 'contact/PHPMailer.php';
require_once 'contact/Exception.php';
require_once 'contact/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

include('database.php');

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$mail = new PHPMailer(true);

function sendValidationEmail($to, $name)
{
    global $mail;

    $mail-> isSMTP();
    $mail-> Host ='smtp.gmail.com';
    $mail-> SMTPAuth = true;
    $mail-> Username = 'a181342@siswa.ukm.edu.my';
    $mail-> Password = 'mimi1705';
    $mail-> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail-> Port = '587';


    $mail->setFrom('a181342@siswa.ukm.edu.my', 'Email Approved');
            // get email from input
    $mail->addAddress($_POST["emel"]);

    $mail->Subject = 'Account Approved';
    $mail->Body = "Dear $name,\n\nYour account has been approved by the admin. You can now login to your account.";

    try {
        $mail->send();
        echo 'Email sent successfully.';
    } catch (Exception $e) {
        echo 'Email could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}

// Assume you have a form where the admin approves a user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_syarikat = $_POST['nama_syarikat'];
    $emel = $_POST['emel'];


    // Perform the validation and approval process
    // ...

    // Retrieve the user's email and name from the database
    $stmt = $conn->prepare("SELECT emel, nama_syarikat FROM fyp_vendors WHERE emel = ?");
    $stmt->bind_param("s", $emel);
    $stmt->execute();
    $stmt->bind_result($emel, $nama_syarikat);
    $stmt->fetch();
    $stmt->close();

    // Send the validation email to the user
    sendValidationEmail($emel, $nama_syarikat);
}
?>
