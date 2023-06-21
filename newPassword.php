<?php

session_start();

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
    <link rel="stylesheet" href="login.css">

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
                <a class="nav-link" href="register.php">Daftar Masuk</a>
              </li>
              
            </ul>
            
          </div>
        </div>
      </nav>

      <section>
        <div class="form-box">
            <div class="form-value">
                <form action="#" method='post'>
                    <h2>New Password</h2>

                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>         
                        <input type="password" id='password' name='password' required>
                        <label for="">Password</label>
            
                    </div>

                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" id='cpassword' name='cpassword' required>
                        <label for="">Confirm Password</label>
                    </div>

                    <button type="submit" name="changepass" id="changepass" >Simpan Kata Laluan</button>

                </form>
            </div>
        </div>
      </section>
  </body>
</html>

<?php
    if(isset($_POST["changepass"])){
        include('database.php');
        $password = $_POST["password"];

        $token = $_SESSION['token'];
        $emel = $_SESSION['emel'];

        $hash = password_hash( $password , PASSWORD_DEFAULT );

        $sql = mysqli_query($conn, "SELECT * FROM fyp_vendors WHERE emel='$emel'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if($emel){
            $new_pass = $hash;
            mysqli_query($conn, "UPDATE fyp_vendors SET password='$password' WHERE emel='$emel'");
            ?>
            <script>
                window.location.replace("login.php");
                alert("<?php echo "Your password has been successfully reset"?>");
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("<?php echo "Please try again"?>");
            </script>
            <?php
        }
    }

?>
<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function(){
        if(password.type === "password"){
            password.type = 'text';
        }else{
            password.type = 'password';
        }
        this.classList.toggle('bi-eye');
    });
</script>

