<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
?>


<?php
  if(isset($_POST['btn-login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query="SELECT * FROM `users` AS usr join `user_role` AS usrl on user_id = user_id WHERE usr.`username` = '$username' AND usr.`password`='$password' AND usr.`statusid` =1 AND usrl.`role_id`=2 ";

    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      $_SESSION['loggedIn']=TRUE;
      $_SESSION['role']=$row['role_id'];
      $_SESSION['username']=$username;
      $_SESSION['name'] = $row['firstname'];

      echo "<script>window.location.href='admin.php?page_no=1';</script>";

    }else{
      echo "oops!";
    }
  }

?>
  <hr>
    <div class="grid-x align-center grid-margin-x grid-margin-y grid-padding-x grid-padding-y ">
      <div class="cell small-12 medium-6 large-4 align-center">
        <form id='admin-form' action="#" method="POST" class="log-in-form">
          <h2 class="text-center">Admin Login</h2>
          <label>Username
            <input type="text" name="username" placeholder="Username" required>
          </label>
          <label>Password
            <input type="password"  name="password" placeholder="Password" required>
          </label>
          <p><input type="submit" class="button expanded" id="login-btn" name="btn-login" value="Log in"></input></p>
        </form>
      </div>

    </div>

<?php
include("./includes/footer.php");
?>
