$(document).ready(function() {
		
	//Default Action
	$(".tab-content").hide();
	$("ul.tabs li:first a").addClass("active"); 
	$("ul.tabs li:first ").show(); 
	$(".tab-content:first").show(); 
	
	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li a").removeClass("active");
		$(this).find("a").addClass("active"); 
		$(".tab-content").hide(); 
		var activeTab = $(this).find("a").attr("href"); 
		$(activeTab).fadeIn();
		return false;
	});

});