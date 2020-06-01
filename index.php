<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
?>
      <!-- Either get jobs form database or just scrape it from some website, you choose -->
<div class="wrapper">  <!–– All of this should be done dynamically ––> 
	<div class= "job-container">
		<?php
			$query="SELECT * FROM `jobs` LIMIT 10";
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
		<!-- <div class="jobs">
			<div class="job-title"><h2><a href="#">MANUU – Professor & Various Vacancies (Hyderabad, Telangana)</a></h2></div>
			<div class="job-details"><h3>Professor (Graduate/Post Graduate) Associate Professor (Graduate/Post Graduate) Assistant Professors (Graduate/Post Graduate) Head of the Department (HoD) - Graduate/Post GraduateProfessor & Various Vacancies - Last Date 29</h3></div>
		</div>
		<div class="jobs">
			<div class="job-title"><h2><a href="#">MANUU – Professor & Various Vacancies (Hyderabad, Telangana)</a></h2></div>
			<div class="job-details"><h3>Professor (Graduate/Post Graduate) Associate Professor (Graduate/Post Graduate) Assistant Professors (Graduate/Post Graduate) Head of the Department (HoD) - Graduate/Post GraduateProfessor & Various Vacancies - Last Date 29</h3></div>
		</div>
		<div class="jobs">
			<div class="job-title"><h2><a href="#">MANUU – Professor & Various Vacancies (Hyderabad, Telangana)</a></h2></div>
			<div class="job-details"><h3>Professor (Graduate/Post Graduate) Associate Professor (Graduate/Post Graduate) Assistant Professors (Graduate/Post Graduate) Head of the Department (HoD) - Graduate/Post GraduateProfessor & Various Vacancies - Last Date 29</h3></div>
		</div>
		<div class="jobs">
			<div class="job-title"><h2><a href="#">MANUU – Professor & Various Vacancies (Hyderabad, Telangana)</a></h2></div>
			<div class="job-details"><h3>Professor (Graduate/Post Graduate) Associate Professor (Graduate/Post Graduate) Assistant Professors (Graduate/Post Graduate) Head of the Department (HoD) - Graduate/Post GraduateProfessor & Various Vacancies - Last Date 29</h3></div>
		</div>
		<div class="jobs">
			<div class="job-title"><h2><a href="#">MANUU – Professor & Various Vacancies (Hyderabad, Telangana)</a></h2></div>
			<div class="job-details"><h3>Professor (Graduate/Post Graduate) Associate Professor (Graduate/Post Graduate) Assistant Professors (Graduate/Post Graduate) Head of the Department (HoD) - Graduate/Post GraduateProfessor & Various Vacancies - Last Date 29</h3></div>
		</div>
		<div class="jobs">
			<div class="job-title"><h2><a href="#">MANUU – Professor & Various Vacancies (Hyderabad, Telangana)</a></h2></div>
			<div class="job-details"><h3>Professor (Graduate/Post Graduate) Associate Professor (Graduate/Post Graduate) Assistant Professors (Graduate/Post Graduate) Head of the Department (HoD) - Graduate/Post GraduateProfessor & Various Vacancies - Last Date 29</h3></div>
		</div>
		<div class="jobs">
			<div class="job-title"><h2><a href="#">MANUU – Professor & Various Vacancies (Hyderabad, Telangana)</a></h2></div>
			<div class="job-details"><h3>Professor (Graduate/Post Graduate) Associate Professor (Graduate/Post Graduate) Assistant Professors (Graduate/Post Graduate) Head of the Department (HoD) - Graduate/Post GraduateProfessor & Various Vacancies - Last Date 29</h3></div>
		</div>
		<div class="jobs">
			<div class="job-title"><h2><a href="#">MANUU – Professor & Various Vacancies (Hyderabad, Telangana)</a></h2></div>
			<div class="job-details"><h3>Professor (Graduate/Post Graduate) Associate Professor (Graduate/Post Graduate) Assistant Professors (Graduate/Post Graduate) Head of the Department (HoD) - Graduate/Post GraduateProfessor & Various Vacancies - Last Date 29</h3></div>
		</div>
		<div class="jobs">
			<div class="job-title"><h2><a href="#">MANUU – Professor & Various Vacancies (Hyderabad, Telangana)</a></h2></div>
			<div class="job-details"><h3>Professor (Graduate/Post Graduate) Associate Professor (Graduate/Post Graduate) Assistant Professors (Graduate/Post Graduate) Head of the Department (HoD) - Graduate/Post GraduateProfessor & Various Vacancies - Last Date 29</h3></div>
		</div> -->
	</div>
	<!-- We can also add ad dynamically, but im too lazy -->
	<div id='advert'>
		<iframe src='linodeAd.html' title=""></iframe>
		<!-- <iframe src='linode.html' title=""></iframe> --> 
	</div>
</div>
<!-- <!–– We can add pagination as well ––>  -->
<!-- <div id="mySidenav" class="sidenav">
<a href="#" class="closebtn" onclick="closeNav()">&times;</a>
<a href="#">No new notification </a> -->
<!-- TODO: remove side panel and make modal insted for login -->
<!-- I've written login code below if login fails then reain form else redirect -->
</div>

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