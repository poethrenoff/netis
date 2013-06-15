// JavaScript Document
/*
用途：校验ip地址的格式
输入：strIP：ip地址
返回：如果通过验证返回true,否则返回false；
 
*/
function isIP(strIP) {
if (isNull(strIP)) return false;
var re=/^(\d+)\.(\d+)\.(\d+)\.(\d+)$/g //匹配IP地址的正则表达式
if(re.test(strIP))
{
if( RegExp.$1 <256 && RegExp.$2<256 && RegExp.$3<256 && RegExp.$4<256) return true;
}
return false;
}
 
/*
用途：检查输入字符串是否为空或者全部都是空格
输入：str
返回：
如果全是空返回true,否则返回false
*/
function isNull( str ){
if ( str == "" ) return true;
var regu = "^[ ]+$";
var re = new RegExp(regu);
return re.test(str);
}
 
 
/*
用途：检查输入对象的值是否符合整数格式
输入：str 输入的字符串
返回：如果通过验证返回true,否则返回false
 
*/
function isInteger( str ){
var regu = /^[-]{0,1}[0-9]{1,}$/;
return regu.test(str);
}
 
/*
用途：检查输入手机号码是否正确
输入：
s：字符串
返回：
如果通过验证返回true,否则返回false
 
*/
function checkMobile( s ){
var regu =/^[1][3][0-9]{9}$/;
var re = new RegExp(regu);
if (re.test(s)) {
return true;
}else{
return false;
}
}
 
/*
用途：检查输入字符串是否符合正整数格式
输入：
s：字符串
返回：
如果通过验证返回true,否则返回false
*/
function isNumber( s ){
var regu = "^[0-9]+$";
var re = new RegExp(regu);
if (s.search(re) != -1) {
return true;
} else {
return false;
}
}
 
/*
用途：检查输入字符串是否是带小数的数字格式,可以是负数
输入：
s：字符串
返回：
如果通过验证返回true,否则返回false
 
*/
function isDecimal( str ){
if(isInteger(str)) return true;
var re = /^[-]{0,1}(\d+)[\.]+(\d+)$/;
if (re.test(str)) {
if(RegExp.$1==0&&RegExp.$2==0) return false;
return true;
} else {
return false;
}
}
 
/*
用途：检查输入对象的值是否符合端口号格式
输入：str 输入的字符串
返回：如果通过验证返回true,否则返回false
 
*/
function isPort( str ){
return (isNumber(str) && str<65536);
}
 
/*
用途：检查输入对象的值是否符合E-Mail格式
输入：str 输入的字符串
返回：如果通过验证返回true,否则返回false
 
*/
function isEmail( str ){
var myReg = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[A-Za-z0-9]{2,3}$/;
if(myReg.test(str)) return true;
return false;
}
 
/*
用途：检查输入字符串是否符合金额格式
格式定义为带小数的正数，小数点后最多三位
输入：
s：字符串
返回：
如果通过验证返回true,否则返回false
 
*/
function isMoney( s ){
var regu = "^[0-9]+[\.][0-9]{0,3}$";
var re = new RegExp(regu);
if (re.test(s)) {
return true;
} else {
return false;
}
}
/*
用途：检查输入字符串是否只由英文字母和数字和下划线组成
输入：
s：字符串
返回：
如果通过验证返回true,否则返回false
 
*/
function isNumberOr_Letter( s ){//判断是否是数字或字母
 
var regu = "^[0-9a-zA-Z\_\-]+$";
var re = new RegExp(regu);
if (re.test(s)) {
return true;
}else{
return false;
}
}
/*
用途：检查输入字符串是否只由英文字母和数字组成
输入：
s：字符串
返回：
如果通过验证返回true,否则返回false
 
*/
function isNumberOrLetter( s ){//判断是否是数字或字母
 
var regu = "^[0-9a-zA-Z]+$";
var re = new RegExp(regu);
if (re.test(s)) {
return true;
}else{
return false;
}
}
/*
用途：检查输入字符串是否只由汉字、字母、数字组成
输入：
value：字符串
返回：
如果通过验证返回true,否则返回false
 
*/
function isChinaOrNumbOrLett( s ){//判断是否是汉字、字母、数字组成
 
var regu = "^[0-9a-zA-Z\u4e00-\u9fa5]+$";
var re = new RegExp(regu);
if (re.test(s)) {
return true;
}else{
return false;
}
}
 
/*
用途：判断是否是日期
输入：date：日期；fmt：日期格式
返回：如果通过验证返回true,否则返回false
*/
function isDate( date, fmt ) {
if (fmt==null) fmt="yyyyMMdd";
var yIndex = fmt.indexOf("yyyy");
if(yIndex==-1) return false;
var year = date.substring(yIndex,yIndex+4);
var mIndex = fmt.indexOf("MM");
if(mIndex==-1) return false;
var month = date.substring(mIndex,mIndex+2);
var dIndex = fmt.indexOf("dd");
if(dIndex==-1) return false;
var day = date.substring(dIndex,dIndex+2);
if(!isNumber(year)||year>"2100" || year< "1900") return false;
if(!isNumber(month)||month>"12" || month< "01") return false;
if(day>getMaxDay(year,month) || day< "01") return false;
return true;
}
 
function getMaxDay(year,month) {
if(month==4||month==6||month==9||month==11)
return "30";
if(month==2)
if(year%4==0&&year%100!=0 || year%400==0)
return "29";
else
return "28";
return "31";
}
 
/*
用途：字符1是否以字符串2结束
输入：str1：字符串；str2：被包含的字符串
返回：如果通过验证返回true,否则返回false
 
*/
function isLastMatch(str1,str2)
{
var index = str1.lastIndexOf(str2);
if(str1.length==index+str2.length) return true;
return false;
}
 
 
/*
用途：字符1是否以字符串2开始
输入：str1：字符串；str2：被包含的字符串
返回：如果通过验证返回true,否则返回false
 
*/
function isFirstMatch(str1,str2)
{
var index = str1.indexOf(str2);
if(index==0) return true;
return false;
}
 
/*
用途：字符1是包含字符串2
输入：str1：字符串；str2：被包含的字符串
返回：如果通过验证返回true,否则返回false
 
*/
function isMatch(str1,str2)
{
var index = str1.indexOf(str2);
if(index==-1) return false;
return true;
}
 
 
/*
用途：检查输入的起止日期是否正确，规则为两个日期的格式正确，
且结束如期>=起始日期
输入：
startDate：起始日期，字符串
endDate：结束如期，字符串
返回：
如果通过验证返回true,否则返回false
 
*/
function checkTwoDate( startDate,endDate ) {
if( !isDate(startDate) ) {
alert("起始日期不正确!");
return false;
} else if( !isDate(endDate) ) {
alert("终止日期不正确!");
return false;
} else if( startDate > endDate ) {
alert("起始日期不能大于终止日期!");
return false;
}
return true;
}
 
/*
用途：检查输入的Email信箱格式是否正确
输入：
strEmail：字符串
返回：
如果通过验证返回true,否则返回false
 
*/
function checkEmail(strEmail) {
//var emailReg = /^[_a-z0-9]+@([_a-z0-9]+\.)+[a-z0-9]{2,3}$/;
var emailReg = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/;
if( emailReg.test(strEmail) ){
return true;
}else{
alert("您输入的Email地址格式不正确！");
return false;
}
}

/*
用途：检查输入的电话号码格式是否正确
输入：
strPhone：字符串
返回：
如果通过验证返回true,否则返回false
 
*/
function checkPhone( strPhone ) {
var phoneRegWithArea = /^[0][1-9]{2,3}-[0-9]{5,10}$/;
var phoneRegNoArea = /^[1-9]{1}[0-9]{5,8}$/;
var prompt = "您输入的电话号码不正确!"
if( strPhone.length > 9 ) {
if( phoneRegWithArea.test(strPhone) ){
return true;
}else{
alert( prompt );
return false;
}
}else{
if( phoneRegNoArea.test( strPhone ) ){
return true;
}else{
alert( prompt );
return false;
}
}
}

//得到对象
function GE(a){return document.getElementById(a);} 

//得到XMLHttpRequest 对象
function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}

/*鼠标划过变换函数*/
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
  var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
  if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
  d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
  if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

//类似于asp中的FormatNumber函数
function FormatNumber(srcStr,nAfterDot){
　　var srcStr,nAfterDot;
　　var resultStr,nTen;
　　srcStr = ""+srcStr+"";
    if(parseFloat(srcStr)==0){
       return 0;
    }
	else{
　　strLen = srcStr.length;
　　dotPos = srcStr.indexOf(".",0);
　　if (dotPos == -1){
　　　　resultStr = srcStr+".";
　　　　for (i=0;i<nAfterDot;i++){
　　　　　　resultStr = resultStr+"0";
　　　　}
　　　　return resultStr;
　　}
　　else{
　　　　if ((strLen - dotPos - 1) >= nAfterDot){
　　　　　　nAfter = dotPos + nAfterDot + 1;
　　　　　　nTen =1;
　　　　　　for(j=0;j<nAfterDot;j++){
　　　　　　　　nTen = nTen*10;
　　　　　　}
　　　　　　resultStr = Math.round(parseFloat(srcStr)*nTen)/nTen;
　　　　　　return resultStr;
　　　　}
　　　　else{
　　　　　　resultStr = srcStr;
　　　　　　for (i=0;i<(nAfterDot - strLen + dotPos + 1);i++){
　　　　　　　　resultStr = resultStr+"0";
　　　　　　}
　　　　　　return resultStr;
　　　　}
　　}
  }
} 

function overColor(Obj)
{
	var elements=Obj.childNodes;
	for(var i=0;i<elements.length;i++)
	{
		elements[i].className="hback_1"
		Obj.bgColor="";//颜色要改
	}
	
}
function outColor(Obj)
{
	var elements=Obj.childNodes;
	for(var i=0;i<elements.length;i++)
	{
		elements[i].className="hback";
		Obj.bgColor="";
	}
}

function OpenWindow(Url,Width,Height,WindowObj)
{
	var ReturnStr=showModalDialog(Url,WindowObj,'dialogWidth:'+Width+'pt;dialogHeight:'+Height+'pt;status:no;help:no;scroll:no;');
	return ReturnStr;
}

function OpenWindowAndSetValue(Url,Width,Height,WindowObj,SetObj)
{
	var ReturnStr=showModalDialog(Url,WindowObj,'dialogWidth:'+Width+'pt;dialogHeight:'+Height+'pt;status:yes;help:no;scroll:yes;');
	if (ReturnStr!='') SetObj.value=ReturnStr;
	return ReturnStr;
}

function Get_PicPath(Url,Width,Height,WindowObj,SetObj,PicObj)
{
	var ReturnStr=showModalDialog(Url,WindowObj,'dialogWidth:'+Width+'pt;dialogHeight:'+Height+'pt;status:yes;help:no;scroll:yes;');
	if (ReturnStr!='') 
	{
	SetObj.value=ReturnStr;
	PicObj.src=ReturnStr;
	}
	return ReturnStr;
}

//缩小图片函数
function DrawImage(ImgD,FitWidth,FitHeight){
     var image=new Image();
     image.src=ImgD.src;
     if(image.width>0 && image.height>0){
         if(image.width/image.height>= FitWidth/FitHeight){
             if(image.width>FitWidth){
                 ImgD.width=FitWidth;
                 ImgD.height=(image.height*FitWidth)/image.width;
             }else{
                 ImgD.width=image.width; 
                ImgD.height=image.height;
             }
         } else{
             if(image.height>FitHeight){
                 ImgD.height=FitHeight;
                 ImgD.width=(image.width*FitHeight)/image.height;
             }else{
                 ImgD.width=image.width; 
                ImgD.height=image.height;
             } 
        }
     }
 }
 
//菜单切换函数
function showindextxt(n,divname,clsname,total){
for(var j=1; j<total; j++){
if(j==n){
 document.getElementById(divname+j).className = "newsmenuname_2";
 document.getElementById(clsname+j).style.display = "";
}
else{
 document.getElementById(divname+j).className = "newsmenuname_1"; 
 document.getElementById(clsname+j).style.display = "none";
}
}
}

//菜单切换函数
function promenu(n,divname,clsname,total){
for(var j=1; j<total; j++){
if(j==n){
 document.getElementById(divname+j).className = "promenuname_2";
 document.getElementById(clsname+j).style.display = "";
}
else{
 document.getElementById(divname+j).className = "promenuname_1"; 
 document.getElementById(clsname+j).style.display = "none";
}
}
}

//全选函数
function CheckAll(formall){
for (var i=0;i<formall.elements.length;i++){
  var e = formall.elements[i];
  if (e.name == 'delid')
	 e.checked = formall.chkall.checked;
  }
}

function CheckAll_up(formall){
for (var i=0;i<formall.elements.length;i++){
  var e = formall.elements[i];
  if (e.name == 'delid')
	 e.checked = formall.Uchkall.checked;
  }
} 

//执行AJAX程序
function execute_Ajax(urlStr,Obj,Resultnum){
var xmlHttp;
var realifun;
var finalResult;
xmlHttp = GetXmlHttpObject();

if (xmlHttp == null){
  alert ("你的浏览器不支持AJAX");
  return;
} 

xmlHttp.open("GET",urlStr,false);
xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); 
//
xmlHttp.onreadystatechange=function(){
var ifun
if (xmlHttp.readyState==1){
    //这里可以放一些处理过程中的提示信息
}
else if (xmlHttp.readyState==4){	
	  if (xmlHttp.status == 200){  
			var regresult = xmlHttp.responseText; 
			if(Resultnum==1){
				  Obj.value =  regresult; 
				  window.location.reload(); 
			}
			else if(Resultnum==2){
				  Obj.value = regresult;
				  alert("调整顺序成功！");
			}
			else if(Resultnum==3){
				  Obj.innerHTML = regresult;
				  //alert(regresult)
			}
			else if(Resultnum==4){
				  Obj.value =  regresult; 
			}
			else if(Resultnum==5){
				  if(parseInt(regresult)==1){
					 ifun=1;}					  
				  else if(parseInt(regresult)==0){
				     ifun=0;}
					 realifun = ifun			  
			}
			else if(Resultnum==6){
				 Get_Subaddress(regresult,Obj)
				 //alert(regresult)
			}	
			else if(Resultnum==7){
				 finalResult = regresult;
			}
  }   
}
}
xmlHttp.send(null); 
if(realifun==1)
    return true;
else if(realifun==0)
    return false; 
else
    return 	finalResult 
}   

//改变地址函数
function Get_Subaddress(arrstr,obj){
obj.options.length = 0;
var arrvalue,arrtext
var arr = new Array(); 
var realarrvalue = new Array(); 
var realarrtext = new Array(); 
jsAddItemToSelect(obj,"请选择","-1");
if(arrstr!=""){
	arr = arrstr.split("{}");
	arrvalue = arr[0];
	arrtext = arr[1];
	realarrvalue = arrvalue.split(",");
	realarrtext = arrtext.split(",");
	
		for (i=0;i<realarrvalue.length;i++ )    
		{    
		   jsAddItemToSelect(obj,realarrtext[i],realarrvalue[i])     
		}	
}	
}

//得到一个select里的所有option的内容
function getrealvalue(obj){
var str="";
if(obj.options.length!=0){
for (var i = 0; i < obj.options.length; i++) { 
     if(i==0)
		 str = obj.options[i].value
	 else	 
	     str = str + "," + obj.options[i].value
}	
}
return str;
}

function inputIntonly(obj){
obj.value = obj.value.replace(/\D/g,'')	
}

/*
1判断select选项中 是否存在Value="paraValue"的Item 
2向select选项中 加入一个Item 
3从select选项中 删除一个Item 
4删除select中选中的项 
5修改select选项中 value="paraValue"的text为"paraText" 
6设置select中text="paraText"的第一个Item为选中 
7设置select中value="paraValue"的Item为选中 
8得到select的当前选中项的value 
9得到select的当前选中项的text 
10得到select的当前选中项的Index 
11清空select的项 
*/

// 1.判断select选项中 是否存在Value="paraValue"的Item        
function jsSelectIsExitItem(objSelect, objItemValue) {        
    var isExit = false;        
    for (var i = 0; i < objSelect.options.length; i++) {        
        if (objSelect.options[i].value == objItemValue) {        
            isExit = true;        
            break;        
        }        
    }        
    return isExit;        
}         
   
// 2.向select选项中 加入一个Item        
function jsAddItemToSelect(objSelect, objItemText, objItemValue) {        
    //判断是否存在
if (objItemText!=""&&objItemValue!=""){	  
  
    if (jsSelectIsExitItem(objSelect, objItemValue)) {        
        alert("该选项值已经存在");        
    } else {        
        var varItem = new Option(objItemText, objItemValue);      
        objSelect.options.add(varItem);     
        //alert("成功加入");     
    }        
}        
}
// 3.从select选项中 删除一个Item        
function jsRemoveItemFromSelect(objSelect, objItemValue) {        
    //判断是否存在        
    if (jsSelectIsExitItem(objSelect, objItemValue)) {        
        for (var i = 0; i < objSelect.options.length; i++) {        
            if (objSelect.options[i].value == objItemValue) {        
                objSelect.options.remove(i);        
                break;        
            }        
        }        
        //alert("成功删除");        
    } else {        
        alert("该select中 不存在该项");        
    }        
}    
   
   
// 4.删除select中选中的项    
function jsRemoveSelectedItemFromSelect(objSelect) {        
    var length = objSelect.options.length - 1;    
    for(var i = length; i >= 0; i--){    
        if(objSelect[i].selected == true){    
            objSelect.options[i] = null;    
        }    
    }    
}      
   
// 5.修改select选项中 value="paraValue"的text为"paraText"        
function jsUpdateItemToSelect(objSelect, objItemText, objItemValue) {        
    //判断是否存在        
    if (jsSelectIsExitItem(objSelect, objItemValue)) {        
        for (var i = 0; i < objSelect.options.length; i++) {        
            if (objSelect.options[i].value == objItemValue) {        
                objSelect.options[i].text = objItemText;        
                break;        
            }        
        }        
        alert("成功修改");        
    } else {        
        alert("该select中 不存在该项");        
    }        
}        
   
// 6.设置select中text="paraText"的第一个Item为选中        
function jsSelectItemByValue(objSelect, objItemText) {            
    //判断是否存在        
    var isExit = false;        
    for (var i = 0; i < objSelect.options.length; i++) {        
        if (objSelect.options[i].text == objItemText) {        
            objSelect.options[i].selected = true;        
            isExit = true;        
            break;        
        }        
    }              
    //Show出结果  
	/*      
    if (isExit) {        
        alert("成功选中");        
    } else {        
        alert("该select中 不存在该项");        
    }*/        
}        
/*  
// 7.设置select中value="paraValue"的Item为选中    
document.all.objSelect.value = objItemValue;    
       
// 8.得到select的当前选中项的value    
var currSelectValue = document.all.objSelect.value;    
       
// 9.得到select的当前选中项的text    
var currSelectText = document.all.objSelect.options[document.all.objSelect.selectedIndex].text;    
       
// 10.得到select的当前选中项的Index    
var currSelectIndex = document.all.objSelect.selectedIndex;    
       
// 11.清空select的项    
document.all.objSelect.options.length = 0; 
*/ 

//增加或者减少一个单位的数量
function Quantity_one(obj,stock,type){
var stock = parseInt(stock);
var num
num = 1;
//确保文本框里的内容为数字
if(isNumber(obj.value)){
	num = parseInt(obj.value)
}
else{
	num = 1;
	obj.value=1	
}

//增加1
if(type=="add"){
	if(num+1>stock){
	    alert("非常抱歉，该商品目前最多只能购买 "+stock+" 件")	
    }
	else{
	    obj.value = num+1
    }  
}
//减去1
else if(type=="cut"){
	if(num-1<1){
	    alert("请至少选择一件商品")	
    }
	else{
	    obj.value = num-1
    }     
}
}

//改变数量，输入到文本框的模式
function Quantity_blur(obj,stock){
var stock = parseInt(stock)
if(!isNumber(obj.value)){
	obj.value = 1
	alert("数量必须为正整数")
}
else if(obj.value==0){
	obj.value = 1
	alert("请至少选择一件商品")	
}
else{
	if(obj.value>stock){
	obj.value = 1
	alert("非常抱歉，该商品目前最多只能购买 "+stock+" 件")		
	}    
} 
}

//取得单选框的值
function getRadioValue(radioName){
    var radios = document.getElementsByName(radioName);
    if(!radios) 
        return '';
    for (var i = 0; i < radios.length; i++) 
    {
        if (radios[i].checked) 
            return radios[i].value;
    }
} 

//取得图片列表的其他图片
function getPictureFamily(picname,ptype){
var arrNum,tmpPic,finalpic
tmpPic = "";
finalpic = ""
var arrPic = new Array(); 
if(picname!=""){
   	arrPic = picname.split(".");
	arrNum = arrPic.length-1;
	if(arrNum==1){
	   tmpPic = arrPic[0]+"_"+ptype+"."+arrPic[1];
	   finalpic = tmpPic;
	}
	else if(arrNum>1){
	   	for (i=0;i<=arrNum-1;i++ ){    
          if(i==0)
		    tmpPic = arrPic[0]
		  else
		    tmpPic = tmpPic + "." + arrPic[i]   
        } 
		finalpic = tmpPic+"_"+ptype+"."+arrPic[arrNum]	
	}
}
return finalpic
}

//复制网址
function copyUrl(url){ 
var clipBoardContent=url; 
window.clipboardData.setData("Text",clipBoardContent); 
alert("复制成功!"); 
} 

/*弹出层函数群开始*/

/******************************************************************************************/

//显示灰色背景和操作窗口
//vType:窗口加载的是html代码还是文件，参数可能为html或url
//url为代码或文件名 args 为传递的参数 格式为{arg1:"",arg2:""} w为窗口的宽 h为窗口的高
function showWin(fulldiv,msgdiv,content,vType,url,args,w,h){
var bH=$("body").height();
var bW=$("body").width();
$("#"+msgdiv).height(h);
$("#"+msgdiv).width(w);
var objWH=objValue(msgdiv);
$("#"+fulldiv).css({width:bW,height:bH,display:"block"});
var tbT=objWH.split("|")[0]+"px";
var tbL=objWH.split("|")[1]+"px";
$("#"+msgdiv).css({top:tbT,left:tbL,display:"block"});
$("#"+content).html("<div style='text-align:center'>正在加载，请稍后...</div>");
if(vType=="url") $("#"+content).load(url,args);
else  $("#"+content).html(url);
}

function objValue(obj){
	var st=document.documentElement.scrollTop+document.body.scrollTop;//滚动条距顶部的距离
	var sl=document.documentElement.scrollLeft;//滚动条距左边的距离
	var ch=document.documentElement.clientHeight;//屏幕的高度
	var cw=document.documentElement.clientWidth;//屏幕的宽度
	var objH=$("#"+obj).height();//浮动对象的高度
	var objW=$("#"+obj).width();//浮动对象的宽度
	var objT=Number(st)+(Number(ch)-Number(objH))/2;
	var objL=Number(sl)+(Number(cw)-Number(objW))/2;
	return objT+"|"+objL;
}
function resscrEvt(fulldiv,msgdiv){
	var bjCss=$("#"+fulldiv).css("display");
	if(bjCss=="block"){
	var bH2=$("body").height();
	var bW2=$("body").width();
	$("#"+fulldiv).css({width:bW2,height:bH2});
	var objV=objValue(msgdiv);
	var tbT=objV.split("|")[0]+"px";
	var tbL=objV.split("|")[1]+"px";
	$("#"+msgdiv).css({top:tbT,left:tbL});
	}
}

//关闭灰色背景和操作窗口
function closeWin(fulldiv,msgdiv){
$("#"+fulldiv).css("display","none");
$("#"+msgdiv).css("display","none");
}

/******************************************************************************************/
/*弹出层函数群结束*/

/*编辑器中插入图片函数开始*/
function insertPic(obj)
{
  var str1="";
  var strurl=GE("ipic_url").value;
  if (strurl==""||strurl=="http://"){
  	alert("请先输入图片地址，或者上传图片！");
	GE("ipic_url").focus();
	return false;
  }
  else{
    str1="<img src='"+GE("ipic_url").value+"' alt='"+GE("ipic_alttext").value+"' ";
    if(GE("ipic_width").value!=''&&GE("ipic_width").value!='0') str1=str1+"width='"+GE("ipic_width").value+"' ";
    if(GE("ipic_height").value!=''&&GE("ipic_height").value!='0') str1=str1+"height='"+GE("ipic_height").value+"' ";
    str1=str1+"border='"+GE("ipic_PicBorder").value+"' align='"+GE("ipic_aligntype").value+"' ";
	if(GE("ipic_vspace").value!=''&&GE("ipic_vspace").value!='0') str1=str1+"vspace='"+GE("ipic_vspace").value+"' ";
	if(GE("ipic_hspace").value!=''&&GE("ipic_hspace").value!='0') str1=str1+"hspace='"+GE("ipic_hspace").value+"' ";
	if(GE("ipic_styletype").value!='')	str1=str1+"style='"+GE("ipic_styletype").value+"'";
    str1=str1+">";
    obj.value=str1;
	closeWin('fulldiv','insertDiv');
  }
}
function IsDigit(){
  return ((event.keyCode >= 48) && (event.keyCode <= 57));
}
/*编辑器中插入图片函数结束*/

/******************************************************************************************/
/*编辑器中插入FLASH函数开始*/
function insertflash(obj)
{
  var str1="";
  var strurl = GE("iswf_url").value;
  var iftmstr = document.getElementById('iswf_iftm').options[document.getElementById('iswf_iftm').selectedIndex].value;
  var wmodestr = "";
  if (!IsExt(strurl,'swf')){
	  alert('文件类型不对，请重新选择！');
	  return;
  }
  if (strurl==""||strurl=="http://"){
  	alert("请先输入FLASH文件地址，或者上传FLASH文件！");
	GE("iswf_url").focus();
	return false;
  }
  else{
    str1="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'  codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0' width="+GE("iswf_width").value+" height="+GE("iswf_height").value+">"
	if (iftmstr=="yes"){
		str1=str1+ "<param name='wmode' value='transparent' />"
		wmodestr = " wmode='transparent'"
	}	 
	str1=str1+"<param name=movie value="+GE("iswf_url").value+"><param name=quality value=high><embed src="+GE("iswf_url").value+" pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash' type='application/x-shockwave-flash' width="+GE("iswf_width").value+" height="+GE("iswf_height").value + wmodestr + "></embed></object>"
    
	obj.value=str1;
	closeWin('fulldiv','insertDiv');
  }
}
/*编辑器中插入FLASH函数结束*/

/******************************************************************************************/
/*编辑器中插入Flv视频开始*/
function insertflv(obj){
  var str1="";
  var strurl=GE("iflv_url").value;
  var ifplay = document.getElementById('iflv_ifplay')
  var ifloop = document.getElementById('iflv_ifloop')  
  var objurl = document.getElementById('iflv_url').value    
  var ifplaystr = ifplay.options[ifplay.selectedIndex].value;  
  var ifloopstr = ifloop.options[ifloop.selectedIndex].value;
  var urlstr = objurl.replace(".flv","");   
  
  if (!IsExt(strurl,'flv')){
	  alert('文件类型不对，请重新选择！');
	  GE("iflv_url").focus();
	  return;
  }
  if (strurl==""||strurl=="http://"){
  	alert("请先输入视频文件地址，或者上传视频文件！");
	GE("iflv_url").focus();
	return false;
  }
  else{
	str1="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0' width='"+GE("iflv_width").value+"' height='"+GE("iflv_height").value+"' id='FLVPlayer1'>"
	str1=str1+"<param name='movie' value='/FlvPlayer/FLVPlayer_Progressive.swf' />"
	str1=str1+"<param name='salign' value='lt' />"	
	str1=str1+"<param name='quality' value='high' />"	
	str1=str1+"<param name='scale' value='noscale' />"	
	str1=str1+"<param name='FlashVars' value='&MM_ComponentVersion=1&skinName=/FlvPlayer/Halo_Skin_3&streamName="+urlstr+"&autoPlay="+ifplaystr+"&autoRewind="+ifloopstr+"' />"	
	str1=str1+"<embed src='/FlvPlayer/FLVPlayer_Progressive.swf' flashvars='&MM_ComponentVersion=1&skinName=/FlvPlayer/Halo_Skin_3&streamName="+urlstr+"&autoPlay="+ifplaystr+"&autoRewind="+ifloopstr+"' quality='high' scale='noscale' width='"+GE("iflv_width").value+"' height='"+GE("iflv_height").value+"' name='FLVPlayer1' salign='LT' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' />"
	str1=str1+"</object>"	
			
	obj.value=str1;
	closeWin('fulldiv','insertDiv');	
  }
}

/******************************************************************************************/
/*编辑器中插入多媒体视频开始*/
function insertmedia(obj){
  var str1="";
  var strurl = GE("imedia_url").value;
  var ifplay = document.getElementById( 'imedia_ifplay' )
  var ifloop = document.getElementById( 'imedia_ifloop' )  
  var ifplaystr = ifplay.options[ifplay.selectedIndex].value;  
  var ifloopstr = ifloop.options[ifloop.selectedIndex].value;   

  if (strurl==""||strurl=="http://"){
  	alert("请先输入视频文件地址，或者上传视频文件！");
	GE("imedia_url").focus();
	return false;
  }
  else{
	str1="<object classid='CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6' id='MediaPlayer1' width="+GE("imedia_width").value+" height="+GE("imedia_height").value+">"
	str1=str1+"<param name='url' value='"+GE("imedia_url").value+"'>"
	str1=str1+"<param name='AutoStart' value='"+ifplaystr+"'>"
	str1=str1+"<param name='PlayCount' value='"+ifloopstr+"'></object>"	
	obj.value=str1;
	closeWin('fulldiv','insertDiv');	
  }
}

/******************************************************************************************/
/*编辑器中插入下载文件开始*/
function insertfile(obj){
  var str1="";
  var filename;
  var arrfilename= new Array(); 
  var strurl = GE("ifile_url").value;

  if (strurl==""||strurl=="http://"){
  	alert("请先输入附件地址！");
	GE("ifile_url").focus();
	return false;
  }
  else{
  arrfilename=strurl.split("/");   
  filename = arrfilename[arrfilename.length-1]
  str1="<a href='"+GE("ifile_url").value+"' target=\""+GE("ifile_target").value+"\">"+ filename +"</a>";
  
  obj.value=str1;
  closeWin('fulldiv','insertDiv');  
  }
}

function IsExt(url,opt)
{  
	var sTemp; 
	var b=false; 
	var s=opt.toUpperCase().split("|");  
	for (var i=0;i<s.length ;i++ ){ 
		sTemp=url.substr(url.length-s[i].length-1); 
		sTemp=sTemp.toUpperCase();
		s[i]="."+s[i];
		if (s[i]==sTemp){
			b=true;
			break;
		}
	}
	return b;
}