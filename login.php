<?php
  require 'connection.php';
  $Erremail=$Errpass=$loginFail='';  
  $email=$password='';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $email = $_POST['email'];
      $password = $_POST['password'];
      $haspass = md5($password);

      if (empty($email)) {
        $Erremail = "Email is Require";
      }
      if (empty($password)) {
        $Errpass = "Password is Require";
      }

      if ($Erremail == '' && $Errpass == '') {
          
          $sql = "SELECT id,email, password from user WHERE email = '$email' AND password = '$haspass'";
          $result = $conn->query($sql);
      
          

          if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    session_start();
                    $_SESSION['Id'] = $row['id'];
                    $_SESSION['Email'] = $row['email'];
                    header('location:product_list.php');
          }
          else{
           $loginFail = "incorrect email or password"; 
          }
      }

  }

?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
  <section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <h3 class="mb-5">Sign in</h3>
            <p style="color: #d44950;"><?= isset($loginFail) ? $loginFail : '' ?> </p>
            <form method="post" action="<?= $_SERVER["PHP_SELF"] ?>">
              
              <div class="form-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Enter email" value="<?= $email ?>">
                <span style="color: #d44950;"><?= !empty($Erremail) ? $Erremail:''; ?></span>
              </div>
              <div class="form-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span style="color: #d44950;"><?= !empty($Errpass) ? $Errpass:''; ?></span>
              </div>
            
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <hr class="my-4">
            <a href="register.php" class="btn btn-lg btn-block btn-success">Register</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>    
</body>
</html>