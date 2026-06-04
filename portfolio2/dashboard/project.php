<?php
require "conn2.php";
$message = "";


// create project
if (isset($_POST['add'])) {
//$id = mysqli_real_escape_string($conn,$_POST['id']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
// $image = mysqli_real_escape_string($conn, $_POST['image']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$image = time() . '_' . $_FILES['image']['name'];
$imgTem = $_FILES['image']['tmp_name'];
$imgFolder = __DIR__ . "/../image/" . $image;

if(move_uploaded_file($imgTem, $imgFolder)){
$message = "image uploaded successful".mysqli_error($conn);
}else{
$message = "image uploaded failed".mysqli_error($conn);
}


// INSERT INTO TABLE REGISTER
$register = "INSERT INTO project  (title, image, description) VALUES ('$title', '$image', '$description')";

$register_exec = mysqli_query($conn, $register).mysqli_error($conn);

// VALIDATE OR CONFIRM THE SQL
if (!$register_exec){
$msg = '<div class="alert alert_danger">registration not successful</div>';   
}

}


//Edit
if (isset($_POST['submit'])) {
$id = mysqli_real_escape_string($conn,$_POST['id']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
// $image = mysqli_real_escape_string($conn, $_POST['image']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$image = time() . '_' . $_FILES['image']['name'];
$imgTem = $_FILES['image']['tmp_name'];
$imgFolder = __DIR__ . "/../image/" . $image;

if(move_uploaded_file($imgTem, $imgFolder)){
$message = "image uploaded successful".mysqli_error($conn);
}else{
$message = "image uploaded failed".mysqli_error($conn);
}


$sql_update = "UPDATE project SET title = '$title', image = '$image', description = '$description' WHERE id = '$id' ";

$sql_update_exec = mysqli_query($conn, $sql_update);

if ($sql_update_exec) {
$message =  '<div class="alert alert-danger">updated</div>'; 
}
else {
$message =  '<div class="alert alert-danger"> Not updated</div>'; 
}
}

//   $sql_update = "UPDATE project SET title = '$title', image = '$image', description = '$description', WHERE id = '$id' ";

//   $sql_update_exec = mysqli_query($conn, $sql_update);

//   if ($sql_update_exec) {
//     $message =  '<div class="alert alert-danger">updated</div>'; 
//   }
//   else {
//     $message =  '<div class="alert alert-danger"> Not updated</div>'; 
//   }



///delete
if(isset($_POST['delete_id'])){
$id = intval($_POST['delete_id']);

$sql_delete = "DELETE FROM project WHERE id = '$id' ";
$sql_delete_exec = mysqli_query($conn, $sql_delete);

if ($sql_delete_exec) {
$message =  '<div class="alert alert-danger">deleted</div>'; 
} else {
$message =  '<div class="alert alert-danger">not deleted</div>'; 
}

}



// select from  register table
$user = "SELECT * FROM project";
$user_exec = mysqli_query($conn, $user);



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

<!-- TABLE -->
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-12">
            <h1 class="fs-3 fw-bold text-primary">ADMIN</h1>
            <div class="d-flex justify-content-end">
                <a href="" class="btn btn-success justify-content-end" data-bs-toggle="modal"
                    data-bs-target="#adduser">+ Add Project</a>
                <div class="modal fade" id="adduser">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header fw-bold fs-4">Add New Project
                                <a href="" class="btn btn-close" data-bs-dismiss="modal"></a>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="shadow p-4">

                                    <div class="row justify-content-around align-items-center m-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="" class="fw-bold">Title</label>
                                            <input type="text" name="title" class="form-control"
                                                placeholder="input title" required>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="" class="fw-bold">Image</label>
                                            <input type="file" name="image" class="form-control"
                                                placeholder="insert image">
                                        </div>
                                    </div>
                                    <div class="row justify-content-around align-items-center m-3">
                                        <div class="col-md-12">
                                            <label for="" class="fw-bold">Description</label>
                                             <textarea name="description" class="form-control"placeholder="Description" name="description"  value="<?= $row['description'] ?>" rows="3"></textarea>
                                        </div>
                                    </div>

                            </div>
                            <div class="row justify-content-around align-items-center m-3">
                                <div class="col-md-12">
                                    <input type="submit" name="add" class="form-control btn btn-primary">
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 shadow-sm">
            <table class="table-stripped table-responsive w-100">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">TITLE</th>
                        <th scope="col">IMAGE</th>
                        <th scope="col">DESCRIPTION</th>
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
        <?= $row['title']?>
    </td>
    <td>
        <?= $row['image']?>
    </td>
    <td>
        <?= $row['description']?>
    </td>
    <td>
        <?= $row['date_created']?>
    </td>
    <td>
<a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $row['id'] ?>">Edit</a>
<form method="POST" style="display:inline;">
    <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
</form>

<div class="modal fade" id="edit<?= $row['id'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header fw-bold fs-4">Edit project
                <a href="" class="btn btn-close" data-bs-dismiss="modal"></a>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" class="shadow p-4">

<div class="row justify-content-around align-items-center m-3">
    <div class="col-md-12 mb-3">
        <label for="" class="fw-bold">Title</label>
        <input type="text" value="<?= $row['title'] ?>"
            name="title" class="form-control"
            placeholder="input title" required>
    </div>
    <div class="col-md-12 mb-3">
        <label for="" class="fw-bold">Image</label>
        <input type="file" value="<?= $row['image'] ?>"
            name="image" class="form-control"
            placeholder="insert image">
    </div>
    <div class="col-md-12">
        <label for=""
            class="fw-bold">Description</label>
        <input type="text" name="description" class="form-control"
            placeholder="Description" name="description"  value="<?= $row['description'] ?>" rows="3"></input>
    </div>


</div>
<div class="row justify-content-around align-items-center m-3">
    <div class="col-md-12">
        <input type="submit" name="add" class="form-control btn btn-primary">
    </div>
</div>
</div>

</td>
</tr>
<?php }?>
</tbody>
</table>
</div>

</div>
</div>
</div>
</div>
</div>




    <script src="../assets/script.js"></script>
</body>

</html>