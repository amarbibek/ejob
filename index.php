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
			$query="SELECT * FROM `jobs` LIMIT 9";
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
	
	<!-- <div id='advert'>
		<iframe src='linodeAd.html' title=""></iframe>
	</div> -->
</div>

<!-- TODO: remove side panel and make modal insted for login -->
<!-- I've written login code below if login fails then reain form else redirect -->
<div id='pagination'>
    <a id='page-prev' href="admin.php?page_no=<?php echo $initial_page_no-1; ?>"> &#8249;&#8249;Previous</a>
    <a id='page-next' href="admin.php?&page_no=<?php echo $initial_page_no+1; ?>">Next&#8250;&#8250; </a>
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