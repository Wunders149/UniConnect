<style>
    body {
    padding-top: 56px; /* Ajuste selon la hauteur de ta navbar */
}
</style>

<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #007bff;">
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
                    <a class="nav-link text-light" href="#"><i class="fa-solid fa-calendar-days"></i> EVENEMENT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#"><i class="fa-solid fa-envelope"></i> NOTIFICATIONS </a>
                </li>
                <!-- ESPACE ETUDIANT avec sous-menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="espaceEtudiantDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-users"></i> ESPACE ETUDIANT
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="espaceEtudiantDropdown">
                        <li><a class="dropdown-item" href="../cours/index.php"><i class="fa-solid fa-book"></i> Cours</a></li>
                        <li><a class="dropdown-item" href="../schedule/index.php"><i class="fa-solid fa-calendar"></i> Emploi du temps</a></li>
                    </ul>
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