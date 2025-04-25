<?php
$host="localhost";
$user="root";
$pass="root";
$dbname="cabinet_medical";
$conn= new mysqli($host,$user,$pass,$dbname);
if ($conn->connect_error){
    die("connexion echouee:" .$conn ->connect_error);
}
$full_name = $_post['fullName'] ;
$email =$_post['email']	;
$phone=$_post['phone'];
$rdv_date=$_post['date'];
$rdv_time=$_post['time'] ;
$doctor=$_post['doctor'];


?>