window.onload = function() {
	if(getCookie("userID")===""){
		alert("Hörröduru, du är ju inte inloggad!");
		toLogin();
	}
};