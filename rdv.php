<?php
$host="localhost";
$user="root";
$pass="root";
$dbname="cabinet_medical";
$conn= new mysqli($host,$user,$pass,$dbname);
if ($conn->connect_error){
    die("connexion echouee:" .$conn ->connect_error);
}
$full_name = $_POST['fullName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$rdv_date = $_POST['date'];
$rdv_time = $_POST['time'];
$doctor = $_POST['doctor'];
$sql = "INSERT INTO rendezvous (full_name, email, phone, rdv_date, rdv_time, doctor) 
        VALUES (?, ?, ?, ?, ?, ?)";
?>