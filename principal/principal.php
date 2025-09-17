<?php
session_start();
if (!isset($_SESSION["principal"])) {
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
  <a class="active" href="principal.php">Werknemers</a>
  <a href="add_employee.php">Werknemer Aanmaken</a>
  <a href="principal_vacante_uren.php">Vacante Uren</a>
  <a href="principal_formulier.php">Formulier</a>
  

  <a class="logout" href="../login/logout.php">⠀<i class="fa fa-sign-out"></i>⠀Logout</a>
</div><br><br>


<?php

include "../conn.php";

$id = $_SESSION['principal'];
$query = "SELECT * FROM accounts Where id = $id ";
$result = mysqli_query($conn, $query);
$account = mysqli_fetch_array($result);
$name = $account["First_name"];
$school_id = $account["School_id"];


$query2 = "SELECT Afkorting_sch FROM scholen Where id = $school_id ";
$result2 = mysqli_query($conn, $query2);
$a = mysqli_fetch_array($result2);
$school = $a["Afkorting_sch"];

  echo "<h3 style='font-size:50px;color:white' align='center'>Hello $name! Je bent de directeur van $school.</h3>";

?>

  <h3 style='font-size:50px;color:white' align='center'>Here zijn jouw medewerkers:</h3>
  <section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
          <div class="table-wrap">
          <table class="table">
          <thead style="background-color:rgba(34, 154, 214)">
          <tr>
          <th>Voornaam:</th>
          <th>Achternaam:</th>
          <th>Email:</th>
          <th></th>
          <th></th>
          </tr>
          </thead>
          <tbody> <?php

include "../conn.php";

$sql = "SELECT * FROM KSLeuven.accounts WHERE Role='employee' AND School_id=$school_id";

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
    <a  href=\"../admin/delete.php?id=".$r[0]."\"><i class='delete-button fa fa-trash'></i></a>
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







  <div id="myForm" class="container">
        <h3 style="font-size:50px;color:white" align="center">Edit the account: </h3>
        <br>
        
        <div  id="myForm" class="card">
            <div class="card-header">Enter the data:</div>
            <div class="card-body">
                <form method="post" id="insert_form">
					<div class="table-repsonsive"> 
                        <span id="error"></span>	
                        <table class="table table-bordered" id="item_table">
                           
                                <tr>
									<th id="f_name"  >Voornaam:</th>
                  <th id="l_name">Last name:</th>
                  <th id="email">Email:</th>
                          
						</table>
						<div align="center">
		
              <button type="submit" class="btn btn-primary">Save</button>
              <button type="button" class="btn btn-primary"onclick="closeForm()">Close</button>

						</div>
					</div>
				</form>

            </div>    
        </div>
    </body>
</html>
<script>

$(document).ready(function(){

    var count = 0;

    function add_input_field(count)
    {
        
        var html = '';

        html += '<tr>';

        html += `<td><input type="text" name="Accounts[${count}][First_name]" required class="form-control" placeholder="First name"/></td>`;

        html += `<td><input type="text" name="Accounts[${count}][Last_name]" required class="form-control" placeholder="Last name"/></td>`;

        html += `<td><input type="email" name="Accounts[${count}][Email]" required class="form-control" placeholder="Email"/></td>`;

        var remove_button = '';

        if(count > 0)
        {
            remove_button = '<button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button>';
        }

        html += '<td>'+remove_button+'</td></tr>';


        return html;

    }

    $('#item_table').append(add_input_field(0));

    $('.selectpicker').selectpicker('refresh');

    $(document).on('click', '.add', function(){
   
        count++;

        $('#item_table').append(add_input_field(count));

        $('.selectpicker').selectpicker('refresh');

    });

    $(document).on('click', '.remove', function(){ 

        $(this).closest('tr').remove()

    });

    $('#insert_form').on('submit' , function(event){
        
        event.preventDefault();
        

        var error = '';

  
        var form_data = $(this).serialize();

        if(error == '')  
        {
            $.ajax({

                url:"edit_employee.php",

                method:"POST",

                data:form_data,

                succes:function(data)
                {

                    if(data == 'ok')
                    {
                        $('#item_table').find('tr:gt(0)').remove();

                        $('#error').html('<div class="alert alert-succes">Waarden succesvol opgeslagen</div>')

                        $('#item_table').append(add_input_field(0));

                        $('.selectpicker').selectpicker('refresh')
                    }
                }
            })
        }
        else
        {
            $('#error').html('<div class="alert alert-danger"><ul>'+error+'</ul></div>');
        }
    }); 
});
</script><br><br>




<script>

let url = new URL(window.location);
let params = new URLSearchParams(url.search);
let sourceid = params.get('id');

if (!sourceid) {
  document.getElementById("myForm").style.display = "none";
}

function openForm(id, f_name, l_name, email) {
  console.log(f_name, l_name, email);
  document.getElementById("myForm").style.display = "block";
  window.location.replace(`principal.php?id=${id}`); 
  window.document.getElementById("f_name").innerText = "hello"; 
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  window.location.replace(`principal.php`); 
}
</script><br><br>

    
  </body>
</html>