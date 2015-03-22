$("#customGoalForm").keypress(function(e) {
    if(e.which == 10 || e.which == 13){
        e.preventDefault();
        addGoalFunction(function() {
        refreshMyGoals();
        });
    }
});