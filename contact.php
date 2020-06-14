<?php
include("./includes/header.php");
include_once("./db-connection/connection.php");
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
          <input type="email" pattern="email" name="email" placeholder="Please enter your name" required>
        </label>
        <label>Message
          <textarea  name="message" placeholder="" required></textarea>
        </label>
        <p><input type="submit" class="button expanded" id="contact-btn" name="btn-contact" value="Send"></input></p>
      </form>
    </div>
  </div>

</div>

<?php
include("./includes/footer.php");
?>
