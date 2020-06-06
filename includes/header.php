<?php
session_start();
include("./db-connection/connection.php");
error_reporting(0);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Job portal</title>

    <link rel="shortcut icon" href="img/favicon.ico" />
    <link href="./css/style.css" rel="stylesheet" type="text/css" />
    <link href='./css/pagination.css' rel="stylesheet" type='text/css' />
    <link href='./css/dropdown.css' rel="stylesheet" type='text/css' />
    <link href='./css/index-jobs.css' rel="stylesheet" type='text/css' />
    <link href='./css/header.css' rel="stylesheet" type='text/css' />
    <link href='./css/footer.css' rel="stylesheet" type='text/css' />
    <link href="./css/admin-login.css" rel="stylesheet" type="text/css" />
    <link href="./css/edit-delete.css" rel="stylesheet" type="text/css" />
	<link href="./toastr/css.css" rel="stylesheet" type="text/css" />
	<link href="./css/advert.css" rel="stylesheet" type="text/css" />
	<link href="./css/admin-jobs.css" rel="stylesheet" type="text/css" />
	<link href="./css/search.css" rel="stylesheet" type="text/css" />

	<link href="./css/about.css" rel="stylesheet" type="text/css" />
	<link href="./css/contact.css" rel="stylesheet" type="text/css" />

	

	<!-- <link rel="stylesheet" href="./css/sidebar.css"> -->
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
 -->  

    
  </head>
   	<body>
		<header>
			<nav> 
				<ul id='navigation'>
					<li id="li-logo">	<span><a href="index.php"><img id="logo" src="img/logo1.png"/></a>	</span></li>
					<?php
						$query="SELECT * FROM `job_category`";
						$result = $conn->query($query);
						if ($result->num_rows > 0) { 
						while($row = $result->fetch_assoc()) {
							echo '<li class="dd">';
								echo '<div class="dropdown">';
									echo '<button class="dropbtn" data-cat_id="'.$row['job_category_id'].'">' .$row['category'].'</button>';
									// echo '<button class="dropbtn ddl-cat" data-cat_id="'.$row['job_category_id'].'">' .$row['category'].'</button>';
									echo '<div class="dropdown-content">';
							// 			echo '<a href="#">Experienced</a>';
							// 			echo '<a href="#">Fresher</a>';
									echo '</div>';
							echo '</div>
							</li>';
						}
						} else {
						echo "0 results";
						}
					?>
					<li class="anchor-header"><a href="about.php">About</a></li>
					<li class="anchor-header"><a href="contact.php">Contact</a></li>
					<?php 
					if(!isset($_SESSION['loggedIn'])){
						 echo '<li class="anchor-header"><a href="admin-login.php">Admin Login</a></li>';
						} else {
						echo '<li class="anchor-header"><a href="admin.php?page_no=1">Admin Panel</a></li>';
					    echo '<li  id="logout-btn"><a href="logout.php" title="logout">Logout</a></li>';
					} ?>
					
				</ul>
			</nav>
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
				$(function(){
					$(".dropbtn").hover(function(){
						$hovered_ele =$(this);
						// console.log($hovered_ele.text());
						$cat_id=$(this).data("cat_id");
						// debugger;
						$.get("./includes/get_sub_category.php",{cat_id:$cat_id},function(htmldata){
							$data=htmldata.split("<br/>"); 
							// $anchor=$hovered_ele.text()+'<div class="dropdown-content">';
							$anchor="";//$hovered_ele.text(); //+'<div class="dropdown-content">';
							$.each($data, function(i,v){
								if(v !== ""){
									$anchor +='<a href="category_jobs.php?category='+ v.split("-")[0] +'&page_no=1">'+v.split("-")[1]+'</a>';
								}
							});
							$anchor += '</div>'
							//  $hovered_ele.html($anchor);
							//  $hovered_ele.after($anchor);
							 $($hovered_ele).parent().find(".dropdown-content").val("").html($anchor);

						});
					},function(){

					})
				});
			</script>
		</header>
