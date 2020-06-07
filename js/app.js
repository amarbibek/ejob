app = {
  //   printHello: function () {
  //     // echo("Hello");
  //     return "Hello";
  //   },
  //   printHello: function (name) {
  //     return name + "Hello";
  //   },
  searchJobs: async function (searchKey) {
    await $.ajax({
      method: "GET",
      url: "includes/getSearchJobs.php",
      data: { searchKey: searchKey },
    }).done(function (msg) {
      return msg;
    });
  },
};
