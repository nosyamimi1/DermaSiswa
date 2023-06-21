<?php

//session_start(); 

if (isset($_SESSION['emel'])) {

    if($_SESSION['role_as'] != 1) {

        $_SESSION['message']="You are not authorised to access this page";
        header('Location: homepage.php');

    }

    else {

        $_SESSION['message']="Login to continue";
        header('Location: admin.php');

    }
}

?>