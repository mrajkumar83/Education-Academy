$().ready(function() {
$( "div ul li a" ).bind( "click", function() {
	$("li.leftMenuActive").removeClass("leftMenuActive");
	$(this).parent().addClass("leftMenuActive");
});
});