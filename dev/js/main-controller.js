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
// function goBack() {
//     window.history.back();
// }

// $("#refreshGoals").click(function(){
    
//     refreshMyGoals();
// });

// $(".userinput").focus(function(){
//     $(this).attr("placeholder", "none");
// });

function toggleLogo(toggle){
    if(toggle===1){
        $('.logoHolder').hide(200);
    }else{
        $('.logoHolder').show(200);
    }
}

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

function toSummary(){
    location.href="summary.php";
}

function toGoals(){
    location.href="goals.php";
}

function toCreate(){
    location.href="create.php";
}

function toWelcome(){
    location.href="welcome.php";
}

function chooseNewGoals(){
    $.ajax({
        type: "GET",
        url: "php/getTime.php",
        success: function(data){
            if(data<12){
                changeAlert("allowed");
            } else {
                changeAlert("declined");
            }
            // console.log(data);
        }
    })

}

function changeAlert(status){
    if(status === "allowed"){
        if(confirm("Dina poäng för dagen kommer att nollställas om du vill välja nya mål. Vill du fortfarande göra det?")){
            window.location="goals.php";
        } 
    } else {
        alert("Du kan endast ändra dina mål innan klockan 12.");
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
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length).replace(/\+/g,' ');
    }
    return "";
}

function unsetCookie(cname) {
    document.cookie = cname + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}