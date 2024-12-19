<?php
session_start();
require 'includes/db_connect.php';

// Vérifiez si l'utilisateur est connecté et est admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit();
}

// Récupère les utilisateurs modérateurs
$stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE role = 'admin'");
$stmt->execute();
$moderators = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupère les utilisateurs joueurs
$stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE role = 'player'");
$stmt->execute();
$players = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            text-align: left;
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        a:hover {
            background-color: #0056b3;
        }
        .password {
            cursor: pointer;
            color: #007BFF;
            text-decoration: underline;
        }
        .password:hover {
            color: #0056b3;
        }
        .button_mdp{
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .button_mdp:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function togglePasswordVisibility(element) {
            const passwordElement = element.previousElementSibling;
            if (passwordElement.type === 'password') {
                passwordElement.type = 'text';
                element.textContent = 'Cacher';
            } else {
                passwordElement.type = 'password';
                element.textContent = 'Afficher';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Liste des Utilisateurs</h1>

        <h2>Modérateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Mot de passe</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($moderators as $moderator): ?>
                    <tr>
                        <td><?= htmlspecialchars($moderator['id']); ?></td>
                        <td><?= htmlspecialchars($moderator['username']); ?></td>
                        <td>
                            <input type="password" value="<?= htmlspecialchars($moderator['password']); ?>" readonly>
                            <span class="password,button_mdp" onclick="togglePasswordVisibility(this)">Afficher</span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Joueurs</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Mot de passe</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($players as $player): ?>
                    <tr>
                        <td><?= htmlspecialchars($player['id']); ?></td>
                        <td><?= htmlspecialchars($player['username']); ?></td>
                        <td>
                            <input type="password" value="<?= htmlspecialchars($player['password']); ?>" readonly>
                            <span class="password,button_mdp" onclick="togglePasswordVisibility(this)">Afficher</span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="admin_manage.php">Retour au tableau de bord</a>
    </div>
</body>
</html>
