<?php 
include_once 'register_crud.php';
include_once 'database.php';


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
    <link rel="stylesheet" href="register.css">

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
                <a class="nav-link" href="login.php">Log Masuk</a>
              </li>
              
            </ul>
            
          </div>
        </div>
      </nav>

    

      <!--Registration Form-->
    <section class="containerregis" >
      <header>Daftar Akaun</header>
      <form action="register.php" method="POST" class="form" id="registerform">

        <div class="column">
         <div class="input-box">
          <label>Nama Syarikat</label>
          <input type="text" id="nama_syarikat" name="nama_syarikat" placeholder="Masukkan nama kedai" required />
        </div>
        </div>

        <div class="column">

         <div class="input-box">
            <label>Nombor Telefon</label>
            <input type="number" id="phonenum" name="phonenum" placeholder="Masukkan nombor telefon" required />
          </div>

          <div class="input-box">
            <label>Alamat e-mel</label>
            <input type="email" id="emel" name="emel" placeholder="Masukkan alamat e-mel" required />
          </div>
        </div>


        <div class="column">

          
          <div class="input-box">
            <label>Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan kata laluan" minlength="8" required />
						</div>

            <div class="input-box">
            <label>Password</label>
            <input type="password" id="cpassword" name="cpassword" placeholder="Masukkan kata laluan" minlength="8" required />
            </div>
        </div>


        

        <div class="input-box">
          <label>Alamat</label>
          <textarea id="story" id="alamat" name="alamat" rows="5" cols="33" placeholder="Masukkan alamat kedai" required></textarea>
           
      </div>
        
      <br>

      <div class="column">
          <div class="select-box"  >
            <select id="jenis_produk" name="jenis_produk">
              <option hidden>Jenis Produk</option>
              <option>Makanan yang dimasak</option>
              <option>Makanan Harian</option>
              <option>Barang Peribadi</option>
              <option>Keperluan Belajar</option>
              <option>Lain-lain</option>
            </select>
          </div>
      </div>

      <br><label>Maklumat individu untuk dihubungi</label>

          <div class="input-box">
            <label>Nama</label>
            <input type="text" id="nama_individu" name="nama_individu" placeholder="Masukkan nama individu" required />
          </div>

          <div class="input-box">
            <label>Nombor Telefon</label>
            <input type="number" id="phonenum_individu" name="phonenum_individu" placeholder="Masukkan nombor telefon" required />
          </div>

      
            <div class="input-box">
              <button type="submit" name="signup" class="btn btn-primary" id="signup">Sign Up</button> 
            </div>
            <p class="small my-4 text-center">Already have an account? <a href="login.php">Log in</a>.</p>

      
        <!--button type="submit">Submit</button-->
      </form>

    </section>
  </body>

 
</html>