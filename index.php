<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
?>

<?php
	include("./includes/search.php");
?>
<div class="grid-container">
	<div class= "grid-x grid-padding-x grid-padding-y job-container" >
		<?php
			$query="SELECT * FROM `jobs` LIMIT 18";
			$result = $conn->query($query);

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo '<div class="cell large-4 small-12 medium-6 jobs">';
					echo '<div class="job">';
						echo '<div class="job-main">';
							echo '<div class="grid-x">';
								echo '<div class="cell large-12 medium-12 small-12 job-title"><a href="#">'. $row["institute"].'</a></div>';
							echo '</div>';
							echo '<div class="job-details"><a href="#">'. $row["job_description"].'</a></div>';
							echo '<div class="job-details"><a href="#">'. "Apply By : ". $row["time"].'</a></div>';
							echo '<div class="job-details"><a href="#">'. "Created Date : ". $row["created_date"].'</a></div>';
							echo '</div>';
							echo '<div class="overlay">';
							echo '<div class="visit-site">';
								if($row['pdf_url']!=NULL){
									echo '<div class="job-pdf" ><a title="Download PDF" href=  "'.$row["pdf_url"].'" target="_blank"><i class="fa fa-download"></i></a></div>';
								}
							echo '<a href="'. $row["website"].'" target="_blank"> Apply Here <i class="fas fa-arrow-circle-right"></i> </a>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
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
