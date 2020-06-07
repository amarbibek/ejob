window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  	if (document.documentElement.scrollTop > 20) {
    	document.getElementById('gototop').style.display = "block";
    	document.getElementById('gototop').style.color = "black";

   	  if(document.documentElement.scrollTop > 1000){    //this is just temporary 
	     document.getElementById('gototop').style.display = "block";
			 document.getElementById('gototop').style.color = "white";
		}
  	} 
  	else{
		document.getElementById('gototop').style.display = "none";
  	}
}  


function goToTop() {
	document.documentElement.scrollTop = 0;
}

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("admin-wrapper").style.marginRight = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  document.getElementById("three-lines").style.display = "none";

}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("admin-wrapper").style.marginRight = "0";
  document.body.style.backgroundColor = "white";
    document.getElementById("three-lines").style.display = "block";

}