<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
include("./filters/functions.php");
check_admin_login();
?>
    <hr>
    <div class="grid-x align-center grid-margin-x grid-margin-y grid-padding-x grid-padding-y">
      <div class="cell small-12 medium-6 large-4 align-center" id='job-entry'>
          <!-- <form id='add-job-cat-form' action="#" method="POST" enctype="multipart/form-data" class="add-cat-form">
            <h2> Add Job Categories </h2>
            <div id='add-tag'>
              <div class="input-group">
                <select name="category" id="category">
                  <option value='none'> Select Category</option>
                  <?php
                    // $query="SELECT * FROM `job_category`";
                    // $result = $conn->query($query);
                    // if ($result->num_rows > 0) {
                    //   while($row = $result->fetch_assoc()) {
                    //   echo '<option value="'.$row['job_category_id'].'">'.$row['category'].'</option> ';
                    //   }
                    // }
                    ?>
                </select>
                <button  id="add-job-cat" name='add-job-cat' class='button  add-job-btn'> <i class="fas fa-plus-square"></i></button>
              </div>
              <div class="input-group">
                <select name="sub-category" id="sub-category">
                </select>
              <button  id="add-job-sub-cat" name='add-job-sub-cat' class='button add-job-btn' data-open="addSubCategory"><i class="fas fa-plus-square"></i></button>
              </div>
            </div>
          </form> -->
        </div>
      </div>
      <!-- <hr> -->
      <div class="grid-x align-center grid-margin-x grid-margin-y grid-padding-x grid-padding-y">
        <div class="cell small-10 medium-6 large-4 align-center add-cat-form-new">
              <h2> Add Job Categories </h2>
              <div>
                <div class="input-group">
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
                  <button  class="button primary" id="catName" name="button" value="catName"><i class="fas fa-plus-square"></i></button>
                </div>
                <div class="input-group">
                  <select name="sub-category" id="sub-category">
                  </select>
                  <button  class="button primary" id="subCatName" name="button" value="subCatName"><i class="fas fa-plus-square"></i></button>
                </div>
              </div>
          </div>
        </div>

    <!-- <div class="reveal" id="addCategory" data-reveal>
    <h3>Enter Category </h3>
    <input type="text" name="newCat" value="">
    <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>

    <div class="reveal" id="addSubCategory" data-reveal>
    <h3>Enter Sub Category </h3>
    <input type="text" name="newSubCat" value="">
    <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
  </div> -->

<script>

// --------------------------------------------------------------------------------
var catName = '';
var subCatName = '';
$('#catName').on('click', function() {
    new Attention.Prompt({
        title: 'Enter Category ',
        content: 'Enter New Category',
        onSubmit: function(component, value) {
            catName = value;console.log(catName);
            var selectedCategoryId = $("#category"). children("option:selected").val();
            var result= app.insertCategory(selectedCategoryId, catName);
        }
    });
});
$('#subCatName').on('click', function() {
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
  new Attention.Prompt({
      title: 'Enter Sub Category ',
      content: 'Enter New Sub Category',
      onSubmit: function(component, value) {
          subCatName = value;
          // console.log(subCatName);
          var result= app.insertSubCategory(selectedCategoryId, subCatName);
      }
  });
}
});
// ----------------------------------------------------------------------------------
var sub_cat_id=0;
$(function(){
$("#add-job-cat").on("click",function(){
var selectedCategoryId = $("#category"). children("option:selected").val();

var catName = window. prompt("Enter a Category: ");
var result= app.insertCategory(selectedCategoryId, catName);
});
$("#add-job-sub-cat").on("click",function(){
var selectedCategoryId = $("#category"). children("option:selected").val();
// debugger;
if(selectedCategoryId == "none"){
  $.toast({
    heading: "Warning",
    text: "Select a category!",
    position: "top-right",
    icon: "warning",
    stack: true,
  });
}else{
  var subCatName = window.prompt("Enter a sub Category: ");
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
    // debugger;
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
