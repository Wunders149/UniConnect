<?php
session_start();
$user_logged_in = isset($_SESSION['user']);
$user_name = $user_logged_in ? $_SESSION['user']['name'] : '';
$user_profile_pic = $user_logged_in ? $_SESSION['user']['profile_pic'] : 'default_profile.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniConnect - Cours</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Intégration de Google Fonts et FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include '../nav/navBar.php'; ?>
    <?php include '../db.php'; ?>

    <h1>Liste des cours</h1>

    <?php
    $sql = "SELECT * FROM cours";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='card mb-3'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $row["titre"] . "</h5>";
            echo "<p class='card-text'>" . $row["description"] . "</p>";
            echo "<p class='card-text'><small class='text-muted'>Du " . $row["date_debut"] . " au " . $row["date_fin"] . "</small></p>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "Aucun cours disponible.";
    }
    ?>
</body>
</html>