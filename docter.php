<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'doctor') {
    header("Location: login.php");
    exit();
}

// Récupérer les rendez-vous du médecin
$stmt = $pdo->prepare("SELECT appointments.*, patients.first_name, patients.last_name 
                       FROM appointments 
                       JOIN patients ON appointments.patient_id = patients.id 
                       WHERE doctor_id = ? 
                       ORDER BY appointment_date, appointment_time");
$stmt->execute([$_SESSION['user_id']]);
$appointments = $stmt->fetchAll();
?>

<!-- Structure similaire à patient_dashboard.php mais adaptée aux médecins -->