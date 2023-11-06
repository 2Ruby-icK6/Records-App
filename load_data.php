<!-- real_escape_string used for to accept special characters -->

<?php
    require('scripts/data_init/vendor/autoload.php');

    $faker = Faker\Factory::create('en_PH');
    $host = 'localhost';
    $username = 'root';
    $password = '12345';
    $database = 'recordsapp';
    
    // Create a mysqli database connection
    $conn = new mysqli($host, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    
    // Office (50 rows)-> id, name, contactnum, email, address, city, country, postal
    for ($i = 1; $i <= 50; $i++) {
        $name = $conn->real_escape_string($faker->company);
        $contactnum = $conn->real_escape_string($faker->phoneNumber);
        $email = $conn->real_escape_string($faker->companyEmail);
        $address = $conn->real_escape_string($faker->address);
        $city = $conn->real_escape_string($faker->city);
        $country = $conn->real_escape_string($faker->country);
        $postal = $conn->real_escape_string($faker->postcode);
    
        $sql = "INSERT INTO recordsapp.office (name, contactnum, email, address, city, country, postal) 
                VALUES ('$name', '$contactnum', '$email', '$address', '$city', '$country', '$postal')";
    
        if ($conn->query($sql) === false) {
            die("Error inserting data: " . $conn->error);
        }
    }
    
    // Fetch valid office_id values from the 'office' table
    $office_Id = [];
    $result = $conn->query("SELECT id FROM recordsapp.office");
    while ($row = $result->fetch_assoc()) {
        $office_Id[] = $row['id'];
    }
    
    // Insert 200 rows of fake data to Employee
    for ($i = 1; $i <= 200; $i++) {
        $lastname = $conn->real_escape_string($faker->lastName);
        $firstname = $conn->real_escape_string($faker->firstName);
        $office_id = $conn->real_escape_string($faker->randomElement($office_Id));
        $address = $conn->real_escape_string($faker->address);
    
        $sql = "INSERT INTO recordsapp.employee (lastname, firstname, office_id, address) 
                VALUES ('$lastname', '$firstname', '$office_id', '$address')";
    
        if ($conn->query($sql) === false) {
            die("Error inserting data: " . $conn->error);
        }
    }

    $employee_Id = [];
    $result = $conn->query("SELECT id FROM recordsapp.employee");
    while ($row = $result->fetch_assoc()) {
        $employee_Id[] = $row['id'];
    }
    
    // Insert 500 rows of fake data to Transactions
    for ($i = 1; $i <= 500; $i++) {
        $employee_id = $conn->real_escape_string($faker->randomElement($employee_Id));
        $office_id = $conn->real_escape_string($faker->randomElement($office_Id));
        $datelog = $conn->real_escape_string($faker->dateTimeThisDecade->format('Y-m-d H:i:s'));
        $action = $conn->real_escape_string($faker->randomElement(['IN', 'OUT', 'COMPLETE']));
        $remarks = $conn->real_escape_string(implode(' ', $faker->words($nb = 2, $asText = false)));
        $documentcode = $conn->real_escape_string($faker->ean8);
    
        $sql = "INSERT INTO recordsapp.transaction (employee_id, office_id, datelog, action, remarks, documentcode) 
                VALUES ('$employee_id', '$office_id', '$datelog', '$action', '$remarks', '$documentcode')";
    
        if ($conn->query($sql) === false) {
            die("Error inserting data: " . $conn->error);
        }
    }
    
    echo "Data has been successfully inserted.";
    
    $conn->close();
    
    // require('scripts/data_init/vendor/autoload.php');

    // $faker = Faker\Factory::create('en_PH');
    // $host = 'localhost';
    // $username = 'root'; 
    // $password = '12345'; 
    // $database = 'recordsapp';

    // // Create a mysqli database connection
    // $conn = new mysqli($host, $username, $password, $database);

    // if ($conn->connect_error) {
    //     die("Database connection failed: " . $conn->connect_error);
    // }

    // // Office (50 rows)-> id, name, contactnum, email, address, city, country, postal
    // for ($i = 1; $i <= 50; $i++) {
    //     $sql = "INSERT INTO recordsapp.office (name, contactnum, email, address, city, country, postal) 
    //             VALUES ('" . $faker->company . "','" . $faker->phoneNumber . "','" . $faker->companyEmail . "', '" . $faker->address . "', '" . $faker->city . "', '" . $faker->country . "', '" . $faker->postcode . "')";
    //     $conn->query($sql);
    // }

    // // Fetch valid office_id values from the 'office' table
    // $office_Id = [];
    // $result = $conn->query("SELECT id FROM office");
    // while ($row = $result->fetch_assoc()) {
    //     $office_Id[] = $row['id'];
    // }

    // // Insert 200 rows of fake data to Employee
    // for ($i = 1; $i <= 200; $i++) {
    //     $sql = "INSERT INTO recordsapp.employee (lastname, firstname, office_id, address) 
    //             VALUES ('" .$faker->lastName . "','" . $faker->firstName . "','" . $faker->randomElement($office_Id) . "', '" . $faker->address . "')";
    //     $conn->query($sql);
    // }

    // // Insert 500 rows of fake data to Transactions
    // for ($i = 1; $i <= 500; $i++) {
    //     $sql = "INSERT INTO recordsapp.transaction (employee_id, office_id, datelog, action, remarks, documentcode) 
    //             VALUES ('".$faker->randomElement($employee_Id)."','".$faker->randomElement($office_Id)."', '".$faker->dateTimeThisDecade->format('Y-m-d H:i:s')."', 
    //             '" . $faker->randomElement(['IN', 'OUT', 'COMPLETE']) . "', '" . implode(' ', $faker->words($nb = 2, $asText = false)) . "', '" . $faker->ean8 . "')";
    //     $conn->query($sql);
    // }

    // echo "Data has been successfully inserted.";

    // $conn->close();

    // try {
    //     // Create a PDO database connection
    //     $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    //     // Office (50 rows)-> id, name, contactnum, email, address, city, country, postal
    //     for ($i = 1; $i <= 50; $i++) {
    //         $sqlQuery = $conn->prepare("INSERT INTO recordsapp.office(name, contactnum, email, address, city , country, postal)
    //         values('".$faker->company."','".$faker->phoneNumber."','".$faker->companyEmail."', '".$faker->address."', '".$faker->city."', '".$faker->country."', '".$faker->postcode."')");
    //     }

    //     // Fetch valid office_id values from the 'office' table
    //     $office_Id = $conn->query("SELECT id FROM office")->fetchAll(PDO::FETCH_COLUMN);

    //     // Insert 200 rows of fake data to Employee
    //     for ($i = 1; $i <= 200; $i++) {
    //         $sqlQuery = $conn->prepare("INSERT INTO recordsapp.employee(lastname, firstname, office_id, address)
    //         values('".$faker->lastName."','".$faker->firstName."','".$faker->randomElement($office_Id)."', '".$faker->address."')");
    //     }

    //     $employee_Id = $conn->query("SELECT id FROM employee")->fetchAll(PDO::FETCH_COLUMN);

    //     // Insert 500 rows of fake data to Transactions
    //     for ($i = 1; $i <= 500; $i++) {
    //         $sqlQuery = $conn->prepare("INSERT INTO recordsapp.transaction(emloyee_id, office_id, datelog, action, remarks, documentcode)
    //         values('".$faker->randomElement($employee_Id)."','".$faker->randomElement($office_Id)."', '".$faker->dateTimeThisDecade->format('Y-m-d H:i:s')."', 
    //         '".$faker->randomElement(['IN','OUT','COMPLETE'])."', '".implode(' ', $faker->words($nb = 2, $asText = false))."', '".$faker->ean8."')");
    //     }

    //     echo "Data has been successfully inserted.";

    // } catch (PDOException $e) {
    //     die("Database connection failed: " . $e->getMessage());
    // }

?>
