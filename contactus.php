<?php

include_once "message.php";


?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="contactus.css">

    <title>DermaSiswa</title>
  </head>
  <body>

  <?php echo $alert; ?>

    

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
                <a class="nav-link" href="homeVendor.php">Laman Utama</a>
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

      

      <div class="wrapper">
        <header>Hubungi Kami</header>

     

        <form action="" method="POST">
            <div class="dbl-field">

                <div class="field">
                    <input type="text" name="name" id="name" placeholder="Masukkan nama anda">
                    <i class="fas fa-user"></i>
                </div>

                <div class="field">
                    <input type="text" name="emel" id="emel" placeholder="Masukkan emel anda">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="field">
                    <input type="text" name="phone" id="phone" placeholder="Masukkan nombor telefon (tanpa '-')">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="message1">
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Write Your Message"></textarea>
                    <i class="material-icons"></i>
                </div>
                <div class="button-area">
                    <button type="submit" name="submit">Send Message</button>
                </div>


            </div>
        </form>
      </div>
  </body>
  <script type="text/javascript">
    if(window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }

  </script>