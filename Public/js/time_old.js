var timestr=document.getElementById('time').innerHTML;
var dateTable=[[31,29,31,30,31,30,31,30,31,31,30,31],[31,28,31,30,31,30,31,31,30,31,30,31]];
var sec=parseInt(timestr.split(":")[2]);
var min=parseInt(timestr.split(":")[1]);
var hou=parseInt(timestr.split(":")[0].split(' ')[1]);
var date1=parseInt(timestr.split("/")[2]);
var month1=parseInt(timestr.split("/")[1]);
var year=parseInt(timestr.split("/")[0]);
var index=0;
 if(year%4 == 0 && year%100 == 0){
    if(year%400 == 0){
        index = 0;
    }else{
        index = 1;
    }
}else if(year%4 == 0 && year%100 != 0){
    index = 0;
}else{
    index = 1;
}
function upDateTime(){
    sec++;
    if(sec==60){
        sec=0;
        min++;
    }
    if(min == 60){
        min=0;
        hou++;
    }
    if(hou == 24){
        hou=0;
        date1++;
    }
    if(date1==dateTable[index][month1-1]){
        month1++;
        date1=1;
    }
    if(month1 == 12){
        month1 = 1;
        year++;
    }
    var result = year+"/"+month1+"/"+date1+" "+hou+":"+min+":"+sec;
    // alert(result);
    document.getElementById("time").innerHTML=result;
    window.setTimeout("upDateTime()",1000);
}