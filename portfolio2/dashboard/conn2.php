<?php
$conn = mysqli_connect("localhost", "root", "", "portfolio");
if (!$conn) {
    echo "not connected".mysqli_error($conn);
}
?>