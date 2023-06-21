<?php

include('adminMiddleware.php');

if (!isset($_SESSION)) {
	session_start();
}




$servername = "lrgs.ftsm.ukm.my";
$username = "a181342";
$password = "hugegrayhamster";
$dbname = "a181342";

$conn = mysqli_connect($servername,$username,$password);


include_once 'validate_registration_crud.php';
//include_once "emailapproval.php";
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="validate_registration.css">

    <title>DermaSiswa</title>
  </head>
  <body>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="#"><span class="text-danger">Derma</span>Siswa</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

              <li class="nav-item">
                <a class="nav-link" href="homepage.php">Laman Utama</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#">Tentang Kami</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#">Hubungi Kami</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Keluar</a>
              </li>
              
            </ul>
            
          </div>
        </div>
      </nav>

      <section id="service" class="services">
   
   <h3 class="heading-title" style="margin-bottom: auto;">New Request</h3>
   

   

</section>
<section class="table-responsive" id="table-responsive">
<table class="center" >
    <thead class="thead-dark">
    <tr>
      <th scope="col">Nama Syarikat</th>
      <th scope="col">Emel Syarikat</th>
      <th scope="col">Status</th>
      <th scope="col">Tindakan</th>

    </tr>
    </thead>
  <tbody>
   <?php
   $per_page = 40;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;
   try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "select * from fyp_vendors WHERE status='Pending'";
           $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
    }
    catch(PDOException $e){
        echo "Error: " . $e->getMessage();
      }
    foreach($result as $readrow) {
      ?>   
      <tr>
        <td name="nama_syarikat" id="nama_syarikat"><?php echo $readrow['nama_syarikat']; ?></td>
        <td name="emel" id="emel"><?php echo $readrow['emel']; ?></td>
        <td name="status" id="status"><?php echo $readrow['status']; ?></td>
        
        <td>
          <form action="validate_registration.php" method="POST">
            <input type="hidden" id="emel" name="emel" value ="<?php echo $readrow['emel']; ?>"></>
            <input type="submit" class="btn btn-outline-primary" name="approve" value="Approve" role="button" ></>
            <input type="submit" class="btn btn-outline-danger" name="reject"  value="Reject" role="button"  onclick="return confirm('Are you sure to reject account registration?');"></>
          </form>
        </td>
      </tr>

      <?php
    }
      $conn = null;
      ?>
   
  </tbody>
</table>

</section>
  </body>
</html>

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

