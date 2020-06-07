<?php
include_once("../db-connection/connection.php"); 

$selectedCategoryId = $_GET['selectedCategoryId'];
$subCatName = $_GET['subCatName'];
$query="INSERT INTO `job_sub_category` (`job_category_id`,`sub_category`,`created_by`) VALUES ('$selectedCategoryId','$subCatName',1)";
    if($conn->query($query) === TRUE){
       echo 'success';
    }

?>