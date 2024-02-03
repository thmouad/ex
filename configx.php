<?php

$username="root";
$password="";
$serverName="localhost";
$database="comptedb";

$connection= new mysqli($serverName,$username,$password,$database);
if($connection->connect_error){

	die("Connection failed : ". $connection->connect_error);
}



?>