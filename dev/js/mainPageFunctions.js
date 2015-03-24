window.onload = function() {
	if(getCookie("userID")===""){
		alert("Du är inte inloggad!");
		toLogin();
	}
	getUsername();
	generateMyGoals();

	showMyGoals();
	getMyStats();
	clickLog('4');
};

var updated = new Date();
var username = "";

function getUsername(){
	$.ajax({
		type: "GET",
		url: "php/getMyUsername.php",
		success: function(data){
			$(".username").html(data);
			username = data;
		}
	});
}

function logOut(){
    if(confirm("Du är inloggad som "+username+". Vill du logga ut?")){
    	unsetCookie('userID');
        window.location="php/logout.php";
    }
    else
    {
        //Cancel button pressed...
    }
}

function slideMenu(){
	$("#slideMenu").show();
	$("#slideMenu").animate({
		left: "0px",
	}, "fast", function(){
		
		$(".menubutton").attr("onclick", "slideBackMenu()")
	})
};

function slideBackMenu(){
	$("#slideMenu").animate({
		left: "-70%"
	}, "fast", function(){
		$("#slideMenu").hide();
		$(".menubutton").attr("onclick", "slideMenu()")
	})
};

function clickLog(type){
	$.ajax({
		type: "POST",
		data: { type : type },
		url: "php/clickLog.php"
	});
} 

function getMyStats(){
	google.load("visualization", "1", {packages:["corechart"]});
    $.ajax({
    	type: "GET",
        url: 'php/generateMyStats.php',
        success: function(data){
        	generateMyStats(data);	
        }
    });
}

function generateMyStats(data){
	var accomplished = data.split(",")[0];
	var available = data.split(",")[1];
	var accomplishedEver = data.split(",")[2];
	var possibleEver = data.split(",")[3];
	var daysOfUsage = data.split(",")[4];
	var avgPts = accomplishedEver/daysOfUsage;
	$("#pointsToday").html(accomplished);
	$("#pointsTotal").html(accomplishedEver);
	$("#avgDailyPoints").html(avgPts.toFixed(1));
	drawStats(accomplished, available, accomplishedEver, possibleEver);
}

function drawStats(completed, total, completedEver, totalEver){
	offsetDaily = 0;
	if(parseInt(completed)>0){
		offsetDaily = 0.1;
	}

	offsetTotal = 0;
	if(parseInt(completedEver)>0){
		offsetTotal = 0.1;
	}
	var data = google.visualization.arrayToDataTable([
	  ['Avklarade', 'Poäng'],
	  ['Avklarade poäng', parseInt(completed)],
	  ['Missade poäng', parseInt(parseInt(total)-parseInt(completed))]
	]);

	var dataTotal = google.visualization.arrayToDataTable([
		['Avklarade', 'Poäng'],
		['Avklarade poäng', parseInt(completedEver)],
		['Missade poäng', parseInt(parseInt(totalEver)-parseInt(completedEver))]
	]);

	var optionsDaily = {
		legend: 'none',
		tooltip: {trigger: 'selection'},
		slices: {
			0: {color: 'rgb(100, 187, 80)'},
			1: {offset: offsetDaily}},
		backgroundColor: 'rgb(33, 33, 33)',
		pieSliceBorderColor: 'none',
	};

	var optionsTotal = {
		legend: 'none',
		tooltip: {trigger: 'selection'},
		slices: {
			0: {color: 'rgb(100, 187, 80)'},
			1: {offset: offsetTotal}},
		backgroundColor: 'rgb(33, 33, 33)',
		pieSliceBorderColor: 'none',
	};

	var chart = new google.visualization.PieChart(document.getElementById('myDailyStats'));
	var chartTotal = new google.visualization.PieChart(document.getElementById('myTotalStats'));

	chart.draw(data, optionsDaily); // Rita upp dagliga stats
	chartTotal.draw(dataTotal, optionsTotal); // Rita upp totala stats
}

function showMyGoals(){
	$("#goalView").show();

	$("#statsView").hide()
	$(".headerTitle").html("Mina mål");
	$(".headerTitle").animate({left: "-10%"}, 50, "linear");

	$(".myGoals").css({backgroundColor: 'rgb(65, 65, 65)'});
	$(".stats").css({backgroundColor: ''});

	$(".myGoals").css({borderTop: 'solid 3px #64bb50'});
	$(".stats").css({borderTop: 'solid 3px rgb(65, 65, 65)'});
	generateMyGoals();
}

function showMyStats(){
	getMyStats();
	$("#statsView").show();
	$("#goalView").hide();

	$(".headerTitle").html("Statistik");
	$(".headerTitle").animate({left: "-10%"}, 50, "linear");

	$(".myGoals").css({backgroundColor: ''});
	$(".stats").css({backgroundColor: 'rgb(65, 65, 65)'});

	$(".myGoals").css({borderTop: 'solid 3px rgb(65, 65, 65)'});
	$(".stats").css({borderTop: 'solid 3px #64bb50'});
}


function generateMyGoals(){
	$.ajax({
		type: "GET",
		url: "php/generateMyGoals.php",
		success: function(data){
			document.getElementById("myTasks").innerHTML = data;
			// console.log(data);
		}
	})
}

function changeAccomplished(tag){
	var tag = tag.children[1].firstChild;
	
	if(tag.getAttribute("class").split(" ")[1] === "accomplished"){
		var accomplished = true;
	} else {
		var accomplished = false;
	}
	var taskID = tag.id;

	
	if(accomplished){// UNACCOMPLISH ME
		tag.className = tag.getAttribute("class").split(" ")[0]+" unaccomplished";
		tag.style.color = "#ffffe8";
		$(tag).parent().prev().removeClass("checkBg");
		$(tag).parent().prev().children().show();
	    $.ajax({
	        type: "POST",
	        url: 'php/unAccomplishGoal.php',
	        data: { taskID : taskID },
	        success: function(){
				getMyStats();
	        }
    });

	} else { // ACCOMPLISH ME
		tag.className = tag.getAttribute("class").split(" ")[0]+" accomplished";
		tag.style.color = "rgba(255, 255, 255, 0.5)";
		$(tag).parent().prev().addClass("checkBg");
		$(tag).parent().prev().children().hide();

	    $.ajax({
        	type: "POST",
        	url: 'php/accomplishGoal.php',
        	data: { taskID : taskID },
        	success: function(){				
				getMyStats();
        	}
    	});
	}
}