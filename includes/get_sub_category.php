<?php
include_once("../db-connection/connection.php"); 
$cat_id = htmlspecialchars($_GET["cat_id"]);
// $query="SELECT * FROM `job_sub_category` WHERE `job_category_id`=$cat_id";
$query="SELECT jsc.job_sub_category_id, jsc.sub_category, COUNT(j.job_id) as job_cnt FROM `job_sub_category` jsc left join jobs j on j.job_sub_category_id=jsc.job_sub_category_id WHERE `job_category_id`=$cat_id GROUP BY jsc.job_sub_category_id";
$result = $conn->query($query);
if ($result->num_rows > 0) {  
while($row = $result->fetch_assoc()) { 
    
    echo $row['job_sub_category_id'] . '-' . $row['sub_category'] . '-' . $row['job_cnt'] .'<br/>'; 
}
} 