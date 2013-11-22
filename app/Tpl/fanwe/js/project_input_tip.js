$(document).ready(function(){

	$(".input-tip-control").focus(function(e) {
        var _id = $(this).attr("ref");
		$("#"+_id).show();
        $(".deal-input-box").css("border-width","5px");
        $(".form_row .textarea3").css({"height":"250px","overflow-y":"auto"});
    });
	$(".input-tip-control").blur(function(e) {
        var _id = $(this).attr("ref");
		$("#"+_id).hide();
        $(".deal-input-box").css("border-width","0px");
        $(".form_row .textarea3").css({"height":"40px","overflow-y":"hidden"});
    });
	$(".cc-tip-control").click(function(){
		var _id = $(this).attr("ref");
		if($("#"+_id).css("display")!="block"){
			$("#"+_id).show();
		}else{
			$("#"+_id).hide();
		}
	});
    $(".deal-info .deal-info-left .deal-remark").click(function(){
        $(".input-tip-control").focus();
    });
    $(".my_form_row #btn_jianjie").click(function(){
        if($(this).css("background-image").indexOf("show")>-1){
            $(".input-tip-control").focus();
            $(this).css("background-image","url(/app/Tpl/fanwe/images/hidesome.jpg)");
        }else{
            $(".input-tip-control").blur();
            $(this).css("background-image","url(/app/Tpl/fanwe/images/showsome.jpg)");
        }
    });
    $('#btn_xiangqing').click(function(){
        //alert($(this).css("background-image").indexOf("show"));
        //parent.var_btnclick=false;
        
        if($(this).css("background-image").indexOf("show")>-1){
            if(var_btnclick==false){
                //$("#deal_title").html($("#deal_title").html()+"*"+$("#xiangqing").css("display")+"*4");
                $("#ta_xiangqing").focus();
            }else{
                //$("#deal_title").html($("#deal_title").html()+"7");
                var_btnclick=false;
            }
            
        }else{
            //$("#deal_title").html($("#deal_title").html()+"1");
            if(var_btnclick==false){
                //$("#deal_title").html($("#deal_title").html()+"2");
                $('#xiangqing').hide();
                $('#ta_xiangqing').show();
                $('.deal-input-box').css('border-width','0px');
                $('#about_xiangqing').hide(); 
                $('#btn_xiangqing').css('background-image','url(/app/Tpl/fanwe/images/showsome.jpg)');
                
            }else{
                //$("#deal_title").html($("#deal_title").html()+"3");
                var_btnclick=false;
            }
        }
    });
    $('#btn_liangdian').click(function(){
        
        if($(this).css("background-image").indexOf("show")>-1){
            if(var_btnclick==false){
                //$("#deal_title").html($("#deal_title").html()+"*"+$("#liangdian").css("display")+"*4");
                $("#ta_liangdian").focus();
            }else{
                //$("#deal_title").html($("#deal_title").html()+"7");
                var_btnclick=false;
            }
            
        }else{
            //$("#deal_title").html($("#deal_title").html()+"1");
            if(var_btnclick==false){
                //$("#deal_title").html($("#deal_title").html()+"2");
                $('#liangdian').hide();
                $('#ta_liangdian').show();
                $('.deal-input-box').css('border-width','0px');
                $('#about_liangdian').hide(); 
                $('#btn_liangdian').css('background-image','url(/app/Tpl/fanwe/images/showsome.jpg)');
                
            }else{
                //$("#deal_title").html($("#deal_title").html()+"3");
                var_btnclick=false;
            }
        }
    });
    $("#ta_xiangqing").focus(function(){
        var_btnclick=false;
        $(this).hide();
        $("#xiangqing").show();
        $(".deal-input-box").css("border-width","5px");
        $("#xiangqing .ke-iframe").focus();
        $('#btn_xiangqing').css("background-image","url(/app/Tpl/fanwe/images/hidesome.jpg)");
         
    })
    $("#ta_liangdian").focus(function(){
        var_btnclick=false;
        $(this).hide();
        $("#liangdian").show();
        $(".deal-input-box").css("border-width","5px");
        $("#liangdian .ke-iframe").focus();
        $("#about_liangdian").show();
        $('#btn_liangdian').css("background-image","url(/app/Tpl/fanwe/images/hidesome.jpg)");
    })
     $("#ta_xiangqing").focus();
});