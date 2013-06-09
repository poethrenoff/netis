;(function(jQuery){
jQuery.fn.extend({
yslmenu:function(options){
options=jQuery.extend({
menu:0,
navsel:"navsel",
nav:"nav"
},options);
var yslmenu=this,src=$("li img",this).eq(options.menu).attr("src");
src=src.replace(options.nav,options.navsel);
$("li img",yslmenu).eq(options.menu).attr("src",src);
$("li",yslmenu).hover(function(){
if(options.menu!=$("li",yslmenu).index(this)){
src=$("img",this).attr("src");
src=src.replace(options.nav,options.navsel)
$("img",this).attr("src",src);
}
$("dl",this).show();
},function(){
if(options.menu!=$("li",yslmenu).index(this)){
src=$("img",this).attr("src");
src=src.replace(options.navsel,options.nav)
$("img",this).attr("src",src);
}
$("dl",this).hide();
});
return yslmenu;
},
yslbmenu:function(options){
options=jQuery.extend({
menu:1,
dlclass:"top"
},options);
var yslbmenu=this,sel,m=options.menu*2;
$("li",yslbmenu).eq(m).addClass("sel").find("a").text($("li",yslbmenu).eq(m).find("a").attr("c"));
if(options.dlclass=="bottom"){$("dl",yslbmenu).append('<dd class=top></dd>')}else{$("dl",yslbmenu).prepend('<dd class=bottom></dd>')}

$("li",yslbmenu).hover(function(){
if($(this).hasClass("p")) return false;
if($("li",yslbmenu).index(this)!=m)$(this).addClass("sel").find("a").text($("a",this).attr("c"));
$(this).find("dl").addClass(options.dlclass).show();
},function(){
if($(this).hasClass("p")) return false;
if($("li",yslbmenu).index(this)!=m)$(this).removeClass("sel").find("a").text($("a",this).attr("e"));
$(this).find("dl").hide();
});
return yslbmenu;
},
"banner":function(options){
var options=$.extend({
width:960,
height:417,
btnwidth:18,
btnheight:19,
animatetime:300,
pictime:3000,
btnclass:"sel",
btnType:"none"
},options);
var len=$("li",this).length,
index=0,
nowLeft=0,
pictimer,
banner=this;
$("ul",banner).css("width",(options.width*len)+"px").css("height",options.height);
var btn="<div class='btn'>";
var btnArray=$("li img",banner).toArray();
for(var i=0;i<len;i++){
var btnn="";
//switch(options.btntype){case "num":btnn="";break;case "image":btnn="<img src='"+btnArray[i].src+"' width='"+options.btnwidth+"' height='"+options.btnheight+"' />";break;case "none":btnn="";break;default:btnn=i+1;break;};
btn+="<span></span>";
}
btn+="</div>";
banner.append(btn);
$(".btn span").removeClass(options.btnclass).eq(index).addClass(options.btnclass)
picTimer=setInterval(function(){
if(index==len-1){index=0}else{index+=1}
showPic(index);
},options.pictime);
$(".btn span",banner).mouseenter(function(){
if(index==len-1){index=0}else{index+=1}
showPic(index);
})
function showPic(index){
nowLeft=(0-index)*options.width;
$("ul",banner).animate({"left":nowLeft+"px"},options.animatetime);
$(".btn span").removeClass(options.btnclass).eq(index).addClass(options.btnclass);
};
return banner;
}
})
})(jQuery);