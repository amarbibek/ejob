<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
// header('location:admin.php');
?>

<!-- <!DOCTYPE html>
<html>
  <head>
    <title>
      Admin Login
    </title>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="./css/style.css" rel="stylesheet" type="text/css" />
    <link href="./css/admin-login.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="img/favicon.ico" />
  </head>
  <body style='overflow-y: hidden'>
    <header>
			<nav>
  		
				<ul id='navigation'>
          <li>	<span><a href="index.html"><img id="logo" src="img/logo1.png"/></a>	</span></li>
          <li class='dd'>
            <div class="dropdown">
              <button class="dropbtn">Category</button>
              <div class="dropdown-content">
                <a href="#">Experienced</a>
                <a href="#">Fresher</a>
              </div>
						</div>
					<li>	
					<li class='dd'>
	  					 <div class="dropdown">
						    <button class="dropbtn">Profession</button>
						    <div class="dropdown-content">
						      <a href="#">Government</a>
						      <a href="#">PSU</a>
						      <a href="#">IT</a>
						      <a href="#">Industrial</a>
							</div>
						</div>
					<li>
					<li class='dd'>
	  					 <div class="dropdown">
						    <button class="dropbtn">Post</button>
						    <div class="dropdown-content">
						      <a href="#">Clerk</a>
						      <a href="#">PO</a>
						      <a href="#">Administration</a>
							</div>
						</div>
					<li>
					<li><a href="#">Contact</a></li>
				</ul>
			</nav>
		</header> -->
<?php
  if(isset($_POST['btn-login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query="SELECT * FROM `users` AS usr join `user_role` AS usrl on user_id = user_id WHERE usr.`username` = '$username' AND usr.`password`='$password' AND usr.`statusid` =1 AND usrl.`role_id`=2 ";
    // echo $query;
    // exit();
    $result = $conn->query($query);
    if ($result->num_rows > 0) { 
      $_SESSION['loggedIn']=TRUE;
      $_SESSION['role']=$row['role_id'];
      $_SESSION['username']=$username;
      $_SESSION['name'] = $row['firstname'];
      // header('location:admin.php');
      echo "<script>window.location.href='admin.php?page_no=1';</script>";
      // echo "Login Successful!";
      // exit();
    }else{
      echo "oops!";
    }
  }

?>

    <div id='limiter'>
      <div id='login-container'>
        <div id='wrap-login'>
          <form id='admin-form' action="#" method="POST">
            <span id='admintitle'>Admin Login</span>

            <div class='input-label'>
              <input class='input-main' type="text" name="username" placeholder="Username" required>
              <span class="focus-input"></span>
            </div>
            
            
            <div class='input-label'>
              <input class='input-main' type="password" name="password" placeholder="Password" required>
              <span class="focus-input"></span>
            </div>
            
            <div id='forgot'>
                <a href="#" >
                  Forgot ?
                </a>
            </div>

            <div id='login' >
              <!-- <button id='login-btn'>
                Login
              </button> -->
              <input type="submit" id='login-btn' name="btn-login" name="btn-login" value="Login">
            </div>

          </form>
        </div>
      </div>
    </div>
    
    <!-- <footer>
      <div id='footer-main'>
        <div id='newsletter'>
          <h2> Subscribe to our newsletter </h2>
          <p>
             We send information about new and exciting job offers once a week, we will not spam you, subscribe if you are interested
          </p>
          <form onsubmit="subscribe()" id='footer-form'>
            <input type='email' placeholder='Enter your Email' id='newsletter_email'/>
            <input type='submit' id='newsletter_email_button' value='Subscribe'></input>
          </form>

        </div>
        <div id='footer-middle'>
          <div id='social-media'>
            <h2> Connect with us</h2>
            <ul>
              <li><a href='#'><img src="img/facebook.png" /> </a> </li>
              <li><a href='#'><img src="img/whatsapp.png" /> </a></li>
              <li><a href='#'><img src="img/linkedin.png" /> </a></li>
              <li><a href='#'><img src="img/instagram.png" /> </a></li>
              <li><a href='#'><img src="img/twitter.png" /> </a></li>
            </ul>
          </div>
          <div id='copyright'>
            <p>
              &copy; 2020 Tapti Inc. All rights reserved.
            </p>
          </div>

        </div>
        <div id='designedby'>
          <p> 
             <h2> Designed By</h2>
              Tapti Laboritories<br />
              Tapti Hostel, <br />
              Jawaharlal Nehru University, <br />
              New Delhi 110067 
          </p>
          <span id='gototop'><a onclick = 'goToTop()'> Top &#8607 </a></span>
        </div>
      </div>
		</footer> -->
  <!-- </body>
</html> -->
<?php
include("./includes/footer.php");
?>