<?php
session_start();

//$conn = mysqli_connect($servername,$username,$password);

include('database.php');


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
  $stmt = $conn->prepare("SELECT * FROM fyp_vendors WHERE emel = '".$_SESSION['emel']."'");
  $stmt->execute();

  $result = $stmt->fetchAll();
}
catch(PDOException $e)
{
        echo "Error: " . $e->getMessage();
    }
 
$conn = null;

include_once 'products_crud.php';


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
    <link rel="stylesheet" href="products.css">

    <style>
        .form-control {
            border: 1px solid #b3a1a1 !important;
            padding: 8px 10px;
        }
        </style>

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

      <div class="container">
      <form action="addproducts.php" method="POST" enctype="multipart/form-data">
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4> Add Category</h4>

                <input class="input-field2" name="owner" id="owner" value="<?php echo "{$_SESSION['emel']}" ?>" type="hidden">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                    <label for="">Product ID</label>
                <input type="text" name="item_id" id="item_id" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['item_id']; ?>" required>
                    </div>
                    <div class="col-md-6">
                    <label for="">Product Name</label>
                <input type="text" name="item_name" id="item_name" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['item_name']; ?>" required>   
                    </div>
                </div>

                <div class="row">
                <div class="col-md-12">
                <div class="column">
          <!--div class="selectpicker"  data-style="btn-primary" required>
            <select id="category" name="category" value="<?php if(isset($_GET['edit'])) echo $editrow['category']; ?>" required>
              <option hidden>Jenis Produk</option>
              <option>Makanan yang dimasak</option>
              <option>Makanan Harian</option>
              <option>Barang Peribadi</option>
              <option>Keperluan Belajar</option>
              <option>Lain-lain</option>
            </select>
          </div-->

          <div class="selectpicker" data-style="btn-primary" required>
  <select id="category" name="category" required>
    <option hidden>Jenis Produk</option>
    <option <?php if(isset($_GET['edit']) && $editrow['category'] == 'Makanan yang dimasak') { echo 'selected'; } ?>>Makanan yang dimasak</option>
    <option <?php if(isset($_GET['edit']) && $editrow['category'] == 'Makanan Harian') { echo 'selected'; } ?>>Makanan Harian</option>
    <option <?php if(isset($_GET['edit']) && $editrow['category'] == 'Barang Peribadi') { echo 'selected'; } ?>>Barang Peribadi</option>
    <option <?php if(isset($_GET['edit']) && $editrow['category'] == 'Keperluan Belajar') { echo 'selected'; } ?>>Keperluan Belajar</option>
    <option <?php if(isset($_GET['edit']) && $editrow['category'] == 'Lain-lain') { echo 'selected'; } ?>>Lain-lain</option>
  </select>
</div>


      </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <label for="">Bilangan Stok</label>
                <input type="number" name="stock" id="stock" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['stock']; ?>" required>   
                    </div>

                    <div class="col-md-3">
                    <label for="">Tarikh</label>
                <input type="date" name="added_at" id="added_at" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['added_at']; ?>" required>   
                    </div>
                </div>
                <div class="row">
                 <div class="col-md-6">
                    <label for="">Muatnaik Gambar Produk</label>
                <input type="file" name="image" id="image" class="form-control" required>   
                </div>
                </div>

                <div class="col-md-6">
                <input type="submit" name="create" class="btn btn-primary btn-block" value="Add Product" >

                    </div>
                </div>

                
                  

                
                    
                       
                    
            </div>

        </div>
    </div>
      </form>
    </div>
    
</div>
