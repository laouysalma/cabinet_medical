<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $specialty = $_POST['specialty'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Gérer le téléchargement du diplôme
    $diplomaName = $_FILES['diploma']['name'];
    $diplomaTmp = $_FILES['diploma']['tmp_name'];
    $diplomaPath = 'uploads/diplomas/' . uniqid() . '_' . $diplomaName;
    move_uploaded_file($diplomaTmp, $diplomaPath);
    
    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT id FROM doctors WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() > 0) {
        die("Cet email est déjà utilisé");
    }
    
    // Insérer le médecin (statut en attente par défaut)
    $stmt = $pdo->prepare("INSERT INTO doctors (first_name, last_name, email, specialty, phone, password, diploma_path, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->execute([$firstName, $lastName, $email, $specialty, $phone, $password, $diplomaPath]);
    
    header("Location: login.php?doctor_registered=1");
    exit();
}
?>