
<?php
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "cabinet_medical";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Sécurisation des entrées (toujours mettre des guillemets autour des clés du tableau $_POST)
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Préparer la requête SQL (exemple pour insérer dans une table 'messages')
$sql = "INSERT INTO messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Message envoyé avec succès.";
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
