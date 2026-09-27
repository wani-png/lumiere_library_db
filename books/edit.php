<?php include '../db.php';
// edit.php — UPDATE (the "U" in CRUD)
// Loads one student's current details into a form, then saves the changes.

// $_GET is a built-in PHP array that holds values coming from the URL.
// The list page links here as  edit.php?id=3 , so here $_GET['id'] would be 3.
$id = $_GET['id'];

// Fetch just that one student. "WHERE id=$id" limits the result to the matching row.
$result = $conn->query("SELECT * FROM books WHERE id=$id");

// fetch_assoc() reads the single row we found into $row (values read by column name).
$row = $result->fetch_assoc();
?>
<h2>Edit Books</h2>

<!--
  The same kind of form as add.php, but each field is PRE-FILLED using
  value="<?php // echo $row['...']; ?>"  so the user sees the current data
  and can change it. <?php // echo ... ?> prints a PHP value into the HTML.
-->
<form method="post">
  Book Title: <input type="text" name="book_title" value="<?php echo $row['book_title']; ?>"><br>
  Book Author: <input type="book_author" name="book_author" value="<?php echo $row['book_author']; ?>"><br>
  Genre: <input type="text" name="genre" value="<?php echo $row['genre']; ?>"><br>
  Publication Date: <input type="date" name="publication_date" value="<?php echo $row['publication_date']; ?>"><br>
  Category ID: <input type="number" name="category_id" value="<?php echo $row['category_id']; ?>"><br>
  Cover Image: <input type="text" name="cover_image" value="<?php echo $row['cover_image']; ?>"><br>
  Description: <input type="text" name="description" value="<?php echo $row['description']; ?>"><br>
  <input type="submit" name="update" value="Update">
</form>

<?php
// IF the Update button was clicked (its name is "update")...
if(isset($_POST['update'])){
  // ...read the new values the user typed.
  $book_title   = $_POST['book_title'];
  $book_author  = $_POST['book_author'];
  $genre = $_POST['genre'];
  $publication_date = $_POST['publication_date'];
  $category_id = $_POST['category_id'];
  $cover_image = $_POST['cover_image'];
  $description = $_POST['description'];

  // UPDATE ... SET ... WHERE id=$id  changes the existing row — only the one with this id.
  // WARNING: without the WHERE, it would overwrite EVERY student, so the WHERE matters a lot!
  $conn->query("UPDATE books SET book_title='$book_title', book_author='$book_author', genre='$genre', publication_date='$publication_date', category_id='$category_id', cover_image='$cover_image', description='$description' WHERE id=$id");

  // Redirect back to the list to see the updated student.
  header("Location: index.php");
}
?>