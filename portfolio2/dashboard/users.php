<?php
require "conn.php";
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

</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center">
            <h2>USER MANAGEMENT</h2>
            <a href="" class="btn btn-primary">+ Add User</a>
            <div class="modal fade" id="edit<?= $row['id'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a href="" class="btn btn-close" data-bs-dismiss="modal"></a>
                        </div>
                        <div class="modal-body">
                            <form action="" class="shadow-p-4" method="post">
                                <input type="text" name="full name" class="form-control" placeholder="full name">
                                 <input type="text" name="email" class="form-control" placeholder="full name">
                                  <select name="role" class="form-select">
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Volunteer">Volunteer</option>
                                  </select>
                                  <select name="status" class="form-select">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                  </select>
                                  <input type="submit" name="save">
                            </form>
                             </div>
                        </div>
                    </div>
                </div>
            </div>


                            <div class="row d-flex justify-content-center">

                                <div class="col-md-3">
                                    <div class="card shadow-sm p-3">
                                        <h6>Total Users</h6>
                                        <h4>
                                            <?= $user ?>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card shadow-sm p-3">
                                        <h6>Total Projects</h6>
                                        <p>18</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card shadow-sm p-3">
                                        <h6>Skills</h6>
                                        <p>18</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card shadow-sm p-3">
                                        <h6>Contacts</h6>
                                        <p>18</p>
                                    </div>
                                </div>


                            </div>
                    </div>
                    <script src="../assets/script.js"></script>
</body>

</html>