<?php
require 'includes/db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    // Préparer la requête SQL
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch();
    $_SESSION['username'] = $user['username']; // Assurez-vous que $user contient les informations de l'utilisateur connecté


    // Vérification des identifiants
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: player.php');
        }
        exit();
    } else {
        echo "<p style='color: red; text-align: center;'>Nom d'utilisateur ou mot de passe incorrect.</p>";
    }
} else {
    echo "<p style='color: red; text-align: center;'>Méthode non autorisée.</p>";
}
?>
