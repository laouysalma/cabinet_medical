<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hachage du mot de passe avant de le stocker
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Connexion à la base de données
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "cabinet_medical";
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    // Requête SQL avec requête préparée
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    
    if ($stmt->execute()) {
        echo "Compte créé avec succès : $username";
        header("Location: login.php");
        exit();
    } else {
        echo "Erreur : " . $conn->error;
    }

    $conn->close();
}
?>
