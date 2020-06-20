app = {
  searchJobs: function (searchKey) {
    $.ajax({
      method: "GET",
      url: "includes/getSearchJobs.php",
      data: { searchKey: searchKey },
    }).done(function (msg) {
      jobs = msg.split("-eol-");
      searchedJobsHtml = "";
      searchedJobsHtml += '<div class="grid-container"><div class= "grid-x grid-padding-x grid-padding-y job-container" >';
      $.each(jobs, function (i, val) {
        // debugger;
        if (val) {
          job = val.split("-eow-");

          searchedJobsHtml += '<div class="cell large-4 meduim-6 small-12 jobs"><div class="job"><div class="job-main">';

          searchedJobsHtml += '<div class="gird-x"><div class="cell large-12 medium-12 small-12 job-title"><a href="#">' + job[1] + "</a></div></div>";
          searchedJobsHtml += '<div class="job-details"><a href="#">' + job[2] + "</a></div> </div>";

          searchedJobsHtml += '<div class="overlay"><div class="visit-site">';
          if (job[4] != "") {
            searchedJobsHtml += '<div class="job-pdf" ><a title="Download" href=  "' + job[4] + '" target="_blank"><i class="fa fa-download"></i></a></div>';
          }
          searchedJobsHtml += '<a href="'+ job[5]+'" target="_blank"> Apply Here <i class="fas fa-arrow-circle-right"></i> </a>';
          searchedJobsHtml += '</div></div></div></div>';
        }
      });
      if (jobs.length === 1) {
        searchedJobsHtml +=
          '<div class="cell large-12 small-12 meduim-12 jobs" style="height:50vh;"> <h1 class="callout">No jobs matching <em>' +
          searchKey +
          '</em></h1><h3 class="secondary">Search again</h3> </div>';
      }
      searchedJobsHtml += '</div></div>';
      $(job_container).val("").html(searchedJobsHtml);
    });
  },
  insertCategory: function (selectedCategoryId, catName) {
    $.ajax({
      method: "GET",
      url:
        "includes/insertCategory.php?selectedCategoryId=" +
        selectedCategoryId +
        "&catName=" +
        catName,
      // data: { searchKey: searchKey },
    }).done(function (msg) {
      // debugger;
      if (msg === "success") {
        $.toast({
          heading: "Added",
          text: "Category has been deleted!",
          position: "top-right",
          icon: "success",
          stack: true,
        });
        location.reload();
      }
    });
  },
  insertEmailList: function (email) {
    $.ajax({
      method: "GET",
      url: "includes/insertEmailList.php?email=" + email,
    }).done(function (msg) {
      // debugger;
      if (msg === "success") {
        $.toast({
          heading: "Added",
          text: "You have been added to our email list!",
          position: "top-right",
          icon: "success",
          stack: true,
        });
        // location.reload();
      }
    });
  },
  insertSubCategory: function (selectedCategoryId, subCatName) {
    $.ajax({
      method: "GET",
      url:
        "includes/insertSubCategory.php?selectedCategoryId=" +
        selectedCategoryId +
        "&subCatName=" +
        subCatName,
    }).done(function (msg) {
      // debugger;
      if (msg === "success") {
        $.toast({
          heading: "Added",
          text: "Sub Category has been deleted!",
          position: "top-right",
          icon: "success",
          stack: true,
        });
        location.reload();
      }
    });
  },
};
