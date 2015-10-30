function click (e)
{
if (!e)e = window.event;
if ((e.type && e.type == "divcontextmenu") || (e.button && e.button == 2) || (e.which && e.which == 3))
{
var relTarg = e.target || e.srcElement;
var spaEle = document.getElementById("filevalue");
spaEle.setAttribute("class",relTarg.id);
if (window.opera) window.alert("Sorry: Diese Funktion ist deaktiviert.");
// Show RightMenu on
if (document.getElementById)
{
document.getElementById("divcontextmenu").style.left = e.clientX + "px";
document.getElementById("divcontextmenu").style.top = e.clientY + "px";
document.getElementById("divcontextmenu").style.visibility = "visible";
//var relTarg = e.relatedTarget || e.fromElement;

}
else if (document.all)
{
document.all.divcontextmenu.style.left = e.clientX;
document.all.divcontextmenu.style.top = e.clientY;
document.all.divcontextmenu.style.visibility = "visible";
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
document.getElementById("divcontextmenu").style.visibility = "hidden";
}
else {
document.all.divcontextmenu.style.visibility= "hidden";
}
} 