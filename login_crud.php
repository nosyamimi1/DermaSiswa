<?php

include_once 'database.php';

session_start();

if(isset($_POST['create'])) {

    try {
      $emel = $_POST['emel'];
      $password = $_POST['password'];
    
      $stmt = mysqli_query($conn, "SELECT * from fyp_vendors WHERE emel = '$emel' AND password = '$password' ");
      $row = mysqli_fetch_array($stmt);
      
      $stmt2 = mysqli_query($conn, "SELECT * from fyp_vendors WHERE emel = '$emel' AND password = '$password' ");
      $count = mysqli_num_rows($stmt2);

      if($count==0){
         echo "<script>alert('Sorry, Your email or password not match. Please try again.');</script>";
      }
      elseif($count==1){
        $status = $row['status'];
        $_SESSION["status"]=$row['status'];
        $_SESSION["vendor_id"]=$row['vendor_id'];
        $_SESSION["emel"]=$row['emel'];
        $_SESSION["alamat"]=$row['alamat'];
        $_SESSION["phonenum"]=$row['phonenum'];
        $_SESSION["jenis_produk"]=$row['jenis_produk'];
        $_SESSION["nama_individu"]=$row['nama_individu'];
        $_SESSION["phonenum_individu"]=$row['phonenum_individu'];
        $_SESSION["password"]=$row['password'];
        $_SESSION["nama_syarikat"]=$row['nama_syarikat'];
        $_SESSION["image"]=$row['image'];
        $_SESSION["role_as"]=$row['role_as'];

        if ($_SESSION["role_as"] == 1) {
          echo "<script>alert('Welcome {$_SESSION['nama_syarikat']}! You have successfully logged in!');document.location='admin.php'</script>";
        }


        else {
          if($status=="Approved"){
          
          echo "<script>alert('Welcome {$_SESSION['nama_syarikat']}! You have successfully logged in!');document.location='homeVendor.php'</script>";
          }
          elseif ($status=="Pending") {
          echo "<script>alert('Your account is still pending for approval!');document.location='login.php'</script>";
          }
          elseif ($status=="Rejected") {
          echo "<script>alert('Your account registration is rejected. Please register again');document.location='login.php'</script>";
          }
       
        }
      }
      
     
    
  }
  catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }


  

 ?>
