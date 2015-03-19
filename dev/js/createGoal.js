// var customGoals = [];
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      createGoal();
    }
  });
});

var customGoals = 0;
if(getCookie("clicked")===""){
	predefinedGoals = 0;
}else{
	var predefinedGoals = getCookie('clicked').split(",").length;
}
var updateChosen = function(){
	document.getElementById("totalGoals").innerHTML = customGoals+predefinedGoals;
}


var createGoal = function(){
	var userInput = document.getElementById("goalInput").value;
	if(userInput != ''){
		$(".createdGoals").append('<p class="noMargin ownGoal"><span  onclick="removeCustom(this)" class="glyphicon glyphicon-remove"></span><input type="checkbox" name="taskDesc[]" value="'+userInput+'" checked="checked">'+userInput+'</input><span id="ownGoalPoints">10 p</span></p>');
		document.getElementById("goalInput").value = "";
		document.getElementById("goalInput").focus();
		customGoals += 1;
		updateChosen();
	}
}

var removeCustom = function(tag){
	tag.parentNode.remove();
	customGoals -= 1;
	updateChosen();
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