
<?php

include "../conn.php";


$id=$_GET["id"];


$sql2 = "DELETE FROM KSLeuven.vacante_uren WHERE id=" . $id . "";
mysqli_query($conn, $sql2);



header("Location: principal_formulier.php");


?>