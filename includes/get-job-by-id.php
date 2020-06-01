<?php
include_once("../db-connection/connection.php"); 
$job_id = htmlspecialchars($_GET["job_id"]);
$query="SELECT * FROM `jobs` j JOIN `job_sub_category` jsc ON j.job_sub_category_id = jsc.job_sub_category_id JOIN `job_category` jc ON jc.job_category_id = jsc.job_category_id  WHERE j.`job_id`=$job_id";
$result = $conn->query($query);
if ($result->num_rows > 0) {  
while($row = $result->fetch_assoc()) { 
    // echo $row['job_id'] . '-' . $row['institute'] . '-' . $row['job_description'] . '-' . $row['job_category_id']. '-' . $row['job_sub_category_id'];
    echo $row['job_id'] .'<br/>' ;
    echo $row['institute'].'<br/>' ;
    echo $row['job_description'].'<br/>' ;
    echo $row['job_category_id'].'<br/>';
    echo $row['job_sub_category_id'].'<br/>';
    echo $row['pdf_url'];
}
} 