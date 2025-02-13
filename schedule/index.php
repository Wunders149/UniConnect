<?php
session_start();
$user_logged_in = isset($_SESSION['user']);
$user_name = $user_logged_in ? $_SESSION['user']['name'] : '';
$user_profile_pic = $user_logged_in ? $_SESSION['user']['profile_pic'] : 'default_profile.png';

include '../db.php';

// Récupération des filières
$filieres_sql = "SELECT id, nom FROM filiere";
$filieres_result = $conn->query($filieres_sql);
$filieres = [];
while ($filiere = $filieres_result->fetch_assoc()) {
    $filieres[] = $filiere;
}

// Récupération des cours et emplois du temps
$cours_sql = "SELECT c.*, f.id AS filiere_id, f.nom AS filiere_nom, e.jour, e.heure_debut, e.heure_fin, e.salle
              FROM cours c
              JOIN filiere f ON c.filiere_id = f.id
              JOIN emploi_du_temps e ON c.id = e.cours_id
              ORDER BY f.nom, c.titre, e.jour, e.heure_debut";
$cours_result = $conn->query($cours_sql);
$cours = [];
while ($row = $cours_result->fetch_assoc()) {
    $cours[] = $row;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniConnect - Emploi du Temps</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .timetable th, .timetable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .timetable th {
            background-color: #f2f2f2;
        }
        .timetable-container {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body>
    <?php include '../nav/navBar.php'; ?>

    <div class="container mt-5">
        <h1 class="mb-4">Emploi du Temps</h1>

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

        <!-- Emploi du temps -->
        <div id="timetable-container">
            <?php foreach ($filieres as $filiere): ?>
                <h2 class="mt-4"><?php echo htmlspecialchars($filiere['nom']); ?></h2>
                <table class="table table-bordered timetable" data-filiere-id="<?php echo htmlspecialchars($filiere['id']); ?>">
                    <thead>
                        <tr>
                            <th>Heure</th>
                            <th>Lundi</th>
                            <th>Mardi</th>
                            <th>Mercredi</th>
                            <th>Jeudi</th>
                            <th>Vendredi</th>
                            <th>Samedi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                        $time_slots = ['08:00-10:00', '10:00-12:00', '12:00-14:00', '14:00-16:00', '16:00-18:00'];

                        foreach ($time_slots as $slot) {
                            list($start, $end) = explode('-', $slot);
                            $start_time = strtotime($start);
                            $end_time = strtotime($end);

                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($slot) . '</td>';

                            foreach ($days as $day) {
                                $course = '';
                                foreach ($cours as $row) {
                                    if ($row['filiere_id'] == $filiere['id'] && $row['jour'] == $day) {
                                        $row_start = strtotime($row['heure_debut']);
                                        $row_end = strtotime($row['heure_fin']);

                                        if ($row_start >= $start_time && $row_end <= $end_time) {
                                            $course = '<strong>' . htmlspecialchars($row['titre']) . '</strong><br>' . 
                                                      htmlspecialchars($row['salle']);
                                            break;
                                        }
                                    }
                                }
                                echo '<td>' . ($course ?: '-') . '</td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('filiere_filter').addEventListener('change', function() {
            const filiereId = this.value;
            document.querySelectorAll('.timetable').forEach(table => {
                if (filiereId === '' || table.dataset.filiereId === filiereId) {
                    table.style.display = 'table';
                    table.previousElementSibling.style.display = 'block';
                } else {
                    table.style.display = 'none';
                    table.previousElementSibling.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>