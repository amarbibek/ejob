<?php
include_once("../db-connection/connection.php"); 

$selectedCategoryId = $_GET['selectedCategoryId'];
$catName = $_GET['catName'];
$query="INSERT INTO `job_category` (`category`,`created_by`) VALUES ('$catName',1)";
    if($conn->query($query) === TRUE){
       echo 'success';
    }

?>