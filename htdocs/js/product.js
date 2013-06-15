$(function(){
    var mouseX = 0;
    var mouseY = 0;
    var maxLeft = 0;
    var maxTop = 0;
    var markLeft = 0;
    var markTop = 0;
    var perX = 0;
    var perY = 0;
    var bigLeft = 0;
    var bigTop = 0;
    
    jQuery(".small").live({"mousemove":function(event){
        var jQuerythis = jQuery(this);
        var jQuerymark = jQuery(this).find(".mark");
        
        mouseX = event.pageX-jQuerythis.offset().left - jQuerymark.outerWidth()/2;
        mouseY = event.pageY-jQuerythis.offset().top - jQuerymark.outerHeight()/2;
        
        maxLeft =jQuerythis.width()- jQuerymark.outerWidth();
        maxTop =jQuerythis.height()- jQuerymark.outerHeight();
        markLeft = mouseX;
        markTop = mouseY;
        
        
        if(markLeft<0){
            markLeft = 0;
        }else if(markLeft>maxLeft){
            markLeft = maxLeft;
        }
        
        
        if(markTop<0){
            markTop = 0;
        }else if(markTop>maxTop){
            markTop = maxTop;
        }
        
        perX = markLeft/jQuery(this).outerWidth();
        perY = markTop/jQuery(this).outerHeight();
        
        bigLeft = -perX*jQuery(this).parent(".detail_bigpic").find(".big").outerWidth();
        bigTop = -perY*jQuery(this).parent(".detail_bigpic").find(".big").outerHeight();
        jQuerymark.css({"left":markLeft,"top":markTop,"display":"block"});


        jQuery(this).parent(".detail_bigpic").find(".boxbig").show().find(".big").css({"display":"block","left":bigLeft,"top":bigTop});
    },"mouseleave":function(){
        jQuery(this).parent(".detail_bigpic").find(".boxbig").hide().find(".big").css({"display":"none"});
        jQuery(this).find(".mark").css({"display":"none"});
    }});
    
    jQuery(".detail_bigpic").hide().eq(0).show()
    jQuery("#detail_piclist ul li").mouseenter(function(){
        jQuery(".detail_bigpic").hide().eq(jQuery(this).index()).show();
    });
});
