
<?php

include "../conn.php";

$Accounts = $_POST["Accounts"];

foreach($Accounts as $Account){

    $new_First = $Account["First_name"];
    $new_Last = $Account["Last_name"];
    $new_Email = $Account["Email"];
    $new_Role = "Employee";

    $stmt = $conn->prepare("INSERT INTO KSLeuven.accounts (First_name, Last_name, Email, Role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $new_First, $new_Last, $new_Email, $new_Role);
    $stmt->execute(); 

}

    header("Location: principal.php");

?>