<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
?>
      
<div class="wrapper"> 
	<div class= "job-container">
		<?php
			$query="SELECT * FROM `jobs` LIMIT 9";
			$result = $conn->query($query);

			if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				echo '<div class="jobs">';
				echo '<div class="job-title"><h2><a href="#">'. $row["institute"].'</a></h2></div>';
				echo '<div class="job-title"><h2><a href="#">'. $row["job_description"].'</a></h2></div>';
				if($row['pdf_url']!=NULL){
					echo '<div class="job1-details"><a href=  "'.$row["pdf_url"].'" target="_blank">PDF</a></div>';
				}
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

<!-- TODO: remove side panel and make modal insted for login -->
<!-- I've written login code below if login fails then reain form else redirect -->
<div id='pagination'>
    <a id='page-prev' href="admin.php?page_no=<?php echo $initial_page_no-1; ?>"><< Previous</a>
    <a id='page-next' href="admin.php?&page_no=<?php echo $initial_page_no+1; ?>">Next >></a>
</div> 
			<!-- @@@modify these function for index.php@@@iminfinity -->

<?php
// if(isset($_POST['login'])){
// 	$username=$_POST['username'];
// 	$password=$_POST['password'];
// 	$query="SELECT * FROM `users` WHERE `username` = $username AND `password`=$password";
// 	$result = $conn->query($query);
// 	if ($result->num_rows > 0) { 
// 		echo "Login Successful!";
// 		header("location:admin.php");
// 	}
// }

?>


<?php
include("./includes/footer.php");
?>