<?php
    include '../db.php';

    // Récupérer les cours de la semaine (dernier 7 jours, limite augmentée à 6)
    $sql = "SELECT titre, description, date_debut FROM cours WHERE date_debut >= CURDATE() - INTERVAL 7 DAY ORDER BY date_debut DESC LIMIT 6";
    $result = $conn->query($sql);
    $cours = [];
    while ($row = $result->fetch_assoc()) {
        $cours[] = $row;
    }
?>

<header class="bg-primary text-white p-4 text-center">
    <h1>Écosystème Numérique Universitaire</h1>
    <p>Plateforme web centralisant les services académiques et sociaux</p>
</header>

<main class="container mt-4">
    <!-- Statistiques -->
    <section class="row text-center">
        <div class="col-md-3">
            <div class="stat-box bg-success text-white p-3 rounded">
                <i class="fas fa-university fa-2x"></i>
                <h3>10+</h3>
                <p>Universités</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box bg-info text-white p-3 rounded">
                <i class="fas fa-user-graduate fa-2x"></i>
                <h3>1000+</h3>
                <p>Étudiants inscrits</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box bg-warning text-white p-3 rounded">
                <i class="fas fa-chalkboard-teacher fa-2x"></i>
                <h3>200+</h3>
                <p>Professeurs</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box bg-danger text-white p-3 rounded">
                <i class="fas fa-book fa-2x"></i>
                <h3>500+</h3>
                <p>Cours disponibles</p>
            </div>
        </div>
    </section>

    <!-- Catégories Académiques -->
    <section class="mt-4">
        <h2>Catégories Académiques</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="category-card p-3 bg-light text-center border rounded">
                    <i class="fas fa-code fa-2x text-primary"></i>
                    <h4>Informatique</h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="category-card p-3 bg-light text-center border rounded">
                    <i class="fas fa-flask fa-2x text-success"></i>
                    <h4>Sciences</h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="category-card p-3 bg-light text-center border rounded">
                    <i class="fas fa-business-time fa-2x text-warning"></i>
                    <h4>Économie</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Annonces -->
    <section class="mt-4">
        <h2>Annonces de la dernière semaine</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card p-3">
                    <h5>Conférence sur l’IA</h5>
                    <p>Une conférence sur l'intelligence artificielle aura lieu ce vendredi.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3">
                    <h5>Nouvelle bibliothèque en ligne</h5>
                    <p>Accédez gratuitement à plus de 10 000 livres en ligne.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cours de la semaine -->
    <section class="mt-4">
        <h2>Cours de cette semaine</h2>
        <div id="coursCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php if (!empty($cours)): ?>
                    <?php foreach ($cours as $index => $cours_item): ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="card p-3 text-center">
                                <img src="../images/pdf.png" class="img-fluid" style="width: 50px; height: 50px;" alt="Cours en PDF">
                                <h5><?php echo htmlspecialchars($cours_item['titre']); ?></h5>
                                <p><?php echo htmlspecialchars($cours_item['description']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="carousel-item active">
                        <div class="alert alert-info">Aucun cours disponible cette semaine.</div>
                    </div>
                <?php endif; ?>
            </div>
            <a class="carousel-control-prev" href="#coursCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="false"></span>
                <span class="visually-hidden">Précédent</span>
            </a>
            <a class="carousel-control-next" href="#coursCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="false"></span>
                <span class="visually-hidden">Suivant</span>
            </a>
        </div>
    </section>
</main>