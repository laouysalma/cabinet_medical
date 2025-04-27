<?php
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "cabinet_medical";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$full_name = $_POST['fullName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$rdv_date = $_POST['rdv_date'];
$rdv_time = $_POST['rdv_time'];
$doctor = $_POST['doctor'];
$sql = "INSERT INTO rdv (full_name, email, phone, rdv_date, rdv_time, doctor) 
        VALUES($full_name, $email, $phone, $rdv_date, $rdv_time, $doctor) ";
if ($conn->query($sql) === TRUE) {
    echo "TU prent votre rdv avec succès.";
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>