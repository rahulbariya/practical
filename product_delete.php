<?php
    require 'connection.php';
    require 'session.php';

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
  }

$sql = "DELETE FROM product WHERE id=$id";

if (mysqli_query($conn, $sql)) {
  echo "Record deleted successfully";
  header('location:product_list.php');
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);

?>