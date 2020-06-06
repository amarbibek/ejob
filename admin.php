<!-- 
TODO:
1.    display all jobs in tabular format and add last column with header "Actions",
2.    this column should contain two links edit,delete 
3.    edit and delete code I'll do
4. wtf is this jgbhjbjhnjnhjbhghghghbgjbh
-->
<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
include("./filters/functions.php");
check_admin_login();

?>

  <?php
    if(isset($_POST['add-job-btn'])){
      $job_title = $_POST['job-title'];
      $job_detail = $_POST['job-detail'];
      $category = $_POST['category'];
      $sub_category = $_POST['sub-category'];

    $targetDir = "./pdf/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    

    if(isset($_POST["add-job-btn"]) && !empty($_FILES["file"]["name"])) {
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

    $url = $targetDir . $fileName;
 
    $query="INSERT INTO `jobs` (`institute`,`job_description`,`job_sub_category_id`,`pdf_url`,`is_visible`,`created_by`) VALUES ('$job_title','$job_detail','$sub_category','$url',1,2)";

    if($conn->query($query) === TRUE){
       echo '<script type="text/javascript">',
            'display_success_toast();',
             '</script>';
        }
      }
  ?>
  <!--   <div id='search-main'>
      <input  type='text' id='search-input' name='search-input' placeholder='Searh jobs' />
      <input  type='submit' id='search-btn' name='search-btn' value='Search' onclick='' />
    </div>
 -->
    <div class="admin-wrapper"> 
      <div class="admin-job-container"> 
        <?php
       
          $initial_page_no=$_GET['page_no']; 
          $page_no=(($initial_page_no-1)*10);
       
          $query="SELECT * FROM `jobs` WHERE `is_visible`=1 LIMIT 18 OFFSET $page_no";
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
      <div id='job-entry'>
          <form id='add-job' action="#" method="POST" enctype="multipart/form-data">
            <h2> Enter New Job Here </h2>
            <label id='label-job-title' name='label-job-title'> Job Title: </label> <br />
            <!-- <textarea name='enter-job-title' id='enter-job-title' autofocus> </textarea><br /> -->
            <textarea name='job-title' id='enter-job-title' required> </textarea><br />
            <label id='label-job-details' name='label-job-details'> Job Details: </label><br />
            <!-- <textarea id='enter-job-details' name='enter-job-detail'> </textarea><br /> -->
            <textarea id='enter-job-details' name='job-detail' required> </textarea><br />
           
            <div id='add-tag'>
            
                <select name="category" id="category">
                  <option value='none'> Select Category</option>
                  <?php
                    $query="SELECT * FROM `job_category`";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) { 
                      while($row = $result->fetch_assoc()) {
                      echo '<option value="'.$row['job_category_id'].'">'.$row['category'].'</option> ';
                      }
                    }
                    ?>
                </select> 
                <!-- <select name="category" id="category">
                  <option value='none'> Select Category</option> -->
                  <?php
                    // $query="SELECT * FROM `job_category`";
                    // $result = $conn->query($query);
                    // if ($result->num_rows > 0) { 
                    //   while($row = $result->fetch_assoc()) {
                    //   echo '<option value="'.$row['job_category_id'].'">'.$row['category'].'</option> ';
                    //   }
                    // }
                    ?>
                <!-- </select>  -->
                <select name="sub-category" id="sub-category">
                  <!-- <option value='none'> Select Sub Category</option>
                  <option value='experienced'>Experienced</option>
                  <option value='fresher'>Fresher</option> -->
                </select> 
              <br />
                
                <!-- <select name='profession' id='profession'>
                  <option value='none'>Select Profession</option>
                  <option value='government'>Government</option>
                  <option value='psu'>PSU</option>
                  <option value='it'>IT</option>
                  <option value='industrial'>Industrial</option>
                </select> 
              <br /> -->
              
                <!-- <select name='post' id='post'>
                  <option value='none'> Select Post</option>
                  <option value='clerk'>Clerk</option>
                  <option value='po'>PO</option>
                  <option value='administration'>Administration</option>
                </select>  -->
            </div>

            <div id='upload-file'>
              <h2> Upload List of jobs </h2>
              <input type='file' id='file' name='file'> <label for='file'>Choose File</label>
              <!-- <input type='submit' id='submit' value='Upload' class='add-job-btn' onclick='' style='margin-top: 20px; background-color: black; color: #fff'/>  -->
            </div>
            <div id='buttons'>
              <input type='submit' name='add-job-btn' class='add-job-btn' value='Add'/> 
            </div>
          </form>
        </div>
      </div>



<?php
  // include("./includes/pagination.php");
?> 
      <div id='pagination'>
        <a id='page-prev' href="admin.php?page_no=<?php echo $initial_page_no-1; ?>"><< Previous</a>
        <a id='page-next' href="admin.php?&page_no=<?php echo $initial_page_no+1; ?>">Next >></a>
    </div>


<script>
var sub_cat_id=0;
$(function(){
$("#category").on("change",function(){
  $hovered_ele =$("#sub-category");
  var selectedCategory = $(this). children("option:selected"). val();
  // debugger;
  $.get("./includes/get_sub_category.php",{cat_id:selectedCategory},function(htmldata){
    // debugger;
    $data=htmldata.split("<br/>"); 
    // $anchor=$hovered_ele.text()+'<div class="dropdown-content">';
    $anchor="<option value='none'> Select Sub-Category</option>";//$hovered_ele.text(); //+'<div class="dropdown-content">';
    $.each($data, function(i,v){
      if(v !== ""){
        $anchor +='<option value="'+ v.split("-")[0] + '">'+ v.split("-")[1]+ '</option> ';
      }
    });
    // $anchor += '</div>'
     $hovered_ele.html($anchor);
    //  alert("a");
    //  $hovered_ele.after($anchor);
      // $($hovered_ele).parent().find(".dropdown-content").val("").html($anchor);

  });
  });

});
  function edit_job(e){
    $job_id = $(e).data("job_id");
    // alert(sub_cat_id);
    $.get("./includes/get-job-by-id.php",{job_id:$job_id},function(retdata){ 
      $data=retdata.split("<br/>"); 
      // debugger;  
    $("#enter-job-title").val($data[1]);
    $("#enter-job-details").val($data[2]);
    sub_cat_id = $data[4];
    $("#category").val($data[3]).trigger('change'); 
     setTimeout(function() {  
        $("#sub-category").val(sub_cat_id);
    }, 300);
    debugger;
    $("#file").val($data[5]);
  }); 
  }
  function delete_job(e){
    $job_id = $(e).data("job_id"); 
    $.get("./includes/delete-job.php",{job_id:$job_id},function(retdata){ 
      if(retdata==="deleted"){
        // https://kamranahmed.info/toast
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