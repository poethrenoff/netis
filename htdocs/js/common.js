// JavaScript Document
String.prototype.Trim = function(){
  return this.replace(/(^s*)|(s*$)/g, "");
}
String.prototype.LTrim = function(){
  return this.replace(/(^s*)/g, "");
}
String.prototype.Rtrim = function(){
  return this.replace(/(s*$)/g, "");
}
//导航
jQuery(function(){
	var len=jQuery("#content_2 tr").length;
	for(var i=0;i<len;i++){
		jQuery("#content_2 tr:eq("+i+") td:first").css("width","162px");
	}
	jQuery("#menu ul li").hover(function(){
		jQuery(this).find(".div").show().siblings("a").addClass("hover");
		//jQuery(".homepro li:first").addClass("sel").find(".subsort").show();
	},function(){
		jQuery(this).find(".div").hide().siblings("a").removeClass("hover");
		jQuery(".homepro li:first").removeClass("sel").find(".subsort").hide();
	});
	jQuery(".homepro li").hover(function(){
		jQuery(".homepro li").removeClass("sel").find(".subsort").hide()
		jQuery(this).addClass("sel").find(".subsort").show();
	},function(){
		jQuery(this).removeClass("sel").find(".subsort").hide();
	});
	jQuery(".subsort dd").hover(function(){
		jQuery(this).toggleClass("sel");
	},function(){
		jQuery(this).toggleClass("sel");
	})
	
	jQuery(".searchresult li").live({
		"mouseover":function(){
			jQuery(this).addClass("over");
		},"mouseout":function(){
			jQuery(this).removeClass("over");
		}
	});
	var len=jQuery(".newslist li").length;
	for(var i=0;i<len;i++){
		if(jQuery(".newslist li").eq(i).attr("ifhotnews")=="1"){jQuery(".newslist li").eq(i).find("span").show();}
	}
	len=jQuery(".productlist li").length;
	for(var i=0;i<len;i++){
		if(jQuery(".productlist li").eq(i).attr("hotb")=="1"){jQuery(".productlist li").eq(i).find(".hotpic").show();}
	}
	
	len=jQuery(".homenews_right li").length;
	for(var i=0;i<len;i++){
		if(jQuery(".homenews_right li").eq(i).attr("ifhotnews")=="1"){jQuery(".homenews_right li").eq(i).find("span").show();}
	}
	jQuery("#language").hover(function(){
		jQuery(this).attr("style","background:#074995");
		jQuery(this).find("a").attr("style","color:#fff");
	},function(){
		jQuery(this).attr("style","");
		jQuery(this).find("a").attr("style","")
	})
    for(var i=0;i<jQuery(".newsdes img").length;i++){DrawImage(jQuery(".newsdes img")[i],700,10000000);}

//搜索
	jQuery("#keyword").keyup(function(){test(jQuery(this));	});
	jQuery("#keyword").focus(function(){test(jQuery(this));	});
	jQuery("#keyword").blur(function(){
		jQuery("#searchDiv").hide();
	});
	jQuery("#searchDiv").hover(function(){
		jQuery("#keyword").unbind("blur");
	},function(){
		jQuery("#keyword").bind("blur",function(){jQuery("#searchDiv").hide();});
	}).click(function(){
		jQuery(this).hide();
	});
	function test(jQueryobj){
		var text=jQueryobj.val().Trim();
		if(text==""){	
			jQuery("#searchDiv").hide();
		}else{
			jQuery.ajax({
				url:"/search/get_result?keyword="+text,
				success:function(data){
					jQuery("#searchDiv").html(data);
				}
			});
			jQuery("#searchDiv").show();
		}
	}
});

function compareItem(id){
    $.get('/compare/add/' + id,function (response){
        $("#compare").html(response);
    });
    return false;
}

