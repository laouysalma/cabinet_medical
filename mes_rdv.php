<?php
session_start();

// Vérification de la connexion
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit;
}

// Configuration DB
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "cabinet_medical";

// Connexion
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

// Récupération des RDV
$patient_id = (int)$_SESSION['patient_id'];
$stmt = $conn->prepare("SELECT id, rdv_date, rdv_time, doctor FROM rdv WHERE patient_id = ? ORDER BY rdv_date, rdv_time");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .rdv-card { transition: all 0.3s; }
        .rdv-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container py-5">
        <h2 class="mb-4">Mes Rendez-vous</h2>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?= $_GET['success'] === 'rdv_updated' ? 'Rendez-vous mis à jour' : 'Action réussie' ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-6 mb-4">
                    <div class="card rdv-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['doctor']) ?></h5>
                            <p class="card-text">
                                <i class="far fa-calendar-alt"></i> <?= date('d/m/Y', strtotime($row['rdv_date'])) ?>
                                <br>
                                <i class="far fa-clock"></i> <?= substr($row['rdv_time'], 0, 5) ?>
                            </p>
                            <div class="d-flex justify-content-between">
                                <a href="modifier_rdv.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">
                                    Modifier
                                </a>
                                <a href="supprimer_rdv.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('Confirmer la suppression?')">
                                    Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info">
                        Aucun rendez-vous prévu. <a href="test.html#rdv" class="alert-link">Prendre un rendez-vous</a>.
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!empty($logout_message)): ?>
    <div class="alert alert-success"><?= $logout_message ?></div>
<?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
<?php
$conn->close();
?>