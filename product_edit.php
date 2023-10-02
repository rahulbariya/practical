<?php
  
  require 'connection.php';
  require 'session.php';
  
  $id = '';
  if (!empty($_GET['id'])) {
    $id = $_GET['id'];
  }

  $Errname=$Errprice=$Errimage=$Errdesc='';	
  $name=$price=$image=$desc='';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $id = $_POST['id'];
  		$name = $_POST['name'];
  		$price = $_POST['price'];
  		$desc = $_POST['desc'];
      if (isset($_FILES['image']['name'])) {
  		  $image = basename($_FILES['image']['name']);
      }

      //print_r($image); die();
  		if (empty($name)) {
  			$Errname = "Product Name is Require";
  		}
  		if (empty($price)) {
  			$Errprice = "Product Price is Require";
  		}
  		if (empty($desc)) {
  			$Errdesc = "Product Desc is Require";
  		}


  		if ($Errname == '' && $Errprice == '' && $Errimage == '' && $Errdesc == '') {

        if (isset($_FILES['image']['name'])) {
  			   move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$image);
        }
  			$imagePath = 'images/'.$image;
	      $sql = "
          UPDATE product 
          SET name='$name',price='$price',image = '$imagePath'
          WHERE id= $id ";

	        $result = $conn->query($sql);

	        if ($result == true){
	          return  header('location:product_list.php?q=true');
	        }
    	}

  }

  
  $sql = "SELECT * FROM product WHERE id = $id";
  $product = $conn->query($sql);
  $result = $product->fetch_object();

?>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit | Product</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
  <section class="vh-100">
  <div class="container">
    <div class="row d-flex justify-content-left align-items-left">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        
          <div class="card-body p-5 text-left">

            <h3 class="mb-4">Add Product</h3>

            <form method="post" action="<?= $_SERVER["PHP_SELF"] ?>" enctype="multipart/form-data">

              <div class="form-group mb-3">
              	<label class="mb-2">Product Name</label>
                <input type="text" class="form-control" name="name" placeholder="Product Name" value="<?= $result->name ?>">
                <span style="color: #d44950;"><?= !empty($Errname) ? $Errname:''; ?></span>
              </div>
              <div class="form-group mb-3">
              	<label class="mb-2">Product Price</label>
                <input type="text" class="form-control" name="price" placeholder="Product Price" value="<?= $result->price ?>">
                <span style="color: #d44950;"><?= !empty($Errprice) ? $Errprice:''; ?></span>
              </div>
              <div class="form-group mb-3">
			           <label class="form-label" for="customFile">Product Image</label>
                 <img src="<?= $result->image ?>" width="50" height="50">
				         <input type="file" class="form-control" name="<?= $result->image ?>" />
			       </div>
              <div class="form-group mb-3">
              	<label class="mb-2">Product Descrictopn</label>
                <textarea name="desc" class="form-control" rows="4" cols="50"><?= $result->desc ?></textarea>
                <span style="color: #d44950;"><?= !empty($Errdesc) ? $Errdesc:''; ?></span>
              </div>
              <input type="hidden" value="<?= $_GET['id'] ?>" name="id">
              
            <hr class="my-4">
              <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </form>
          </div>
        
      </div>
    </div>
  </div>
</section>    
</body>
</html>