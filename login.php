<?php
session_start();

// Configuration de la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "cabinet_medical";

// Connexion MySQLi
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Gestion des messages
if (isset($_GET['logout']) && $_GET['logout'] === 'success') {
    $logout_message = "Vous avez été déconnecté avec succès";
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Requête préparée sécurisée
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['patient_id'] = $id;
            
            // Redirection intelligente
            $redirect_url = $_SESSION['redirect_url'] ?? 'profile.php';
            unset($_SESSION['redirect_url']);
            header("Location: $redirect_url");
            exit();
        } else {
            $login_error = "Mot de passe incorrect.";
        }
    } else {
        $login_error = "Email non trouvé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Connexion</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($logout_message)): ?>
                            <div class="alert alert-success"><?= $logout_message ?></div>
                        <?php endif; ?>
                        
                        <?php if (isset($login_error)): ?>
                            <div class="alert alert-danger"><?= $login_error ?></div>
                        <?php endif; ?>
                        
                        <form method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>