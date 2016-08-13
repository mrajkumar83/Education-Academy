<?php
session_start();
?>

<html>
<form name="form1" method="post">
<table>
<tr><td>Username </td><td><input type="text" name="text1"></td></tr>
<tr><td>Password</td><td><input type="password" name="pwd"></td></tr>
<tr><td><input type="submit" value="SignIn" name="submit1"> </td></tr>
</table>
</form>
</html>

<?php
if(isset($_POST['submit1']))
{
$v1 = "FirstUser";
$v2 = "MyPassword";
$v3 = $_POST['text1'];
$v4 = $_POST['pwd'];
if($v1 == $v3 && $v2 == $v4)
{
$_SESSION['luser'] = $v1;
$_SESSION['start'] = time(); // taking now logged in time
$_SESSION['expire'] = $_SESSION['start'] + (1 * 60) ; // ending a session in 30     minutes from the starting time
header('Location: homepage.php');
}
else
{
echo "Please enter Username or Passwod again !";
}

}
?>