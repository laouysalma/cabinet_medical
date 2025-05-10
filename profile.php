<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data from database
$conn = new mysqli("localhost", "root", "", "cabinet_medical");
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['patient_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-card {
            max-width: 600px;
            margin-top: 50px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="card profile-card mx-auto p-4">
            <div class="card-body text-center">
                <h2 class="card-title text-primary mb-4">Bienvenue, <?= htmlspecialchars($user['username']) ?></h2>
                
                <div class="mb-4 p-3 bg-light rounded">
                    <p class="mb-1"><strong>Email:</strong></p>
                    <p class="text-muted"><?= htmlspecialchars($user['email']) ?></p>
                </div>
                
                <div class="d-flex justify-content-center gap-3">
                    <a href="mes_rdv.php" class="btn btn-primary px-4">
                        <i class="fas fa-calendar-alt me-2"></i>Mes rendez-vous
                    </a>
                    <a href="logout.php" class="btn btn-danger px-4">
                        <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                    </a>
                               <div class="profile-links">
                   <a href="test.html" class="profile-link home">
                    <i class="fas fa-home"></i> revenir au site
                   </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome pour les icônes -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>