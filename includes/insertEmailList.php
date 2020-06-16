<?php
include_once("../db-connection/connection.php"); 
 
$email = $_GET['email'];
$query="INSERT INTO `emailList` (`email`) VALUES ('$email')";
    if($conn->query($query) === TRUE){
       echo 'success';
    }

?>