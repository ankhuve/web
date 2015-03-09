// $('#goalButton').click(function(){
// 	$(this).hide();
// });
console.log("mjao");
$(window).load(function(){
	for ( var i = 0; i < 20; i++ ) {
		$( '<div class="col-xs-4 col-sm-2 col-md-2 goalButton" id='+i+'><p class="center">Panta en burk</p></div>' ).appendTo( ".goalGrid" );
	}
	var clicked = [];
	$( "div.goalButton" ).click(function() {
		var found = false;
		for(k = 0; k < clicked.length; k++){
			if(clicked[k]===$(this).attr("id")){
				found = true;
			}
		}
		if (!found){
			clicked.push($(this).attr("id"));
			$(this).find(">:first-child").animate({opacity:'0.5'},200);
			$('<div class="confirmBox" id='+$(this).attr("id")+'>').appendTo(this);
			$("#"+$(this).attr("id")+".confirmBox").show(200);
			$( "div.confirmBox" ).click(function() {
				$(this).remove();
			})
		}else{
			var index = clicked.indexOf($(this).attr("id"));
			$(this).find(">:first-child").animate({opacity:'1'},200);
			if(index>-1){
				clicked.splice(index, 1);
			}
		}
		
	});

	

})