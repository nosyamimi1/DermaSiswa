<?php 

include_once 'database.php';

if(empty($_SESSION)) {
    session_start();
  }
  
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  if(isset($_POST['signup'])) {

    
  
    try {
  
      $stmt = $conn->prepare("SELECT * from fyp_vendors WHERE emel = :emel");
      $stmt->bindParam(':emel', $_POST['emel'], PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      //echo $count; die(); //to check  masuk ke tak
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
  
      $stmt = $conn->prepare("SELECT * from fyp_vendors WHERE nama_syarikat = :nama_syarikat");
      $stmt->bindParam(':nama_syarikat', $_POST['nama_syarikat'], PDO::PARAM_STR);
      $stmt->execute();
      $count1 = $stmt->rowCount();
      //echo $count; die(); //to check  masuk ke tak
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
  
      if ($count1 > 0) {
        echo "<script>alert('Sorry, Company Name has already exist. Please use a different name.');</script>";
      }
      
      if ($count > 0) {
        echo "<script>alert('Sorry, email has already exist. Please use a different email.');</script>";
      }
  
      else if($count == 0 && $count1 == 0) {
  
        $stmt = $conn->prepare("INSERT INTO fyp_vendors (nama_syarikat, phonenum, emel, password, alamat, jenis_produk, nama_individu, phonenum_individu, status) VALUES (:nama_syarikat, :phonenum, :emel, :password, :alamat, :jenis_produk,:nama_individu, :phonenum_individu, 'Pending')");


        $nama_syarikat = $_POST['nama_syarikat'];
        $phonenum = $_POST['phonenum'];
        $emel = $_POST['emel'];
        $password = $_POST['password'];
        $alamat = $_POST['alamat'];
        $jenis_produk = $_POST['jenis_produk'];
        $nama_individu = $_POST['nama_individu']; 
        $phonenum_individu = $_POST['phonenum_individu'];
  
        $stmt->bindParam(':nama_syarikat', $nama_syarikat, PDO::PARAM_STR);
        $stmt->bindParam(':phonenum', $phonenum, PDO::PARAM_STR);
        $stmt->bindParam(':emel', $emel, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':alamat', $alamat, PDO::PARAM_STR);
        $stmt->bindParam(':jenis_produk', $jenis_produk, PDO::PARAM_STR);
        $stmt->bindParam(':nama_individu', $nama_individu, PDO::PARAM_STR);
        $stmt->bindParam(':phonenum_individu', $phonenum_individu, PDO::PARAM_STR);
  
        $stmt->execute();
        
        echo "<script>alert('Welcome! You have successfully registered!');document.location='login.php'</script>";
        if(!session_id()) 
          session_start();
        //header("Location: loginSP.php");
      }
      
    }
    catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  

?>