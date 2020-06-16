<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
?>


<div class="grid-container">
	<div class= "grid-x grid-padding-x grid-padding-y job-container" >
		<?php
			$query="SELECT * FROM `jobs` LIMIT 18";
			$result = $conn->query($query);

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo '<div class="cell large-4 small-12 medium-6 jobs">';
					echo '<div class="grid-x">';
					echo '<div class="cell large-11 medium-10 small-10 job-title"><a href="#">'. $row["institute"].'</a></div>';
					if($row['pdf_url']!=NULL){
						echo '<div class="cell large-1 medium-2 small-2 job-pdf text-right" ><a title="Download" href=  "'.$row["pdf_url"].'" target="_blank">&#10247;</a></div>';
					}
					echo '</div>';
					echo '<div class="job-details"><a href="#">'. $row["job_description"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. "Apply By : ". $row["time"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. "Created Date : ". $row["created_date"].'</a></div>';

					echo '</div>';
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
