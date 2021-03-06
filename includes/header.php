<?php
session_start();
include("./db-connection/connection.php");
error_reporting(0);
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" />
    <title>Job portal</title>
    <link rel="stylesheet" href="css/foundation/foundation.css">
    <link rel="stylesheet" href="css/foundation/app.css">

    <link rel="stylesheet" href="css/index-jobs.css">
    <link rel="stylesheet" href="css/admin-login.css">

    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/admin-sidemenu.css">

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/admin-jobs.css">
    <link rel="stylesheet" href="./toastr/css.css">

    <link href="attention/attention.css" rel="stylesheet">
    <script src="attention/attention.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

    <script src="https://kit.fontawesome.com/16d1e0ba88.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="./toastr/js.js"></script>


    <script>
      function display_success_toast(){
        $.toast({
            heading: 'Job Added',
            text: 'Job has been added successfully!',
            position: 'top-right',
            icon: 'success',
            stack: true
          });
      }
      function display_success_edit_toast(){
        $.toast({
            heading: 'Job Updated',
            text: 'Job has been updated successfully!',
            position: 'top-right',
            icon: 'success',
            stack: true
          });
      }
        $(function(){
          $(".dropbtn").hover(function(){
            $hovered_ele =$(this);
            $cat_id=$(this).data("cat_id");
            $.get("./includes/get_sub_category.php",{cat_id:$cat_id},function(htmldata){
              $data=htmldata.split("<br/>");
              $anchor="";
              $.each($data, function(i,v){
                if(v !== ""){
                  $anchor +='<a href="category_jobs.php?category='+ v.split("-")[0] +'&page_no=1">'+v.split("-")[1] + " ("+ v.split("-")[2]+') </a>';
                }
              });
              $anchor += '</div>';
               $($hovered_ele).parent().find(".dropdown-content").val("").html($anchor);

            });
          },function(){

          })
        });
    </script>
  </head>




   	<body>
      <header>
        <a href="index.php" class="logo show-for-medium" >
        <img src="img/logo1.png" alt="logo">
        </a>
        <div class="title-bar" data-responsive-toggle="main-navigation" data-hide-for="medium">
          <button class="menu-icon" type="button" data-toggle>
          </button>

      </div>

        <div class="top-bar main-nav" id="main-navigation">
          <div class="top-bar-left nav-left" style="margin-left: 40px">
            <ul class="dropdown menu medium-horizontal vertical" data-responsive-menu="accordion medium-dropdown" data-dropdown-menu>
              <li>
                <a href="#"> Jobs </a>
                <ul class="menu">
            <?php
                $query="SELECT * FROM `job_category`";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    echo '<li>';
                    echo '<a class="dropbtn" href="#" data-cat_id="'.$row['job_category_id'].'">'.$row['category'].'</a>';
                    echo '<ul class="menu dropdown-content">';
                    echo '</ul>';
                    echo '</li>';
                  }
                } else {
                  echo "0 results";
                }
              ?>
            </ul>
              <li><a href="about.php">About</a></li>
              <li><a href="contact.php">Contact</a></li>
              <?php
                if(isset($_SESSION['loggedIn'])){
                  echo '<li><a href="admin.php?page_no=1">Admin Panel</a></li>';
                }
                ?>
                </ul>
              </div>
              <div class="top-bar-right nav-left">
              <?php
                if(!isset($_SESSION['loggedIn'])){
                  echo '<ul class="menu">';
                   echo '<li><a href="admin-login.php">Admin Login</a></li>';

                  } else {
                    echo '<ul class="menu">';
                    echo '<li><a href="logout.php" title="logout">Logout</a></li>';
                  ;
                }
              ?>
              <?php
                if(isset($_SESSION['loggedIn'])){
                  include("./includes/admin-sidemenu.php");
                }
              ?>
              </ul>
            </div>

        </div>

      </header>
