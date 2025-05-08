<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT id FROM patients WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() > 0) {
        die("Cet email est déjà utilisé");
    }
    
    // Insérer le patient
    $stmt = $pdo->prepare("INSERT INTO patients (first_name, last_name, email, phone, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$firstName, $lastName, $email, $phone, $password]);
    
    header("Location: login.php?registered=1");
    exit();
}
?>