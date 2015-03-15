
window.onload = function() {
	generateMyGoals();
	generateTotalHighscore();
	generateDailyHighscore();
	showMyGoals();
};

function showMyGoals(){
	$("#goalView").show();
	$("#highscoreView").hide();
	$("#statsView").hide()
	$(".highscore").css({backgroundColor: ''});
	$(".goals").css({backgroundColor: 'rgb(65, 65, 65)'});
	$(".stats").css({backgroundColor: ''});
	generateMyGoals();

}

function showHighscore(){
	$("#highscoreView").show();
	$("#goalView").hide();
	$("#statsView").hide();
	$(".highscore").css({backgroundColor: 'rgb(65, 65, 65)'});
	$(".stats").css({backgroundColor: ''});
	$(".goals").css({backgroundColor: ''});

}

function showMyStats(){
	$("#statsView").show();
	$("#goalView").hide();
	$("#highscoreView").hide();
	$(".highscore").css({backgroundColor: ''});
	$(".goals").css({backgroundColor: ''});
	$(".stats").css({backgroundColor: 'rgb(65, 65, 65)'});
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
		tag.style.color = "white";
		// tag.parentNode.parentNode.firstChild.children[0].style.color = "white";
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
		tag.className = tag.getAttribute("class").split(" ")[0]+" accomplished";
		tag.style.color = "green";
		// tag.parentNode.parentNode.firstChild.children[0].style.color = "green";

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
}

// function checkboxTrigger(checkbox){
// 	changeAccomplished(checkbox.parentNode);
// }