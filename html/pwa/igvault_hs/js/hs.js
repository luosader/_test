function refreshlogin(csrf){$.ajax({type:'post',data:{'_csrf':csrf},url:_hs_page_fastlogin_replace_url,success:function(data){$("#fastlogin").html(data);}})}
function refreshtoplogin(csrf){$.ajax({type:'post',data:{'_csrf':csrf},url:_hs_page_fasttoplogin_replace_url,success:function(data){$("#toplinbarlogin").html(data);}})
return false;}
(function($){if(!$)return;$.extend({Object:{count:function(p){p=p||false;return $.map(this,function(o){if(!p)return o;return true;}).length;}}});})(jQuery);(function($){if(!$)return;$.extend(String.prototype,{'toBoolean':function(){return(this=='false'||this==''||this=='0')?false:true},'toNumber':function(){return(!isNaN(this))?Number(this):this.toString()},'toRealValue':function(){return(this=='true'||this=='false')?this.toBoolean():this.toNumber()},'trim':function(){return this.replace(/(^\s*)|(\s*$)/g,'')},'ltrim':function(){return this.replace(/(^\s*)/g,'')},'rtrim':function(){return this.replace(/(\s*$)/g,'')},'trimAll':function(){return this.replace(/\s/g,'')},'left':function(a){return this.substring(0,a)},'right':function(a){return(this.length<=a)?this.toString():this.substring(this.length-a,this.length)},'reverse':function(){return this.split('').reverse().join('')},'startWith':function(a,b){return!(b?this.toLowerCase().indexOf(a.toLowerCase()):this.indexOf(a))},'endWith':function(a,b){return b?(new RegExp(a.toLowerCase()+"$").test(this.toLowerCase().trim())):(new RegExp(a+"$").test(this.trim()))},'sliceAfter':function(a){return(this.indexOf(a)>=0)?this.substring(this.indexOf(a)+a.length,this.length):this.toString()},'sliceBefore':function(a){return(this.indexOf(a)>=0)?this.substring(0,this.indexOf(a)):this.toString()},'getByteLength':function(){return this.replace(/[^\x00-\xff]/ig,'xx').length},'subByte':function(a,s){if(a<0||this.getByteLength()<=a){return this.toString()}
var b=this;b=b.substr(0,a).replace(/([^\x00-\xff])/g,"\x241 ").substr(0,a).replace(/[^\x00-\xff]$/,"").replace(/([^\x00-\xff]) /g,"\x241");return b+(s||'')},'textToHtml':function(){return this.replace(/</ig,'&lt;').replace(/>/ig,'&gt;').replace(/\r\n/ig,'<br>').replace(/\n/ig,'<br>')},'htmlToText':function(){return this.replace(/<br>/ig,'\r\n')},'htmlEncode':function(){var a=this,re={'<':'&lt;','>':'&gt;','&':'&amp;','"':'&quot;'};for(i in re){a=a.replace(new RegExp(i,'g'),re[i])}
return a},'htmlDecode':function(){var a=this,re={'&lt;':'<','&gt;':'>','&amp;':'&','&quot;':'"'};for(i in re){a=a.replace(new RegExp(i,'g'),re[i])}
return a},'stripHtml':function(){return this.replace(/(<\/?[^>\/]*)\/?>/ig,'')},'stripScript':function(){return this.replace(/<script(.|\n)*\/script>\s*/ig,'').replace(/on[a-z]*?\s*?=".*?"/ig,'')},'replaceAll':function(a,b){return this.replace(new RegExp(a,"gm"),b)},'escapeReg':function(){return this.replace(new RegExp("([.*+?^=!:\x24{}()|[\\]\/\\\\])","g"),'\\\x241')},'addQueryValue':function(a,b){var c=this.getPathName();var d=this.getQueryJson();if(!d[a])d[a]=b;return c+'?'+$.param(d)},'getQueryValue':function(a){var b=new RegExp("(^|&|\\?|#)"+a.escapeReg()+"=([^&]*)(&|\x24)","");var c=this.match(b);return(c)?c[2]:''},'getQueryJson':function(){if(this.indexOf('?')<0)return{};var a=this.substr(this.indexOf('?')+1),params=a.split('&'),len=params.length,result={},key,value,item,param;for(var i=0;i<len;i++){param=params[i].split('=');key=param[0];value=param[1];item=result[key];if('undefined'==typeof item){result[key]=value}else if(Object.prototype.toString.call(item)=='[object Array]'){item.push(value)}else{result[key]=[item,value]}}
return result},'getDomain':function(){if(this.startWith('http://'))return this.split('/')[2];return ''},'getPathName':function(){return(this.lastIndexOf('?')==-1)?this.toString():this.substring(0,this.lastIndexOf('?'))},'getFilePath':function(){return this.substring(0,this.lastIndexOf('/')+1)},'getFileName':function(){return this.substring(this.lastIndexOf('/')+1)},'getFileExt':function(){return this.substring(this.lastIndexOf('.')+1)},'parseDate':function(){return(new Date()).parse(this.toString())},'parseJSON':function(){return(new Function("return "+this.toString()))()},'parseAttrJSON':function(){var d={},a=this.toString().split(';');for(var i=0;i<a.length;i++){if(a[i].trim()==''||a[i].indexOf(':')<1)continue;var b=a[i].sliceBefore(':').trim(),val=a[i].sliceAfter(':').trim();if(b!=''&&val!='')d[b.toCamelCase()]=val.toRealValue()}
return d},'_pad':function(a,b,c){var d=[c?'':this,c?this:''];while(d[c].length<(a?a:0)&&(d[c]=d[1]+(b||' ')+d[0]));return d[c]},'padLeft':function(a,b){if(this.length>=a)return this.toString();return this._pad(a,b,0)},'padRight':function(a,b){if(this.length>=a)return this.toString();return this._pad(a,b,1)},'toHalfWidth':function(){return this.replace(/[\uFF01-\uFF5E]/g,function(c){return String.fromCharCode(c.charCodeAt(0)-65248)}).replace(/\u3000/g," ")},'toCamelCase':function(){if(this.indexOf('-')<0&&this.indexOf('_')<0){return this.toString()}
return this.replace(/[-_][^-_]/g,function(a){return a.charAt(1).toUpperCase()})},'format':function(){var a=this;if(arguments.length>0){var b=(arguments.length==1&&$.isArray(arguments[0]))?arguments[0]:$.makeArray(arguments);$.each(b,function(i,n){a=a.replace(new RegExp("\\{"+i+"\\}","g"),n)})}
return a},'substitute':function(d){if(d&&typeof(d)=='object'){return this.replace(/\{([^{}]+)\}/g,function(a,b){var c=d[b];return(c!==undefined)?''+c:''})}else{return this.toString()}},'extractValues':function(c,d){var e=this.toString();d=d||{};var f=d.delimiters||["{","}"];var g=d.lowercase;var h=d.whitespace;var j=/[\\\^\$\*\+\.\?\(\)]/g;var k=new RegExp(f[0]+"([^"+f.join("")+"\t\r\n]+)"+f[1],"g");var l=c.match(k);var m=new RegExp(c.replace(j,"\\$&").replace(k,"(\.+)"));if(g){e=e.toLowerCase()}
if(h){e=e.replace(/\s+/g,function(a){var b="";for(var i=0;i<h;i++){b=b+a.charAt(0)};return b})};var n=e.match(m);if(!n){return null}
n=n.splice(1);var o={};for(var i=0;i<l.length;i++){o[l[i].replace(new RegExp(f[0]+"|"+f[1],"g"),"")]=n[i]}
return o}})})(jQuery);(function($){if(!$)return;$.extend(Number.prototype,{'comma':function(a){if(!a||a<1)a=3;source=(''+this).split(".");source[0]=source[0].replace(new RegExp('(\\d)(?=(\\d{'+a+'})+$)','ig'),"$1,");return source.join(".")},'randomInt':function(a,b){return Math.floor(Math.random()*(b-a+1)+a)},'padLeft':function(a,b){return(''+this).padLeft(a,b)},'padRight':function(a,b){return(''+this).padRight(a,b)}})})(jQuery);(function($){if(!$)return;$.extend(Date.prototype,{'parse':function(a){if(typeof(a)=='string'){if(a.indexOf('GMT')>0||a.indexOf('gmt')>0||!isNaN(Date.parse(a))){return this.parseGMT(a)}else if(a.indexOf('UTC')>0||a.indexOf('utc')>0||a.indexOf(',')>0){return this.parseUTC(a)}else{return this.parseCommon(a)}}
return new Date()},'parseGMT':function(a){this.setTime(Date.parse(a));return this},'parseUTC':function(a){return(new Date(a))},'parseCommon':function(a){var d=a.split(/ |T/),d1=d.length>1?d[1].split(/[^\d]/):[0,0,0],d0=d[0].split(/[^\d]/);return new Date(d0[0]-0,d0[1]-1,d0[2]-0,d1[0]-0,d1[1]-0,d1[2]-0)},'dateAdd':function(a,b){var c=this.getFullYear();var d=this.getMonth();var e=this.getDate();var f=this.getHours();var g=this.getMinutes();var h=this.getSeconds();switch(a){case 'y':this.setFullYear(c+b);break;case 'm':this.setMonth(d+b);break;case 'd':this.setDate(e+b);break;case 'h':this.setHours(f+b);break;case 'n':this.setMinutes(g+b);break;case 's':this.setSeconds(h+b);break}
return this},'format':function(a){if(isNaN(this))return '';var o={'m+':this.getMonth()+1,'d+':this.getDate(),'h+':this.getHours(),'n+':this.getMinutes(),'s+':this.getSeconds(),'S':this.getMilliseconds(),'W':["Sun","Mon","Tur","Wen","Thu","Fri","Sat"][this.getDay()],'q+':Math.floor((this.getMonth()+3)/3)};if(a.indexOf('am/pm')>=0){a=a.replace('am/pm',(o['h+']>=12)?'PM':'AM');if(o['h+']>=12)o['h+']-=12}
if(/(y+)/.test(a)){a=a.replace(RegExp.$1,(this.getFullYear()+"").substr(4-RegExp.$1.length))}
for(var k in o){if(new RegExp("("+k+")").test(a)){a=a.replace(RegExp.$1,RegExp.$1.length==1?o[k]:("00"+o[k]).substr((""+o[k]).length))}}
return a}})})(jQuery);(function($){if(!$)return;$.fn.tagName=function(){if(this.length==0)return '';if(this.length>1){var b=[];this.each(function(i,a){b.push(a.tagName.toLowerCase())});return b}else{return this[0].tagName.toLowerCase()}};$.fn.attrJSON=function(a){return(this.attr(a||'rel')||'').parseAttrJSON()};$.fn.bindJqueryUI=function(a,b){if(this.size()==0)return this;var c=this;HS.load('jqueryui',function(){c[a](b)});return this};$.fn.bindHSUI=function(a,b,c){if(this.size()==0||!HS)return this;if(HS.ui&&HS.ui[a]){HS.ui[a](this,b);this.data(a+'-binded',true)}else{this.bindHSUIExtend(c||'ui',a,b)}
return this};$.fn.bindHSUIExtend=function(a,b,c){if(this.size()==0||!HS)return this;var d=this;HS.load(a,function(){setTimeout(function(){if(!HS.ui[b])return;HS.ui[b](d,c);d.data(b+'-binded',true)},200)});return this}})(jQuery);(function($){if(!$)return;if(!window.HS)window.HS={};HS.namespace=function(e,f){var s=e.split(f||'.'),d={},o=function(a,b,c){if(c<b.length){if(!a[b[c]]){a[b[c]]={}}
d=a[b[c]];o(a[b[c]],b,c+1)}};o(window,s,0);return d};HS.debugMode=false;HS.debugIndex=0;HS.debug=function(a,b){if(!this.debugMode)return;if(typeof(console)=='undefined'){HS.debug.log(((Date.prototype.format)?(new Date()).format('hh:nn:ss.S'):(++HS.debugIndex))+', '+a+' = '+b)}else{if(console&&console.log)console.log(((Date.prototype.format)?(new Date()).format('hh:nn:ss.S'):(++HS.debugIndex))+', '+a,'=',b)}};HS.debug.log=function(){this.createDOM();var p=[],v=$('#_hs_debuglog textarea').val();for(var i=0;i<arguments.length;i++){p.push(arguments[i])}
v+=(v==''?'':'\n')+p.join(' ');$('#_hs_debuglog textarea').val(v)};HS.debug.clear=function(){$('#_hs_debuglog textarea').val('')};HS.debug.createDOM=function(){if($('#_hs_debuglog').size()==0){var a='<div id="_hs_debuglog" style="position:fixed;bottom:0;left:0;right:0;_position:absolute;_bottom:auto;_top:0;padding:5px 0 5px 5px;border:solid 5px #666;background:#eee;z-index:1000;"><textarea style="font-size:12px;line-height:16px;display:block;background:#eee;border:none;width:100%;height:80px;"></textarea><a style="text-decoration:none;display:block;height:80px;width:20px;text-align:center;line-height:16px;padding:5px 0;_padding:6px 0;background:#666;color:#fff;position:absolute;right:-5px;bottom:0;" href="#">close</a></div>';$('body').append(a);$('#_hs_debuglog a').click(function(){$(this).parent().remove();return false});$('#_hs_debuglog textarea').focus(function(){this.select()})}};HS.load=function(a,b,c){if($.isArray(a)){var d=a.join(',');var e=a.length;var f=HS.loader.checkFileLoader(d);if(f==e+1){if(typeof(b)=='function')b()}else if(f>0){HS.loader.addExecute(d,b)}else if(f==0){HS.loader.addExecute(d,b);HS.loader.fileLoader[d]=1;HS.debug('Start loading JS',d);for(var i=0;i<e;i++){HS.load(a[i],function(){HS.loader.fileLoader[d]++;if(HS.loader.fileLoader[d]==e+1){HS.debug('Finished loading JS',d);HS.loader.execute(d)}})}}}else if(HS.loader.serviceLibs[a]&&HS.loader.serviceLibs[a].requires){HS.load(HS.loader.serviceLibs[a].requires,function(){HS.load.run(a,b,c)})}else{HS.load.run(a,b,c)}};HS.load.version='';HS.load.add=function(a,b){if(HS.loader.serviceLibs[a])return;if(b.js&&(!b.js.startWith('http'))&&this.version){b.js=b.js.addQueryValue('v',this.version)}
if(b.css&&(!b.css.startWith('http'))&&this.version){b.css=b.css.addQueryValue('v',this.version)}
HS.loader.serviceLibs[a]=b};HS.load.setPath=function(a){HS.loader.serviceBase=a};HS.load.run=function(a,b,c){var d=(typeof(b)=='string')?(function(){try{var o=eval('HS.'+a);if(o&&o[b])o[b](c)}catch(e){}}):(b||function(){});if(HS.loader.checkService(a)){d();return}
var f=HS.loader.getServiceUrl(a);var g=HS.loader.checkFileLoader(f);if(g==2){d()}else if(g==1){HS.loader.addExecute(f,d)}else if(g==0){if($('script[src="'+f+'"]').size()>0){HS.loader.fileLoader[f]=2;d()}else{HS.loader.addExecute(f,d);HS.loader.addScript(a)}}else{HS.debug('Load exception',a)}};HS.loader={};HS.loader.fileLoader={};HS.loader.executeLoader={};HS.loader.serviceBase=(function(){return $('script:last').attr('src').sliceBefore('/js/')+'/'})();HS.loader.serviceLibs={};HS.loader.checkFullUrl=function(a){return(a.indexOf('/')==0||a.indexOf('http://')==0)};HS.loader.checkService=function(a){if(this.checkFullUrl(a))return false;try{if(a.indexOf('.')>0){var o=eval('HS.'+a);return(typeof(o)!='undefined')}
return false}catch(e){return false}};HS.loader.checkFileLoader=function(a){return(a!='')?(this.fileLoader[a]||0):-1};HS.loader.getServiceUrl=function(a){var b='';if(this.checkFullUrl(a)){b=a}else if(this.serviceLibs[a]){b=(this.checkFullUrl(this.serviceLibs[a].js))?this.serviceLibs[a].js:(this.serviceBase+this.serviceLibs[a].js)}
return b};HS.loader.execute=function(a){if(this.executeLoader[a]){for(var i=0;i<this.executeLoader[a].length;i++){this.executeLoader[a][i]()}
this.executeLoader[a]=null}};HS.loader.addExecute=function(a,b){if(typeof(b)!='function')return;if(!this.executeLoader[a])this.executeLoader[a]=[];this.executeLoader[a].push(b)};HS.loader.addScript=function(a){var b=this;if(this.checkFullUrl(a)){var c=a;this.getScript(c,function(){b.fileLoader[c]=2;HS.debug('complete loading JS',c);HS.loader.execute(c)})}else if(this.serviceLibs[a]){if(this.serviceLibs[a].css){var c=(this.checkFullUrl(this.serviceLibs[a].css))?this.serviceLibs[a].css:(this.serviceBase+this.serviceLibs[a].css);if(!this.fileLoader[c]){$('head').append('<link rel="stylesheet" type="text\/css"  href="'+c+'" \/>');this.fileLoader[c]=1;HS.debug('start loading CSS',c)}}
if(this.serviceLibs[a].js){var c=(this.checkFullUrl(this.serviceLibs[a].js))?this.serviceLibs[a].js:(this.serviceBase+this.serviceLibs[a].js);this.getScript(c,function(){b.fileLoader[c]=2;HS.debug('complete loading JS',c);HS.loader.execute(c)})}}};HS.loader.getScript=function(a,b,c){this.getRemoteScript(a,b,c);this.fileLoader[a]=1;HS.debug('start loading JS',a)};HS.loader.getRemoteScript=function(a,b,c,d){if($.isFunction(b)){d=c;c=b;b={}}
var e=document.getElementsByTagName("head")[0];var f=document.createElement("script");f.type='text/javascript';f.src=a;for(var g in b){if(g=='keepScriptTag'){f.keepScriptTag=true}else{f.setAttribute(g,b[g])}}
f.onload=f.onreadystatechange=function(){if(!this.readyState||this.readyState=="loaded"||this.readyState=="complete"){if(c)c();f.onload=f.onreadystatechange=null;if(!f.keepScriptTag)e.removeChild(f)}};f.onerror=function(){if(d)d()};e.appendChild(f)};HS.timestat={};HS.timestat.libs={};HS.timestat.loadTime=(typeof(_hs_page_loadtime)=='number')?_hs_page_loadtime:new Date().getTime();HS.timestat.add=function(a){this.libs[a]=new Date().getTime()-this.loadTime};HS.timestat.get=function(a){return this.libs[a]||0};HS.lang={};HS.lang.language='zh-cn';HS.lang.text={};HS.lang.get=function(a,b){if(b){if(this.text[a]){return this.text[a][b]||''}else{return ''}}else{return this.text[a]||null}};HS.lang.set=function(a,b,c){if(!this.text[a]){this.text[a]={}}
if(c){this.text[a][b]=c}else{this.text[a]=b}};HS.lang.extend=function(a,b){if(!this.text[a]){this.text[a]={}}
$.extend(this.text[a],b)}})(jQuery);(function($){if(!$||!window.HS)return;HS.namespace('HS.json');HS.json.parse=function(a){return(new Function("return "+a))()};HS.json.stringify=function(d){var m={'\b':'\\b','\t':'\\t','\n':'\\n','\f':'\\f','\r':'\\r','"':'\\"','\\':'\\\\'},s={'array':function(x){var a=['['],b,f,i,l=x.length,v;for(i=0;i<l;i+=1){v=x[i];f=s[typeof v];if(f){v=f(v);if(typeof v=='string'){if(b){a[a.length]=','}
a[a.length]=v;b=true}}}
a[a.length]=']';return a.join('')},'boolean':function(x){return String(x)},'null':function(x){return 'null'},'number':function(x){return isFinite(x)?String(x):'null'},'object':function(x){if(x){if(x instanceof Array){return s.array(x)}
var a=['{'],b,f,i,v;for(i in x){v=x[i];f=s[typeof v];if(f){v=f(v);if(typeof v=='string'){if(b){a[a.length]=','}
a.push(s.string(i),':',v);b=true}}}
a[a.length]='}';return a.join('')}
return 'null'},'string':function(x){if(/["\\\x00-\x1f]/.test(x)){x=x.replace(/([\x00-\x1f\\"])/g,function(a,b){var c=m[b];if(c){return c}
c=b.charCodeAt();return '\\u00'+Math.floor(c/16).toString(16)+(c%16).toString(16)})}
return '\"'+x+'\"'}};return s.object(d)}})(jQuery);(function($){if(!$||!window.HS)return;HS.namespace('HS.page');HS.page.refresh=function(a){var a=a||document.location.href.sliceBefore('#');document.location.href=a};HS.page.addFavor=function(u,t){var a=u||document.location.href,title=t||document.title;if(a.match(/_fromid=[\w]*/)){a=a.replace(/_fromid=[\w]*/,'_fromid=userfavorite')}else{a+=((a.indexOf('?')>0)?'&':'?')+'_fromid=userfavorite'}
var b=((navigator.userAgent.toLowerCase()).indexOf('mac')!=-1)?'Command/Cmd':'CTRL';if(document.all){window.external.AddFavorite(a,title)}else if(window.sidebar){window.sidebar.addPanel(title,a,'')}else{alert('you can try key'+b+' + D add to favorit~')}};HS.page.setDomain=function(){};HS.page.keyHandler={};HS.page.keyHandler.events={};HS.page.keyHandler.keys={'ESC':27,'PAGEUP':33,'PAGEDOWN':34,'END':35,'HOME':36,'LEFT':37,'TOP':38,'RIGHT':39,'DOWN':40,'INSERT':45,'DELETE':46,'F1':112,'F2':113,'F3':114,'F4':115,'F5':116,'F6':117,'F7':118,'F8':119,'F9':120,'F10':121,'F11':122,'F12':123};HS.page.keyHandler.add=function(b,c,d,f){this.events[d]=function(e){try{var a=e.which||e.keyCode||0;if(a==HS.page.keyHandler.keys[c]){f()}}catch(err){}};$(b).bind('keydown',this.events[d])};HS.page.keyHandler.remove=function(a,b){$(a).unbind('keydown',this.events[b]);this.events[b]=null};HS.page.flash=function(a,b,c,d,e,f,g,h,i){HS.load('swfobject',function(){swfobject.embedSWF(a,b,c,d,e,f||false,g||false,h||false,i||false)})};HS.page.msgtip=function(a,b,c){var c=c||{};c.content=b;HS.load('util-msgtip',function(){new HS.util.msgtip($(a),c)})};HS.page.popbox=function(a){HS.load('util.popbox','show',a)};HS.page.popbox.close=function(){HS.load('util.popbox','close',null)};HS.page.alert=function(a,b){if(HS.util&&HS.util.dialog&&HS.util.dialog.status){alert(a);if(b)b();return false}else{var c=($.isPlainObject(a))?a:{message:a,callback:b};HS.load('util.dialog','alert',c)}};HS.page.showSuccess=function(a,b){var c=($.isPlainObject(a))?a:{message:a,callback:b};c.type='success';HS.load('util.dialog','alert',c)};HS.page.showError=function(a,b){var c=($.isPlainObject(a))?a:{message:a,callback:b};c.type='error';HS.load('util.dialog','alert',c)};HS.page.confirm=function(a,b,c){var d=($.isPlainObject(a))?a:{message:a,callback:b,cancel:c};HS.load('util.dialog','confirm',d)};HS.page.prompt=function(a,b){var c=($.isPlainObject(a))?a:{message:a,callback:b};HS.load('util.dialog','prompt',c)};HS.page.showLoading=function(a){var b=($.isPlainObject(a))?a:{loadingText:a};HS.load('util.dialog','showLoading',b)};HS.page.hideLoading=function(){HS.load('util.dialog','close','')};HS.page.dialog=function(a){HS.load('util.dialog','open',a)};HS.page.dialog.pop=function(a){HS.load('util.dialog','pop',a)};HS.page.dialog.poptab=function(a,b,c){var d=a[0];$.extend(d,{tabs:a,width:b,height:c});HS.load('util.dialog','pop',d)};HS.page.dialog.show=function(a){HS.load('util.dialog','show',a);};HS.page.dialog.ajax=function(a){HS.load('util.dialog','ajax',a);};HS.page.dialog.form=function(a,b,c,d){var e='frame'+(new Date()).getTime();var f='<iframe id="{frameId}" name="{frameId}" src="about:blank" width="100%" height="100%" scrolling="auto" frameborder="0" marginheight="0" marginwidth="0"></iframe>';var g={};g.title=b;g.width=c;g.height=d;g.content=f.substitute({frameId:e});g.callback=function(){a.target=e;a.submit()};HS.page.dialog(g);return false;};HS.page.closeDialog=function(a){HS.load('util.dialog','close',a);};HS.page.dialog.setContent=function(a){HS.load('util.dialog',function(){HS.util.dialog.setContent(a);HS.util.dialog.setAutoHeight()})};HS.page.dialog.setConfig=function(a,b){HS.load('util.dialog',function(){HS.util.dialog[a]=b})}})(jQuery);(function($){if(!$||!window.HS)return;HS.namespace('HS.login');HS.login.servicePath='/';HS.login.serviceAPI={'login':_hs_page_fastlogin_login_url,'register':_hs_page_fastlogin_register_url,'headinfo':_hs_page_fastlogin_headinfo_url+'?callback=?'};HS.login.setServicePath=function(path){this.servicePath=path;};HS.login.loadTime=new Date().getTime();HS.login.headData={};HS.login.userData={};HS.login.getUserInfo=function(callback){this.addEvent(callback);this.loadUserInfo();};HS.login.loadUserInfo=function(callback){var callback=callback||function(){HS.login.exeEvents();};this.loadTime=new Date().getTime();if(this.servicePath=='/'){this.servicePath=(("https:"==document.location.protocol)?"https://":"http://")+document.domain;}
$.getJSON(this.servicePath+this.serviceAPI.headinfo,function(data){HS.login.headData=data;HS.login.userData={};if(data.memberInfo){HS.login.userData=data.memberInfo;HS.login.userData.nickName=HS.login.userData.nickName||HS.login.userData.logName;HS.login.userData.isLogin=true;}
callback(HS.login.userData,HS.login.headData);if(HS.login.userData.isLogin){HS.login.clearEvents();}});};HS.login.checkUserStatus=function(){var m=(new Date().getTime()-this.loadTime)/60000;if(this.userData.isLogin&&m<5)return true;return false;};HS.login.events=[];HS.login.addEvent=function(callback){if(callback)this.events.push(callback);};HS.login.exeEvents=function(){for(var i=0;i<this.events.length;i++){this.events[i](this.userData,this.headData);}};HS.login.clearEvents=function(){this.events=[];};HS.login.pop=function(param,callback){if(!callback){callback=param;param={};}
param.pagetype='pop';this.callback=function(){};if($.isFunction(callback)){this.callback=callback;}else if(typeof(callback)=='string'&&callback!=''){this.callback=function(){document.location.href=callback;};}
if(this.checkUserStatus()){this.callback(this.userData,this.headData);}else{this.loadUserInfo(function(userData,headData){if(userData.isLogin){HS.login.callback(userData,headData);}else{HS.login.dialog(param);}});}
return false;};HS.login.dialog=function(param){if(this.servicePath!='/'){HS.page.setDomain();param.crossdomain=true;}
param.pay_name_type=_fast_pay_register_item;param.signruntype=_sign_phone_checkout;HS.page.dialog.poptab([{title:_hs_page_fastlogin_login_languaue,url:this.servicePath+this.serviceAPI.login+'?'+$.param(param)},{title:_hs_page_fastlogin_register_languaue,url:this.servicePath+this.serviceAPI.register+'?'+$.param(param)}],480,400);this.status=true;this.success=function(){HS.page.closeDialog();HS.login.addEvent(HS.login.callback);HS.login.status=false;HS.login.getUserInfo();};};HS.login.success=function(url){document.location.href=url;};HS.login.status=false;})(jQuery);(function($){if(!$||!window.HS)return;HS.namespace('HS.dataproxy');HS.dataproxy.loaders=[];HS.dataproxy.add=function(callback){if(this.j$){callback(this.j$);return;}
if(this.loaders.length==0){alert(11);HS.page.setDomain();$('body').append('<iframe name="dataProxy" id="dataProxy" src="" width="0" height="0" style="display:none;"></iframe>');}
this.loaders.push(callback);};HS.dataproxy.setJquery=function(j$){this.j$=j$;for(var i=0;i<this.loaders.length;i++){this.loaders[i](this.j$);}
this.loaders=[];};HS.dataproxy.ajax=function(params){if(HS.login.servicePath=='/'){$.ajax(params);}else{this.add(function(j$){j$.ajax(params);});}};HS.dataproxy.get=function(url,params,success,type){if(HS.login.servicePath=='/'){$.get(url,params,success,type);}else{this.add(function(j$){j$.get(url,params,success,type);});}};HS.dataproxy.getJSON=function(url,params,success){if(HS.login.servicePath=='/'){$.getJSON(url,params,success);}else{this.add(function(j$){j$.getJSON(url,params,success);});}};HS.dataproxy.post=function(url,params,success,type){if(HS.login.servicePath=='/'){$.post(url,params,success,type);}else{this.add(function(j$){j$.post(url,params,success,type);});}};})(jQuery);(function($){if(!$||!window.HS)return;HS.namespace('HS.valid');HS.valid.isIP=function(str){var re=/^(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])$/;return re.test(str);};HS.valid.isUrl=function(str){return(new RegExp(/(http[s]?|ftp):\/\/[^\/\.]+?\..+\w$/i).test(str.trim()));};HS.valid.isDate=function(str){var result=str.match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/);if(result==null)return false;var d=new Date(result[1],result[3]-1,result[4]);return(d.getFullYear()==result[1]&&d.getMonth()+1==result[3]&&d.getDate()==result[4]);};HS.valid.isTime=function(str){var result=str.match(/^(\d{1,2})(:)?(\d{1,2})\2(\d{1,2})$/);if(result==null)return false;if(result[1]>24||result[3]>60||result[4]>60)return false;return true;};HS.valid.isDateTime=function(str){var result=str.match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/);if(result==null)return false;var d=new Date(result[1],result[3]-1,result[4],result[5],result[6],result[7]);return(d.getFullYear()==result[1]&&(d.getMonth()+1)==result[3]&&d.getDate()==result[4]&&d.getHours()==result[5]&&d.getMinutes()==result[6]&&d.getSeconds()==result[7]);};HS.valid.isInteger=function(str){return(new RegExp(/^(-|\+)?\d+$/).test(str.trim()));};HS.valid.isPositiveInteger=function(str){return(new RegExp(/^\d+$/).test(str.trim()))&&parseInt(str)>0;};HS.valid.isNegativeInteger=function(str){return(new RegExp(/^-\d+$/).test(str.trim()));};HS.valid.isNumber=function(str){return!isNaN(str);};HS.valid.isEmail=function(str){return(new RegExp(/^([_a-zA-Z\d\-\.])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/).test(str.trim()));};HS.valid.isMobile=function(str){return(new RegExp(/^(13|14|15|18)\d{9}$/).test(str.trim()));};HS.valid.isPhone=function(str){return(new RegExp(/^(([0\+]\d{2,3}-)?(0\d{2,3})-)?(\d{7,8})(-(\d{3,}))?$/).test(str.trim()));};HS.valid.isAreacode=function(str){return(new RegExp(/^0\d{2,3}$/).test(str.trim()));};HS.valid.isPostcode=function(str){return(new RegExp(/^\d{6}$/).test(str.trim()));};HS.valid.isLetters=function(str){return(new RegExp(/^[A-Za-z]+$/).test(str.trim()));};HS.valid.isDigits=function(str){return(new RegExp(/^[1-9][0-9]+$/).test(str.trim()));};HS.valid.isAlphanumeric=function(str){return(new RegExp(/^[a-zA-Z0-9]+$/).test(str.trim()));};HS.valid.isValidString=function(str){return(new RegExp(/^[a-zA-Z0-9\s.\-_]+$/).test(str.trim()));};HS.valid.isLowerCase=function(str){return(new RegExp(/^[a-z]+$/).test(str.trim()));};HS.valid.isUpperCase=function(str){return(new RegExp(/^[A-Z]+$/).test(str.trim()));};HS.valid.isChinese=function(str){return(new RegExp(/^[\u4e00-\u9fa5]+$/).test(str.trim()));};HS.valid.isIDCard=function(str){var r15=new RegExp(/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$/);var r18=new RegExp(/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X|x)$/);return(r15.test(str.trim())||r18.test(str.trim()));};HS.valid.isCardNo=function(str,cardType){var cards={"Visa":{lengths:"13,16",prefixes:"4",checkdigit:true},"MasterCard":{lengths:"16",prefixes:"51,52,53,54,55",checkdigit:true},"BankCard":{lengths:"16,17,19",prefixes:"3,4,5,6,9",checkdigit:false}};if(!cards[cardType])return false;var cardNo=str.replace(/[\s-]/g,"");var cardexp=/^[0-9]{13,19}$/;if(cardNo.length==0||!cardexp.exec(cardNo)){return false;}else{cardNo=cardNo.replace(/\D/g,"");var modTenValid=true;var prefixValid=false;var lengthValid=false;if(cards[cardType].checkdigit){var checksum=0,mychar="",j=1,calc;for(i=cardNo.length-1;i>=0;i--){calc=Number(cardNo.charAt(i))*j;if(calc>9){checksum=checksum+1;calc=calc-10;}
checksum=checksum+calc;if(j==1){j=2}else{j=1};}
if(checksum%10!=0)modTenValid=false;}
if(cards[cardType].prefixes==''){prefixValid=true;}else{var prefix=cards[cardType].prefixes.split(",");for(i=0;i<prefix.length;i++){var exp=new RegExp("^"+prefix[i]);if(exp.test(cardNo))prefixValid=true;}}
var lengths=cards[cardType].lengths.split(",");for(j=0;j<lengths.length;j++){if(cardNo.length==lengths[j])lengthValid=true;}
if(!modTenValid||!prefixValid||!lengthValid){return false;}else{return true;}}};HS.valid.isLogName=function(str){return(HS.valid.isEmail(str)||HS.valid.isMobile(str));};HS.valid.isRealName=function(str){return /^[A-Za-z \u4E00-\u9FA5]+$/.test(str);};})(jQuery);(function($){if(!$||!window.HS)return;HS.load.version='141220';HS.load.add('ui',{js:'js/hs/hs.ui.js'});HS.load.add('util-msgtip',{js:'js/hs/util/msgtip.js',css:'js/hs/util/msgtip.css'});HS.load.add('util.overlayer',{js:'js/hs/util/overlayer.js'});HS.load.add('util.popbox',{js:'js/hs/util/popbox.js',requires:'util.overlayer'});HS.load.add('util.dialog',{js:'js/hs/util/dialog.js',css:'js/hs/util/dialog.css',requires:'util.overlayer'});HS.load.add('lhgcalendar',{js:'js/lib/new.lhgcalendar.min.js'});HS.load.add('jqueryui',{js:'js/lib/jquery-ui-1.11.1.custom.min.js'});HS.load.add('swfobject',{js:'js/lib/swfobject.js'});HS.page.init=function(){HS.timestat.add('page-init');HS.debug('page','begin init');};$(function(){HS.page.init();});HS.timestat.add('load-hs');HS.debug('hs.js','loaded')})(jQuery);