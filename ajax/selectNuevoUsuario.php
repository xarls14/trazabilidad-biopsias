<?php
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$query = "SELECT * FROM areas ORDER BY id_area ASC";



if (!$result = mysqli_query($link, $query)) {
	exit(mysqli_error($link));
}	

if(mysqli_num_rows($result) > 0)
    {
        $number = 1;
        while($row = mysqli_fetch_array($result))
        {
            echo '<option value="'.$row['id_area'].'">'.$row['nombre'].'</option>';
            //echo '<option>'.$row['nombre'].'</option>';
              
        }
    }
    else
    {
        // records now found 
        echo '<option>Opciones no encontradas</option>';
    }
 
    
?>

