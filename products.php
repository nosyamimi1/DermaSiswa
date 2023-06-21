<?php

session_start();
include 'database.php';

// Establish a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

try {
  // Create a new PDO instance
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  
  // Set PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepare and execute the SQL query
  $stmt = $pdo->prepare("SELECT * FROM fyp_items WHERE owner = :emel");
  $stmt->bindParam(':emel', $_SESSION['emel']);
  $stmt->execute();

  // Fetch all rows from the result
  $result = $stmt->fetchAll();
} catch(PDOException $e) {
  // Handle any errors that occurred during the process
  echo "Error: " . $e->getMessage();
}

// Close the PDO connection
$pdo = null;
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

  <section>
    <td class="addbutton">
      <a href="addproducts.php" class="btn btn-outline-primary" role="button">Add Product</a>
    </td>
  </section>

  <!-- Product List -->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              Products
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Image</th>
                    <th>Stok</th>
                    <th>Tarikh</th>
                    <th>Tindakan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($result as $readrow) {
                    ?>
                    <tr>
                      <td><?php echo $readrow['item_id']; ?></td>
                      <td><?php echo $readrow['item_name']; ?></td>
                      <td><?php echo $readrow['category']; ?></td>
                      <td><img width="50px" height="50px" src="images/<?php echo $readrow['image']; ?>"></td>
                      <td><?php echo $readrow['stock']; ?></td>
                      <td><?php echo $readrow['added_at']; ?></td>
                      <td>
                        <a href="addproducts.php?edit=<?php echo $readrow['item_id']; ?>" name="edit" id="edit" class="btn btn-outline-primary" role="button">Edit</a>
                        <a href="products.php?delete=<?php echo $readrow['item_id']; ?>" name="delete" onclick="return confirm('Are you sure to delete?');" class="btn btn-outline-danger" role="button">Delete</a>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  
</body>
</html>
