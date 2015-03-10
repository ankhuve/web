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

$("#addGoal").click(function(){
    addGoalFunction(function() {
    refreshMyGoals();
    });
});

$("#refreshGoals").click(function(){
    refreshMyGoals();
});

// $(document).ready(function() {
var addGoal = function(){
    var userInput = document.getElementById("userInput").value;

    $.ajax({
        type: "POST",
        url: 'php/addCustomGoalFunction.php',
        data: { userInput : userInput },
        success: function(data)
        {
            console.log("Success!");
            console.log(data);
        }
    });
}

function addGoalFunction(callback){
    addGoal();
    callback();
};


// $("#addGoal").click(function() {
// 	var userInput = document.getElementById("userInput").value;

//     $.ajax({
//         type: "POST",
//         url: 'php/addCustomGoalFunction.php',
//         data: { userInput : userInput },
//         success: function(data)
//         {
//         	console.log("Success!");
//             console.log(data);
//         }
//     });

//     // outputCustomGoals();
//     refreshMyGoals();
//     document.getElementById("userInput").value = "";
// });
// });

// ****** Typ en lite säkrare version av refreshMyGoals eller nåt... ******
// function outputCustomGoals(){
//     console.log("outputCustomGoals initiated!");
// 	var xmlhttp;
// 	xmlhttp = new XMLHttpRequest();

// 	xmlhttp.onreadystatechange=function(){
// 		if(xmlhttp.readyState==4 && xmlhttp.status==200){
// 			document.getElementById("myCustomGoals").innerHTML = xmlhttp.responseText;
// 		} else {
//             console.log("readyState or status incorrect");
//         }
// 	}

	
// 	console.log("SENDING GET REQUEST");
// 	xmlhttp.open("GET", "php/outputCustomGoals.php", true);
// 	xmlhttp.send();

//     console.log("outputCustomGoals complete!");
// }

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
    location.href="php/logout.php";
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

// function toNewUser(){
//     location.href="newUser.php";
// }
