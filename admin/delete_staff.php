
<?php

include "../conn.php";


$id=82;
$sid=$_GET["sid"];

$sql = "DELETE FROM KSLeuven.accounts WHERE id=" . $id . "";


mysqli_query($conn, $sql);
header("Location: staff.php?School_id=$sid");


?>