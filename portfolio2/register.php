<?php

require "dashboard/header.php";
$msg = "";
 
if (isset($_POST['register'])){
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $confirm_pwd = mysqli_real_escape_string($conn, $_POST['confirm_pwd']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    if (strlen($name) <= 20) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            if (strlen($pwd) <= 20) {
                if ($pwd == $confirm_pwd)
                    if (strlen($phone) <= 11) {

    // HASH PASSWORD
    $hash = password_hash($pwd, PASSWORD_DEFAULT);

    // INSERT INTO TABLE REGISTER
    $register = "INSERT INTO register  (username, email, pwd, phone)VALUES ('$name', '$email', '$hash', '$phone')";

    $register_exec = mysqli_query($conn, $register).mysqli_error($conn);

    // VALIDATE OR CONFIRM THE SQL
    if (!$register_exec){
      $msg = '<div class="alert alert_danger">registration not successful</div>';   
    }
                }else{
                    $msg = '<div class="alert alert_danger">phone should be 11 digits</div>'; 
                }
            }else{
                $msg = '<div class="alert alert_danger">password doensn\'t match</div>'; 
            }
        }else{
            $msg = '<div class="alert alert_danger">password equal 20 or less character</div>'; 
        }
    }else{
        $msg = '<div class="alert alert_danger">invalid email</div>'; 
    }
    
}else{
    $msg = '<div class="alert alert_danger">name equal 20 or less character</div>'; 
}
?>

<body>
     <!-- CONTACT SECTION -->
<div class="container-fluid py-5 bg-dark text-white" id="contacts">
  <!-- Section Header -->
  <div class="text-center mb-5">
    <h3 class="fw-bold mb-2">
      Register <span class="text-primary">::</span>
    </h3>
    <div class="mx-auto" style="width: 90px; height: 3px; background-color: #0d6efd;"></div>
  </div>

  <!-- Contact Content -->
  <div class="row justify-content-around align-items-start px-md-5">
    <!-- Right Column: Contact Form -->
    <div class="col-md-5">
      <form class="p-4 bg-light text-dark rounded-4 shadow-lg" method="post">
        <div class="mb-3">
            
          <label for="text" class="form-label fw-bold text-primary">Username</label>
          <input type="text" name="username" class="form-control form-control-sm rounded-3" placeholder="Enter username">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label fw-bold text-primary">Email</label>
          <input type="email" name="email" class="form-control form-control-sm rounded-3" placeholder="Enter email">
        </div>
         <div class="mb-3">
          <label for="password" class="form-label fw-bold text-primary">password</label>
          <input type="password" name="pwd" class="form-control form-control-sm rounded-3" placeholder="Enter password">
        </div>
         <div class="mb-3">
          <label for="confirm password" class="form-label fw-bold text-primary">confirm password</label>
          <input type="password" name="confirm_pwd" class="form-control form-control-sm rounded-3" placeholder="confirm your password ">
        </div>
         <div class="mb-3">
          <label for="phone" class="form-label fw-bold text-primary">phone</label>
          <input type="phone" name="phone" class="form-control form-control-sm rounded-3" placeholder="Enter phone">
        </div>

        <div class="text-center">
          <button name="register" class="btn btn-primary fw-bold rounded-3 px-4 py-2">register</button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>