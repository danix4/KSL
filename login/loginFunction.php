<?php

session_start();

if (isset($_POST["Email"]) && isset($_POST["Password"])) {
    include "../conn.php";
    $Email = $_POST["Email"];
    $Password = $_POST["Password"];

    $sql = "SELECT * FROM accounts WHERE Email=? AND Pass=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $Email, $Password);
    $stmt->execute();
    $result=$stmt->get_result();
    $data=$result->fetch_assoc();
    $role=$data['Role'];
    $_SESSION['School_id']=$data['School_id'];
    
    if ($result->num_rows>0 && $role == 'admin') {
        $_SESSION["admin"] = $Email;
        header("Location: ../admin/admin.php");
    } 
    elseif ($result->num_rows>0 && $role == 'principal') {
        $_SESSION["principal"] = $data['id'];
        header("Location: ../principal/principal.php");
    }
    elseif ($result->num_rows>0 && $role == 'employee') {
        $_SESSION["employee"] = $data['id'];
        header("Location: ../employee/employee.php");
    }
    else {
        header("Location: login.php?error=credentials");
    } 
} 
?>
