<?php
require "header.php";
$message = "";

session_start();

if (!isset($_SESSION['id'])){
  header("location: ../login.php");
}

// EDIT
if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $confirm_pwd = mysqli_real_escape_string($conn, $_POST['confirm_pwd']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

  


    $hash = password_hash($pwd, PASSWORD_DEFAULT);
  $sql_update = "UPDATE register SET username = '$username', username = '$username', pwd = '$hash', email = '$email', phone = '$phone' WHERE id = '$id' ";

  $sql_update_exec = mysqli_query($conn, $sql_update);

  if ($sql_update_exec) {
    $message =  '<div class="alert alert-danger">updated</div>'; 
  }
  else {
    $message =  '<div class="alert alert-danger"> Not updated</div>'; 
  }
}


///delete
if(isset($_POST['delete_id'])){
    $id = intval($_POST['delete_id']);

    $sql_delete = "DELETE FROM register WHERE id = '$id' ";
    $sql_delete_exec = mysqli_query($conn, $sql_delete);

    if ($sql_delete_exec) {
        $message =  '<div class="alert alert-danger">deleted</div>'; 
    } else {
        $message =  '<div class="alert alert-danger">not deleted</div>'; 
    }
    
}



// select from  register table
$user = "SELECT * FROM register";
$user_exec = mysqli_query($conn, $user);

$count = "SELECT
(SELECT count(*) FROM register) AS users
-- (SELECT count(*) FROM projects) AS projects
-- (SELECT count(*) FROM skills) AS skills
-- (SELECT count(*) FROM contacts) AS contacts
";
$count_exec = mysqli_query($conn, $count);
$row = mysqli_fetch_assoc($count_exec);

$user = $row['users'];
// $project = $row['projects'];
// $skills = $row['skills'];
// $contacts = $row['contacts'];


 $select = "SELECT * FROM contact";
$contact_exec = mysqli_query($conn, $select);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex">
            <?php require "../dashboard/sidenav.php"; ?>
            <div class="col-md-10">
                <div class="row mt-5">
                    <div class="col-md-6">
                        <h1>CHEZ-2 Dashboard</h1>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control w-25" placeholder="search....">
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm p-3">
                            <h6>Total Users</h6>
                            <h4>
                                <?= $user ?>
                            </h4>
                        </div>
                    </div>
              
                </div>

                <!-- TABLE -->
                <div class="container py-4">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-12">
                            <h1 class="fs-3 fw-bold text-primary">ADMIN</h1>
                            <div class="p-3 shadow-sm">
                                <table class="tabl-success table-stripped table-responsive w-100">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">USERNAME</th>
                                            <th scope="col">EMAIL</th>
                                            <th scope="col">PASSWORD</th>
                                            <th scope="col">PHONE</th>
                                            <th scope="col">Date_created</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

          while ($row = mysqli_fetch_assoc($user_exec)) {
           $row['id'];
          
?>
<tr>
<th scope="row">
<?= $row['id'] ?>
</th>
<td>
<?= $row['username']?>
</td>
<td>
<?= $row['email']?>
</td>
<td> ********* </td>
<td>
<?= $row['phone']?>
</td>
<td>
<?= $row['date_created']?>
</td>
<td>
<a href="" class="btn btn-warning" data-bs-toggle="modal"
    data-bs-target="#edit<?= $row['id'] ?>">Edit</a>
<form method="POST" style="display:inline;">
    <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
    <button type="submit" name="delete"
        class="btn btn-danger">Delete</button>
</form>

<div class="modal fade" id="edit<?= $row['id'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="" class="btn btn-close"
                    data-bs-dismiss="modal"></a>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="shadow p-4">
                    <div>
                        <?= $message ?>
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" name="id"
                            value="<?= $row['id'] ?>">
                    </div>
                    <div
                        class="row justify-content-around align-items-center m-3">
                        <div class="col-md-6">
                            <label for="" class="fw-bold">name</label>
                            <input type="text" name="username"
                                class="form-control"
                                placeholder="username"
                                value="<?= $row['username'] ?>"
                                required>
                        </div>
                    </div>
                    <div
                        class="row justify-content-around align-items-center m-3">
                        <div class="col-md-12">
                            <label for=""
                                class="fw-bold">password</label>
                            <input type="password" name="pwd"
                                class="form-control"
                                placeholder="password"
                                value="<?= $row['pwd'] ?>" required>
                        </div>
                    </div>
                    <div
                        class="row justify-content-around align-items-center m-3">
                        <div class="col-md-12">
                            <label for="" class="fw-bold">confirm
                                password</label>
                            <input type="password" name="confirm_pwd"
                                class="form-control" required>
                        </div>
                    </div>
                    <div
                        class="row justify-content-around align-items-center m-3">
                        <div class="col-md-6">
                            <label for="" class="fw-bold">email</label>
                            <input type="text" name="email"
                                class="form-control" placeholder="email"
                                value="<?= $row['email'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="fw-bold">phone
                                number</label>
                            <input type="text" name="phone"
                                class="form-control"
                                placeholder="phone number"
                                value="<?= $row['phone'] ?>" required>
                        </div>
                        <div
                            class="row justify-content-around align-items-center m-3">
                            <div class="col-md-12">
                                <input type="submit" value="submit"
                                    name="submit"
                                    class="form-control btn btn-success">
                            </div>
                        </div>
                </form>
</td>
</tr>
<?php }?>
</tbody>
</table>

<br>
 <h1 class="fs-3 fw-bold text-primary">CONTACTS</h1>
<div class="p-3 shadow-sm">
<table class="

">
                <thead style="background-color: rgb(148, 175, 148);">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">MESSAGE</th>
                        <th scope="col">Date_created</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
<?php

while ($row = mysqli_fetch_assoc($contact_exec)) {
$row['id'];

?>
<tr>
    <th scope="row">
        <?= $row['id'] ?>
    </th>
    <td>
        <?= $row['name']?>
    </td>
    <td>
        <?= $row['email']?>
    </td>
     <td>
        <?= $row['message']?>
    </td>
    <td>
        <?= $row['date_created']?>
    </td>
    <td>
<form method="POST" style="display:inline;">
    <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
</form>

</td>
</tr>
<?php }?>
</tbody>
</table
                            </div>

                        </div>
                    </div>
                </div>
            </div>




        </div>


    </div>




    <script src="../assets/script.js"></script>
</body>

</html>