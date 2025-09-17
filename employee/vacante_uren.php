
<?php
session_start();
if (!isset($_SESSION["employee"])) {
    header("Location:../login/login.php");
}

$school_id = $_SESSION['School_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Principal</title>
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../css/UI.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/principal.css">
    <link rel="stylesheet" href="../css/test.scss">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
	  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
  <body style="background-color: #3fa435;">

  <div class="topnav">
    <a href="employee.php">Forms</a>
    <a class="active" href="vacante_uren.php">Mijn vacante uren</a>


    <a class="logout" href="../login/logout.php"><i class="fa fa-sign-out"></i>⠀Logout</a>
    </div><br><br>


<?php

include "../conn.php";

$id = $_SESSION['employee'];
$query = "SELECT First_name FROM accounts Where id = $id ";
$result = mysqli_query($conn, $query);
$account = mysqli_fetch_array($result);
$name = $account["First_name"];


?>

  <h3 style='font-size:50px;color:white' align='center'>Hier zijn jouw vakante uren:</h3>
  <section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
          <div class="table-wrap">
          <table class="table">
          <thead style="background-color:rgba(34, 154, 214)">
          <tr>
          <th>Ambt:</th>
          <th>Vak:</th>
          <th>Graad:</th>
          <th>ond_vorm:</th>
          <th>uren_week:</th>
          <th>⠀</th>
          </tr>
          </thead>
          <tbody>  <?php

include "../conn.php";

$sql1 = "SELECT * FROM KSLeuven.scholen WHERE id=$school_id";

$result1 = mysqli_query($conn, $sql1);

$r1 = mysqli_fetch_array($result1);

$school_akf=$r1[2];

$sql = "SELECT * FROM KSLeuven.vacante_uren WHERE School='$school_akf'";

$result = mysqli_query($conn, $sql);


while ($r = mysqli_fetch_array($result)){

   
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
      <td>
        <a  href=\"delete_vacante_uren.php?id=".$r[0]."\"><i class='delete-button fa fa-trash'></i></a>
      </td>";
      echo "
      </tr>";
}

          ?></tbody>
          </table>
        </div>
				</div>
			</div>
		</div>
	</section>

              <div align="center">
              <form method="post" action="../update_vacante.php">
              
              <?php

              include "../conn.php";
              $year=date('Y');
              $id = $_SESSION['employee'];    

                $result = mysqli_query($conn, "SELECT * FROM uploads Where Account_id=$id AND Submitted=1 AND Year=$year"); 

                if(!mysqli_num_rows($result)) {

                  echo ' <input id="send" style=" background-color:blue; color:white; font-size: 36px;" type="submit" name="submit" id="submit_button"  value="Stuur"/>';

                }


              ?>
              </form>
						</div><br><br><br>
        
  

 

    
  </body>
</html>