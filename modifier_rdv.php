<?php
session_start();

// Vérification de la connexion
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit;
}

// Configuration directe de la base de données
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "cabinet_medical";

// Connexion à la base de données
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}

// Récupération de l'ID du rendez-vous
$rdv_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$patient_id = (int)$_SESSION['patient_id'];

// Vérification que le RDV appartient bien à l'utilisateur
$stmt = $conn->prepare("SELECT * FROM rdv WHERE id = ? AND patient_id = ?");
$stmt->bind_param("ii", $rdv_id, $patient_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: mes_rdv.php?error=rdv_not_found");
    exit;
}

$rdv = $result->fetch_assoc();

// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation des données
    $rdv_date = $_POST['rdv_date'] ?? '';
    $rdv_time = $_POST['rdv_time'] ?? '';
    
    if (empty($rdv_date) || empty($rdv_time)) {
        header("Location: modifier_rdv.php?id=$rdv_id&error=missing_fields");
        exit;
    }

    // Mise à jour du rendez-vous
    $update_stmt = $conn->prepare("UPDATE rdv SET rdv_date = ?, rdv_time = ? WHERE id = ? AND patient_id = ?");
    $update_stmt->bind_param("ssii", $rdv_date, $rdv_time, $rdv_id, $patient_id);
    
    if ($update_stmt->execute()) {
        header("Location: mes_rdv.php?success=rdv_updated");
    } else {
        header("Location: modifier_rdv.php?id=$rdv_id&error=update_failed");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 600px; margin-top: 50px; }
        .form-group { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Modifier le Rendez-vous</h2>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                switch($_GET['error']) {
                    case 'missing_fields': echo "Veuillez remplir tous les champs"; break;
                    case 'update_failed': echo "Erreur lors de la mise à jour"; break;
                    default: echo "Une erreur est survenue";
                }
                ?>
            </div>
        <?php endif; ?>
        
        <form method="post">
            <div class="form-group">
                <label for="rdv_date">Date:</label>
                <input type="date" class="form-control" id="rdv_date" name="rdv_date" 
                       value="<?= htmlspecialchars($rdv['rdv_date']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="rdv_time">Heure:</label>
                <input type="time" class="form-control" id="rdv_time" name="rdv_time" 
                       value="<?= htmlspecialchars($rdv['rdv_time']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Médecin:</label>
                <p class="form-control-static"><?= htmlspecialchars($rdv['doctor']) ?></p>
            </div>
            
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="mes_rdv.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>