<?php
    include("./includes/header.php");

    include("./db-connection/connection.php");

    echo '<div class="grid-container">';
    echo '<div class= "grid-x grid-padding-x grid-padding-y job-container">';

    $category_id=$_GET['category'];
    $initial_page_no=$_GET['page_no'];
    $page_no=(($initial_page_no-1)*10);
    $query="SELECT * FROM `jobs` WHERE `job_sub_category_id`=$category_id AND `is_visible`=1 LIMIT 18 OFFSET $page_no";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="cell large-4 medium-6 small-12 jobs">';
              echo '<div class="job">';
                echo '<div class="job-main">';
                  echo '<div class="grid-x">';
                    echo '<div class="cell large-12 medium-12 small-12 job-title"><a href="#">'. $row["institute"].'</a></div>';
                  echo '</div>';
                  echo '<div class="job-details"><a href="#">'. $row["job_description"].'</a></div>';
                  echo '<div class="job-details"><a href="#">'."Apply By : ". $row["time"].'</a></div>';
                  echo '<div class="job-details"><a href="#">'."Created Date : ". $row["created_date"].'</a></div>';
                  echo '</div>';
                  echo '<div class="overlay">';
                    echo '<div class="visit-site">';
                    if($row['pdf_url']!=NULL){
                      echo '<div class="job-pdf" ><a title="Download PDF" href=  "'.$row["pdf_url"].'" target="_blank"><i class="fa fa-download"></i></a></div>';
                    }
                    echo '<a href="'. $row["website"].'" target="_blank"> Apply Here <i class="fas fa-arrow-circle-right"></i> </a>';
                  echo '</div>';
                echo '</div>';
              echo '</div>';
            echo '</div>';
        }
    }
    else {
    echo "No jobs found!!!";
    }

    echo '</div>';
    echo '</div>';
?>


    <ul class="pagination text-center" role="navigation">
      <li><a id='page-prev' href="category_jobs.php?category=<?php echo $category_id;?>&page_no=<?php echo $initial_page_no-1; ?>"> <i class="fas fa-arrow-circle-left"></i><span class='prev-next'> Previous</span></a></li>
      <li><a id='page-next' href="category_jobs.php?category=<?php echo $category_id;?>&page_no=<?php echo $initial_page_no+1; ?>"><span class='prev-next'>Next </span> <i class="fas fa-arrow-circle-right"></i></a></li>
    </ul>

<?php
include("./includes/footer.php");
?>
