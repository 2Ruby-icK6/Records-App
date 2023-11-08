<!DOCTYPE html>
<html>
<head>
<title>Add Employee</title>
</head>
<body>
    <h1>ADD EMPLOYEE</h1>

    <form action="" method="POST">
        <label>Last Name:</label><input type="text" name="last_name" required><br></br>
        <label>First Name:</label><input type="text" name="first_name" required><br></br>
        <label>Office ID:</label>
            <select name="office_id" id="office_id" required>
                <?php
                    require('..\config\config.php');
                    require('..\config\db.php');   
                    $office_Id = [];
                    $result = $conn->query("SELECT id FROM recordsapp.office");
                    while ($row = $result->fetch_assoc()) {
                        $office_Id[] = $row['id'];
                    }
                    foreach ($office_Id as $id) {
                        echo "<option value='$id'>$id</option>";
                    }
                ?>
            </select><br></br>
        <label>Address:</label><input type="text" name="address" required><br></br>
        <button type="submit" name="submit">Submit</button>
</body>
</html>
<?php

    if (isset($_POST['submit'])) {
        $last_name = $_POST["last_name"];
        $first_name = $_POST["first_name"];
        $office_id = $_POST["office_id"];
        $address = $_POST["address"];

        $sql= "INSERT into recordsapp.employee(lastname,
    firstname, office_id, address)
    VALUES('$last_name', '$first_name', '$office_id', '$address')";

    $result = mysqli_query($conn, $sql) or die("connection failed" . $conn->connect_error);
    if($result){
        header("Location: ../index.php?msg=New record has been added.");
        echo "New record has been added.";

    }
    else {
        echo "Not successful.";
    }
    }
    else{
        echo "Fill out all fields";
    }

?>