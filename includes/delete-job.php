<?php
include_once("../db-connection/connection.php"); 
$job_id = htmlspecialchars($_GET["job_id"]);
$query="UPDATE `jobs` SET `is_visible`=0  WHERE `job_id`=$job_id";
$result = $conn->query($query);
if ($result === TRUE) {  
    echo "deleted";
} 