<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #007bff;">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">
            <i class="fas fa-university"></i> UniConnect
        </a>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Rechercher..." aria-label="Search">
            <button class="btn btn-outline-light" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse align-items-center" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" href="#"><i class="fas fa-home"></i> ACCUEIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#"><i class="fas fa-newspaper"></i> EVENEMENT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#"><i class="fas fa-enveloppe"></i> NOTIFICATIONS </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#"><i class="fas fa-comments"></i> ESPACE ETUDIANT</a>
                </li>
            </ul>
        </div>
        <div class="search-profile d-flex align-items-center">
            <div class="user-profile ms-3 d-flex align-items-center">
                <?php if ($user_logged_in): ?>
                    <img src="<?php echo $user_profile_pic; ?>" alt="Profile" class="rounded-circle" width="40" height="40">
                    <span class="ms-2 text-white"><?php echo $user_name; ?></span>
                    <button class="btn btn-danger ms-2" onclick="window.location.href='logout.php';">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                <?php else: ?>
                    <button class="btn btn-light ms-2" onclick="window.location.href='login.php';">
                        <i class="fas fa-sign-in-alt"></i>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>