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
    <title>Tableau de bord Admin</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
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
        .logout {
            margin-top: 20px;
            color: white;
            background-color: #ff4d4d;
        }
        .logout:hover {
            background-color: #e60000;
        }
    </style>
</head>
<body>
    <h1>Bienvenue Admin</h1>
    <p>Choisissez l'action que vous souhaitez effectuer :</p>

    <!-- Bouton vers la page publique -->
    <a href="public.php" class="btn">Accéder à la page publique</a>

    <!-- Bouton vers la gestion des joueurs -->
    <a href="admin_manage.php" class="btn">Gérer les joueurs</a>

    <!-- Bouton de déconnexion -->
    <a href="logout.php" class="btn logout">Se déconnecter</a>
</body>
</html>
