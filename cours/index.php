<?php
session_start();
$user_logged_in = isset($_SESSION['user']);
$user_name = $user_logged_in ? $_SESSION['user']['name'] : '';
$user_profile_pic = $user_logged_in ? $_SESSION['user']['profile_pic'] : 'default_profile.png';

include '../db.php';

// Traitement du formulaire de publication de cours
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['publish_course'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $filiere_id = $_POST['filiere_id'];

    $sql = "INSERT INTO cours (titre, description, date_debut, date_fin, filiere_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $titre, $description, $date_debut, $date_fin, $filiere_id);
    $stmt->execute();
    $stmt->close();

    $success_message = "Cours publié avec succès.";
}

// Récupération des filières pour le formulaire
$filieres_sql = "SELECT id, nom FROM filiere";
$filieres_result = $conn->query($filieres_sql);
$filieres = [];
while ($filiere = $filieres_result->fetch_assoc()) {
    $filieres[] = $filiere;
}
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

    <div class="container mt-5">
        <h1 class="mb-4">Liste des cours</h1>

        <!-- Formulaire de publication de cours -->
        <!-- <div class="card mb-4">
            <div class="card-header">Publier un nouveau cours</div>
            <div class="card-body">
                <?php if (isset($success_message)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo htmlspecialchars($success_message); ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="date_debut" class="form-label">Date de début</label>
                        <input type="date" class="form-control" id="date_debut" name="date_debut" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date de fin</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin" required>
                    </div>
                    <div class="mb-3">
                        <label for="filiere_id" class="form-label">Filière</label>
                        <select class="form-select" id="filiere_id" name="filiere_id" required>
                            <?php foreach ($filieres as $filiere): ?>
                                <option value="<?php echo htmlspecialchars($filiere['id']); ?>">
                                    <?php echo htmlspecialchars($filiere['nom']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="publish_course" class="btn btn-primary">Publier</button>
                </form>
            </div>
        </div> -->

        <!-- Filtres de recherche -->
        <div class="mb-4">
            <label for="filiere_filter" class="form-label">Filtrer par filière</label>
            <select class="form-select" id="filiere_filter">
                <option value="">Toutes les filières</option>
                <?php foreach ($filieres as $filiere): ?>
                    <option value="<?php echo htmlspecialchars($filiere['id']); ?>">
                        <?php echo htmlspecialchars($filiere['nom']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Liste des cours -->
        <div class="row" id="cours-list">
            <?php
            $sql = "SELECT c.*, f.nom AS filiere_nom FROM cours c JOIN filiere f ON c.filiere_id = f.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4" data-filiere="' . htmlspecialchars($row["filiere_id"]) . '">';
                    echo '<div class="card h-100">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . htmlspecialchars($row["titre"]) . '</h5>';
                    echo '<p class="card-text">' . htmlspecialchars($row["description"]) . '</p>';
                    echo '<p class="card-text"><small class="text-muted">Du ' . htmlspecialchars($row["date_debut"]) . ' au ' . htmlspecialchars($row["date_fin"]) . '</small></p>';
                    echo '<span class="badge bg-primary">' . htmlspecialchars($row["filiere_nom"]) . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="alert alert-info" role="alert">Aucun cours disponible.</div>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('filiere_filter').addEventListener('change', function() {
            const filiereId = this.value;
            const coursList = document.getElementById('cours-list');
            const coursItems = coursList.getElementsByClassName('col-md-4');

            for (let i = 0; i < coursItems.length; i++) {
                const coursItem = coursItems[i];
                if (filiereId === '' || coursItem.getAttribute('data-filiere') === filiereId) {
                    coursItem.style.display = '';
                } else {
                    coursItem.style.display = 'none';
                }
            }
        });
    </script>
</body>
</html>