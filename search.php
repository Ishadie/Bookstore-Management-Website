<?php
  session_start();
  $count = 0;
  // connecto database

  $title = "Index";
  require_once "./template/header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  //$row = select4LatestBook($conn);
?>
<h2>
  Search results
</h2>
<div class = "manga-container">
  <?php
  if(isset($_POST['submit-search'])){
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT * FROM books WHERE book_title LIKE '%$search%' OR book_author LIKE '%$search%' ";
    $result = mysqli_query($conn,$sql);
    $queryResult = mysqli_num_rows($result);

    echo "There are ".$queryResult." results!";

    if($queryResult>0){
      while($row = mysqli_fetch_assoc($result)){
        echo "<a href = 'bookSearched.php?title=".$row['book_title']."&author=".$row['book_author']." '><div class='manga-box'>

        <h4>".$row['book_title']."</h4>
        <p>".$row['book_author']."<p>
        <p>".$row['book_price']."<p>

        </div></a>";
      }
    }else{
      echo "There are no results matching your search :(";
    }
  }
   ?>
</div>
