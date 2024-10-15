var mydate=new Date();
var year=mydate.getYear();   
if (year < 1000) year+=1900;
var day=mydate.getDay();
var month=mydate.getMonth();
var daym=mydate.getDate(); 
if (daym<10) daym="0"+daym;
var dayarray=new Array("Chủ nhật","Thứ Hai","Thứ Ba","Thứ Tư","Thứ Năm","Thứ Sáu","Thứ Bảy"); 
var montharray=new Array("1","2","3","4","5","6","7","8","9","10","11","12");
document.write(""+dayarray[day]+", Ngày "+daym+"/"+montharray[month]+"/"+year+"");
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
    t = setTimeout(function () {
        startTime()
    }, 500);
}