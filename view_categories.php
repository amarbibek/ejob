<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
include("./filters/functions.php");
check_admin_login();

?> 
 <?include("/includes/admin-sidemenu.css"); ?>
    <div class="admin-wrapper"> 
      

      <div id='job-entry'>
          <form id='add-job' action="#" method="POST" enctype="multipart/form-data">
            <span style="font-size:50px;font-weight:bolder;float:right;margin-right:34px;margin-top:3px;cursor:pointer;" onclick="openNav()">&#8801;</span>
            <h2> Job Categories </h2>
            <!-- <label id='label-job-title' name='label-job-title'> Job Title: </label> <br /> 
            <textarea name='job-title' id='enter-job-title' required> </textarea><br />
            <label id='label-job-details' name='label-job-details'> Job Details: </label><br /> 
            <textarea id='enter-job-details' name='job-detail' required> </textarea><br /> -->
           
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
              <input type='button' id="add-job-cat" name='add-job-cat' class='add-job-btn' value='Add Cat'/> 

                <select name="sub-category" id="sub-category">
                  <!-- <option value='none'> Select Sub Category</option>
                  <option value='experienced'>Experienced</option>
                  <option value='fresher'>Fresher</option> -->
                </select> 
              <input type='button' id="add-job-sub-cat" name='add-job-sub-cat' class='add-job-btn' value='Add Sub Cat'/> 

              <br /> 
            </div> 
            <!-- <div id='buttons'>
              <input type='submit' name='add-job-btn' class='add-job-btn' value='Add'/> 
            </div> -->
          </form>
          
        </div>
      </div>
 

<?php include("./includes/admin-sidemenu.php"); ?>

<script>
var sub_cat_id=0;
$(function(){
$("#add-job-cat").on("click",function(){
var selectedCategoryId = $("#category"). children("option:selected").val();
var catName = window. prompt("Enter a Category: "); 
var result= app.insertCategory(selectedCategoryId, catName);
});
$("#add-job-sub-cat").on("click",function(){
var selectedCategoryId = $("#category"). children("option:selected").val();
debugger;
if(selectedCategoryId == "none"){
  $.toast({
    heading: "Warning",
    text: "Select a category!",
    position: "top-right",
    icon: "warning",
    stack: true,
  });
}else{
  var subCatName = window. prompt("Enter a sub Category: "); 
  var result= app.insertSubCategory(selectedCategoryId, subCatName);
}
});













$("#category").on("change",function(){
  $hovered_ele =$("#sub-category");
  var selectedCategory = $(this). children("option:selected").val();
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