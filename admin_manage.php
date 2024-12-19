<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Joueurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        .btn {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn.danger {
            background-color: #ff4d4d;
        }
        .btn.danger:hover {
            background-color: #e60000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestion des Joueurs</h1>
        <p>Bienvenue sur la page de gestion des joueurs. Ici, vous pouvez ajouter ou supprimer des utilisateurs.</p>

        <!-- Bouton pour voir la liste des joueurs -->
        <a href="list_users.php" class="btn">Liste des joueurs</a>

        <!-- Bouton pour ajouter un joueur -->
        <a href="add_player.php" class="btn">Ajouter un joueur</a>

        <!-- Bouton pour supprimer un joueur -->
        <a href="delete_player.php" class="btn danger">Supprimer un joueur</a>

        <!-- Bouton pour créer un post -->
        <a href="create_post.php" class="btn">Créer un post</a>

        <!-- Retour au tableau de bord -->
        <a href="admin.php" class="btn">Retour au tableau de bord</a>
    </div>
</body>
</html>
