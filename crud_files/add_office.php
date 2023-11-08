<!DOCTYPE html>
<html>
<head>
<title>Add Office</title>
</head>
<body>
    <h1>ADD OFFICE</h1>

    <form action="" method="POST">
        <label>Office Name:</label><input type="text" name="office_name"><br></br>
        <label>Contact Number:</label><input type="text" name="contact_num"><br></br>
        <label>Email:</label><input type="text" name="email"><br></br>
        <label>Address:</label><input type="text" name="address"><br></br>
        <label>city:</label><input type="text" name="city"><br></br>
        <label>country:</label><input type="text" name="country"><br></br>
        <label>postal:</label><input type="text" name="postal"><br></br>

        <button type="submit" name="submit">Submit</button>
</body>
</html>
<?php
require('..\config\config.php');
require('..\config\db.php');    