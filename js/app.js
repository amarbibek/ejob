app = {
  searchJobs: function (searchKey) {
    $.ajax({
      method: "GET",
      url: "includes/getSearchJobs.php",
      data: { searchKey: searchKey },
    }).done(function (msg) {
      jobs = msg.split("-eol-");
      searchedJobsHtml = "";
      $.each(jobs, function (i, val) {
        debugger;
        if (val) {
          job = val.split("-eow-");
          searchedJobsHtml += '<div class="jobs">';
          if (job[4] != "") {
            searchedJobsHtml +=
              '<div class="job-pdf" ><a title="Download" href=  "' +
              job[4] +
              '" target="_blank">&#10247;</a></div>';
          }
          searchedJobsHtml +=
            '<div class="job-title"><a href="#">' + job[1] + "</a></div>";
          searchedJobsHtml +=
            '<div class="job-details"><a href="#">' + job[2] + "</a></div>";

          searchedJobsHtml += "</div>";
        }
      });
      if (jobs.length === 1) {
        searchedJobsHtml = "<h2>No jobs found...</h2>";
      }
      $(job_container).val("").html(searchedJobsHtml);
    });
  },
};
