<?php
session_start();
include "database.php";

if (empty($_SESSION)) {
    header("Location: login.php");
    exit();
}

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Update profile
if (isset($_POST['update'])) {
    try {
        $stmt = $conn->prepare("UPDATE fyp_vendors SET
            nama_syarikat = :nama_syarikat, alamat = :alamat, phonenum = :phonenum, password = :password,
            nama_individu = :nama_individu, phonenum_individu = :phonenum_individu
            WHERE emel = :emel");

        $stmt->bindParam(':nama_syarikat', $_POST['nama_syarikat'], PDO::PARAM_STR);
        $stmt->bindParam(':alamat', $_POST['alamat'], PDO::PARAM_STR);
        $stmt->bindParam(':phonenum', $_POST['phonenum'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $_POST['password'], PDO::PARAM_STR);
        $stmt->bindParam(':nama_individu', $_POST['nama_individu'], PDO::PARAM_STR);
        $stmt->bindParam(':phonenum_individu', $_POST['phonenum_individu'], PDO::PARAM_STR);
        $stmt->bindParam(':emel', $_SESSION['emel'], PDO::PARAM_STR);

        $stmt->execute();

        $_SESSION['nama_syarikat'] = $_POST['nama_syarikat'];
        $_SESSION['alamat'] = $_POST['alamat'];
        $_SESSION['phonenum'] = $_POST['phonenum'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['nama_individu'] = $_POST['nama_individu'];
        $_SESSION['phonenum_individu'] = $_POST['phonenum_individu'];

        header("Location: vendorprofile.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Image upload
if (isset($_POST['upload'])) {
    if (!empty($_FILES['image']['tmp_name'])) {
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_ext;

        $path = "images/";
        move_uploaded_file($_FILES['image']['tmp_name'], $path . $filename);

        try {
            $stmt = $conn->prepare("UPDATE fyp_vendors SET image = :image WHERE emel = :emel");
            $stmt->bindParam(':image', $filename, PDO::PARAM_STR);
            $stmt->bindParam(':emel', $_SESSION['emel'], PDO::PARAM_STR);
            $stmt->execute();

            $_SESSION['image'] = $filename;

            header("Location: vendorprofile.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

try {
    $stmt = $conn->prepare("SELECT * FROM fyp_vendors WHERE emel = :emel");
    $stmt->bindParam(':emel', $_SESSION['emel'], PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
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
  <link rel="stylesheet" href="testprofile.css">

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



  <div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    
    
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <form method="POST" enctype="multipart/form-data" action="vendorprofile.php">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Gambar Profil</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img  class="img-account-profile rounded-circle mb-2" src="<?php echo ($_SESSION['image'] == "") ? 'images/noprofile.jpg' : 'images/'.$_SESSION['image']; ?>" alt="Profile Image" height="200" width="200">
                

                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <input type="file" name="image" /> <br> <br>
                    <button class="btn btn-primary" type="submit" name="upload">Upload new image</button>
                </div>
            </div>
            </form>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Maklumat Pembekal</div>
                <div class="card-body">
                    <form method="POST">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Nama Syarikat</label>
                            <input class="form-control" id="inputUsername" name="nama_syarikat" type="text"  value="<?php echo "{$_SESSION['nama_syarikat']}" ?>">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Emel</label>
                                <input class="form-control" id="inputFirstName" type="text" name="emel"  value="<?php echo "{$_SESSION['emel']}" ?>" readonly>
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Nombor Telefon</label>
                                <input class="form-control" id="inputLastName" type="text" name="phonenum"  value="<?php echo "{$_SESSION['phonenum']}" ?>">
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Password</label>
                                <input class="form-control" id="password" type="password" name="password"  value="<?php echo "{$_SESSION['password']}" ?>">
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">New Password</label>
                                <input class="form-control" id="cpassword" name="cpassword" type="password" >
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Alamat</label>
                            <input cols="30" rows="5" class="form-control" id="alamat" name="alamat"  value="<?php echo "{$_SESSION['alamat']}" ?>">
                        </div>

                        Maklumat Untuk Dihubungi <br><br>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                          
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Nama Individu</label>
                                <input class="form-control" id="inputPhone" name="nama_individu" value="<?php echo "{$_SESSION['nama_individu']}" ?>">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">No Telefon Individu</label>
                                <input class="form-control" id="inputBirthday" type="text" name="phonenum_individu"  value="<?php echo "{$_SESSION['phonenum_individu']}" ?>">
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit" name="update" >Kemas Kini Profil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
                 