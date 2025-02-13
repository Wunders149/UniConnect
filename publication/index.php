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
    /* Fixe le formulaire à gauche */
    .sticky-form {
        position: sticky;
        top: 30%;
        height: fit-content;
        width: 100%;
    }
    /* Style des publications */
    .post-card {
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .post-header {
        background: #f8f9fa;
        padding: 10px 15px;
        display: flex;
        align-items: center;
    }
    .post-header img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        margin-right: 10px;
    }
    .post-content {
        padding: 15px;
    }
    .file-preview {
        margin-top: 10px;
        text-align: center;
    }
    .file-preview img {
        max-width: 100%;
        border-radius: 5px;
    }
    .comment-box {
        padding: 10px;
        border-top: 1px solid #ddd;
    }
    </style>
</head>
<body>
    <?php include "../nav/navBar.php" ?>
    <div class="container mt-4">
    <div class="row">
        <!-- Formulaire fixé à gauche -->
        <div class="col-md-4">
            <div class="card sticky-form p-3">
                <h5 class="mb-3">Publier un message</h5>
                <form method="POST" enctype="multipart/form-data">
                    <textarea name="post_content" class="form-control mb-2" rows="3" required placeholder="Exprimez-vous..."></textarea>
                    <input type="file" name="post_file" class="form-control mb-2" accept="image/*,video/mp4,.pdf,.doc,.docx">
                    <button class="btn btn-primary w-100" type="submit"><i class="fas fa-paper-plane"></i> Publier</button>
                </form>
            </div>
        </div>

        <!-- Publications affichées à droite -->
        <div class="col-md-8">
            <?php
            $posts = $conn->query("SELECT publication.*, etudiant.nom, etudiant.prenom FROM publication JOIN etudiant ON publication.etudiant_id = etudiant.id ORDER BY publication.date_publication DESC");
            while ($post = $posts->fetch_assoc()): ?>
                <div class="card post-card mb-3">
                    <div class="post-header">
                        <img src="https://via.placeholder.com/40" alt="Profil">
                        <div>
                            <strong><?php echo htmlspecialchars($post["nom"] . " " . $post["prenom"]); ?></strong>
                            <p class="text-muted small mb-0"> <?php echo $post["date_publication"]; ?> </p>
                        </div>
                    </div>
                    <div class="post-content">
                        <p><?php echo nl2br(htmlspecialchars($post["contenu"])); ?></p>

                        <?php if (!empty($post["fichier"])): ?>
                            <div class="file-preview">
                                <?php 
                                    $fileType = strtolower(pathinfo($post["fichier"], PATHINFO_EXTENSION)); 
                                    if (in_array($fileType, ["jpg", "jpeg", "png", "gif"])): ?>
                                        <img src="<?php echo htmlspecialchars($post["fichier"]); ?>" alt="Image">
                                    <?php elseif ($fileType == "mp4"): ?>
                                        <video controls class="w-100">
                                            <source src="<?php echo htmlspecialchars($post["fichier"]); ?>" type="video/mp4">
                                        </video>
                                    <?php elseif ($fileType == "pdf"): ?>
                                        <a href="<?php echo htmlspecialchars($post["fichier"]); ?>" target="_blank" class="btn btn-danger">
                                            <i class="fas fa-file-pdf"></i> Voir le PDF
                                        </a>
                                    <?php elseif (in_array($fileType, ["doc", "docx"])): ?>
                                        <a href="<?php echo htmlspecialchars($post["fichier"]); ?>" target="_blank" class="btn btn-primary">
                                            <i class="fas fa-file-word"></i> Voir le Document
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo htmlspecialchars($post["fichier"]); ?>" target="_blank" class="btn btn-secondary">
                                            📄 Voir le fichier
                                        </a>
                                    <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Commentaires -->
                    <div class="comment-box">
                        <form method="POST">
                            <input type="hidden" name="publication_id" value="<?php echo $post['id']; ?>">
                            <input type="text" name="comment_content" class="form-control mb-2" required placeholder="Ajouter un commentaire...">
                            <button type="submit" class="btn btn-outline-primary btn-sm w-100">Commenter</button>
                        </form>

                        <!-- Affichage des commentaires -->
                        <?php
                        $comments = $conn->query("SELECT commentaire.*, etudiant.nom, etudiant.prenom FROM commentaire JOIN etudiant ON commentaire.etudiant_id = etudiant.id WHERE publication_id = " . $post["id"]);
                        while ($comment = $comments->fetch_assoc()): ?>
                            <div class="comment mt-2">
                                <p><strong><?php echo htmlspecialchars($comment["nom"] . " " . $comment["prenom"]); ?></strong> - <?php echo $comment["date_commentaire"]; ?></p>
                                <p><?php echo nl2br(htmlspecialchars($comment["contenu"])); ?></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>