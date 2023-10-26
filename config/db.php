<!-- Records App 01.mp4 -->
<?php
// download recordsapp.sql 
// import it and rename the schema to "recordsapp"

$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME); // Connect on phpadmin or mysql

if(mysqli_connect_errno()){
    echo "Failed to connect to MYSQL ". mysqli_connect_errno();
}