String.prototype.trim=function(){var text=this;var start=0;var end=text.length;var display="";for(var i=0;i<text.length;i++){display+=text.charCodeAt(i)+" ";}
for(var i=0;i<text.length;i++){var code=text.charCodeAt(i);if(code>=33){start=i;break;}
else{start++;}}
for(var i=text.length;i>start;i--){var code=text.charCodeAt(i-1);if(code>=33){end=i;break;}}
return text.substring(start,end);}
var clicked=false;function allowClick(){if(!clicked){clicked=true;return true;}
return false;}
var windowNameSeq=0;var windows=new Array();function windowExists(name){for(var i=0;i<windows.length;i++){try{if(windows[i].name==name){return true;}}
catch(exception){}}
return false;}
function getWindow(name){for(var i=0;i<windows.length;i++){try{if(windows[i].name==name){return windows[i];}}
catch(exception){}}}
function removeWindow(name){for(var i=0;i<windows.length;i++){try{if(windows[i].name==name){windows.splice(i,1);return;}}
catch(exception){}}}
function pushWin(name,url,width,height){var defaultOptions="location=yes,status=yes,toolbar=no,personalbar=no,menubar=no,directories=no,";defaultOptions+="scrollbars=yes,resizable=yes,";defaultOptions+="width="+width+",height="+height;launchWinWithOptions(name,url,defaultOptions);}
function launchWin(name,url,width,height){var defaultOptions="location=no,status=no,toolbar=no,personalbar=no,menubar=no,directories=no,";var winleft=(screen.width-width)/2;var winUp=(screen.height-height)/2;defaultOptions+="scrollbars=no,resizable=yes,top="+winUp+",left="+winleft+",";defaultOptions+="width="+width+",height="+height;launchWinWithOptions(name,url,defaultOptions);}
function launchWinWithOptions(name,url,options){if(!windowExists(name)){var winVar=window.open(url,name,options);windows[windows.length]=winVar;return winVar;}
else{var theWin=getWindow(name);theWin.focus();}}
function getTopLevelWindow(){var win=window;if(win.parent==win){return win;}
while(win.parent!=win){win=window.parent.window;}
return win;}
function closeWin(win){win.close();}
function handleClose(message){if(confirm(message)){removeWindow(getTopLevelWindow().name);closeWin(getTopLevelWindow());return true;}
else{return false;}}
function confirmCancel(message){if(confirm(message)){getTopLevelWindow().location.href='userinfo.jsp';return true;}
else{return false;}}
function cancelQueue(workgroup,chatID){getTopLevelWindow().location.href='userinfo.jsp?workgroup='+workgroup+'&chatID='+chatID;return true;}
function confirmCancelAndClose(message){if(confirm(message)){getTopLevelWindow().location.href='userinfo.jsp';getTopLevelWindow().close();return true;}
else{return false;}}
function confirmCancel(message,workgroup,chatID){if(confirm(message)){getTopLevelWindow().location.href='userinfo.jsp?workgroup='+workgroup+'&chatID='+chatID;return true;}
else{return false;}}
function closeAll(){removeWindow(getTopLevelWindow().name);closeWin(getTopLevelWindow());}
function launchHelpWin(){var win=launchWin('helpwin','helpwin.jsp',550,350);}
function hide(divId){if(document.layers){document.layers[divId].visibility='hide';}
else if(document.all){document.all[divId].style.visibility='hidden';}
else if(document.getElementById){document.getElementById(divId).style.visibility='hidden';}}
function show(divId){if(document.layers){document.layers[divId].visibility='show';}
else if(document.all){document.all[divId].style.visibility='visible';}
else if(document.getElementById){document.getElementById(divId).style.visibility='visible';}}
function getDiv(divID){if(document.layers){return document.layers[divID];}
else if(document.all){return document.all[divID];}
else if(document.getElementById){return document.getElementById(divID);}}
function getDivByDoc(divID,doc){if(doc.layers){return doc.layers[divID];}
else if(doc.all){return doc.all[divID];}
else if(doc.getElementById){return doc.getElementById(divID);}}
function showTypingIndicator(flag){if(flag){}
else{}}
function informConnectionClosed(){alert('Your support session has ended, you will be redirected to the transcript page.');parent.location.href='transcriptmain.jsp';}
function addChatText(yakWin,from,text){var yakDiv=yakWin.document.getElementById('ytext');var isAnnouncement=(from=="");var numChildren=yakDiv.childNodes.length;var nameSpan=document.createElement("span");var textSpan=document.createElement("span");if(isAnnouncement){nameSpan.setAttribute("class","chat-announcement");textSpan.setAttribute("class","chat-announcement");}
else{textSpan.setAttribute("class","text");}
var fromIsCurrentUser=false;if(!isAnnouncement){fromIsCurrentUser=(nickname==from);if(fromIsCurrentUser){nameSpan.setAttribute("class","client-name");}
else{nameSpan.setAttribute("class","operator-name");}}
var chatLineDiv=document.createElement("div");chatLineDiv.setAttribute("class","chat-line");var appendFailed=false;try{if(!isAnnouncement){nameSpan.innerHTML=from+": ";chatLineDiv.appendChild(nameSpan);}
textSpan.innerHTML=text;chatLineDiv.appendChild(textSpan);yakDiv.appendChild(chatLineDiv);}
catch(exception){appendFailed=true;}
if(!appendFailed){appendFailed=(numChildren==yakDiv.childNodes.length);}
if(appendFailed){var inn=yakDiv.innerHTML;inn+="<div class=\"chat-line\">";if(!isAnnouncement){inn+="<span class=\"";if(isAnnouncement){inn+="chat-announcement";}
else if(fromIsCurrentUser){inn+="client-name";}
else{inn+="operator-name";}
inn+="\">"+from+": </span>";}
inn+="<span class=\"";inn+=(isAnnouncement?"chat-announcement\">":"chat_text\">");inn+=text+"</span></div>";yakDiv.innerHTML=inn;}
else{}}
function scrollYakToEnd(yakWin){var endDiv=yakWin.document.getElementById('enddiv');yakWin.scrollTo(0,endDiv.offsetTop);}