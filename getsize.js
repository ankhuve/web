$(document).ready(function() {
    //* Tar bort möjlighet att scrolla i appen *//
    // document.ontouchmove = function(e) {e.preventDefault()};

    var viewportWidth = $(window).width();
    var viewportHeight = $(window).height();
    $('.container.fullWidth').css('width', viewportWidth)
    $('.container.fullWidth').css('height', viewportHeight)
    $(window).resize(function(){
        var viewportWidth = $(window).width();
        var viewportHeight = $(window).height();
        $('.container.fullWidth').css('width', viewportWidth)
        $('.container.fullWidth').css('min-height', viewportHeight)
    });
});