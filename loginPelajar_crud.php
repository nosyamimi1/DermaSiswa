<?php

include_once 'database.php';

session_start();

if(isset($_POST['create'])) {

    try {
      $emel = $_POST['emel'];
      $password = $_POST['password'];
    
      $stmt = mysqli_query($conn, "SELECT * from fyp_pelajar WHERE emel = '$emel' AND password = '$password' ");
      $row = mysqli_fetch_array($stmt);
      
      $stmt2 = mysqli_query($conn, "SELECT * from fyp_pelajar WHERE emel = '$emel' AND password = '$password' ");
      $count = mysqli_num_rows($stmt2);

      if($count==0){
         echo "<script>alert('Sorry, Your email or password not match. Please try again.');</script>";
      }
      elseif($count==1){
        $status = $row['status'];
        $_SESSION["nama"]=$row['nama'];
        $_SESSION["emel"]=$row['emel'];
        $_SESSION["password"]=$row['password'];
        $_SESSION["phonenum"]=$row['phonenum'];
        $_SESSION["image"]=$row['image'];
        $_SESSION["matricno"]=$row['matricno'];
        $_SESSION["fakulti"]=$row['fakulti'];
        $_SESSION["kolej"]=$row['kolej'];

          echo "<script>alert('Welcome {$_SESSION['matricno']}! You have successfully logged in!');document.location='homePelajar.php'</script>";
        

      }
      
     
    
  }
  catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }

 ?>
