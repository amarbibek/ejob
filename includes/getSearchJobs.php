<?php
include_once("../db-connection/connection.php"); 
$searchKey = htmlspecialchars($_GET["searchKey"]);
$query="SELECT * FROM `jobs` j   WHERE j.`institute` LIKE '%$searchKey%'";
// echo $query;

$result = $conn->query($query);
if ($result->num_rows > 0) {  
while($row = $result->fetch_assoc()) { 
    echo $row['job_id'] . '-eow-' . $row['institute'] . '-eow-' . $row['job_description'] . '-eow-' .  $row['job_sub_category_id']. '-eol-';
    // echo $row['job_id'] .'<br/>' ;
    // echo $row['institute'].'<br/>' ;
    // echo $row['job_description'].'<br/>' ;
    // echo $row['job_category_id'].'<br/>';
    // echo $row['job_sub_category_id'].'<br/>';
    // echo $row['pdf_url'];
}
} 