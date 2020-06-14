window.onload = function(){
  $add_job_main = $("#add-job-main");

  $add_job_main.on("mouseover",()=>{
    $("#admin-menu").css("display","block")
  });

  $add_job_main.on("mouseout",()=>{
    setTimeout(function(){
      $("#admin-menu").css("display","none");
    }, 2000 )
    });
}


window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  	if (document.documentElement.scrollTop > 20) {
    	document.getElementById('gototop').style.display = "block";
    	document.getElementById('gototop').style.color = "#4caf50";

  //  	  if(document.documentElement.scrollTop > 1000){
	 //     document.getElementById('gototop').style.display = "block";
		// 	 document.getElementById('gototop').style.color = "white";
		// }
  	}
  	else{
		document.getElementById('gototop').style.display = "none";
  	}
}


function goToTop() {
	document.documentElement.scrollTop = 0;
}
