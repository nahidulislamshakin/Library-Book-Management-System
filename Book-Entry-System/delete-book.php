<?php
require_once("configAL.php");
if(!isset($_SESSION['username']))
{
	header("location:index.php");
}
if(!empty($_GET['book_id']))
{
	$book_id = $_GET['book_id'];
	mysqli_query($al, "DELETE FROM books WHERE book_id = '$book_id'");
	header("location:manage-books.php#view");
}
?>