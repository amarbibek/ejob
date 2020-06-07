<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
?>

<?php
include("./includes/search.php");
?>

<div class="wrapper"> 
	<div class= "job-container">
		<?php
			$query="SELECT * FROM `jobs` LIMIT 18";
			$result = $conn->query($query);
			
			if ($result->num_rows > 0) { 
				while($row = $result->fetch_assoc()) {
					echo '<div class="jobs">';
					if($row['pdf_url']!=NULL){
						echo '<div class="job-pdf" ><a title="Download" href=  "'.$row["pdf_url"].'" target="_blank">&#10247;</a></div>';
					}
					echo '<div class="job-title"><a href="#">'. $row["institute"].'</a></div>';
					echo '<div class="job-details"><a href="#">'. $row["job_description"].'</a></div>';
					
					echo '</div>';
					// echo "id: " . $row["job_id"]. " - Name: " . $row["institute"]. " " . $row["job_description"]. "<br>";
				}
			} else {
				echo "0 results";
			}
			?>
		
	</div>
	
	<div id='advert'>
		<!-- <iframe src='linodeAd.html' title=""></iframe> -->
	</div>
</div>

<?php
include("./includes/footer.php");
?>
<script>
$(function(){
	var job_container=$(".job-container");
	var searchedJobsHtml = "";
	$("#search-input").on("keyup",function(){
		var searchKey=$("#search-input").val();
		$.ajax({
		method: "GET",
		url: "includes/getSearchJobs.php",
		data: { searchKey: searchKey },
		}).done(function (msg) { 
		jobs= msg.split("-eol-");
		searchedJobsHtml = "";
		$.each(jobs,function(i,val){ 
			if(val){
			job= val.split("-eow-");
				searchedJobsHtml+= '<div class="jobs">';
						if(job[4]!= null){
							searchedJobsHtml += '<div class="job-pdf" ><a title="Download" href=  "'+ job[4] +'" target="_blank">&#10247;</a></div>';
						}
						searchedJobsHtml += '<div class="job-title"><a href="#">'+ job[1] +'</a></div>';
						searchedJobsHtml += '<div class="job-details"><a href="#">'+ job[2] +'</a></div>';
						
						searchedJobsHtml += '</div>';
					}
			});
			if(jobs.length === 1){
				searchedJobsHtml ="<h2>No jobs found...</h2>";
			}
			$(job_container).val("").html(searchedJobsHtml);
		}); 
		// var searchedJobs= app.searchJobs(searchKey)
		// .then(function(res){
		// 	// debugger;
		// 	debugger;
	});
});
</script>