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

function toNewUser(){
    location.href="newUser.php";
}



