<?php
include_once("./db-connection/connection.php");

    if(isset($_POST['add-job-btn'])){
      $job_title = $_POST['job-title'];
      $job_detail = $_POST['job-detail'];
      $category = $_POST['category'];
      $sub_category = $_POST['sub-category'];

      $targetDir = "../../pdf/";
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
          
          // $url = $targetDir . $fileName;
          $url = "/pdf/". $fileName;
          // echo $url;
          // echo $statusMsg;
          // exit();

    $query="INSERT INTO `jobs` (`institute`,`job_description`,`job_sub_category_id`,`pdf_url`,`is_visible`,`created_by`) VALUES ('$job_title','$job_detail','$sub_category','$url',1,2)";

    if($conn->query($query) === TRUE){
       echo '<script type="text/javascript">',
            'display_success_toast();',
             '</script>';

        }
      }
?>

<div class="reveal add-job-reveal" style="height: 80vh;" id="addjob" data-reveal>
  <div class="grid-x grid-margin-x grid-padding-x align-center">
    <div class="cell large-8 small-12 medium-10 " id="job-entry">
        <form id='add-job' action="#" method="POST" enctype="multipart/form-data">

          <!-- <input id='hdn-job-id' name='hdn-job-id' style="display:none"> </input> <br /> -->
          <input id='hdn-job-id' name='hdn-job-id' style="display:none" > </input> <br />
          <label id='label-job-title' name='label-job-title'> Job Title: </label> <br />
          <textarea name='job-title' id='enter-job-title' required> </textarea><br />
          <label id='label-job-details' name='label-job-details'> Job Details: </label><br />
          <textarea id='enter-job-details' name='job-detail' required> </textarea><br />

          <div id='add-tag'>
              <select name="category" id="category1">
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

              <select name="sub-category" id="sub-category1">
                </select>

            <?php
              // $arr = ["Post", "Qualification"];
              // for ($i= 1; $i < 3; $i++) {
              //   echo '<select name="category" id="category">';
              //   echo '<option value="none"> Select '. $arr[$i-1]. '</option>';
              //   $query="SELECT * FROM `job_sub_category`";
              //   $result = $conn->query($query);
              //   if ($result->num_rows > 0) {
              //     while($row = $result->fetch_assoc()) {
              //       if($row['job_category_id'] == $i) {
              //         echo '<option value="'.$row['job_category_id'].'">'.$row['sub_category'].'</option> ';
              //       }
              //     }
              //   }
              //   echo '</select>';
              // }
            ?>
          </div>
          <div class="grid-x">
            <div class="text-left cell large-6 small-6 medium-6" id='upload-file'>
              <label for="file" class="button filex" title="Upload">Upload File</label>
              <input type="file" id="file" class="show-for-sr" name="file">
            </div>

            <div class="text-right cell large-6 small-6 medium-6" id='buttons'>
              <button type='submit' class="button add-job-btn" name='add-job-btn' id="add-job-btn">Add job</button>
              <button type='submit'  class="button update-job-btn"  id="update-job-btn" name='update-job-btn'>Update job</button>
            </div>
          </div>

        </form>
      </div>
    </div>
    <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>

<hr>


  <footer class="footer">
    <div class="grid-container text-center">
      <div  class="footer grid-x grid-padding-x">
        <div class="cell small-12 large-4 medium-4">
          <h2> Subscribe to our newsletter </h2>
          <p class="callout" style="background-color: rgb(23,121,186,0.2);color:whitesmoke">
             We send information about new and exciting job offers once a week, we will not spam you, subscribe if you are interested
          </p>
          <form>
            <div class="input-group">
              <span class="input-group-label" style="background:inherit;border:1px groove #2196f3"><i class="far fa-paper-plane fa-lg" style="color:#2196f3"></i></span>
              <input class="input-group-field" type="email" id='newsletter_email' placeholder="Enter your Email" pattern="email">
                <div class="input-group-button">
                <input type="button" class="button primary" id='newsletter_email_button' value='Subscribe'>
              </div>
            </div>
          </form>



        </div>
        <div class="cell small-12 large-4 medium-4">
          <h2> Connect with us</h2>
        <div class="grid-y">
            <ul class="cell large-8 menu no-bullet align-center">
              <li><a href='https://www.facebook.com/' target="_blank"><img src="img/facebook.png" /> </a> </li>
              <li><a href='https://web.whatsapp.com/' target="_blank"><img src="img/whatsapp.png" /> </a></li>
              <li><a href='https://www.linkedin.com/' target="_blank"><img src="img/linkedin.png" /> </a></li>
              <li><a href='https://www.instagram.com/' target="_blank"><img src="img/instagram.png" /> </a></li>
              <li><a href='https://twitter.com/' target="_blank"><img src="img/twitter.png" /> </a></li>
            </ul>
            <!-- <ul class="menu no-bullet align-center">
              <li><a href='#'><i class="fa fa-facebook fa-3x" style="color:#4267b2"></i> </a> </li>
              <li><a href='#'><i class="fa fa-whatsapp fa-3x" style="color:#29a81a"></i> </a></li>
              <li><a href='#'><i class="fa fa-linkedin fa-3x" style="color:#007bb5"></i> </a></li>
              <li><a href='#'><i class="fa fa-instagram fa-3x" style="color:#de3566"></i> </a></li>
              <li><a href='#'><i class="fa fa-twitter fa-3x" style="color:#00aced"></i> </a></li>
            </ul> -->
            <p  class="cell auto">
              &copy; 2020 Tapti Inc&#8482;. All rights reserved.
            </p>
        </div>

        </div>
        <div class="cell small-12 large-4 medium-4">
             <h2> Designed By</h2>
             <p>
              Tapti Laboritories<br>
              Tapti Hostel, <br>
              Jawaharlal Nehru University, <br>
            </p>

          <div id='gototop'><a onclick = 'goToTop()'><i class="fas fa-chevron-circle-up fa-2x"></i></a></div>
        </div>
      </div>
    </div>
	</footer>

    <script src="./js/script.js"></script>
    <script src="./js/app.js"></script>



    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app-foundation.js"></script>
    <script src="./toastr/js.js"></script>

    <script type="text/javascript">
      // if($(#contact).length){
      //   console.log("Trippy");
      // }
    	var job_container=$(".job-container");
    	var searchedJobsHtml = "";
    	$(function(){
        $("#category1").on("change",function(){
          $hovered_ele =$("#sub-category1");
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
    		$("#search-input").on("keyup",function(){
    			var searchKey=$("#search-input").val();
    			var searchedJobs= app.searchJobs(searchKey);
    		});
    	});
      // function subscribe(){
        $("#newsletter_email_button").on("click",function(){
          // debugger;
          var email=$("#newsletter_email").val();
          if(email == ""){
            $.toast({
              heading: "Warning",
              text: "Enter your email",
              position: "top-right",
              icon: "warning",
              stack: true,
            });
          }else{
            var result= app.insertEmailList(email);
          }
        })

    </script>
  </body>
</html>
