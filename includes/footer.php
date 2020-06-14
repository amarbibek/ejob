<div class="reveal" style="height: 80vh;" id="addjob" data-reveal>
  <div class="grid-x grid-margin-x grid-padding-x align-center">
    <div class="cell large-8 small-12 medium-10 " id="job-entry">
        <form id='add-job' action="#" method="POST" enctype="multipart/form-data">

          <label id='label-job-title' name='label-job-title'> Job Title: </label> <br />
          <textarea name='job-title' id='enter-job-title' required> </textarea><br />
          <label id='label-job-details' name='label-job-details'> Job Details: </label><br />
          <textarea id='enter-job-details' name='job-detail' required> </textarea><br />

          <div id='add-tag'>
              <select name="category" id="category">
                <option value='none'> Select Category</option>
                <?php
                  $query="SELECT * FROM `job_category`";
                  $result = $conn->query($query);
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo '<option value="'.$row['job_category_id'].'">'.$row['category'].'</option> ';
                    }
                  }
                ?>
              </select>

            <?php
              $arr = ["Post", "Qualification"];
              for ($i= 1; $i < 3; $i++) {
                echo '<select name="category" id="category">';
                echo '<option value="none"> Select '. $arr[$i-1]. '</option>';
                $query="SELECT * FROM `job_sub_category`";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    if($row['job_category_id'] == $i) {
                      echo '<option value="'.$row['job_category_id'].'">'.$row['sub_category'].'</option> ';
                    }
                  }
                }
                echo '</select>';
              }
            ?>
          </div>
          <div class="grid-x">
            <div class="text-left cell large-6 small-6 medium-6" id='upload-file'>
              <label for="file" class="button">Upload File</label>
              <input type="file" id="file" class="show-for-sr">
            </div>

            <div class="text-right cell large-6 small-6 medium-6" id='buttons'>
              <input type='submit' class="button add-job-btn" name='add-job-btn' value='Add job'/>
            </div>
          </div>

        </form>
      </div>
    </div>
    <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>

<hr>


  <footer class="footer">
    <div class="grid-container text-center">
      <div  class="footer grid-x grid-padding-x">
        <div class="cell small-12 large-4 medium-4">
          <h2> Subscribe to our newsletter </h2>
          <p class="callout" style="background-color: rgb(23,121,186,0.2);color:whitesmoke">
             We send information about new and exciting job offers once a week, we will not spam you, subscribe if you are interested
          </p>
          <form onsubmit="subscribe()">
            <div class="input-group">
              <span class="input-group-label" style="background:inherit;border:1px groove #2196f3"><i class="far fa-paper-plane fa-lg" style="color:#2196f3"></i></span>
              <input class="input-group-field" type="email" id='newsletter_email' placeholder="Enter your Email" pattern="email" required>
                <div class="input-group-button">
                <input type="submit" class="button primary" id='newsletter_email_button' value='Subscribe'>
              </div>
            </div>
          </form>



        </div>
        <div class="cell small-12 large-4 medium-4">
          <h2> Connect with us</h2>
        <div class="grid-y">
            <ul class="cell large-8 menu no-bullet align-center">
              <li><a href='#'><img src="img/facebook.png" /> </a> </li>
              <li><a href='#'><img src="img/whatsapp.png" /> </a></li>
              <li><a href='#'><img src="img/linkedin.png" /> </a></li>
              <li><a href='#'><img src="img/instagram.png" /> </a></li>
              <li><a href='#'><img src="img/twitter.png" /> </a></li>
            </ul>
            <!-- <ul class="menu no-bullet align-center">
              <li><a href='#'><i class="fa fa-facebook fa-3x" style="color:#4267b2"></i> </a> </li>
              <li><a href='#'><i class="fa fa-whatsapp fa-3x" style="color:#29a81a"></i> </a></li>
              <li><a href='#'><i class="fa fa-linkedin fa-3x" style="color:#007bb5"></i> </a></li>
              <li><a href='#'><i class="fa fa-instagram fa-3x" style="color:#de3566"></i> </a></li>
              <li><a href='#'><i class="fa fa-twitter fa-3x" style="color:#00aced"></i> </a></li>
            </ul> -->
            <p  class="cell auto">
              &copy; 2020 Tapti Inc&#8482;. All rights reserved.
            </p>
        </div>

        </div>
        <div class="cell small-12 large-4 medium-4">
             <h2> Designed By</h2>
             <p>
              Tapti Laboritories<br>
              Tapti Hostel, <br>
              Jawaharlal Nehru University, <br>
            </p>

          <div id='gototop'><a onclick = 'goToTop()'><i class="fas fa-chevron-circle-up fa-2x"></i></a></div>
        </div>
      </div>
    </div>
	</footer>

    <script src="./js/script.js"></script>
    <script src="./js/app.js"></script>



    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app-foundation.js"></script>

    <script type="text/javascript">
      if($(#contact).length){
        console.log("Trippy");
      }
    	var job_container=$(".job-container");
    	var searchedJobsHtml = "";
    	$(function(){
    		$("#search-input").on("keyup",function(){
    			var searchKey=$("#search-input").val();
    			var searchedJobs= app.searchJobs(searchKey);
    		});
    	});
    </script>
  </body>
</html>
