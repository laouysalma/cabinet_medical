<?php
$host="localhost";
$user="root";
$pass="root";
$dbname="cabinet_medical";
$conn= new mysqli($host,$user,$pass,$dbname);
if ($conn->connect_error){
    die("connexion echouee:" .$conn ->connect_error);
}
?>