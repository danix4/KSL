
<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location:../login/login.php");
}

$school_id = $_GET['School_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Principal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="../css/principal.css">
<link rel="stylesheet" href="../css/navbar.css">
<link rel="stylesheet" href="../css/test.scss">

</head>
  <body style="background-color:#3fa435">

  
  <div class="topnav">
  <a href="admin.php">Home</a>
  <a class="active" onclick="window.location='staff.php'+ window.location.search ;">De School</a>
  <a class="link" onclick="window.location='formulier.php'+ window.location.search ;" >Formulier</a>

  <a class="logout" href="../login/logout.php">Logout⠀<i class="fa fa-sign-out"></i></a>
</div><br><br>


<?php

include "../conn.php";

$query = "SELECT Benaming FROM scholen Where id = $school_id ";
$result = mysqli_query($conn, $query);
$school = mysqli_fetch_array($result);
$school_name = $school["Benaming"];

  echo "<h3 style='font-size:50px;color:white' align='center'>Welkom in $school_name</h3>";

?>
 

<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
          
        <input id="search" type="text" placeholder="Zoek op..." name="search">
          <button onclick="search_function()" type="submit"><i class="fa fa-search"></i></button>
          <button onclick="reset()" type="submit"><i class="fa fa-arrow-left"></i></button>
     

          <div class="table-wrap"><br>
          <table class="table">
          <thead style="background-color:rgba(34, 154, 214)">
          <tr>
          <th>Naam:</th>
          <th>Email</th>
          <th>Rol:</th>
          <th>⠀</th>
          <th>⠀</th>
          </tr>
          </thead>
          <tbody> <?php

include "../conn.php";



if(isset($_GET['name'])) {
  $name = $_GET['name'];
  $sql = "SELECT * FROM KSLeuven.accounts WHERE First_name LIKE '$name%' AND (Role='employee' OR Role='principal') AND School_id=$school_id ORDER BY Role='employee'"; 
} else {
  $sql = "SELECT * FROM KSLeuven.accounts WHERE (Role='employee' OR Role='principal') AND School_id=$school_id ORDER BY Role='employee'";
 } 



$result = mysqli_query($conn, $sql);

while ($r = mysqli_fetch_array($result)){

  echo "
  <tr>";
  echo "
    <td>".$r[1]." ".$r[2]."</td>";
  echo "
    <td>".$r[3]."</td>";
  echo "
    <td>".$r[5]."</td>";
  echo "
  <td>
  <a  href=\"delete.php?id=".$r[0]."\"><i class='delete-button fa fa-trash'></i></a>
</td>";
echo "
<td>
  <a onclick='openForm($r[0])'><i class='edit-button fa fa-pencil'></i></a>
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




  
<?php

if (isset($_GET["id"])) {
 
include "../conn.php";
$id=$_GET["id"];
$sql = "SELECT * FROM accounts WHERE id=$id";
$result1 = mysqli_query($conn, $sql);
$b = mysqli_fetch_array($result1);
$email = $b[3];
$school = $b[6]; 

}


?><br><br>

<div id="myForm">
<form action="edit_staff.php">
<h2>Edit:</h2><br>

<label><b>Id:</b></label>
<input name="id"  type="number" value="<?php echo $id; ?>" readonly>

<label><b>Email:</b></label>
<input name="email"  type="text" value="<?php echo isset($email) ? $email: '' ;?>"  placeholder="Kies een email" required>

<label><b>School:</b></label>
<input name="school" type="number" min="1" value="<?php echo isset($school) ? $school: '' ;?>" placeholder="Kies een school" required>

<button type="submit">Save</button>
<button type="button" onclick="closeForm()">Close</button>
</form>
</div>


<script>

let url = new URL(window.location);
let params = new URLSearchParams(url.search);
let sourceid = params.get('id');

if (!sourceid) {
document.getElementById("myForm").style.display = "none";
}

function openForm(id,school_id) {
document.getElementById("myForm").style.display = "block";

let searchParams = new URLSearchParams(window.location.search);
let param = searchParams.get('School_id');

window.location.href=(`staff.php?id=${id}&School_id=${param}`);   
}

function closeForm() {
document.getElementById("myForm").style.display = "none";

let searchParams = new URLSearchParams(window.location.search);
let param = searchParams.get('School_id');

window.location.href=(`staff.php?id=${id}&School_id=${param}`);   

}


function search_function() {

 let value = document.getElementById('search').value;

 window.location='staff.php'+ window.location.search + '&name=' + value ;
  
}


function removeParam(key, sourceURL) {
    var rtn = sourceURL.split("?")[0],
        param,
        params_arr = [],
        queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        if (params_arr.length) rtn = rtn + "?" + params_arr.join("&");
    }
    return rtn;
}



function reset() {

  var originalURL = window.location='staff.php'+ window.location.search;
  var alteredURL = removeParam("name", originalURL);
  window.location.href=alteredURL;
}


</script>


  </body>
</html>