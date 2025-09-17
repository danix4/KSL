<?php

session_start();
if (!isset($_SESSION["employee"])) {
    header("Location:login/login.php");
}

include "../conn.php";

function fill_unit_select_box2($connect)
{
    $output = '';
    $query = "SELECT * FROM vakken";
    $result = $connect->query($query);
    foreach($result as $row)
    {
        $output .= '<option value="'. $row["Vakbenaming"]. '">'. $row["Vakbenaming"] . '</option>';
    }

    return $output;
}



function fill_unit_select_box3($connect)
{
    $output = '';
    $query = "SELECT * FROM ambten
    ORDER BY Volgorde_ambt ASC";
    $result = $connect->query($query);
    foreach($result as $row)
    {
        $output .= '<option value="'. $row["Ambt"]. '">'. $row["Ambt"] . '</option>';
    }

    return $output;
}



function fill_unit_select_box4($connect)
{
    $output = '';

    $row=[1,2,3,4];
    foreach($row as $grade)
    {
        $output .= '<option value="'. $grade. '">'. $grade . '</option>';
    }

    return $output;
}



function fill_unit_select_box5($connect)
{
    $output = '';

    $row=["ASO","BSO","KSO","TSO"];
    foreach($row as $ond_vorm)
    {
        $output .= '<option value="'. $ond_vorm. '">'. $ond_vorm . '</option>';
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
    <title>Employee page</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../css/UI.css">
    <link rel="stylesheet" href="../css/navbar.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script src="https://unpkg.com/localbase/dist/localbase.min.js"></script>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<body style="background-color: #3fa435;">
    

    <div class="topnav">
    <a class="active" href="employee.php">Forms</a>
    <a href="vacante_uren.php">Mijn vacante uren</a>


    <a class="logout" href="../login/logout.php"><i class="fa fa-sign-out"></i>⠀Logout</a>
    </div><br><br>

<?php

include "../conn.php";


$id = $_SESSION['employee'];

$query = "SELECT * FROM accounts Where id = $id ";
$result = mysqli_query($conn, $query);
$account = mysqli_fetch_array($result);
$name = $account["First_name"];
$school_id = $account["School_id"];

$query2 = "SELECT Afkorting_sch FROM scholen Where id = $school_id";
$result2 = mysqli_query($conn, $query2);
$a = mysqli_fetch_array($result2);
$school = $a["Afkorting_sch"];

echo "<h3 style='font-size:50px;color:white' align='center'>Hallo $name! Je bent een medewerker in $school.</h3>";

?>
        
        <div style="max-width: 1000px; margin: 0 auto; margin-top:65px" class="card">
            <div class="card-header">Enter the data:</div>
            <div class="card-body">
                <form method="post" id="insert_form">
					<div class="table-repsonsive"> 
                        <span id="error"></span>	
                        <table class="table table-bordered" id="item_table">
                           
                                <tr>
                                    <th>Vak:</th>
                                    <th>Ambt:</th>
                                    <th>Graad:</th>
                                    <th>Ond_vorm:</th>
                                    <th>Uren per week:</th>

									<th><button type="button" name="add" class="btn btn-success btn-sm add"> 
                                    <i class="fas fa-plus"></i></button></th>
                                </tr>
                          
						</table>
						<div align="center">
							<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Toevoegen" />
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

        html += `<td><select id="vak_select" name="Accounts[${count}][Vak]" required class="form-control selectpicker" onchange="change_function('vak_select')" data-live-search="true"><option value="">Kies Vak</option><?php echo fill_unit_select_box2($conn); ?></select></td>`;

        html += `<td><select name="Accounts[${count}][Ambt]" required class="form-control selectpicker" data-live-search="true"><option value="">Kies Ambt</option><?php echo fill_unit_select_box3($conn); ?></select></td>`;

        html += `<td><select name="Accounts[${count}][Graad]" required class="form-control selectpicker" data-live-search="true"><option value="">Kies Graad</option><?php echo fill_unit_select_box4($conn); ?></select></td>`;

        html += `<td><select name="Accounts[${count}][Ond_vorm]" required class="form-control selectpicker" data-live-search="true"><option value="">Kies Ond_Form</option><?php echo fill_unit_select_box5($conn); ?></select></td>`;

        html += `<td><class="form-control selectpicker" data-live-search="true"><input name="Accounts[${count}][uren_week]" required type="number" min="0" max="40"></input></td>`;

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

                url:"../insert_vakante.php",

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

function change_function(id){


    let db = new Localbase("db");
    const new_value = document.getElementById(id).value;
    update_db("vak", new_value);
    
    if(id === "vak_select"){
        db.collection('Form_backup').add({
            
            Vak: new_value,

        })
    }


}

function update_db(column, value){
    
    //gets table
    var table = document.getElementById('item_table');

    //gets rows of table
    var rowLength = table.rows.length;

    //loops through rows    
    for (i = 0; i < rowLength; i++){

      //gets cells of current row  
       var cells = table.rows.item(i).cells;

       //gets amount of cells of current row
       var cellLength = cells.length;

       //loops through each cell in current row
       for(var j = 0; j < cellLength; j++){

              // get your cell info here

              var cellVal = cells.item(j);
              console.log("cellVal:", cellVal);
           }
    }


    rows = "array of all rows as HTML objects"

    col = "column to change the value in"
    for (let i = 0; i < rows.length; i++) {
      rows[i][col] = new_value
    }

// update db
//...

}

</script>