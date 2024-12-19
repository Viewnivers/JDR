<?php
// Start the session to access session variables
session_start();
// Include the database connection file
require 'includes/db_connect.php';

// Fetch all posts from the database
$stmt = $pdo->prepare("SELECT title, content, created_at FROM post ORDER BY created_at DESC");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Publics</title>
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
            padding: 20px;
        }
        /* Styling for the main container */
        .container {
            text-align: center;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }
        /* Styling for the posts */
        .post {
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .post h2 {
            margin: 0;
            color: #333;
        }
        .post p {
            margin: 5px 0;
        }
        .post .date {
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Main container for displaying posts -->
    <div class="container">
        <h1>Posts Publics</h1>
        <?php if (count($posts) > 0): ?>
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                    <p class="date"><?php echo date('d M Y', strtotime($post['created_at'])); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun post à afficher pour le moment.</p>
        <?php endif; ?>
    </div>
</body>
</html>
