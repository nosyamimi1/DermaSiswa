<?php

require_once 'database.php';

$sql = "SELECT * from fyp_vendors";
$all_product = $conn -> query($sql);



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
  <link rel="stylesheet" href="test.css">

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

  <main>
    <?php

    while($row = mysqli_fetch_assoc($all_product)) {

    


?>
    <div class="card">
        <div class="image">
           <img src="images/<?php echo $row['image']?>" height="200" width="200">

         </div>
    <div class="caption">
        <p class= "product_name"><?php echo $row['nama_syarikat']?> </p>
        <p class= "alamat"><?php echo $row['alamat'] ?> </p>
        <p class= "Kategori"><?php echo $row['jenis_produk'] ?> </p>
    </div>
    <button class="add">Book</button>
    </div>
    <?php
    }
    ?>
  </main>
