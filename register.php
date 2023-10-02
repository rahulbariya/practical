<?php
  
  require 'connection.php';

  $Errfname=$Errlname=$Erremail=$Errpass=$Errcpass='';	
  $firstname=$lastname=$email=$password=$cpassword='';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

  		$firstname = $_POST['firstname'];
  		$lastname = $_POST['lastname'];
  		$email = $_POST['email'];
  		$password = $_POST['password'];
  		$cpassword = $_POST['cpassword'];



  		if (empty($firstname)) {
  			$Errfname = "Firstname is Require";
  		}
  		if (empty($lastname)) {
  			$Errlname = "Lastname is Require";
  		}
  		if (empty($email)) {
  			$Erremail = "Email is Require";
  		}
  		if (empty($password)) {
  			$Errpass = "Password is Require";
  		}
  		if (empty($cpassword)) {
  			$Errcpass = "Confirm password is Require";
  		}
  		if ($password !== $cpassword) {
  			$Errcpass = "Confirm password does not match with Password";
  		}

  		$haspass = md5($password);

  		if ($Errfname == '' && $Errlname == '' && $Erremail == '' && $Errpass == '' && $Errcpass == '') {

	        $sql = "INSERT INTO user VALUES (null,'$firstname','$lastname','$email','$haspass')";
	        $result = $conn->query($sql);

	        if ($result == true){
	            header('location:login.php?q=true');
	        }
    	}

  }

?>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
  <section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Register</h3>

            <form method="post" action="<?= $_SERVER["PHP_SELF"] ?>">

              <div class="form-group mb-3">
                <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="<?= $firstname ?>">
                <span style="color: #d44950;"><?= !empty($Errfname) ? $Errfname:''; ?></span>
              </div>
              <div class="form-group mb-3">
                <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="<?= $lastname ?>">
                <span style="color: #d44950;"><?= !empty($Errlname) ? $Errlname:''; ?></span>
              </div>
              <div class="form-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Enter email" value="<?= $email ?>">
                <span style="color: #d44950;"><?= !empty($Erremail) ? $Erremail:''; ?></span>
              </div>
              <div class="form-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" value="<?= $password ?>">
                <span style="color: #d44950;"><?= !empty($Errpass) ? $Errpass:''; ?></span>
              </div>
              <div class="form-group mb-3">
                <input type="password" class="form-control" name="cpassword" placeholder="confirm Password">
                <span style="color: #d44950;"><?= !empty($Errcpass) ? $Errcpass:''; ?></span>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <hr class="my-4">
            <a href="login.php" class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;"/>Login</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>    
</body>
</html>