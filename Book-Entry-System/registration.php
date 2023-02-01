<?php
require_once("configAL.php");
if(!empty($_POST))
{
	$name = $_POST['fname'];
	$username = $_POST['uname'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$password = sha1($_POST['password']);
	$sql = mysqli_query($al, "INSERT INTO users(username, name, password, gender, email) VALUES('$username','$name','$password','$gender','$email')");
	if($sql)
	{
		$msg = "Registration successful";
	}
	else
	{
		$msg = "Registration error: username or email already registered";
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Book Entry System | Registration</title>
<link href="css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
function vegan()
{
	var p1 = document.getElementById('p1');
	var p2 = document.getElementById('p2');
	if(p1.value == p2.value)
	{
		return confirm('Are you sure..?');
	}
	else
	{
		alert("Password doesn't match");
		return false;
	}
}
</script>
</head>
<body>
<div id="nav">
  <ul>
    <li><a href="index.php">Login</a></li>
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
    <td colspan="2" class="sub-head">User Registration</td>
  </tr>
  <tr>
    <td colspan="2" class="error-msg"><?php if(isset($msg)) { echo $msg; }?></td>
  </tr>
  <tr>
    <td class="form-lables">Full Name:</td>
    <td><input type="text" name="fname" required size="30" autocomplete="off" placeholder="Enter Full Name" /></td>
  </tr>
  <tr>
    <td class="form-lables">Email:</td>
    <td><input type="email" name="email" required size="30" autocomplete="off" placeholder="Enter Email Id" title="Invalid Email ID" /></td>
  </tr>
  <tr>
    <td class="form-lables">Gender:</td>
    <td class="form-lables"><input type="radio" name="gender" required value="Male" />
      Male
      <input type="radio" name="gender" required value="Female" />
      Female</td>
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
    <td class="form-lables">Retype Password:</td>
    <td><input type="password" name="password" required size="30" autocomplete="off" placeholder="Enter Password" id="p2" /></td>
  </tr>
  <tr>
    <td colspan="2" class="sub-head" align="center"><input type="submit" value="Register" onClick="return vegan();" /></td>
  </tr>
</table>
</div>
</body>
</html>