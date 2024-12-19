<!-- delete_player.php -->
<?php
session_start();
require 'includes/db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));

    if ($username) {
        $stmt = $pdo->prepare('DELETE FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $success = "Le joueur a été supprimé avec succès.";
    } else {
        $error = "Veuillez fournir un nom d'utilisateur.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un Joueur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .message {
            text-align: center;
            color: red;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
        }
        input, button {
            margin-top: 5px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #FF4D4D;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #E60000;
        }
        .back {
            text-align: center;
            margin-top: 10px;
        }
        .back a {
            text-decoration: none;
            color: #007BFF;
        }
        .back a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Supprimer un Joueur</h1>
        <?php if (isset($error)) echo "<p class='message'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p class='message' style='color: green;'>$success</p>"; ?>

        <form method="POST" action="">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>

            <button type="submit">Supprimer</button>
        </form>

        <div class="back">
            <a href="admin_manage.php">Retour à la gestion des joueurs</a>
        </div>
    </div>
</body>
</html>
