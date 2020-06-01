<?php
session_start();
 function check_admin_login(){
    if(!isset($_SESSION['loggedIn'])){
        // header('location:login-redirected.php');
      echo "<script>window.location.href='login-redirected.php';</script>";
    }
}