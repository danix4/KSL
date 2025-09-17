<?php

session_start();
if (!isset($_SESSION["admin"])) {
    header("Location:../login/login.php");
}


include "../conn.php";


function fill_unit_select_box2($connect)
{
    $output = '';
    $query = "SELECT * FROM scholen
    ORDER BY Volgorde ASC";
    $result = $connect->query($query);
    foreach($result as $row)
    {
        $output .= '<option  data-sname="'. $row["Benaming"]. '" value="'. $row["id"]. '">'. $row["Benaming"] . '</option>';
    }

    return $output;
}

?>
<!DOCTYPE html>
<html lang="en" style="background-color: #3fa435;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create accounts</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../css/UI.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/test.scss">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<body style="background-color: #3fa435;">
    
   

    <div class="topnav">
    <a class="active" href="admin.php">Scholen</a>
    <a href="admins.php">Admins</a>
    <a href="UI.php">Medewerkers Aanmaken</a>
    <a href="add_admin.php">Admins Aanmaken</a>

    <a class="logout" href="../login/logout.php">⠀<i class="fa fa-sign-out"></i>⠀Logout</a>
    </div><br><br>


    <div class="container">
        <h3 style="font-size:50px;color:white" align="center">Kies een school: </h3>
        <br>
        
        <div style="max-width: 600px; margin: 0 auto; margin-top:65px" class="card">
            <div class="card-header">Kijk naar de scholen:</div>
            <div class="card-body">
                <form method="post" id="insert_form">
					<div class="table-repsonsive"> 
                        <span id="error"></span>	
                        <table class="table table-bordered" id="item_table">
                           
                                <tr>
                                    <th>School:</th>
							
                                </tr>
                          
						</table>
						<div align="center">
							<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Uitzicht" />        
						</div>
					</div>
				</form>

            </div>
            
        </div>
    </body>
</html>
<script>

$(document).ready(function(){

    

    function add_input_field(count)
    {
        
        var html = '';

        html += '<tr>';

        html += `<td><select name="Accounts[${count}][School]" class="form-control selectpicker" data-live-search="true"><option value="">Kies een school</option><?php echo fill_unit_select_box2($conn); ?></select></td>`;

        return html;

    }
    

    $('#item_table').append(add_input_field(0)); 

    $('.selectpicker').selectpicker('refresh');

    $('#insert_form').on('submit' , function(event){
    
        event.preventDefault();

        var form_data = $(this).serializeArray();
     
        var sid = form_data[0].value;

        console.log(form_data);

        window.location.href=`staff.php?School_id=${sid}`;

    }); 
});
</script>