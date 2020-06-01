<?php
include("./includes/header.php");

include("./db-connection/connection.php");

$category_id=$_GET['category'];
$initial_page_no=$_GET['page_no']; 
$page_no=(($initial_page_no-1)*10);
$query="SELECT * FROM `jobs` WHERE `job_sub_category_id`=$category_id AND `is_visible`=1 LIMIT 10 OFFSET $page_no";
$result = $conn->query($query); 
if ($result->num_rows > 0) { 
while($row = $result->fetch_assoc()) {
    echo '<div class="jobs">';
    echo '<div class="job-title"><h2><a href="#">'. $row["job_id"].'</a></h2></div>';
    echo '<div class="job-title"><h2><a href="#">'. $row["institute"].'</a></h2></div>';
    echo '<div class="job-details"><h2><a href="#">'. $row["job_description"].'</a></h2></div>';
    if($row['pdf_url']!=NULL){
        echo '<div class="job1-details"><a href=  "'.$row["pdf_url"].'" target="_blank">PDF</a></div>';
    }
    echo '</div>';
}
} else {
echo "No jobs found!!!";
}
?>
<!-- pagination -->
<div>
    <a href="category_jobs.php?category=<?php echo $category_id;?>&page_no=<?php echo $initial_page_no-1; ?>">Previous</a>
    <a href="category_jobs.php?category=<?php echo $category_id;?>&page_no=<?php echo $initial_page_no+1; ?>">Next</a>
</div>
<?php

?>
<?php

include("./includes/footer.php");