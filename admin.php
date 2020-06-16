<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
include("./filters/functions.php");
check_admin_login();

?>



<?include("/includes/admin-sidemenu.css"); ?>
    <div class="admin-wrapper">
      <div class="admin-job-container">
        <?php

          $initial_page_no=$_GET['page_no'];
          $page_no=(($initial_page_no-1)*10);

          $query="SELECT * FROM `jobs` WHERE `is_visible`=1 LIMIT 20 OFFSET $page_no";
      		$result = $conn->query($query);

      			if ($result->num_rows > 0) {
      			while($row = $result->fetch_assoc()) {

              echo '<div class="admin-jobs" >';
              echo '  <div class="admin-job-title">';
              if($row['pdf_url']!=NULL){
                echo '<div class="admin-job-pdf"><a href="'.$row["pdf_url"].'" target="_blank">&#10247;</a></div>';
              }
              echo '    <a href="#">'. $row["institute"].'</a>';
              echo '  </div>';
              echo '  <div class="admin-job-details">';
              echo '    '. $row["job_description"].'';
              echo '  </div>';
              echo '  <div class="admin-job-details">';
              echo '   Apply By : '. $row["time"].'';
              echo '  </div>';
              echo '  <div class="admin-job-details">';
              echo '   Created Date : '. $row["created_date"].'';
              echo '  </div>';
    					echo '<div class="job-detailsss"><a href="'. $row["website"].'" target="_blank"> Apply Here </a></div>';


              echo '  <div class="edit-delete">';
              echo '    <button name="edit" class="edit-button" data-job_id="'.$row['job_id'].'" onclick="edit_job(this)">Edit</button>';
              echo '    <button name="delete" class="delete-button" data-job_id="'.$row['job_id'].'" onclick="delete_job(this)">';
              echo '      Delete';
              echo '    </button>';
              echo '  </div>';
              echo '</div>';

      			}
      			} else {
      			echo "0 results";
      			}
        ?>
      </div>
      </div>
      <hr>
    <ul class="pagination text-center" role="navigation">
      <li><a id='page-prev' href="admin.php?page_no=<?php echo $initial_page_no-1;?>"> <i class="fas fa-arrow-circle-left"></i><span class='prev-next' > Previous</span></a></li>
      <li><a id='page-next' href="admin.php?&page_no=<?php echo $initial_page_no+1; ?>"><span class='prev-next'>Next </span> <i class="fas fa-arrow-circle-right"></i></a></li>
    </ul>

 	<!-- <div class= "grid-x grid-padding-x grid-padding-y job-container" >
        <?php

          $initial_page_no=$_GET['page_no'];
          $page_no=(($initial_page_no-1)*10);

          $query="SELECT * FROM `jobs` WHERE `is_visible`=1 LIMIT 20 OFFSET $page_no";
      		$result = $conn->query($query);

      			if ($result->num_rows > 0) {
      			while($row = $result->fetch_assoc()) {

              echo '<div class="cell large-3 small-12 medium-6 grid-y grid-margin-y  grid-padding-y admin-jobs" >';
              echo '  <div class="cell large-4 small-4 medium-4 grid-x admin-job-title">';
              echo '  <div class="cell large-11 small-10 medium-10"><a href="#">'. $row["institute"].'</a></div>';
              if($row['pdf_url']!=NULL){
                echo '<div class="cell large-1 small-2 medium-2 text-right admin-job-pdf"><a href="'.$row["pdf_url"].'" target="_blank">&#10247;</a></div>';
              }
              echo '  </div>';
              echo '  <div class="cell large-6 small-6 medium-4 admin-job-details">';
              echo '    '. $row["job_description"].'';
              echo '  </div>';

              echo '  <div class="cell large-2 small-2 medium-4  grid-x edit-delete">';
              echo '    <div class="cell large-6 medium-6 small-6 text-left">';
              echo '      <button name="edit" class="large primary button" data-job_id="'.$row['job_id'].'" onclick="edit_job(this)">Edit</button>';
              echo '    </div>';
              echo '    <div class="cell large-6 medium-6 small-6 text-right">';
              echo '      <button name="delete" class="large alert button" data-job_id="'.$row['job_id'].'" onclick="delete_job(this)">Delete</button>';
              echo '    </div>';
              echo '  </div>';
              echo '</div>';

      			}
      			} else {
      			echo "0 results";
      			}
        ?>
      </div>


      <hr>
    <ul class="pagination text-center" role="navigation">
      <li><a id='page-prev' href="admin.php?page_no=<?php echo $initial_page_no-1;?>"> <i class="fas fa-arrow-circle-left"></i><span class='prev-next' > Previous</span></a></li>
      <li><a id='page-next' href="admin.php?&page_no=<?php echo $initial_page_no+1; ?>"><span class='prev-next'>Next </span> <i class="fas fa-arrow-circle-right"></i></a></li>
    </ul> -->



<script>
var sub_cat_id=0;
$(function(){
// $("#category").on("change",function(){
//   $hovered_ele =$("#sub-category");
//   var selectedCategory = $(this). children("option:selected"). val();

//   $.get("./includes/get_sub_category.php",{cat_id:selectedCategory},function(htmldata){

//     $data=htmldata.split("<br/>");
//     $anchor="<option value='none'> Select Sub-Category</option>";
//     $.each($data, function(i,v){
//       if(v !== ""){
//         $anchor +='<option value="'+ v.split("-")[0] + '">'+ v.split("-")[1]+ '</option> ';
//       }
//     });

//      $hovered_ele.html($anchor);

//   });
//   });

});
  function edit_job(e){
    $job_id = $(e).data("job_id");
    $.get("./includes/get-job-by-id.php",{job_id:$job_id},function(retdata){
      $data=retdata.split("<br/>");
    $("#enter-job-title").val($data[1]);
    $("#enter-job-details").val($data[2]);
    sub_cat_id = $data[4];
    $("#category").val($data[3]).trigger('change');
     setTimeout(function() {
        $("#sub-category").val(sub_cat_id);
    }, 300);
    $("#file").val($data[5]);
  });
  }
  function delete_job(e){
    $job_id = $(e).data("job_id");
    $.get("./includes/delete-job.php",{job_id:$job_id},function(retdata){
      if(retdata==="deleted"){
        $.toast({
            heading: 'Deleted',
            text: 'Job has been deleted!',
            position: 'top-right',
            icon: 'error',
            stack: true
        });
        location.reload();
      }
  });
}


</script>
<?php
include("./includes/footer.php");
?>
