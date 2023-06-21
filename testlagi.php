<?php
session_start();
include('database.php');
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <script src="js/jquery-3.7.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery-ui/jquery-ui-1.13.2/jquery-ui.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="search.css">

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
            <a class="nav-link" href="homePelajar.php">Laman Utama</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Tentang Kami</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Hubungi Kami</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profilepelajar.php">Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log Keluar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
        <div class="row">
         <br/>
         <h2 align="center">Search Vendor</h2>
         <br />
            <div class="col-md-3">                    
              <div class="list-group">
                <h3>Kategori</h3>
                    <?php

                    $query = "
                    SELECT DISTINCT(jenis_produk) FROM fyp_vendors ORDER BY jenis_produk DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector ram" value="<?php echo $row['jenis_produk']; ?>" > <?php echo $row['jenis_produk']; ?></label>
                    </div>
                    <?php    
                    }

                    ?>
              </div>
           </div>
              <div class="col-md-9">
             <br />
                <div class="row filter_data">

                </div>
            </div>
        </div>

    </div>
<style>
#loading
{
 text-align:center; 
 background: url('loader.gif') no-repeat center; 
 height: 150px;
}
</style>

<script>
  $(document).ready(function(){

filter_data();

function filter_data() {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'search_fetch';
        var jenis_produk = get_filter('jenis_produk');
        $.ajax({
            url:"search_fetch.php",
            method:"POST",
            data:{action:action, jenis_produk:jenis_produk},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
}

function get_filter(class_name) {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

  });
</script>

  

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-DXxRDkZVt/CYB8Lo6u4M9JrA04b5UL8hj1dpbku7dmDNYwoXyv7mNCcr3iX/3a+x" crossorigin="anonymous"></script>
</body>
</html>
