

<?php

include "../conn.php";

$id=$_GET["id"];
$new_f_name=$_GET["f_name"];
$new_l_name=$_GET["l_name"];
$new_email=$_GET["email"];

$sql = "UPDATE accounts
        SET Email='$new_email', First_name='$new_f_name', Last_name='$new_l_name'
        WHERE id=$id ";



mysqli_query($conn, $sql);

header("Location: admins.php");


?>