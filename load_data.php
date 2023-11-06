<?php

require ('scripts\data_init\vendor\autoload.php');

$faker = Faker\Factory::create("en_PH");
$conn = mysqli_connect("localhost","root","root","faker");

if(!$conn)
{   
die(mysqli_error());
}