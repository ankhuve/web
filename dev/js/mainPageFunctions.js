
window.onload = function() {
	generateMyGoals();
	generateTotalHighscore();
	generateDailyHighscore();
	$("#goalView").show();
	$("#highscoreView").hide();
	$("#statsView").hide();
};

function showMyGoals(){
	$("#goalView").show();
	$("#highscoreView").hide();
	$("#statsView").hide();
	generateMyGoals();
}

function showHighscore(){
	$("#highscoreView").show();
	$("#goalView").hide();
	$("#statsView").hide();
}

function showMyStats(){
	$("#statsView").show();
	$("#goalView").hide();
	$("#highscoreView").hide();
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
	var taskID = tag.childNodes[0].value;
	var checked = tag.childNodes[0].checked;
	
	if(checked){// UNACCOMPLISH ME
		tag.childNodes[0].checked = false;
		tag.style.color = "red";
	    $.ajax({
	        type: "POST",
	        url: 'php/unAccomplishGoal.php',
	        data: { taskID : taskID },
	        success: function(){
	        	generateTotalHighscore();
				generateDailyHighscore();
	        }
    });

	} else { // ACCOMPLISH ME
		tag.childNodes[0].checked = true;
		tag.style.color = "green";
	    $.ajax({
        	type: "POST",
        	url: 'php/accomplishGoal.php',
        	data: { taskID : taskID },
        	success: function(){
        		generateTotalHighscore();
				generateDailyHighscore();
        	}
    	});
	}
	// generateTotalHighscore();
	// generateDailyHighscore();
}

function checkboxTrigger(checkbox){
	changeAccomplished(checkbox.parentNode);
}