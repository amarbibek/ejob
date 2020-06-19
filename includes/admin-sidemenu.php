  <div class="off-canvas position-right admin-side-menu-main" id="adminSideMenu" data-off-canvas>
    <h3 class="callout" style="background:black;color:whitesmoke;margin-bottom:0;">Admin Menu</h3>
    <ul class="menu vertical no-bullet admin-side-menu">
      <li><a href="admin.php?page_no=1">Admin Home</a></li>
      <li><a href="view_users.php">Users</a></li>
      <li><a href="view_categories.php">Categories</a></li>
      <li><a href="../ejob/Email/index.php">Trigger Email List</a></li>
    </ul>
  </div>


      <ul class="menu grid-x" style="background: black">
        <li class="cell large-10 small-10 medium-10" id="add-job-main" ><button class="button"   data-open="addjob" style="width: 100%;">Add Job</button></li>
        <li class="cell large-2 small-2 medium-2 " id="admin-menu" style="display:none;">
          <button class="button" type="button"  data-toggle="adminSideMenu" style="cursor:pointer;padding:0;margin:0;height:100%;width:100%" onclick="adminDown()">
          <span class="title-bar-title"><i class="fas fa-chevron-circle-down"></i></span>
          <!-- <span class="title-bar-title"><i class="fas fa-chevron-circle-down"></i></span> -->
        </button></li>
      <ul>

<!-- nav-right add-job-button -->
