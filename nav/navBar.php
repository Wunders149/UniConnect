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
</style>

<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="fas fa-university"></i> UniConnect
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-home"></i> ACCUEIL</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-newspaper"></i> PUBLICATIONS</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-comments"></i> MESSAGERIE</a></li>
            </ul>
        </div>
        <div class="search-profile">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Rechercher..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="user-profile ms-3 d-flex align-items-center">
                <?php if ($user_logged_in): ?>
                    <img src="<?php echo $user_profile_pic; ?>" alt="Profile">
                    <span class="ms-2"><?php echo $user_name; ?></span>
                    <button class="btn btn-danger ms-2" onclick="window.location.href='logout.php';">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                <?php else: ?>
                    <button class="btn btn-primary ms-2" onclick="window.location.href='login.php';">
                        <i class="fas fa-sign-in-alt"></i>
                    </button>
                <?php endif; ?>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</nav>