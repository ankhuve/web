var customGoals = [];

var createGoal = function(){
	$(".createdGoals").append("<p>"+document.getElementById("goalInput").value+"</p>");
	customGoals.push(document.getElementById("goalInput").value);
	document.getElementById("goalInput").value = "";
}