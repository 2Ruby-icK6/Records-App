
<?php
    require('scripts/data_init/vendor/autoload.php');

    $faker = Faker\Factory::create('en_PH');
    $host = 'localhost';
    $username = 'root'; 
    $password = '12345'; 
    $database = 'recordsapp'; 

    // $conn = mysqli_connect($host,$username,$password,$database); // Connect on phpadmin or mysql

    // // condition for connection on database (MySQL o Xampp)
    // if(mysqli_connect_errno()){
    //     echo "Failed to connect to MYSQL ". mysqli_connect_errno();
    // }

    // // Office (50 rows)-> id, name, contactnum, email, address, city, country, postal
    // for ($i=1; $i<=50; $i++){   
    //     $sql = "INSERT INTO recordsapp.office(name, contactnum, email, address, city , country, postal)
    //      values('".$faker->company."','".$faker->phoneNumber."','".$faker->companyEmail."', '".$faker->address."', '".$faker->city."', '".$faker->country."', '".$faker->postcode."')";
    //     mysqli_query($conn, $sql);}

    // // Employee (200 rows) -> id, lastname, firstname, office_id, address
    // for ($i=1; $i<=200; $i++){   
    //     $sql = "INSERT INTO recordsapp.employee(lastname, firstname, office_id, address)
    //      values('".$faker->lastName."','".$faker->firstName."','".$faker->nuberBetween($min = 1, $max = 55)."', '".$faker->address."')";
    //     mysqli_query($conn, $sql);}
    
    // // Transaction (500 rows) -> id, employee_id, office_id, datelog, action, remarks, documentcode
    // for ($i=1; $i<=500; $i++){   
    //     $sql = "INSERT INTO recordsapp.transaction(emloyee_id, office_id, datelog, action, remarks, documentcode)
    //      values('".$faker->numberBetween($min = 1, $max = 205)."','".$faker->nuberBetween($min = 1, $max = 55)."', '".$faker->dateTime($max= 'now')->format('Y-m-d H:i:s')."', 
    //      '".$faker->randomElement(['ON','OUT','COMPLETE'])."', '".$faker->sentence($nbWords = 2, $variableNbWords = true)."', '".$faker->ean8."')";
    //     mysqli_query($conn, $sql);}

    try {
        // Create a PDO database connection
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);

        // Office (50 rows)-> id, name, contactnum, email, address, city, country, postal
        for ($i = 1; $i <= 50; $i++) {
            $sqlQuery = $conn->prepare("INSERT INTO recordsapp.office(name, contactnum, email, address, city , country, postal)
            values('".$faker->company."','".$faker->phoneNumber."','".$faker->companyEmail."', '".$faker->address."', '".$faker->city."', '".$faker->country."', '".$faker->postcode."')");
        }

        // Fetch valid office_id values from the 'office' table
        $office_Id = $conn->query("SELECT id FROM office")->fetchAll(PDO::FETCH_COLUMN);

        // Insert 200 rows of fake data to Employee
        for ($i = 1; $i <= 200; $i++) {
            $sqlQuery = $conn->prepare("INSERT INTO recordsapp.employee(lastname, firstname, office_id, address)
            values('".$faker->lastName."','".$faker->firstName."','".$faker->randomElement($office_Id)."', '".$faker->address."')");
        }

        $employee_Id = $conn->query("SELECT id FROM employee")->fetchAll(PDO::FETCH_COLUMN);

        // Insert 500 rows of fake data to Transactions
        for ($i = 1; $i <= 500; $i++) {
            $sqlQuery = $conn->prepare("INSERT INTO recordsapp.transaction(emloyee_id, office_id, datelog, action, remarks, documentcode)
            values('".$faker->randomElement($employee_Id)."','".$faker->randomElement($office_Id)."', '".$faker->dateTimeThisDecade->format('Y-m-d H:i:s')."', 
            '".$faker->randomElement(['IN','OUT','COMPLETE'])."', '".implode(' ', $faker->words($nb = 2, $asText = false))."', '".$faker->ean8."')");
        }

        echo "Data has been successfully inserted.";

    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }

?>
