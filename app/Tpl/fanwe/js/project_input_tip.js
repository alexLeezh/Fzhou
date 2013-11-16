$(document).ready(function(){

	$(".input-tip-control").focus(function(e) {
        var _id = $(this).attr("ref");
		$("#"+_id).show();
    });
	$(".input-tip-control").blur(function(e) {
        var _id = $(this).attr("ref");
		$("#"+_id).hide();
    });
	$(".cc-tip-control").click(function(){
		var _id = $(this).attr("ref");
		if($("#"+_id).css("display")!="block"){
			$("#"+_id).show();
		}else{
			$("#"+_id).hide();
		}
	});
});