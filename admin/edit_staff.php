

<?php

include "../conn.php";


$id=$_GET["id"];
$new_email=$_GET["email"];
$new_school=$_GET["school"];

$sql = "UPDATE accounts
        SET Email = '" . $new_email . "', School_id = '" . $new_school . "'
        WHERE id = " . $id . "";

mysqli_query($conn, $sql);
header("Location: staff.php?School_id=$new_school");


?>