<?php 
	require 'connection.php';
	require 'session.php';
	$sql = "SELECT * FROM product ORDER BY ID DESC";
	$product = $conn->query($sql);
	$row = $product->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<title>List | Product</title>
</head>
<body>
	<h1 style="text-align: center;">Welcome you Are Login</h1>
	<section class="vh-100">
		  <div class="container">
		    <div class="row d-flex justify-content-left align-items-left">
		      <div class="col-12 col-md-10 col-lg-10 col-xl-10">
		          <div class="card-body p-5" >
		            <h3 class="mb-4" style=" float:left;">Product List</h3>
		            <a href="product_add.php" class="btn btn-primary" style=" float: right;">Add Product</a>
		            <table class="table table-striped">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Product Image</th>
					      <th scope="col">Product Name</th>
					      <th scope="col">Price</th>
					      <th scope="col">description</th>
					      <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php if ($product->num_rows > 0){ $i=1;
            			while ($row = $product->fetch_assoc()){  ?>
					    <tr>
					      <td><?= $i ?></td>
					      <td><input type="image" src="<?=$row['image']?>" width="30" height="30"></td>
					      <td><?= $row['name'] ?></td>
					      <td><?= $row['price'] ?></td>
					      <td><?= $row['description'] ?></td>
					      <td>
					      		<a href="product_edit.php?id=<?= $row['id'] ?>" class="btn btn-success">Edit</a>
					      		<a href="product_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
					      </td>
					    </tr>
					<?php  $i++;  }}
					?>
					  </tbody>
					</table>
		             <a href="logout.php" class="btn btn-danger">Logout</a>
		          </div>
		      </div>
		    </div>
		  </div>
	</section> 
</body>
</html>