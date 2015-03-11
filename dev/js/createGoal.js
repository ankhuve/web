// var customGoals = [];
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      // return false;
      createGoal();
    }
  });
});

var createGoal = function(){
	var userInput = document.getElementById("goalInput").value;
	if(userInput != ''){
		console.log(userInput);
		$(".createdGoals").append('<p><input type="checkbox" name="taskDesc[]" value="'+userInput+'" checked="checked">'+userInput+'</input></p>');
	// customGoals.push();
		document.getElementById("goalInput").value = "";
		document.getElementById("goalInput").focus();
	}

}