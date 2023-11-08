<!DOCTYPE html>
<html>
<head>
<title>Add Office</title>
</head>
<body>
    <h1>ADD OFFICE</h1>

    <form action="" method="POST">
        <label>Office Name:</label><input type="text" name="office_name" required><br></br>
        <label>Contact Number:</label><input type="number" name="contact_num" required><br></br>
        <label>Email:</label><input type="text" name="email" required><br></br>
        <label>Address:</label><input type="text" name="address" required><br></br>
        <label>city:</label><input type="text" name="city" required><br></br>
        <label>country:</label><input type="text" name="country" required><br></br>
        <label>postal:</label><input type="text" name="postal" required><br></br>

        <button type="submit" name="submit">Submit</button>
</body>
</html>
<?php
require('..\config\config.php');
require('..\config\db.php');    

if (isset($_POST['submit'])) {
    $office_name = $_POST["office_name"];
    $contact_num = $_POST["contact_num"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $country = $_POST["country"];
    $postal = $_POST["postal"];

    $sql= "INSERT into recordsapp.office(name,
    contactnum, email, address, city, country, postal)
    VALUES('$office_name', '$contact_num', '$email', '$address', '$city', '$country', '$postal')";

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


$conn->close();
?>