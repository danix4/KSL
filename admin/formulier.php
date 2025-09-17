
<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location:../login/login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Formulier</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../css/principal.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/test.scss">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
  <body style="background-color:#3fa435">

    <div class="topnav">
    <a href="admin.php">Home</a>
    "<a  class = "link" onclick="window.location='staff.php'+ window.location.search ;">De School</a>"
    <a class="active" onclick="window.location='formulier.php'+ window.location.search ;">Formulier</a>

    <a class="logout" href="../login/logout.php">⠀<i class="fa fa-sign-out"></i>⠀Logout</a>
    </div>

<?php

if (isset($_GET["id"])) {
 
include "../conn.php";
$id=$_GET["id"];
$sql = "SELECT * FROM ACCOUNTS WHERE id=$id";
$result1 = mysqli_query($conn, $sql);
$b = mysqli_fetch_array($result1);
$email = $b[3];

}

?><br><br>

<h3 style="font-size:50px;color:white" align="center">Welkom in HHL! Vakante uren: </h3>

<section class="ftco-section">
    <div class="container">
	
      <table class="table">
      <thead style="background-color:rgba(34, 154, 214)">
      <tr>
      <th>Ambt:</th>
      <th>Vak:</th>
      <th>Graad:</th>
      <th>ond_vorm:</th>
      <th>uren_week:</th>
      </tr>
      </thead>
      <tbody>  <?php

include "../conn.php";


$new_School_id = $_GET['School_id'];


$query = "SELECT Afkorting_sch FROM scholen Where id = $new_School_id ";
$result = mysqli_query($conn, $query);
$school = mysqli_fetch_array($result);
$school_afkorting = $school["Afkorting_sch"];



$sql = "SELECT * FROM KSLeuven.vacante_uren WHERE School='$school_afkorting'";

$result1 = mysqli_query($conn, $sql);


while ($r = mysqli_fetch_array($result1)){

echo "
<tr>";
echo "
<td>".$r[2]."</td>";
echo "
<td>".$r[3]."</td>";
echo "
<td>".$r[4]."</td>";
echo "
<td>".$r[5]."</td>";
echo "
<td>".$r[6]."</td>";
echo "

</tr>";

}

?></tbody>
</table>
</div>
</div>

</section>
