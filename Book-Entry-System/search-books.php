<?php
require_once("configAL.php");
if(!isset($_SESSION['username']))
{
	header("location:index.php");
}
$data = mysqli_fetch_array(mysqli_query($al,"SELECT * FROM users WHERE username = '".$_SESSION['username']."'"));
if(!empty($_POST))
{
	$term = $_POST['keyword'];
	$qry = mysqli_query($al,"SELECT * FROM books WHERE book_name LIKE '%".substr($term,0,4)."%' OR book_category LIKE '%".substr($term,0,4)."%' OR author_name LIKE '%".substr($term,0,4)."%' OR publisher_name LIKE '%".substr($term,0,4)."%' ORDER BY book_name ASC");
	if($qry)
	{
		$flag = 1;
	}
	else
	{
		$flag = 0;
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Book Entry System | Home</title>
<link href="css/style.css" type="text/css" rel="stylesheet" />
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

</head>
<body>
<div id="nav">
  <ul>
    <li><a href="logout.php">Logout</a></li>
    <li><a href="#">
      <?php if($data['gender'] == "Male") {echo "&#x1F468;";}else{echo "&#x1F469;";}echo " ".$data['name'];?>
      </a></li>
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
        <td colspan="2" class="sub-head">Search/View Books</td>
      </tr>
      <tr>
        <td colspan="2" class="error-msg"><?php if(isset($msg)) { echo $msg; }?></td>
      </tr>
      <tr>
        <td class="form-lables">Keyword:</td>
        <td><input type="text" required placeholder="Enter Keyword" name="keyword" size="30" class="cap" id="search" /></td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" value="Search"></td>
      </tr>
    </table>
  </form>
</div>
<br>
<br>
<br>
<?php
if($flag == 1)
{?>
<div id="box" style="width:1000px;"> <span class="sub-head">View/Delete Books</span> <br>
  <?php if(isset($msg2)) { echo $msg2; }?>
  <br>
  <table border="1" cellpadding="5" cellspacing="5" style="border-collapse:collapse;">
    <tr class="form-lables" style="font-size:18px;">
      <th>Sr.No.</th>
      <th>Cover Page</th>
      <th>Book Name</th>
      <th>Category</th>
      <th>Author</th>
      <th>Publisher</th>
      <th>Price</th>
    </tr>
    <?php 
	$sr = 1;
	while($pr = mysqli_fetch_array($qry))
	{
		?>
    <tr class="form-lables" style="background-color:<?php if($sr%2==0){ echo"rgba(219,219,219,0.9)"; }?>;font-size:16px;">
      <td><?php echo $sr;$sr++;?></td>
      <td align="center"><img src="covers/<?php echo $pr['cover_image'];?>" height="100" width="60"/></td>
      <td><?php echo $pr['book_name'];?></td>
      <td><?php echo $pr['book_category'];?></td>
      <td><?php echo $pr['publisher_name'];?></td>
      <td><?php echo $pr['author_name'];?></td>
      <td><?php echo "৳".$pr['book_price'];?></td>
    </tr>
    <?php } ?>
  </table>
 <?php } ?>
</div>
<br>
<br>
<br>

</body>
<script type="text/javascript">
  $(function() {
     $( "#search" ).autocomplete({
       source: 'search-books-script.php',
     });
  });
</script>
</html>