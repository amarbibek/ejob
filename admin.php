<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
include("./filters/functions.php");
check_admin_login();

?>
<!-- <link href="dist/attention.css" rel="stylesheet">
<script src="dist/attention.js"></script> -->
<?php
if(isset($_POST['update-job-btn'])){
      $job_id = $_POST['hdn-job-id'];
      $job_title = $_POST['job-title'];
      $job_detail = $_POST['job-detail'];
      $category = $_POST['category'];
      $sub_category = $_POST['sub-category'];

      $targetDir = "../pdf/";
      $fileName = basename($_FILES["file"]["name"]);
      $targetFilePath = $targetDir . $fileName;
      $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


    if(isset($_POST["update-job-btn"]) && !empty($_FILES["file"]["name"])) {
        //allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($fileType, $allowTypes)){
            //upload file to server
            if(move_uploaded_file($_FILES["file"]["tmp_name"],__DIR__. $targetDir . $_FILES["file"]['name'])){
                $statusMsg = "The file ".$fileName. " has been uploaded.";
              }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
              }
            }else{
              $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
            }
          }else{
            $statusMsg = 'Please select a file to upload.';
          }
          
          // $url = $targetDir . $fileName;
          $url = "/pdf/". $fileName;
          // echo $url;
          // echo $statusMsg;
          // exit();

    // $query="INSERT INTO `jobs` (`institute`,`job_description`,`job_sub_category_id`,`pdf_url`,`is_visible`,`created_by`) VALUES ('$job_title','$job_detail','$sub_category','$url',1,2)";
    // $query="UPDATE`jobs` SET `institute`=$job_title AND `job_description` = $job_detail, `job_sub_category_id` = $sub_category, `pdf_url` = $url, `is_visible` = 1, `created_by` =2 WHERE `job_id`=$job_id";//  (`institute`,`job_description`,`job_sub_category_id`,`pdf_url`,`is_visible`,`created_by`) VALUES ('$job_title','$job_detail','$sub_category','$url',1,2)";
    $query="UPDATE `jobs` SET `institute`='$job_title' , `job_description` = '$job_detail', `job_sub_category_id` = '$sub_category', `is_visible` = 1, `created_by` =2 WHERE `job_id`=$job_id";//  (`institute`,`job_description`,`job_sub_category_id`,`pdf_url`,`is_visible`,`created_by`) VALUES ('$job_title','$job_detail','$sub_category','$url',1,2)";
    // echo $query;
    // exit();
    if($conn->query($query) === TRUE){
       echo '<script type="text/javascript">',
            'display_success_edit_toast();',
             '</script>';

        }
      }

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
              echo '    <button name="edit" class="edit-button" data-open="addjob" data-job_id="'.$row['job_id'].'" onclick="edit_job(this)">Edit</button>';
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

              // echo '<div class="overlay">';
              //   echo '<div class="visit-site">';
              //   if($row['pdf_url']!=NULL){
              //     echo '<div class="job-pdf" ><a title="Download PDF" href=  "../ejob/'.$row["pdf_url"].'" target="_blank"><i class="fa fa-download"></i></a></div>';
              //   }
              //   echo '<a href="'. $row["website"].'" target="_blank"> Apply Here <i class="fas fa-arrow-circle-right"></i> </a>';
              // echo '</div>';


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
      <li><a id='page-prev' href="admin.php?page_no=<?php //echo $initial_page_no-1;?>"> <i class="fas fa-arrow-circle-left"></i><span class='prev-next' > Previous</span></a></li>
      <li><a id='page-next' href="admin.php?&page_no=<?php //echo $initial_page_no+1; ?>"><span class='prev-next'>Next </span> <i class="fas fa-arrow-circle-right"></i></a></li>
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
      // console.log(retdata);
      $data=retdata.split("<br/>");
      $("#enter-job-title").val($data[1]);
      $("#enter-job-details").val($data[2]);
      sub_cat_id = $data[4];
      $("#category1").val($data[3]).trigger('change');
      setTimeout(function() {
          $("#sub-category1").val(sub_cat_id);
      }, 300);
      // debugger;
      if($data[5] !== ""){
        // $("#file").val($data[5]);
      }
      $("#hdn-job-id").val($job_id);
      // debugger;
      $("#update-job-btn").show();
      $("#add-job-btn").hide();
  });
  }
  function add_job(){
    // debugger;
    $("#update-job-btn").hide();
    $("#add-job-btn").show();
  }
  function delete_job(e){
    new Attention.Confirm({
    title: 'Delete Job!',
    content: 'Are You Sure? You Want To Delete This Job?',
    buttonCancel: false, // custom button text
    buttonConfirm: false,
    onConfirm(component){
      // debugger;
      // debugger;
      // console.log('Accepted');
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
          setTimeout(function(){
          location.reload();
          },500)
        }
    });
    },
    onAccept(component) {
    },
    onCancel(component) {
      console.log('Canceled');
    },
});

}


</script>
<?php
include("./includes/footer.php");
?>
