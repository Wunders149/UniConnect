<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">UniConnect</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="#">ACCUEIL</a></li>
                <li class="nav-item"><a class="nav-link" href="#">PUBLICATIONS</a></li>
                <li class="nav-item"><a class="nav-link" href="#">MESSAGERIE</a></li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Rechercher..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Rechercher</button>
            </form>
            <button id="login-btn" class="btn btn-primary ms-2" onclick="window.location.href='login.php';">Connexion</button>
            <button id="logout-btn" class="btn btn-danger ms-2" onclick="window.location.href='logout.php';" style="display:none;">Déconnexion</button>
        </div>
    </div>
</nav>