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

<!-- Rest of your HTML code -->
