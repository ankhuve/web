$(window).load(function(){

	// Hämta de förbestämda målen från databasen
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            createGoals(xmlhttp.responseText);
        }
    }
    xmlhttp.open("GET","php/getGoals.php",true);
    xmlhttp.send();

    $.ajax({
    	type: "GET",
        url: 'php/getMyTasklist.php',
        success: function(data){
        	if(data != ""){
	        	var returnedTasklist = data.split(",");
	        	for(i in returnedTasklist){
		        	$("div.goalButton#"+returnedTasklist[i]).click();
        		}
    		}

        }
    });
    //Create the goal boxes
    var createGoals = function(data){
    	var data = JSON.parse(data);
		for ( var i = 0; i < data.length; i++ ) {
			$( '<div class="col-xs-4 col-sm-2 col-md-2 goalButton" id='+data[i].taskID+'><p>'+data[i].taskDescription+'</p><div class="taskPoints">'+data[i].taskPoints+' poäng</div></div>' ).appendTo( ".goalGrid" );
		}
		chooseGoal();
	}

	clicked = [];

	var chooseGoal = function(){
		$( "div.goalButton" ).click(function() {
			var found = false;
			for(k = 0; k < clicked.length; k++){
				if(clicked[k]===$(this).attr("id")){
					found = true;
				}
			}
			if (!found){
				if(clicked.length != 5){
					clicked.push($(this).attr("id"));
					$(this).removeClass('fixGoalBgGray');
					$(this).addClass('fixGoalBgGreen');
					var parentHeight = $(this).find(">:first-child").height()+12;
					$('<div class="confirmBox" id='+$(this).attr("id")+'>').appendTo(this);
					$("#"+$(this).attr("id")).find(".confirmBox").css({top: -parentHeight});
					$("#"+$(this).attr("id")+".confirmBox").show(200);
					$( "div.confirmBox" ).click(function() {
						$(this).hide(200, function(){
							$(this).remove();
						});
						
					})
				} else {
					alert("Du har redan valt 5/5 mål.");
				}
			}else{
				var index = clicked.indexOf($(this).attr("id"));
				$(this).removeClass('fixGoalBgGreen');
				$(this).addClass('fixGoalBgGray');
				if(index>-1){
					clicked.splice(index, 1);
				}
			}

			document.getElementById("numChosenGoals").innerHTML=clicked.length;
		});
	};

	$(".toCustomGoals").click(function(){
		
		// Cookien tas bort en timma efter att den satts
		var expireTime = new Date(new Date().getTime() + 1000*60*60);
		if(clicked.length != 0){
			document.cookie = "clicked="+clicked+"; expires="+expireTime;
		};
	});
});