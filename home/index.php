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
    <!-- Intégration de Google Fonts et FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
        font-family: 'Poppins', sans-serif;
    }
    
    .navbar {
        padding: 10px 20px;
    }
    
    .navbar-brand {
        font-weight: 600;
        font-size: 1.3rem;
    }

    .navbar-nav .nav-link {
        font-weight: 500;
        font-size: 1.1rem;
        margin-right: 15px;
    }

    .search-profile {
        display: flex;
        align-items: center;
    }

    .user-profile img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
    }

    .btn {
        font-size: 0.9rem;
    }
    /* Effet de survol pour les éléments du menu */
    .navbar-nav .nav-link {
        transition: background-color 0.3s, color 0.3s;
    }

    .navbar-nav .nav-link:hover {
        text-decoration: underline;
    }
    </style>
</head>
<body>
    <?php include "./nav/navBar.php" ?>
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
