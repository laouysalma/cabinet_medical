<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['patient_id'])) {
    $_SESSION['redirect_url'] = basename($_SERVER['PHP_SELF']); // Stocke la page actuelle
    header("Location: login.php?error=not_logged_in");
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

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nettoyage des données
    $full_name = htmlspecialchars($_POST['fullName']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
    $rdv_date = $_POST['rdv_date'];
    $rdv_time = $_POST['rdv_time'];
    $doctor = htmlspecialchars($_POST['doctor']);
    $patient_id = (int)$_SESSION['patient_id'];

    // Validation des champs
    if (empty($full_name) || empty($email) || empty($phone) || empty($rdv_date) || empty($rdv_time) || empty($doctor)) {
        header("Location: appointment.php?error=missing_fields");
        exit;
    }

    // Insertion sécurisée
    $stmt = $conn->prepare("INSERT INTO rdv (patient_id, full_name, email, phone, rdv_date, rdv_time, doctor) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $patient_id, $full_name, $email, $phone, $rdv_date, $rdv_time, $doctor);

if ($stmt->execute()) {
    echo "
    <script>
        if (confirm('Rendez-vous enregistré avec succès. Voulez-vous voir vos rendez-vous ?')) {
            window.location.href = 'mes_rdv.php';
        } else {
               window.location.href = 'test.html';
        }
    </script>
    ";
    exit;
}
}

// Si accès direct au fichier
header("Location: appointment.php");
exit;
?>