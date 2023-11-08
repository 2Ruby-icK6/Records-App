<!DOCTYPE html>
<html>
<head>
<title>Add Transaction</title>
</head>
<?php
    require('..\config\config.php');
    require('..\config\db.php');   
?>
<body>
    <h1>ADD TRANSACTION</h1>

    <form action="" method="POST">
        <label>Employee ID:</label>
            <select name="employee_id" id="employee_id" required>
                <?php
                    $employee_Id = [];
                    $result = $conn->query("SELECT id FROM recordsapp.employee");
                    while ($row = $result->fetch_assoc()) {
                        $employee_Id[] = $row['id'];
                    }
                    foreach ($employee_Id as $id) {
                        echo "<option value='$id'>$id</option>";
                    }
                ?>
            </select><br></br>
        <label>Office ID:</label>
            <select name="office_id" id="office_id" required>
                <?php
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
        <label>Date Created:</label>
            <input type="datetime-local" id="date" name="date" required><br></br>
        <label>Action: </label>
            <select name="action" id="action" required>
                <option value="IN">IN</option>
                <option value="OUT">OUT</option>
                <option value="COMPLETE">COMPLETE</option>
            </select><br></br>
        <label>Remarks:</label><input type="text" name="remarks"><br></br>
        <label>Document Code:</label><input type="text" name="doc_code" required><br></br>
        <button type="submit" name="submit">Submit</button>
</body>
</html>
<?php
    if (isset($_POST['submit'])) {
        $employee_id = $_POST["employee_id"];
        $office_id = $_POST["office_id"];
        $date = $_POST["date"];
        $action = $_POST["action"];
        $remarks = $_POST["remarks"];
        $doc_code = $_POST["doc_code"];

        $sql= "INSERT into recordsapp.transaction(employee_id,
                    office_id, datelog, action, remarks, documentcode)
        VALUES('$employee_id', '$office_id', '$date', '$action', '$remarks', '$doc_code')";

        $result = mysqli_query($conn, $sql) or die("connection failed" . $conn->connect_error);
        if($result){
            echo "New record has been added.";
        }
        else {
        echo "Not successful.";
        }
    }

    $conn->close();
?>