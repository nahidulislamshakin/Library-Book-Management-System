<?php
require_once("configAL.php");
if(!isset($_SESSION['username']))
{
	header("location:index.php");
}
$data = mysqli_fetch_array(mysqli_query($al,"SELECT * FROM users WHERE username = '".$_SESSION['username']."'"));
if(!empty($_POST))
{
	$book_name = ucwords($_POST['book_name']);
	$book_category = $_POST['book_category'];
	$author_name = ucwords($_POST['author_name']);
	$publisher_name = ucwords($_POST['publisher_name']);
	$book_price = $_POST['book_price'];
	$book_id = uniqid();
	//Insert with File
		$fileName = $_FILES['book_cover']['name'];
		$fileNameCmps = explode(".", $fileName);
		$fileExtension = strtolower(end($fileNameCmps));
		$allowedfileExtensions = array('jpg','JPG','jpeg','JPEG','webp','WEBP','gif','GIF','png','PNG');
		if (in_array($fileExtension, $allowedfileExtensions)) 
		{
			$veganFileName = $book_id.".".$fileExtension;
			$fs = move_uploaded_file($_FILES['book_cover']['tmp_name'],"covers/".$veganFileName);
			if($fs)
			{
				$sql = mysqli_query($al, "INSERT INTO books(book_id,book_name,book_category,author_name,publisher_name,book_price,cover_image) VALUES('$book_id','$book_name','$book_category','$author_name','$publisher_name','$book_price','$veganFileName')");
				if($sql)
				{
					$msg = "Successfully saved";
				}
				else
				{
					$msg = "Error saving book information";
				}
			}
			else
			{
				$msg = "Cover image file error";
			}
		}
		else
		{
			$msg = "Invalid file uploaded";
		}
}
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
    <li><a href="#">
      <?php if($data['gender'] == "Male") {echo "&#x1F468;";}else{echo "&#x1F469;";}echo " ".$data['name'];?>
      </a></li>
    <li><a href="#view">View/Delete Books</a></li>
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
  <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <table border="0" cellpadding="5" cellspacing="5">
      <tr>
        <td colspan="2" class="sub-head">Manage Books</td>
      </tr>
      <tr>
        <td colspan="2" class="error-msg"><?php if(isset($msg)) { echo $msg; }?></td>
      </tr>
      <tr>
        <td class="form-lables">Book Name:</td>
        <td><input type="text" required placeholder="Enter Book Name" name="book_name" size="30" class="cap" /></td>
      </tr>
      <tr>
        <td class="form-lables">Book Category:</td>
        <td><select name="book_category" required>
            <option value="NA" disabled selected>- - Select Category - -</option>
            <option value="Arts and Music">Arts and Music</option>
            <option value="Biographies">Biographies</option>
            <option value="Business">Business</option>
            <option value="Comics">Comics</option>
            <option value="Computer and Technology">Computer and Technology</option>
            <option value="Cooking">Cooking</option>
            <option value="Education">Education</option>
            <option value="Entertainment">Entertainment</option>
            <option value="Health and Fitness">Health and Fitness</option>
            <option value="History">History</option>
            <option value="Crafts">Crafts</option>
            <option value="Home and Garden">Home and Garden</option>
            <option value="Kids">Kids</option>
            <option value="Literature">Literature</option>
            <option value="Medical">Medical</option>
            <option value="Mysteries">Mysteries</option>
            <option value="Religion">Religion</option>
            <option value="Science and Maths">Science and Maths</option>
            <option value="Social Sciences">Social Sciences</option>
            <option value="Sports">Sports</option>
            <option value="Travel">Travel</option>
          </select></td>
      </tr>
      <tr>
        <td class="form-lables">Author Name:</td>
        <td><input type="text" required placeholder="Enter Author Name" name="author_name" size="30" class="cap" /></td>
      </tr>
      <tr>
        <td class="form-lables">Publisher Name:</td>
        <td><input type="text" required placeholder="Enter Publisher Name" name="publisher_name" size="30" class="cap" /></td>
      </tr>
      <tr>
        <td class="form-lables">Price:</td>
        <td><input type="number" required placeholder="Enter Book Price" name="book_price" size="20" class="cap" title="Invalid Amount" /></td>
      </tr>
      <tr>
        <td class="form-lables">Cover Picture:</td>
        <td><input type="file" name="book_cover" required style="font-size:15px;" accept="image/png, image/jpeg, image/webp, image/gif" /></td>
      <tr>
        <td colspan="2"><input type="submit" value="Add Book" onClick="return confirm('Are you sure?');"></td>
      </tr>
    </table>
  </form>
</div>
<br>
<br>
<br>
<br>
<a name="view"></a>
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
      <th>Delete</th>
    </tr>
    <?php 
	$f_query = mysqli_query($al, "SELECT * FROM books ORDER BY id DESC");
	$sr = 1;
	while($pr = mysqli_fetch_array($f_query))
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
      <td align="center"><a href="delete-book.php?book_id=<?php echo $pr['book_id'];?>" onClick="return confirm('Confirm delete?');"><img src="images/delete.png" height="35" width="35"></a></td>
    </tr>
    <?php } ?>
  </table>
</div>
<br>
<br>
<br>
</body>
</html>