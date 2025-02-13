<?php
session_start();
$user_logged_in = isset($_SESSION['user']);
$user_name = $user_logged_in ? $_SESSION['user']['name'] : '';
$user_profile_pic = $user_logged_in ? $_SESSION['user']['profile_pic'] : 'default_profile.png';
require_once "../db.php";

// Vérification de l'authentification
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Publier un message
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["post_content"])) {
    $content = trim($_POST["post_content"]);
    $filePath = null;

    if (!empty($_FILES["post_file"]["name"])) {
        $targetDir = "uploads/";
        $fileName = time() . "_" . basename($_FILES["post_file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif", "mp4", "pdf", "doc", "docx"];
        $maxSize = 5 * 1024 * 1024;

        if (in_array($fileType, $allowedTypes) && $_FILES["post_file"]["size"] <= $maxSize) {
            if (move_uploaded_file($_FILES["post_file"]["tmp_name"], $targetFilePath)) {
                $filePath = $targetFilePath;
            }
        }
    }

    $stmt = $conn->prepare("INSERT INTO publication (etudiant_id, contenu, fichier) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $content, $filePath);
    $stmt->execute();
    $stmt->close();
}

// Publier un commentaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment_content"])) {
    $comment = trim($_POST["comment_content"]);
    $publication_id = $_POST["publication_id"];

    $stmt = $conn->prepare("INSERT INTO commentaire (publication_id, etudiant_id, contenu) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $publication_id, $user_id, $comment);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fil d'actualité</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Styles généraux */
        /* body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        } */

        .container {
            margin-top: 30px;
        }

        .card {
            border-radius: 15px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
        }

        .post-header {
            display: flex;
            align-items: center;
            padding: 15px;
        }

        .post-header img {
            border-radius: 50%;
            margin-right: 10px;
        }

        .post-content p {
            font-size: 1.1rem;
        }

        .file-preview img, .file-preview video {
            width: 100%;
            border-radius: 8px;
            max-height: 300px;
            object-fit: cover;
        }

        .file-preview {
            margin-top: 10px;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
        }

        .btn-primary {
            border-radius: 50px;
            width: 100%;
            padding: 10px;
        }

        .btn-primary:hover {
            background-color: #007bff;
        }

        .comment {
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 8px;
            margin-top: 10px;
        }

        /* Section d'édition de message */
        .form-group textarea {
            border-radius: 10px;
            padding: 10px;
            width: 100%;
            min-height: 120px;
        }

        .file-upload-btn {
            padding: 10px 20px;
            background-color: #f1f1f1;
            border-radius: 5px;
            margin-top: 10px;
        }

        .file-upload-btn:hover {
            background-color: #e2e2e2;
        }
    </style>
</head>
<body>
    <?php include "../nav/navBar.php" ?>
    <div class="container">
        <!-- Formulaire de publication -->
        <div class="card shadow-sm p-4">
            <h2 class="mb-3">Publier un message</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <textarea name="post_content" class="form-control" required placeholder="Exprimez-vous..."></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="post_file" class="form-label">Ajouter un fichier</label>
                    <input type="file" name="post_file" id="post_file" class="form-control" accept="image/*,video/mp4,.pdf,.doc,.docx">
                </div>
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-paper-plane"></i> Publier
                </button>
            </form>
        </div>

        <!-- Affichage des publications -->
        <?php
        $posts = $conn->query("SELECT publication.*, etudiant.nom, etudiant.prenom FROM publication JOIN etudiant ON publication.etudiant_id = etudiant.id ORDER BY publication.date_publication DESC");
        while ($post = $posts->fetch_assoc()):
        ?>
            <div class="card">
                <div class="post-header">
                    <img src="https://via.placeholder.com/40" alt="Profil">
                    <strong><?php echo htmlspecialchars($post["nom"] . " " . $post["prenom"]); ?></strong> - <?php echo $post["date_publication"]; ?>
                </div>
                <div class="post-content">
                    <p><?php echo nl2br(htmlspecialchars($post["contenu"])); ?></p>

                    <?php if (!empty($post["fichier"])): ?>
                        <?php $fileType = strtolower(pathinfo($post["fichier"], PATHINFO_EXTENSION)); ?>
                        <?php if (in_array($fileType, ["jpg", "jpeg", "png", "gif"])): ?>
                            <div class="file-preview">
                                <img src="<?php echo htmlspecialchars($post["fichier"]); ?>" alt="Image">
                            </div>
                        <?php elseif ($fileType == "mp4"): ?>
                            <div class="file-preview">
                                <video controls>
                                    <source src="<?php echo htmlspecialchars($post["fichier"]); ?>" type="video/mp4">
                                </video>
                            </div>
                        <?php else: ?>
                            <p><a href="<?php echo htmlspecialchars($post["fichier"]); ?>" target="_blank">📄 Voir le fichier</a></p>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Formulaire de commentaire -->
                    <form method="POST">
                        <input type="hidden" name="publication_id" value="<?php echo $post['id']; ?>">
                        <input type="text" name="comment_content" class="form-control" required placeholder="Ajouter un commentaire...">
                        <button type="submit" class="btn btn-primary mt-2">Commenter</button>
                    </form>

                    <!-- Affichage des commentaires -->
                    <?php
                    $comments = $conn->query("SELECT commentaire.*, etudiant.nom, etudiant.prenom FROM commentaire JOIN etudiant ON commentaire.etudiant_id = etudiant.id WHERE publication_id = " . $post["id"]);
                    while ($comment = $comments->fetch_assoc()): ?>
                        <div class="comment">
                            <p><strong><?php echo htmlspecialchars($comment["nom"] . " " . $comment["prenom"]); ?></strong> - <?php echo $comment["date_commentaire"]; ?></p>
                            <p><?php echo nl2br(htmlspecialchars($comment["contenu"])); ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
