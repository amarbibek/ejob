<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
// header('location:admin.php');
?>


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
            
            <!-- <div id='forgot'>
                <a href="#" >
                  Forgot ?
                </a>
            </div> -->

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

<?php
include("./includes/footer.php");
?>