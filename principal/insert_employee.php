
<?php
session_start();
include "../conn.php";


$Accounts = $_POST["Accounts"];


function RandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];

        }
        return $randstring;
        echo $randstring;
    }


foreach($Accounts as $Account){

    $new_First = $Account["First_name"];
    $new_Last = $Account["Last_name"];
    $new_Email = $Account["Email"];
    $new_Role = "Employee";
    $new_Pass = RandomString();
    $new_School_id = $_SESSION['School_id'];

    $stmt = $conn->prepare("INSERT INTO KSLeuven.accounts (First_name, Last_name, Email, Pass, Role, School_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssd", $new_First, $new_Last, $new_Email, $new_Pass, $new_Role,$new_School_id);
    $stmt->execute(); 

}

    header("Location: add_employee.php");

?>