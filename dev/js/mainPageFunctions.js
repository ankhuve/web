window.onload = function() {
	if(getCookie("userID")===""){
		alert("Hörröduru, du är ju inte inloggad!");
		toLogin();
	}
	generateMyGoals();
	generateTotalHighscore();
	generateDailyHighscore();
	showMyGoals();
	getMyStats();
};

// window.onbeforeunload = function(){
// }

function clickLog(type){
	// console.log("Clicked "+type);
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
	drawStats(accomplished, available, accomplishedEver, possibleEver);
}

function drawStats(completed, total, completedEver, totalEver){
	
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

	var options = {
		legend: 'none',
		slices: {
			0: {color: 'rgb(100, 187, 80)'},
			1: {offset: 0.1}},
		backgroundColor: 'rgb(33, 33, 33)',
		pieSliceBorderColor: 'none',
	};

	var chart = new google.visualization.PieChart(document.getElementById('myDailyStats'));
	var chartTotal = new google.visualization.PieChart(document.getElementById('myTotalStats'));

	chart.draw(data, options); // Rita upp dagliga stats
	chartTotal.draw(dataTotal, options); // Rita upp totala stats
}

function showMyGoals(){
	$("#goalView").show();
	$("#highscoreView").hide();
	$("#statsView").hide()
	$(".headerTitle").html("Mina mål");
	$(".headerTitle").animate({left: "-10vw"}, 50, "linear");
	$(".highscore").css({backgroundColor: ''});
	$(".myGoals").css({backgroundColor: 'rgb(65, 65, 65)'});
	$(".stats").css({backgroundColor: ''});
	$(".highscore").css({borderTop: 'solid 3px rgb(65, 65, 65)'});
	$(".myGoals").css({borderTop: 'solid 3px #64bb50'});
	$(".stats").css({borderTop: 'solid 3px rgb(65, 65, 65)'});
	generateMyGoals();
	clickLog("1");
}

function showHighscore(){
	$("#highscoreView").show();
	$("#highscoreTotal").hide();
	$("#highscoreDaily").show();
	$("#goalView").hide();
	$("#statsView").hide();
	$(".headerTitle").html("Daglig topplista");
	$(".headerTitle").animate({left: "-4vw"}, 50, "linear");
	$(".highscore").css({backgroundColor: 'rgb(65, 65, 65)'});
	$(".stats").css({backgroundColor: ''});
	$(".myGoals").css({backgroundColor: 'rgb(33, 33, 33)'});
	$(".highscore").css({borderTop: 'solid 3px #64bb50'});
	$(".myGoals").css({borderTop: 'solid 3px rgb(65, 65, 65)'});
	$(".stats").css({borderTop: 'solid 3px rgb(65, 65, 65)'});
	$(".toggleDaily").attr("id", "total");
	$(".toggleDaily").removeClass("bg1");
	clickLog("2");
}

function showMyStats(){
	getMyStats();
	$("#statsView").show();
	$("#goalView").hide();
	$("#highscoreView").hide();
	$(".headerTitle").html("Statistik");
	$(".headerTitle").animate({left: "-10vw"}, 50, "linear");
	$(".highscore").css({backgroundColor: ''});
	$(".myGoals").css({backgroundColor: ''});
	$(".stats").css({backgroundColor: 'rgb(65, 65, 65)'});
	$(".highscore").css({borderTop: 'solid 3px rgb(65, 65, 65)'});
	$(".myGoals").css({borderTop: 'solid 3px rgb(65, 65, 65)'});
	$(".stats").css({borderTop: 'solid 3px #64bb50'});
	clickLog("3");

}


function generateMyGoals(){
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        document.getElementById("myTasks").innerHTML = xmlhttp.responseText;
    }
    xmlhttp.open("GET", "php/generateMyGoals.php", true);
    xmlhttp.send();
}

function generateTotalHighscore(){
	xmlhttpHS = new XMLHttpRequest();
	xmlhttpHS.onreadystatechange=function(){
		document.getElementById("highscoreTotal").innerHTML = xmlhttpHS.responseText;
	}
	xmlhttpHS.open("GET", "php/generateTotalHighscore.php", true);
	xmlhttpHS.send();
}

function generateDailyHighscore(){
	xmlhttpDHS = new XMLHttpRequest();
	xmlhttpDHS.onreadystatechange=function(){
		document.getElementById("highscoreDaily").innerHTML = xmlhttpDHS.responseText;
	}
	xmlhttpDHS.open("GET", "php/generateDailyHighscore.php", true);
	xmlhttpDHS.send();
}

function changeAccomplished(tag){

	
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
	        	generateTotalHighscore();
				generateDailyHighscore();
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
        		generateTotalHighscore();
				generateDailyHighscore();
				getMyStats();
        	}
    	});
	}
}

function toggleHighscore(){
	if($(".toggleDaily").attr("id")==="daily"){
		$("#highscoreTotal").hide(200);
		$("#highscoreDaily").show(200);
		$(".headerTitle").html("Daglig topplista");
		$(".toggleDaily").attr("id", "total");
		$(".toggleDaily").removeClass("bg1");
			}else{
		$("#highscoreTotal").show(200);
		$("#highscoreDaily").hide(200);
		$(".headerTitle").html("Total topplista");
		$(".toggleDaily").attr("id", "daily");
		$(".toggleDaily").addClass("bg1");
	}

};
