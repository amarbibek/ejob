<?php
    include("./includes/header.php");

    include("./db-connection/connection.php");

    echo '<div class="wrapper">';
    echo '<div class="job-container">';

    $category_id=$_GET['category'];
    $initial_page_no=$_GET['page_no']; 
    $page_no=(($initial_page_no-1)*10);
    $query="SELECT * FROM `jobs` WHERE `job_sub_category_id`=$category_id AND `is_visible`=1 LIMIT 18 OFFSET $page_no";
    $result = $conn->query($query); 
    if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) {
            echo '<div class="jobs">';
            if($row['pdf_url']!=NULL){
                echo '<div class="job-pdf"><a href=  "'.$row["pdf_url"].'" target="_blank" title="Download">&#10247;</a></div>';
            }
            // echo '<div class="job-title"><a href="#">'. $row["job_id"].'</a></div>';
            echo '<div class="job-title"><a href="#">'. $row["institute"].'</a></div>';
            echo '<div class="job-details"><a href="#">'. $row["job_description"].'</a></div>';
            
            echo '</div>';
        }
    }
    else {
    echo "No jobs found!!!";
    }

    echo '</div>';
    echo '</div>';
?>

<div id='pagination'>
    <a id='page-prev' href="category_jobs.php?category=<?php echo $category_id;?>&page_no=<?php echo $initial_page_no-1; ?>"> <span class="arrow">&#171;</span><span class='prev-next'>Previous</span></a>
    <a id='page-next' href="category_jobs.php?category=<?php echo $category_id;?>&page_no=<?php echo $initial_page_no+1; ?>"><span class='prev-next'>Next</span> <span class="arrow">&#187;</span></a>
</div>


<?php
include("./includes/footer.php");
?>