<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
?>

<?php
// include("./includes/search.php");
?>
<?php include("./includes/admin-sidemenu.css"); ?>
<div class="wrapper"> 
	<div class= "job-container">
		<?php
			$query="SELECT * FROM `users` u JOIN `gender` g ON u.genderid=g.id JOIN `usertype` ut ON u.usertypeid=ut.usertypeid";
			$result = $conn->query($query);
			
			if ($result->num_rows > 0) { 
				while($row = $result->fetch_assoc()) {
					echo '<div class="jobs">'; 
					echo '<div class="job-title"><a href="#">'. $row["firstname"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["middlename"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["lastname"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["username"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["email"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["dob"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["gender"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["status"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["usertypedisplaytext"].'</a></div>';
					
					echo '</div>';
					// echo "id: " . $row["job_id"]. " - Name: " . $row["institute"]. " " . $row["job_description"]. "<br>";
				}
			} else {
				echo "0 results";
			}
			?>
		
	</div>
	
	<!-- <div id='advert'>
		<iframe src='linodeAd.html' title=""></iframe>
	</div> -->
</div>

<?php
include("./includes/footer.php");
?>
 
<?php include("./includes/admin-sidemenu.php"); ?>