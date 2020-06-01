<!-- 
TODO:
1.    display all jobs in tabular format and add last column with header "Actions",
2.    this column should contain two links edit,delete 
3.    edit and delete code I'll do
-->
<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
include("./filters/functions.php");
check_admin_login();

?>
<!-- <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Admin</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="adminpanel.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="img/favicon.ico" />
  </head>
  <body>
    	<header>
			<nav>
  		  <ul id='navigation'>
          <li>	<span><a href="index.html"><img id="logo" src="img/logo1.png"/></a>	</span></li>   
				</ul>
			</nav>
		</header> -->
  <?php
  if(isset($_POST['add-job-btn'])){
    $job_title = $_POST['job-title'];
    $job_detail = $_POST['job-detail'];
    $category = $_POST['category'];
    $sub_category = $_POST['sub-category'];

    //file upload path
$targetDir = "./pdf/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
// $file_name=$_FILES['file']['name'];

if(isset($_POST["add-job-btn"]) && !empty($_FILES["file"]["name"])) {
    //allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        //upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"],__DIR__. $targetDir . $_FILES["file"]['name'])){// $targetFilePath)){
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

//display status message
// echo $statusMsg;
    
    
    // $targetfolder = "pdfs/";
    // $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
    // $ok=1;
    // $file_type=$_FILES['file']['type'];
    // $file_name=$_FILES['file']['name'];
    // // echo $file_type;
    // // echo $file_name;
    // if ($file_type=="application/pdf" || $file_type=="image/jpeg") {
    //   if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
    //   {
    //     echo "The file ". basename( $_FILES['file']['name']). " is uploaded";
    //   }
    //   else {
    //     echo "Problem uploading file";
    //   }
    // }
    // else {
    //   echo "You may only upload PDFs or JPEGs files.<br>";
    // }


    $url = $targetDir . $fileName;
    // echo $url;
    // insert query
    $query="INSERT INTO `jobs` (`institute`,`job_description`,`job_sub_category_id`,`pdf_url`,`is_visible`,`created_by`) VALUES ('$job_title','$job_detail','$sub_category','$url',1,2)";
    // echo $query;

    // $result = ;
    if($conn->query($query) === TRUE){
      // if($_POST['event'] == 'button_clicked'){
      // echo 'job uploaded successfully!'; 
      echo '<script type="text/javascript">',
            'display_success_toast();',
             '</script>';
      // }
      // echo '<script>
      // $.toast({
      //     heading: "Job Added",
      //     text: "Job has been added successfully!",
      //     position: "top-right",
      //     icon: "success",
      //     stack: true
      // });
      // </script>';
    }
  }

  ?>
    <div class="wrapper"> 
    <div class="job-container"> 
<?php
  include("./includes/admin-sidebar.php");
?>
    <?php
    // $category_id=$_GET['category'];
    $initial_page_no=$_GET['page_no']; 
    $page_no=(($initial_page_no-1)*10);
    // $query="SELECT * FROM `jobs` LIMIT 10";
    // $query="SELECT * FROM `jobs` WHERE `job_sub_category_id`=$category_id AND `is_visible`=1 LIMIT 10 OFFSET $page_no";
    $query="SELECT * FROM `jobs` WHERE `is_visible`=1 LIMIT 10 OFFSET $page_no";
		$result = $conn->query($query);

			if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				// echo '<div class="jobs">';
				// echo '<div class="job-title"><h2><a href="#">'. $row["institute"].'</a></h2></div>';
				// echo '<div class="job-title"><h2><a href="#">'. $row["job_description"].'</a></h2></div>';
        // echo '</div>';
        echo '<div class="jobs">';
        echo '  <div class="job-title">';
        echo '    <a href="#"><h2>'. $row["institute"].'</h2></a>';
        echo '  </div>';
        echo '  <div class="job-details">';
        echo '    <h3>'. $row["job_description"].'</h3>';
        echo '  </div>';
        if($row['pdf_url']!=NULL){
          echo '<div class="job1-details"><a href=  "'.$row["pdf_url"].'" target="_blank">PDF</a></div>';
        }
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
            <textarea name='job-title' id='enter-job-title' autofocus> </textarea><br />
            <label id='label-job-details' name='label-job-details'> Job Details: </label><br />
            <!-- <textarea id='enter-job-details' name='enter-job-detail'> </textarea><br /> -->
            <textarea id='enter-job-details' name='job-detail'> </textarea><br />
           
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

      <!-- pagination, i hate it so fishh this , use mine -->
      <!-- <div class="pagination">
        <a href="#">&laquo;</a>
        <a class='active' href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">&raquo;</a>
      </div>  -->
      <div>
        <a href="admin.php?page_no=<?php echo $initial_page_no-1; ?>"><< Previous</a>
        <a href="admin.php?&page_no=<?php echo $initial_page_no+1; ?>">Next >></a>
    </div>
  <!-- </body>
</html> -->
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