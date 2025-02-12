<?php
session_start();
$user_logged_in = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniConnect - Accueil</title>
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <script>
        function toggleLogin() {
            let loginBtn = document.getElementById('login-btn');
            let logoutBtn = document.getElementById('logout-btn');
            if (<?php echo json_encode($user_logged_in); ?>) {
                loginBtn.style.display = 'none';
                logoutBtn.style.display = 'block';
            } else {
                loginBtn.style.display = 'block';
                logoutBtn.style.display = 'none';
            }
        }
    </script>
</head>
<body onload="toggleLogin()">
    
    <?php include '../nav/navBar.php'; ?>

    <!-- <div class="container mt-4"> -->
        
        <!-- Blog de publicité -->
        <!-- <section>
            <h2>Publicités et Annonces</h2>
            <p>Découvrez les dernières actualités et événements de l'université.</p>
        </section> -->
        
        <!-- Section des cours -->
        <!-- <section class="mt-4">
            <h2>Cours disponibles</h2>
            <p>Accédez aux ressources académiques et améliorez vos compétences.</p>
            <a href="courses.php" class="btn btn-info">Voir les cours</a>
        </section> -->
    <!-- </div> -->

    <script src="../styles/bootstrap.bundle.min.js"></script>
</body>
</html>