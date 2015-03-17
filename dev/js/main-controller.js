var showSelectGoals = function(){
	$(".welcomeInfo").show();
	$(".selectGoals").show();
}

var backToWelcome = function(){
	$(".welcomeInfo").show();
	$(".selectGoals").show();
}

function checkIfEmpty(field) {
    if (field.value == '') {
    	document.getElementById("userGoal").checked = false;
    } else {
    	document.getElementById("userGoal").checked = true;
    }
}
function goBack() {
    window.history.back()
}

$("#customGoalForm").keypress(function(e) {
    if(e.which == 10 || e.which == 13){
        e.preventDefault();
        addGoalFunction(function() {
        refreshMyGoals();
        });
    }
});

$("#refreshGoals").click(function(){
    refreshMyGoals();
});

function refreshMyGoals(){
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        document.getElementById("myCustomGoals").innerHTML = xmlhttp.responseText;
    }
    // document.getElementById("myCustomGoals").innerHTML = xmlhttp.responseText;
    xmlhttp.open("GET", "php/outputCustomGoals.php", true);
    xmlhttp.send();
}

function toLogin(){
    location.href="login.php";
}

function logOut(){
    if(confirm("Du är inloggad som "+getCookie("username")+". Vill du logga ut?")){
        location.href="php/logout.php";
    }
    else
    {
        //Cancel button pressed...
    }
}

// ***** AJAX TO SHOW LOGIN/REGISTER *****
function loginOrRegister(str) {
    if (str == "") {
        document.getElementById("loginOrRegister").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("loginOrRegister").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","php/getUser.php?q="+str,true);
        xmlhttp.send();
    }
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function unsetCookie(cname) {
    document.cookie = cname + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

var a=document.getElementsByTagName("a");
for(var i=0;i<a.length;i++)
{
    a[i].onclick=function()
    {
        window.location=this.getAttribute("href");
        return false
    }
}