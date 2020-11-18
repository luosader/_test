function TopAd()
{
var strTopAd="";
return strTopAd;
}
document.write(TopAd());
$(function(){
	//过两秒显示 showImage(); 内容
    setTimeout("showImage();",2000);
    //alert(location);
});
function showImage()
{
    $("#adBig").slideUp(1000);
}