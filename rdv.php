<?php
require_once 'result.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $fullName = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $doctor = $_POST['doctor'] ?? '';

    // Validation simple
    if (empty($fullName) || empty($email) || empty($phone) || empty($date) || empty($time) || empty($doctor)) {
        die("Tous les champs sont obligatoires.");
    }

    try {
        // Préparation de la requête SQL
        $stmt = $pdo->prepare("INSERT INTO rdv
                              (full_name, email, phone, rdv_date, rdv_time, doctor, created_at) 
                              VALUES 
                              (:full_name, :email, :phone, :rdv_date, :rdv_time, :doctor, NOW())");

        // Exécution avec les paramètres
        $stmt->execute([
            ':full_name' => $fullName,
            ':email' => $email,
            ':phone' => $phone,
            ':rdv_date' => $date,
            ':rdv_time' => $time,
            ':doctor' => $doctor
        ]);

        // Redirection après succès
        header('Location: projet_medical.htmll#rdv?success=1');
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de l'enregistrement du rendez-vous: " . $e->getMessage());
    }
} else {
    header('Location: projet_medical.htmll#rdv');
    exit();
}
?>