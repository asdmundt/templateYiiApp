
/**
*****************************************************
*	@author			Söhnke Mundt
*	@file			std.js
*	@description		take all js funktion in this file		
*	@date			27.02.2006
*	release
******************************************************
*/

function css_check(name)
{
	
	var browser = navigator.appName;
	var ver  = navigator.appVersion;	
	var os   = navigator.platform.substring(0,3);	
	var css;
	var css = "<link rel='stylesheet' type='text/css' href='../../css/" + name + ".css' media='screen'>";
	
	document.write(css);		
}

// Standart Layer Funktion Aufruf Beispiel: MM_showHideLayers('Layer1','','show')f�r zeigen und MM_showHideLayers('Layer1','','hide')f�r verstecken--->

//////////////////////////////////////////////////////////////////////////////////////////////


function MM_showHideLayers(x,l,d) { //v3.0
	elm = document.getElementById(x);

	if(d == 'show')
	{
  		elm.style.visibility = "visible";
	}
	else
	{
		elm.style.visibility = "hidden";
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
// takeValue()
//
//
// S�hnke Mundt @ asd 00.00.2006
////////////////////////////////

function takeValue(caller)
  {
   var value = "";
   if(document.cookie) 
   {
   	cookieName = document.cookie.substring(0,document.cookie.indexOf("="));
	if(caller == cookieName){
	
	}
    valueStart = document.cookie.indexOf("=") + 1;
    valueEnd = document.cookie.indexOf(";");
    if(valueEnd == -1) valueEnd = document.cookie.length;
    value = document.cookie.substring(valueStart,valueEnd);
   }
   return value;
  }
////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
//wird verwendet 03.03.2006

function setValue(caller, value, expiresTime)
 {
  if(document.cookie){
  	cookieName = document.cookie.substring(0,document.cookie.indexOf("="));
  	if(caller == cookieName){
		var timeNow = new Date(now.getTime());
		document.cookie = caller+"="+value+"; expires="+timeNow.toGMTString()+";";
	}
  }
  var now = new Date();
  var timeOut = new Date(now.getTime() + expiresTime);
  document.cookie = caller+"="+value+"; expires="+expiresTime.toGMTString()+";";
 }

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
//wird verwendet 12.05.2004 s�hnke mundt
function start(url){

	myWin = window.open(url,'TOWeb','top=-10,left=-10,width='+(screen.width+10)+',height='+(screen.height)+',scrollbars=yes,resizable=no,menubar=no,locationbar=no,toolbar=no');
	myWin.moveTo(-10,-10);
	myWin.resizeTo((screen.width+10),(screen.height+10)); 
	login.close();
	return true;
}
////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////

function menu(url1){
	self.frames[0].location.href=url1;
}
////////////////////////////////////////////////////////////////////////////////////////////////

function parenthref(url1){
	window.parent.location.href=url1;
        return true;
}
////////////////////////////////////////////////////////////////////////////////////////////////
function toParentFrame(){
    if (self != parent && self != top)
    {
    top.location.href=self.location.href;
    }
    return true;
}

// isANumber gibt true zur�ck wenn eingabe "n" nur ziffern enth�lt
// todo isANumberPlz gibt true zur�ck wenn eingabe "n" nur ziffern enth�lt und keine 0 an i = 0
////////////////////////////////////////////////////////////////////////////////////////////////	

function isANumber(n){
	var str 	= "" + n;
	var ziffern	= "0123456789";
	
	for (var i = 0 ; i <  str.length ; i++) {
		if(ziffern.indexOf(str.charAt(i) == -1)) {
			return false;
		}
	}
	return true;
}	
////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////
function isANumberAndString(n){
	var str 		= "" + n;
	var ziffern		= "0123456789";
	var zeichen 	= "abcdefghijklmnopqrstuvwxyz";
	var intZiffern	= 1;
	var intZeichen	= 1;
	
	for (var i = 0 ; i < str.length ; i++) {
		if(!ziffern.indexOf(str.charAt(i) == -1)) {
			intZiffern	= intZiffern + 1
		}
		
		if(!zeichen.indexOf(str.charAt(i) == -1)) {
			intZeichen	= intZeichen + 1
		}
	}
	if((intZiffern < 1) || (intZeichen < 3)) {
		return false;
	}
	return true;
}	

////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
function isAMailString(n){
	var str 		= "" + n;
	var zeichen 	= ".@";
	var intZeichen	= 1;
	
	for (var i = 0 ; i < str.length ; i++) {
		if(zeichen.indexOf(str.charAt(i) > -1)) {
			intZeichen	= intZeichen + 1
		}
	}
	if(intZeichen < 3) {
		return false;
	}
	return true;
}	

////////////////////////////////////////////////////////////////////////////////////////////////




function NiftyCheck()
{
if(!document.getElementById || !document.createElement)
    return(false);
var b=navigator.userAgent.toLowerCase();
if(b.indexOf("msie 5")>0 && b.indexOf("opera")==-1)
    return(false);
return(true);
}

function Rounded(selector,bk,color,size){
var i;
var v=getElementsBySelector(selector);
var l=v.length;
for(i=0;i<l;i++){
    AddTop(v[i],bk,color,size);
    AddBottom(v[i],bk,color,size);
    }
}

function RoundedTop(selector,bk,color,size){
var i;
var v=getElementsBySelector(selector);
for(i=0;i<v.length;i++)
    AddTop(v[i],bk,color,size);
}

function RoundedBottom(selector,bk,color,size){
var i;
var v=getElementsBySelector(selector);
for(i=0;i<v.length;i++)
    AddBottom(v[i],bk,color,size);
}

function AddTop(el,bk,color,size){
var i;
var d=document.createElement("b");
var cn="r";
var lim=4;
if(size && size=="small"){ cn="rs"; lim=2}
d.className="rtop";
d.style.backgroundColor=bk;
for(i=1;i<=lim;i++){
    var x=document.createElement("b");
    x.className=cn + i;
    x.style.backgroundColor=color;
    d.appendChild(x);
    }
el.insertBefore(d,el.firstChild);
}

function AddBottom(el,bk,color,size){
var i;
var d=document.createElement("b");
var cn="r";
var lim=4;
if(size && size=="small"){ cn="rs"; lim=2}
d.className="rbottom";
d.style.backgroundColor=bk;
for(i=lim;i>0;i--){
    var x=document.createElement("b");
    x.className=cn + i;
    x.style.backgroundColor=color;
    d.appendChild(x);
    }
el.appendChild(d,el.firstChild);
}

function getElementsBySelector(selector){
var i;
var s=[];
var selid="";
var selclass="";
var tag=selector;
var objlist=[];
if(selector.indexOf(" ")>0){  //descendant selector like "tag#id tag"
    s=selector.split(" ");
    var fs=s[0].split("#");
    if(fs.length==1) return(objlist);
    return(document.getElementById(fs[1]).getElementsByTagName(s[1]));
    }
if(selector.indexOf("#")>0){ //id selector like "tag#id"
    s=selector.split("#");
    tag=s[0];
    selid=s[1];
    }
if(selid!=""){
    objlist.push(document.getElementById(selid));
    return(objlist);
    }
if(selector.indexOf(".")>0){  //class selector like "tag.class"
    s=selector.split(".");
    tag=s[0];
    selclass=s[1];
    }
var v=document.getElementsByTagName(tag);  // tag selector like "tag"
if(selclass=="")
    return(v);
for(i=0;i<v.length;i++){
    if(v[i].className==selclass){
        objlist.push(v[i]);
        }
    }
return(objlist);
}

/*
 * function getElementsBySelector(selector){
 * 
 */
function setvisibilityfromid(id){
  var elm = document.getElementById(id);
  
}


/*
 * function getElementsBySelector(selector){
 * 
 */
function setDocCat(id){
  var elm = document.getElementById("documentMenu");
  
}

function renderCreateDoc(ref_id, ref_table){
  var elm = document.getElementById("documentMenu");
  
}

function sethiddenvalue(v){
    
     document.getElementById("formaction").value=v;
     return true;
}
/**
 * To get all a elements in the document with a “info-links” class.
    getElementsByClassName(document, "a", "info-links");
To get all div elements within the element named “container”, with a “col” class.
    getElementsByClassName(document.getElementById("container"), "div", "col"); 
To get all elements within in the document with a “click-me” class.
    getElementsByClassName(document, "*", "click-me"); 
 */
function getElementsByClassName(oElm, strTagName, strClassName){
	var arrElements = (strTagName == "*" && oElm.all)? oElm.all : oElm.getElementsByTagName(strTagName);
	var arrReturnElements = new Array();
	strClassName = strClassName.replace(/\-/g, "\\-");
	var oRegExp = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
	var oElement;
	for(var i=0; i<arrElements.length; i++){
		oElement = arrElements[i];
		if(oRegExp.test(oElement.className)){
			arrReturnElements.push(oElement);
		}
	}
	return (arrReturnElements)
}
/*
function click (e)
{
if (!e)e = window.event;
if ((e.type && e.type == "contextmenu") || (e.button && e.button == 2) || (e.which && e.which == 3))
{
var relTarg = e.target || e.srcElement;
var spaEle = document.getElementById("filevalue");
spaEle.setAttribute("class",relTarg.id);
if (window.opera) window.alert("Sorry: Diese Funktion ist deaktiviert.");
// Show RightMenu on
if (document.getElementById)
{
document.getElementById("contextmenu").style.left = e.clientX + "px";
document.getElementById("contextmenu").style.top = e.clientY + "px";
document.getElementById("contextmenu").style.visibility = "visible";
//var relTarg = e.relatedTarget || e.fromElement;

}
else
{
if (document.all)
{
document.all.contextmenu.style.left = e.clientX;
document.all.contextmenu.style.top = e.clientY;
document.all.contextmenu.style.visibility = "visible";
}
}
 
return false;
}
}
if (document.layers) document.captureEvents(Event.MOUSEDOWN);
document.onmousedown = click;
document.oncontextmenu = click;
document.onclick = initiateHideMenu;
function initiateHideMenu(sub)
{
if (document.getElementById)
{
document.getElementById("contextmenu").style.visibility = "hidden";
}
else {
document.all.contextmenu.style.visibility= "hidden";
}
} 
*/

function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) {
            return pair[1];
        }
    }
    return null;
}