<?php
require_once("configAL.php");
if(!isset($_SESSION['username']))
{
	header("location:index.php");
}
$data = mysqli_fetch_array(mysqli_query($al,"SELECT * FROM users WHERE username = '".$_SESSION['username']."'"));
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Book Entry System | Home</title>
<link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="nav">
  <ul>
    <li><a href="logout.php">Logout</a></li>
    <li><a href="#"> <?php if($data['gender'] == "Male") {echo "&#x1F468;";}else{echo "&#x1F469;";}echo " ".$data['name'];?></a></li>
    <li class="head">BOOK ENTRY SYSTEM</li>
  </ul>
</div>
<br>
<br>
<br>
<br>
<br>
<div id="box">
<table border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td colspan="2" class="sub-head">User Control Panel</td>
  </tr>
  <tr>
    <td colspan="2" class="error-msg"><?php if(isset($msg)) { echo $msg; }?></td>
  </tr>
  <tr>
    <td><a href="search-books.php" class="panel-buttons">Search/View Books</a></td>
    <td><a href="manage-books.php" class="panel-buttons">Manage Books</a></td>
  </tr>
  <tr>
    <td colspan="2"><br><a href="change-password.php" class="panel-buttons">Change Password</a></td>
  </tr>
  
</table>
</div>
</body>
</html>