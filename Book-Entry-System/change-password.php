<?php
require_once("configAL.php");
if(!isset($_SESSION['username']))
{
	header("location:index.php");
}
$data = mysqli_fetch_array(mysqli_query($al,"SELECT * FROM users WHERE username = '".$_SESSION['username']."'"));
if(!empty($_POST))
{
	$current_password = sha1($_POST['c_p']);
	$new_password = sha1($_POST['n_p']);
	if($data['password'] == $current_password)
	{
		$sql = mysqli_query($al,"UPDATE users SET password = '$new_password' WHERE username = '".$_SESSION['username']."'");
		if($sql)
		{
			$msg = "Password successfully updated";
		}
	}
	else
	{
		$msg = "Incorrect current password";
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Book Entry System | Home</title>
<link href="css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
	function veganPasswordCheck()
	{
		if(document.getElementById('n_p').value == document.getElementById('n_pp').value)
		{
			return true;
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
    <li><a href="logout.php">Logout</a></li>
    <li><a href="#"><?php if($data['gender'] == "Male") {echo "&#x1F468;";}else{echo "&#x1F469;";}echo " ".$data['name'];?></a></li>
    <li><a href="home.php">Home</a></li>
    <li class="head">BOOK ENTRY SYSTEM</li>
  </ul>
</div>
<br>
<br>
<br>
<br>
<br>
<div id="box">
<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
<table border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td colspan="2" class="sub-head">Change Password</td>
  </tr>
  <tr>
    <td colspan="2" class="error-msg"><?php if(isset($msg)) { echo $msg; }?></td>
  </tr>
  <tr>
  	<td class="form-lables">Current Password:</td>
    <td><input type="password" name="c_p" required size="30" placeholder="Enter Current Password" /></td>
    </tr>      
      <tr>
  	<td class="form-lables">New Password:</td>
    <td><input type="password" name="n_p" required size="30" placeholder="Enter New Password" id="n_p" /></td>
    </tr>  
  <tr>
  	<td class="form-lables">Confirm New Password:</td>
    <td><input type="password" name="n_pp" required size="30" placeholder="Confirm New Password" id="n_pp" /></td>
    </tr>  
      <tr>
    <td colspan="2"><input type="submit" value="Change Password" onClick="return veganPasswordCheck();"/></td>
    </tr>  
</table>
</form>
</div>
</body>
</html>