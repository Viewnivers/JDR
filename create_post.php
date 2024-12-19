<?php
// Start the session to access session variables
session_start();
// Include the database connection file
require 'includes/db_connect.php';

// Check if the user is logged in and is an admin; otherwise, redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit();
}

// Check if the form has been submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and trim the input data from the form
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    // Check if both fields are non-empty
    if (!empty($title) && !empty($content)) {
        try {
            // Prepare an SQL statement to insert a new post into the database
            $stmt = $pdo->prepare("INSERT INTO post (title, content, created_at) VALUES (?, ?, NOW())");
            $stmt->execute([$title, $content]);

            // Display a success message
            echo "<p>Post créé avec succès !</p>";
        } catch (PDOException $e) {
            // Display an error message if the statement fails
            echo "<p>Erreur lors de la création du post : " . $e->getMessage() . "</p>";
        }
    } else {
        // Display a message if any field is left empty
        echo "<p>Veuillez remplir tous les champs.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Post</title>
    <style>
        /* Basic styling for the page */
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
        /* Styling for the main container */
        .container {
            text-align: center;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        /* Styling for the header */
        h1 {
            color: #333;
        }
        /* Styling for form groups */
        .form-group {
            margin-bottom: 15px;
        }
        /* Styling for form labels */
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        /* Styling for input fields and textarea */
        input, textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        /* Styling for the submit button */
        button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        /* Hover effect for the button */
        button:hover {
            background-color: #0056b3;
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
    <!-- Main container for creating a post -->
    <div class="container">
        <h1>Créer un Post</h1>
        <!-- Form for post creation -->
        <form method="POST" action="create_post.php">
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Contenu</label>
                <textarea id="content" name="content" rows="5" required></textarea>
            </div>
            <button type="submit">Créer</button>
            
        </form>
        <a href="admin_manage.php" class="btn">Retour au tableau de bord</a>
    </div>
    
</body>
</html>
