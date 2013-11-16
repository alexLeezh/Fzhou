$(document).ready(function() {
    $(".filter-show-o-button").click(function(e) {
		if($(".filter-tags-others").css("display")!="block"){
			$(this).attr("class","bt-curr");
        	$(".filter-tags-others").show();
		}else{
			$(this).attr("class","filter-show-o-button");
			$(".filter-tags-others").hide();
		}
    });
    
    
    $('.progress-bar').each(function(index, element) {
    	var percent = $(this).attr('title');
        var _l=percent.substr(0,percent.indexOf("%"));
        if(!isNaN(_l)&&parseInt(_l)<=12) $(this).animate({width:26},1000);
    	else if(!isNaN(_l)&&parseInt(_l)>=100) $(this).animate({width:'100%'},1000);
        else $(this).animate({width:percent},1000);
    });
	
	$("#filterListStyle").click(function(e) {
        $("#projectList").attr("class",$(this).attr("bclass"));
		$(this).attr("class","filter-show-list-lb-curr");
		$("#filterViewStyle").attr("class","filter-show-list-fg");
    });
	$("#filterViewStyle").click(function(e) {
        $("#projectList").attr("class",$(this).attr("bclass"));
		$("#filterListStyle").attr("class","filter-show-list-lb");
		$(this).attr("class","filter-show-list-fg-curr");
    });
    
});