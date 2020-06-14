<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
?>


<?php include("./includes/admin-sidemenu.css"); ?>
	<h3 class="text-center"><i class="fas fa-users fa-4x"></i></h3>
		<hr>
<div class="grid-contaner">
	<div class= "grid-x grid-margin-y">
		<?php
			$query="SELECT * FROM `users` u JOIN `gender` g ON u.genderid=g.id JOIN `usertype` ut ON u.usertypeid=ut.usertypeid";
			$result = $conn->query($query);
			$user_icon = array("fas fa-user-secret fa-2x","fas fa-user-graduate fa-2x","fas fa-user-tie fa-2x","fas fa-user-ninja fa-2x","fas fa-user-nurse fa-2x","fas fa-user-astronaut fa-2x");
			$counter = 0;
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo '<div class="cell large-4 medium-4 small-12 text-center">';
					echo '<i class="' .$user_icon[$counter]. '"></i>';
					echo '<div class="job-title"><a href="#">'. $row["firstname"].'</a></div>';
					echo '<div class="job-title"><a href="#">'. $row["middlename"].'</a></div>';
					echo '<div class="job-title"><a href="#">'. $row["lastname"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["username"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["email"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["dob"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["gender"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["status"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["usertypedisplaytext"].'</a></div>';

					echo '</div>';

					if ($counter > 5){
						$counter = -1;
					}
					$counter++;
				}
			} else {
				echo "0 results";
			}
			?>

	</div>

</div>

<?php
include("./includes/footer.php");
?>
