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
        

    </style>
</head>
<body>
    <?php include "../nav/navBar.php" ?>
    <div class="container">
        <div class="card">
            <h2>Publier un message</h2>
            <form method="POST" enctype="multipart/form-data">
                <textarea name="post_content" required placeholder="Exprimez-vous..."></textarea>
                <input type="file" name="post_file" accept="image/*,video/mp4,.pdf,.doc,.docx">
                <button class="bouton" type="submit"><i class="fas fa-paper-plane"></i> Publier</button>
            </form>
        </div>
    
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

                    <form method="POST">
                        <input type="hidden" name="publication_id" value="<?php echo $post['id']; ?>">
                        <input type="text" name="comment_content" required placeholder="Ajouter un commentaire...">
                        <button type="submit" class="bouton">Commenter</button>
                    </form>

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
</body>
</html>
