<?php
error_reporting(0);
date_default_timezone_set(" Asia/Kolkata ");
$al = mysqli_connect("localhost","root","","book_entry");
if(!$al)
{
	echo "Database Not Connected";
}
session_start();
?>