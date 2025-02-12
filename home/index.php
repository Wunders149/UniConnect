<?php
session_start();
$user_logged_in = isset($_SESSION['user']);
$user_name = $user_logged_in ? $_SESSION['user']['name'] : '';
$user_profile_pic = $user_logged_in ? $_SESSION['user']['profile_pic'] : 'default_profile.png';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniConnect - Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .navbar .container-fluid {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-nav {
            flex: 1;
            justify-content: center;
        }
        .search-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <?php include "../nav/navBar.php" ?>
    <div class="container mt-4">
        
        <!-- Blog de publicité -->
        <section>
            <h2>Publicités et Annonces</h2>
            <p>Découvrez les dernières actualités et événements de l'université.</p>
        </section>
        
        <!-- Section des cours -->
        <section class="mt-4">
            <h2>Cours disponibles</h2>
            <p>Accédez aux ressources académiques et améliorez vos compétences.</p>
            <a href="courses.php" class="btn btn-info">Voir les cours</a>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
