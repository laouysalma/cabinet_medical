<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Récupérer les médecins en attente de validation
$pendingDoctors = $pdo->query("SELECT * FROM doctors WHERE status = 'pending'")->fetchAll();

// Récupérer les statistiques
$totalPatients = $pdo->query("SELECT COUNT(*) FROM patients")->fetchColumn();
$totalDoctors = $pdo->query("SELECT COUNT(*) FROM doctors WHERE status = 'approved'")->fetchColumn();
$totalAppointments = $pdo->query("SELECT COUNT(*) FROM appointments")->fetchColumn();
?>

<!-- Tableau de bord admin avec gestion des médecins, statistiques, etc. -->