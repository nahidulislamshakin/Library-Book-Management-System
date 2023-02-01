<?php
require_once('configAL.php');
function search($al , $term){ 
 $query = "SELECT * FROM books WHERE book_name LIKE '%".$term."%' OR book_category LIKE '%".$term."%' OR author_name LIKE '%".$term."%' OR publisher_name LIKE '%".$term."%' ORDER BY book_name ASC";
 $result = mysqli_query($al, $query); 
 $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
 return $data; 
}
 
if (isset($_GET['term'])) {
 $getBook = search($al, $_GET['term']);
 $bookList = array();
 foreach($getBook as $book){
 $bookList[] = $book['book_name']." ".$book['author_name'];
 }
 if($bookList == NULL)
 { 
 		$a[] = "Sorry! This Book is Not Available";
	 echo json_encode($a);
 }
 else
 {
	 echo json_encode($bookList);
 }
}
?>