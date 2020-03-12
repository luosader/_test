
var inner="";
var date=new Date();
var h=date.getHours();
if(h>=22){
inner='3686'; 
}else if(h<=8){
inner='2686'
}else{
inner=(h-8)*100+2686;
}
document.getElementById("test1").innerHTML=inner;
