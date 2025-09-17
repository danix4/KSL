
<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location:../login/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admins</title>
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
    <a href="admin.php">Scholen</a>
    <a class="active" href="admins.php">Admins</a>
    <a href="UI.php">Medewerkers Aanmaken</a>
    <a href="add_admin.php">Admins Aanmaken</a>

    <a class="logout" href="../login/logout.php">⠀<i class="fa fa-sign-out"></i>⠀Logout</a>
    </div>

<?php

if (isset($_GET["id"])) {
 
include "../conn.php";
$id=$_GET["id"];
$sql = "SELECT * FROM accounts WHERE id=$id";
$result1 = mysqli_query($conn, $sql);
$b = mysqli_fetch_array($result1);
$f_name = $b[1];
$l_name = $b[2];
$email = $b[3];

}
?><br><br>

<h3 style="font-size:50px;color:white" align="center">Hier zijn alle admins: </h3>

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
      <th>Voornaam:</th>
      <th>Achternaam:</th>
      <th>Email:</th>
      <th>⠀</th>
      <th>⠀</th>
      </tr>
      </thead>
      <tbody>  <?php

include "../conn.php";



if(isset($_GET['name'])) {
  $name = $_GET['name'];
  $sql = "SELECT * FROM KSLeuven.accounts WHERE First_name LIKE '$name%' AND Role='admin'"; 
} else {
  $sql = "SELECT * FROM KSLeuven.accounts WHERE Role='admin'";
 } 




$result = mysqli_query($conn, $sql);


while ($r = mysqli_fetch_array($result)){

echo "
<tr>";
echo "
<td>".$r[1]."</td>";
echo "
<td>".$r[2]."</td>";
echo "
<td>".$r[3]."</td>";
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


<div id="myForm">
<form action="edit_admin.php">
<h2>Bewerk:</h2><br>

<label><b>Id:</b></label>
<input name="id"  type="number" value="<?php echo $id; ?>" readonly>

<label><b>Voornaam:</b></label>
<input name="f_name"  type="text" value="<?php echo isset($f_name) ? $f_name: '' ;?>"  placeholder="Kies Voornaam" required>

<label><b>Achternaam:</b></label>
<input name="l_name"  type="text" value="<?php echo isset($l_name) ? $l_name: '' ;?>"  placeholder="Kies Achternaam" required>

<label><b>Email:</b></label>
<input name="email"  type="text" value="<?php echo isset($email) ? $email: '' ;?>"  placeholder="Kies Email" required>

<button type="submit">Opslaan</button>
<button type="button" onclick="closeForm()">Sluit</button>
</form>
</div><br><br>



<script>

let url = new URL(window.location);
let params = new URLSearchParams(url.search);
let sourceid = params.get('id');

if (!sourceid) {
document.getElementById("myForm").style.display = "none";
}

function openForm(id) {
document.getElementById("myForm").style.display = "block";
window.location.replace(`admins.php?id=${id}`); 
}

function closeForm() {
document.getElementById("myForm").style.display = "none";
window.location.replace(`admins.php`); 
}


function search_function() {

let value = document.getElementById('search').value;

window.location='admins.php'+ window.location.search + '?name=' + value ;
 
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

 var originalURL = window.location='admins.php'+ window.location.search;
 var alteredURL = removeParam("name", originalURL);
 window.location.href=alteredURL;
}


</script>



</body>
</html>