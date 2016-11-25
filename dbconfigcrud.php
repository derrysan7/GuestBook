<?php

$DB_host = "localhost";
$DB_user = "adminhmsi";
$DB_pass = "12345";
$DB_name = "dbtest";


try
{
 $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
 $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
 echo $e->getMessage();
}

//error_reporting(0);
?>