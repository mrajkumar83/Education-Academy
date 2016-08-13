<?php 
echo "Asdfsadf";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
 <script>
var timer = 0;
function set_interval() {
timer = setInterval("auto_logout()", 60000);
// set to 10 minutes
}

function reset_interval() {
//resets the timer. The timer is reset on each of the below events:
// 1. mousemove   2. mouseclick   3. key press 4. scroliing
//first step: clear the existing timer

if (timer != 0) {
clearInterval(timer);
timer = 0;
// second step: implement the timer again
timer = setInterval("auto_logout()", 60000);
// completed the reset of the timer
} 
}

function auto_logout() {
 // this function will redirect the user to the logout script
 //window.location = "logout.php";
 alert("Your Session Expired");
}
</script>
</head>

<body onLoad="set_interval();" onmousemove="reset_interval();" onclick="reset_interval();" onkeypress="reset_interval();" onscroll="reset_interval();">
</body>
</html>