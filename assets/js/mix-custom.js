// Display Current Date
// var dt = new Date();
// document.getElementById("date").innerHTML = (("0"+dt.getDate()).slice(-2)) +"/"+  (("0"+(dt.getMonth()+1)).slice(-2)) +"/"+ (dt.getFullYear());

// Display Current Time
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
  }
  function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

// Create Agency
$('#document').on('change', function() {
    $('.documentDisplay').text($(this).val());
    // do whatever you want with 'values'
}); 

function showDiv(divId, element)
{
    document.getElementById(divId).style.display = 'block';
}