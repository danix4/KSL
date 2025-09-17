<?php

session_start();

include "../conn.php";

$Accounts = $_POST["Accounts"];

foreach($Accounts as $Account){

    $new_Vak = $Account["Vak"];
    $new_Ambt = $Account["Ambt"];
    $new_Graad = $Account["Graad"];
    $new_Ond_vorm = $Account["Ond_vorm"];
    $new_uren_week = $Account["uren_week"];
    $new_School_id = $_SESSION['School_id'];
    $new_draft = 1;


    $query = "SELECT * FROM scholen Where id = $new_School_id ";
    $result = mysqli_query($conn, $query);
    $school = mysqli_fetch_array($result);
    $school_afkorting = $school["Afkorting_sch"];


    $stmt = $conn->prepare("INSERT INTO KSLeuven.vacante_uren (School, Ambt, Vak, Graad, ond_vorm, uren_week, draft) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdsdd", $school_afkorting, $new_Ambt, $new_Vak, $new_Graad, $new_Ond_vorm, $new_uren_week, $new_draft);
    $stmt->execute(); 

}

?>