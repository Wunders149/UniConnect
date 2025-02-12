<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">UniConnect</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#">ACCUEIL</a></li>
                <li class="nav-item"><a class="nav-link" href="#">PUBLICATIONS</a></li>
                <li class="nav-item"><a class="nav-link" href="#">MESSAGERIE</a></li>
            </ul>
        </div>
        <div class="search-profile">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Rechercher..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Rechercher</button>
            </form>
            <div class="user-profile">
                <?php if ($user_logged_in): ?>
                    <img src="<?php echo $user_profile_pic; ?>" alt="Profile">
                    <span><?php echo $user_name; ?></span>
                    <button class="btn btn-danger ms-2" onclick="window.location.href='logout.php';">Déconnexion</button>
                <?php else: ?>
                    <button class="btn btn-primary" onclick="window.location.href='login.php';">Connexion</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>