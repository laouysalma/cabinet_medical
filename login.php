<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Vérifier dans la table patients
    $stmt = $pdo->prepare("SELECT * FROM patients WHERE email = ?");
    $stmt->execute([$email]);
    $patient = $stmt->fetch();
    
    if ($patient && password_verify($password, $patient['password'])) {
        $_SESSION['user_id'] = $patient['id'];
        $_SESSION['user_type'] = 'patient';
        $_SESSION['user_name'] = $patient['first_name'] . ' ' . $patient['last_name'];
        header("Location: patient_dashboard.php");
        exit();
    }
    
    // Vérifier dans la table doctors
    $stmt = $pdo->prepare("SELECT * FROM doctors WHERE email = ?");
    $stmt->execute([$email]);
    $doctor = $stmt->fetch();
    
    if ($doctor && password_verify($password, $doctor['password'])) {
        $_SESSION['user_id'] = $doctor['id'];
        $_SESSION['user_type'] = 'doctor';
        $_SESSION['user_name'] = $doctor['first_name'] . ' ' . $doctor['last_name'];
        header("Location: doctor_dashboard.php");
        exit();
    }
    
    // Vérifier dans la table admin
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();
    
    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['user_type'] = 'admin';
        $_SESSION['user_name'] = 'Administrateur';
        header("Location: admin_dashboard.php");
        exit();
    }
    
    $_SESSION['error'] = "Email ou mot de passe incorrect";
    header("Location: index.php#loginModal");
    exit();
}
?>