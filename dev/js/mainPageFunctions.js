
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
	$(".headerTitle").html("Mina mål");
	$(".highscore").css({backgroundColor: ''});
	$(".myGoals").css({backgroundColor: 'rgb(65, 65, 65)'});
	$(".stats").css({backgroundColor: ''});
	$(".highscore").css({borderTop: 'solid 3px rgb(65, 65, 65)'});
	$(".myGoals").css({borderTop: 'solid 3px #64bb50'});
	$(".stats").css({borderTop: 'solid 3px rgb(65, 65, 65)'});
	generateMyGoals();

}

function showHighscore(){
	$("#highscoreView").show();
	$("#highscoreTotal").hide();
	$("#highscoreDaily").show();
	$("#goalView").hide();
	$("#statsView").hide();
	$(".headerTitle").html("Daglig topplista");
	$(".highscore").css({backgroundColor: 'rgb(65, 65, 65)'});
	$(".stats").css({backgroundColor: ''});
	$(".myGoals").css({backgroundColor: ''});
	$(".highscore").css({borderTop: 'solid 3px #64bb50'});
	$(".myGoals").css({borderTop: 'solid 3px rgb(65, 65, 65)'});
	$(".stats").css({borderTop: 'solid 3px rgb(65, 65, 65)'});
	$(".toggleDaily").attr("id", "total");
	$(".toggleDaily").removeClass("bg1");
}

function showMyStats(){
	$("#statsView").show();
	$("#goalView").hide();
	$("#highscoreView").hide();
	$(".headerTitle").html("Statistik");
	$(".highscore").css({backgroundColor: ''});
	$(".goals").css({backgroundColor: ''});
	$(".stats").css({backgroundColor: 'rgb(65, 65, 65)'});
	$(".highscore").css({borderTop: 'solid 3px rgb(65, 65, 65)'});
	$(".myGoals").css({borderTop: 'solid 3px rgb(65, 65, 65)'});
	$(".stats").css({borderTop: 'solid 3px #64bb50'});

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
