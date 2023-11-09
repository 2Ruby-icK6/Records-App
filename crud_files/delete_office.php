<?php
    require('../config/config.php'); 
    require('../config/db.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    

        $query = 'DELETE FROM office WHERE id='. $id;

        //Get the Result
        $result =  mysqli_query($conn, $query);

        //Free Result
        mysqli_free_result($result);

        //Close the Connection
        mysqli_close($conn);
    }

header("location: /Records-App/office.php");
exit;

?>