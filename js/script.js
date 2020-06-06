function openNav() {
  document.getElementById("mySidenav").style.width = "200px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}
function openLogin() {
  document.getElementById("mySidenav").style.width = "200px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.body.style.backgroundColor = "white";
}


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
