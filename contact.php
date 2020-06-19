<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
?>
<?php
if(isset($_POST['btn-contact'])){
  $name = $_POST['username'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $query="INSERT INTO `contactus` (`name`,`email`,`message`) VALUES ('$name','$email','$message')";
      if($conn->query($query) === TRUE){
        //  echo 'success';
         echo '<script>$.toast({
              heading: "Success",
              text: "You will be contacted soon!",
              position: "top-right",
              icon: "success",
              stack: true,
            });</script>';
      }
}
?>

<div id="contact">
  <hr>
  <div class="grid-x align-center grid-margin-x grid-margin-y grid-padding-x grid-padding-y">
    <div class="cell small-12 medium-6 large-4 align-center">
      <form id='admin-form' action="#" method="POST" class="contact-us-form">
        <h2 class="text-center">Contact Us</h2>
        <label>Name
          <input type="text" name="username" placeholder="Please enter your name" required>
        </label>
        <label>Email
          <input type="email" name="email" placeholder="Please enter your name" required>
          <!-- <input type="email" pattern="email" name="email" placeholder="Please enter your name" required> -->
        </label>
        <label>Message
          <textarea  name="message" placeholder="" required></textarea>
        </label>
        <p><input type="submit" class="button expanded" id="contact-btn" name="btn-contact" value="Send"></input></p>
      </form>
    </div>
    <div class="cell small-12 medium-6 large-4 align-center">
      <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d56078.532404705635!2d77.13178423952836!3d28.542476608585527!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x390d1dc392ac3985%3A0x3b20e3376e83bca1!2sJNU%20Administration%2C%20Jawaharlal%20Nehru%20University%2C%20Vice-%20Chancellors%20Office%2C%20JNU%20Ring%20Road%2C%20New%20Delhi%2C%20Delhi%2C%20India!3m2!1d28.5424057!2d77.16680389999999!5e0!3m2!1sen!2snp!4v1592314952537!5m2!1sen!2snp" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
  </div>

</div>

<?php
include("./includes/footer.php");
?>
