<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'patient') {
    header("Location: login.php");
    exit();
}

// Récupérer les rendez-vous du patient
$stmt = $pdo->prepare("SELECT appointments.*, doctors.first_name, doctors.last_name, doctors.specialty 
                       FROM appointments 
                       JOIN doctors ON appointments.doctor_id = doctors.id 
                       WHERE patient_id = ? 
                       ORDER BY appointment_date, appointment_time");
$stmt->execute([$_SESSION['user_id']]);
$appointments = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Patient - MediCab+</title>
    <!-- Inclure les mêmes CSS que dans index.html -->
</head>
<body>
    <!-- Navigation similaire à index.html mais adaptée -->
    
    <div class="container py-5">
        <h2 class="mb-4">Bonjour, <?php echo $_SESSION['user_name']; ?></h2>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Mes Informations</h5>
                        <!-- Afficher les infos du patient -->
                        <a href="edit_profile.php" class="btn btn-sm btn-outline-primary mt-3">Modifier</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Mes Rendez-vous</h5>
                    </div>
                    <div class="card-body">
                        <?php if (count($appointments) > 0): ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Heure</th>
                                            <th>Médecin</th>
                                            <th>Spécialité</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($appointments as $appointment): ?>
                                            <tr>
                                                <td><?= date('d/m/Y', strtotime($appointment['appointment_date'])) ?></td>
                                                <td><?= $appointment['appointment_time'] ?></td>
                                                <td>Dr. <?= $appointment['first_name'] . ' ' . $appointment['last_name'] ?></td>
                                                <td><?= $appointment['specialty'] ?></td>
                                                <td>
                                                    <span class="badge bg-<?= $appointment['status'] == 'confirmed' ? 'success' : 'warning' ?>">
                                                        <?= $appointment['status'] == 'confirmed' ? 'Confirmé' : 'En attente' ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">Détails</a>
                                                    <a href="cancel_appointment.php?id=<?= $appointment['id'] ?>" class="btn btn-sm btn-outline-danger">Annuler</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">Vous n'avez aucun rendez-vous programmé.</p>
                            <a href="#appointment" class="btn btn-primary">Prendre un rendez-vous</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>