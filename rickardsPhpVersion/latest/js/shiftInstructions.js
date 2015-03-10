$(document).ready(function() {
    $('.welcomeInstruction').on("swipeleft", function(){
        console.log("cluickad"+$(this).attr('id'));
        $(this).hide();
    });
});