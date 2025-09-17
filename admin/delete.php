
<?php

include "../conn.php";


$id=$_GET["id"];

$sql1 = "SELECT School_id FROM KSLeuven.accounts WHERE id=" .$id. "";
$result = mysqli_query($conn, $sql1);
$school = mysqli_fetch_array($result);
$school_id = $school["School_id"];


$sql = "DELETE FROM KSLeuven.accounts WHERE id=" . $id . "";
mysqli_query($conn, $sql);



header("Location: staff.php?School_id=$school_id");


?>