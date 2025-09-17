<?php

session_start();
if (!isset($_SESSION["admin"])) {
    header("Location:../login/login.php");
}


include "../conn.php";

function fill_unit_select_box($connect)
{
    $output = '';

    $row=["Employee","Principal"];
    foreach($row as $role)
    {
        $output .= '<option value="'. $role. '">'. $role . '</option>';
    }

    return $output;
}


function fill_unit_select_box2($connect)
{
    $output = '';
    $query = "SELECT * FROM scholen
    ORDER BY Volgorde ASC";
    $result = $connect->query($query);
    foreach($result as $row)
    {
        $output .= '<option value="'. $row["Benaming"]. '">'. $row["Benaming"] . '</option>';
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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<body style="background-color: #3fa435;">
    
  

    <div class="topnav">
    <a href="admin.php">Scholen</a>
    <a href="admins.php">Admins</a>
    <a class="active" href="UI.php">Medewerkers Aanmaken</a>
    <a href="add_admin.php">Admins Aanmaken</a>

    <a class="logout" href="../login/logout.php">⠀<i class="fa fa-sign-out"></i>⠀Logout</a>
    </div><br><br>


    <div class="container">
        <h3 style="font-size:50px;color:white" align="center">Account van een medewerker of directeur aanmaken: </h3>
        <br>
        
        <div style="max-width: 1000px; margin: 0 auto; margin-top:65px" class="card">
            <div class="card-header">Voer de gegevens in:</div>
            <div class="card-body">
                <form method="post" id="insert_form">
					<div class="table-repsonsive"> 
                        <span id="error"></span>	
                        <table class="table table-bordered" id="item_table">
                           
                                <tr>
									<th>Voornaam:</th>
                                    <th>Achternaam:</th>
                                    <th>Email:</th>
                                    <th>Rol:</th>
                                    <th>School:</th>
									<th><button type="button" name="add" class="btn btn-success btn-sm add"> 
                                    <i class="fas fa-plus"></i></button></th>
                                </tr>
                          
						</table>
						<div align="center">
							<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Invoegen" />
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

        html += `<td><input type="text" name="Accounts[${count}][First_name]" required class="form-control" placeholder="Voornaam"/></td>`;

        html += `<td><input type="text" name="Accounts[${count}][Last_name]" required class="form-control" placeholder="Achternaam"/></td>`;

        html += `<td><input type="email" name="Accounts[${count}][Email]" required class="form-control" placeholder="Email"/></td>`;

        html += `<td><select name="Accounts[${count}][Role]" required class="form-control selectpicker" data-live-search="true"><option value="">Kies een rol</option><?php echo fill_unit_select_box($conn); ?></select></td>`;

        html += `<td><select name="Accounts[${count}][School]" required class="form-control selectpicker" data-live-search="true"><option value="">Kies een school</option><?php echo fill_unit_select_box2($conn); ?></select></td>`;

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

                url:"insert.php",

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
</script>