
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
    $new_Role = $Account["Role"];
    $new_Pass = RandomString();

    $query = "SELECT id FROM scholen Where Benaming = '".$Account["School"]."' ";
    $result = mysqli_query($conn, $query);
    $school = mysqli_fetch_array($result);
    $school_id = $school["id"];

    $stmt = $conn->prepare("INSERT INTO KSLeuven.accounts (First_name, Last_name, Email, Pass, Role, School_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssd", $new_First, $new_Last, $new_Email, $new_Pass, $new_Role, $school_id);
    $stmt->execute(); 

}

    header("Location: UI.php");

?>