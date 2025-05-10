<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit;
}

// Configuration de la base de données
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "cabinet_medical";

// Connexion MySQLi
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

// Récupérer l'ID du RDV à supprimer
$rdv_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$patient_id = (int)$_SESSION['patient_id'];

if ($rdv_id > 0) {
    // Vérifier que le RDV appartient bien à l'utilisateur avant suppression
    $stmt = $conn->prepare("DELETE FROM rdv WHERE id = ? AND patient_id = ?");
    $stmt->bind_param("ii", $rdv_id, $patient_id);
    
    if ($stmt->execute()) {
        header("Location: mes_rdv.php?success=rdv_deleted");
    } else {
        header("Location: mes_rdv.php?error=delete_failed");
    }
    exit;
}

// Si pas d'ID valide
header("Location: mes_rdv.php?error=invalid_id");
exit;
?>