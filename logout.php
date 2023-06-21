<?php 
session_start();
if (isset($_SESSION['nama'])) {
    session_destroy();
    header("Location: loginPelajar.php");
    exit();
}

// Clear vendor session
if (isset($_SESSION['nama_syarikat'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>