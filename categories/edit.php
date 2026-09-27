<?php include '../db.php';
// edit.php — UPDATE (the "U" in CRUD)
// Loads one student's current details into a form, then saves the changes.

// $_GET is a built-in PHP array that holds values coming from the URL.
// The list page links here as  edit.php?id=3 , so here $_GET['id'] would be 3.
$category_id = $_GET['category_id'];

// Fetch just that one student. "WHERE id=$id" limits the result to the matching row.
$result = $conn->query("SELECT * FROM categories WHERE category_id=$category_id");

// fetch_assoc() reads the single row we found into $row (values read by column name).
$row = $result->fetch_assoc();
?>
<h2>Edit Categories</h2>

<!--
  The same kind of form as add.php, but each field is PRE-FILLED using
  value="<?php // echo $row['...']; ?>"  so the user sees the current data
  and can change it. <?php // echo ... ?> prints a PHP value into the HTML.
-->
<form method="post">
  Category ID: <input type="number" name="category_id" value="<?php echo $row['category_name']; ?>"><br>
  Category Name: <input type="text" name="category_name" value="<?php echo $row['category_name']; ?>"><br>

  <input type="submit" name="update" value="Update">
</form>

<?php
// IF the Update button was clicked (its name is "update")...
if(isset($_POST['update'])){
  // ...read the new values the user typed.
  $category_id   = $_POST['category_id'];
  $category_name   = $_POST['category_name'];


  // UPDATE ... SET ... WHERE id=$id  changes the existing row — only the one with this id.
  // WARNING: without the WHERE, it would overwrite EVERY student, so the WHERE matters a lot!
  $conn->query("UPDATE categories SET category_id='$category_id', category_name='$category_name' WHERE category_id=$category_id");

  // Redirect back to the list to see the updated student.
  header("Location: index.php");
}
?>