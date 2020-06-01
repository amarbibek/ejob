<?php
include_once("../db-connection/connection.php"); 
$cat_id = htmlspecialchars($_GET["cat_id"]);
$query="SELECT * FROM `job_sub_category` WHERE `job_category_id`=$cat_id";
$result = $conn->query($query);
if ($result->num_rows > 0) {  
while($row = $result->fetch_assoc()) { 
    
    echo $row['job_sub_category_id'] . '-' . $row['sub_category'] .'<br/>'; 
}
} 