<?php
session_start();
include_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">Game Store</div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="games.php">Games</a></li>
                <li><a href="premium.php">Premium</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <section class="featured-games">
            <h2>Featured Games</h2>
            <?php
            $database = new Database();
            $db = $database->getConnection();
            
            $query = "SELECT * FROM Games ORDER BY release_date DESC LIMIT 6";
            $stmt = $db->prepare($query);
            $stmt->execute();
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='game-card'>";
                echo "<img src='" . htmlspecialchars($row['image_url']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                echo "<p class='price'>$" . htmlspecialchars($row['price']) . "</p>";
                echo "<a href='game_details.php?id=" . $row['game_id'] . "' class='btn'>View Details</a>";
                echo "</div>";
            }
            ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Game Store. All rights reserved.</p>
    </footer>
</body>
</html>
