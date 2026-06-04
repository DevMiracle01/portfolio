<?php

require "./dashboard/header.php";
$msg = "";
session_start();

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (strlen($pwd) <= 20) {

    // SELECTING FROM THE TABLE REGISTER
    $login = "SELECT * FROM register WHERE email = '$email' ";
    $login_exec = mysqli_query($conn, $login);

    if (mysqli_num_rows($login_exec)  > 0) {
        $row = mysqli_fetch_Assoc($login_exec);

        if (password_verify($pwd, $row['pwd'])){
    
    // SESSION
    $_SESSION['id'] = $row['id'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['username'] = $row['username'];

    header("location: dashboard/dashboard.php");
        }
    }else{
       header("location: login.php"); 
    }
        }else{
            $msg = '<div class="alert alert_danger">invalid credentials</div>';
        }
          $msg = '<div class="alert alert_danger">invalid credentials</div>';  
    }
}

?>
 
 <body>
    <!-- CONTACT SECTION -->
<div class="container-fluid py-5 bg-dark text-white" id="contacts" style="height: 100vh;">
  <!-- Section Header -->
  <div class="text-center mb-5">
    <h3 class="fw-bold mb-2">
      login <span class="text-primary">::</span>
    </h3>
    <div class="mx-auto" style="width: 90px; height: 3px; background-color: #0d6efd;"></div>
  </div>

  <!-- Contact Content -->
  <div class="row justify-content-around align-items-start px-md-5">
    <!-- Right Column: Contact Form -->
    <div class="col-md-5">
      <form class="p-4 bg-light text-dark rounded-4 shadow-lg" method="post">
        <div class="mb-3">
          <label for="email" class="form-label fw-bold text-primary">email</label>
          <input type="email" name="email" class="form-control form-control-sm rounded-3" placeholder="Enter your email">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label fw-bold text-primary">password</label>
          <input type="password" name="pwd" class="form-control form-control-sm rounded-3" placeholder="Enter your password">
        </div>

        <div class="text-center">
          <button name="login" class="btn btn-primary fw-bold rounded-3 px-4 py-2">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>
 </body>