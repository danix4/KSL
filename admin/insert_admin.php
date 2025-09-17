
<?php

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
    $new_Role = "Admin";
    $new_Pass = RandomString();

    $stmt = $conn->prepare("INSERT INTO KSLeuven.accounts (First_name, Last_name, Email, Pass, Role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $new_First, $new_Last, $new_Email, $new_Pass, $new_Role);
    $stmt->execute(); 

}

    header("Location: add_admin.php");

?>