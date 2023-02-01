<?php
require_once("configAL.php");
if(isset($_SESSION['username']))
{
	header("location:home.php");
}
if(!empty($_POST))
{
	$username = mysqli_real_escape_string($al,$_POST['uname']);
	$password = mysqli_real_escape_string($al,sha1($_POST['password']));
	$sql = mysqli_query($al,"SELECT * FROM users WHERE username = '$username' AND password = '$password'");
	if(mysqli_num_rows($sql) == 1)
	{
		$_SESSION['username'] = $username;
		header("location:home.php");
	}
	else
	{
		$msg = "Incorrect credentials";
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Book Entry System | Login</title>
<link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="nav">
  <ul>
    <li><a href="registration.php">Registration</a></li>
    <li class="head">BOOK ENTRY SYSTEM</li>
  </ul>
</div>
<br>
<br>
<br>
<br>
<br>
<div id="box">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<table border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td colspan="2" class="sub-head">User Login</td>
  </tr>
  <tr>
    <td colspan="2" class="error-msg"><?php if(isset($msg)) { echo $msg; }?></td>
  </tr>
  <tr>
    <td class="form-lables">Username:</td>
    <td><input type="text" name="uname" required size="30" autocomplete="off" placeholder="Enter Username" /></td>
  </tr>
  <tr>
    <td class="form-lables">Password:</td>
    <td><input type="password" name="password" required size="30" autocomplete="off" placeholder="Enter Password" id="p1" /></td>
  </tr>
  <tr>
    <td colspan="2" class="sub-head" align="center"><input type="submit" value="Login" /></td>
  </tr>
</table>
</form>
</div>
</body>
</html>