<?php

include_once 'database.php';

// $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if (isset($_POST['approve'])) {
    $emel= $_POST['emel'];
    
    $select = "UPDATE fyp_vendors SET status='Approved' WHERE emel ='$emel'";
    $result = mysqli_query($conn, $select);

    echo "<script>alert('Vendor Account had been Approved!');document.location='validate_registration.php'</script>";
    
}

if (isset($_POST['reject'])) {
    $emel= $_POST['emel'];
 
    $select = "UPDATE fyp_vendors SET status='Rejected' WHERE emel ='$emel'";
    $result = mysqli_query($conn, $select);

    echo "<script>alert('Vendor Account had been Rejected!');document.location='validate_registration.php'</script>";
    
}
?>