
<?php
session_start();

include "conn.php";



$id = $_SESSION['employee'];
$sql1 = "SELECT * FROM accounts Where id = $id ";
$result1 = mysqli_query($conn, $sql1);
$account = mysqli_fetch_array($result1);
$school_id = $account["School_id"];

$sql2 = "SELECT * FROM scholen Where id = $school_id ";
$result2 = mysqli_query($conn, $sql2);
$school = mysqli_fetch_array($result2);
$school_afk = $school["Afkorting_sch"];


$sql3 = "UPDATE vacante_uren
        SET draft=1
        WHERE School='$school_afk' ";


mysqli_query($conn, $sql3);

$year=date('Y');
$submitted=1;

$stmt = $conn->prepare("INSERT INTO uploads (Account_id, Year, Submitted) VALUES (?, ?, ?)");
$stmt->bind_param("ddd", $id, $year, $submitted);
$stmt->execute(); 


header("Location: employee/vacante_uren.php");


?>