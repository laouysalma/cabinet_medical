<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "cabinet_medical";

// Connexion
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Vérification de la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie que toutes les clés existent
    if (
        isset($_POST['fullName']) &&
        isset($_POST['email']) &&
        isset($_POST['phone']) &&
        isset($_POST['rdv_date']) &&
        isset($_POST['rdv_time']) &&
        isset($_POST['doctor'])
    ) {
        $full_name = $_POST['fullName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $rdv_date = $_POST['rdv_date'];
        $rdv_time = $_POST['rdv_time'];
        $doctor = $_POST['doctor'];

        // Préparer et exécuter la requête (plus sécurisé)
        $stmt = $conn->prepare("INSERT INTO rdv (full_name, email, phone, rdv_date, rdv_time, doctor) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $full_name, $email, $phone, $rdv_date, $rdv_time, $doctor);

        if ($stmt->execute()) {
            echo "TU prent votre rdv avec succès.";
        } else {
            echo "Erreur lors de l'insertion : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erreur : champs manquants dans le formulaire.";
    }
}

$conn->close();
?>
