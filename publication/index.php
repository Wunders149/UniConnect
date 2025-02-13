<?php
session_start();
require_once "../db.php";

// ---------------------
// CSRF Token Generation
// ---------------------
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// ---------------------
// User Authentication
// ---------------------
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$user_logged_in = isset($_SESSION['user']);
$user_name = $user_logged_in ? $_SESSION['user']['name'] : '';
$user_profile_pic = $user_logged_in ? $_SESSION['user']['profile_pic'] : 'default_profile.png';

// ---------------------
// Handle POST Requests
// ---------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
         die("Invalid CSRF token");
    }
    
    // Identify which form was submitted
    $action = isset($_POST["action"]) ? $_POST["action"] : '';
    
    if ($action === "post_message") {
        $content = trim($_POST["post_content"]);
        $filePath = null;
        
        // Process file upload if one was sent
        if (isset($_FILES["post_file"]) && $_FILES["post_file"]["error"] === UPLOAD_ERR_OK) {
            $targetDir = "uploads/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            // Sanitize the original file name
            $originalFileName = basename($_FILES["post_file"]["name"]);
            $safeFileName = preg_replace("/[^a-zA-Z0-9\._-]/", "", $originalFileName);
            $fileName = time() . "_" . $safeFileName;
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $allowedTypes = ["jpg", "jpeg", "png", "gif", "mp4", "pdf", "doc", "docx"];
            $maxSize = 5 * 1024 * 1024; // 5MB

            if (in_array($fileType, $allowedTypes) && $_FILES["post_file"]["size"] <= $maxSize) {
                if (move_uploaded_file($_FILES["post_file"]["tmp_name"], $targetFilePath)) {
                    $filePath = $targetFilePath;
                } else {
                    $uploadError = "Failed to upload file.";
                }
            } else {
                $uploadError = "Invalid file type or file size exceeds the limit.";
            }
        }
        
        // If there is no upload error, insert the post
        if (!isset($uploadError)) {
            $stmt = $conn->prepare("INSERT INTO pub (etudiant_id, contenu, fichier) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("iss", $user_id, $content, $filePath);
                $stmt->execute();
                $stmt->close();
            } else {
                error_log("Prepare failed: " . $conn->error);
            }
        }
        
        // Redirect to prevent form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    
    if ($action === "post_comment") {
        $comment = trim($_POST["comment_content"]);
        $pub_id = $_POST["pub_id"];

        $stmt = $conn->prepare("INSERT INTO coms (pub_id, etudiant_id, contenu) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("iis", $pub_id, $user_id, $comment);
            $stmt->execute();
            $stmt->close();
        } else {
            error_log("Prepare failed: " . $conn->error);
        }
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// ---------------------
// Helper Function: Get Like Count
// ---------------------
function getLikeCount($pubId) {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM likes WHERE pub_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $pubId);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = 0;
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
        }
        $stmt->close();
        return $count;
    }
    return 0;
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
        .sticky-form {
            position: sticky;
            top: 25%;
            max-width: 350px;
            width: 100%;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        /* Nouveau style pour l'initial du profil */
        .profile-initial {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: #007bff;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        margin-right: 10px;
        }
        .post-card {
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .post-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }
        .post-header {
            background: #f8f9fa;
            padding: 15px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
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
            padding: 15px;
            border-top: 1px solid #ddd;
            background-color: #f8f9fa;
        }
        .comment {
            padding: 10px;
            border: 1px solid #f0f0f0;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }
        .post-btn {
            background-color: #007bff;
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
            text-align: center;
            width: 100%;
            border: none;
            transition: background-color 0.3s ease;
        }
        .post-btn:hover {
            background-color: #0056b3;
        }
        .post-actions {
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <?php include "../nav/navBar.php"; ?>
    <div class="container mt-4">
        <div class="row">
        <!-- Left Column: Post Message Form -->
        <div class="col-md-4">
            <div class="sticky-form">
            <h5 class="mb-3">Publier un message</h5>
            <?php if(isset($uploadError)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($uploadError); ?></div>
            <?php endif; ?>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <input type="hidden" name="action" value="post_message">
                <textarea name="post_content" class="form-control mb-3" rows="4" required placeholder="Exprimez-vous..."></textarea>
                <input type="file" name="post_file" class="form-control mb-3" accept="image/*,video/mp4,.pdf,.doc,.docx" onchange="previewFile()">
                <!-- Conteneur d'aperçu -->
                <div id="file-preview-container" style="display: none; margin-top: 10px;"></div>
                <button class="post-btn" type="submit">
                <i class="fas fa-paper-plane"></i> Publier
                </button>
            </form>
            </div>
        </div>
        <!-- Right Column: Posts Feed -->
        <div class="col-md-8">
            <?php
            $posts = $conn->query("SELECT pub.*, etudiant.nom, etudiant.prenom FROM pub JOIN etudiant ON pub.etudiant_id = etudiant.id ORDER BY pub.date_pub DESC");
            while ($post = $posts->fetch_assoc()):
            ?>
            <div class="card post-card">
                <div class="post-header">
                <!-- Afficher la première lettre du nom de l'auteur -->
                <div class="profile-initial">
                    <?php echo strtoupper(substr($post["nom"], 0, 1)); ?>
                </div>
                <div>
                    <strong><?php echo htmlspecialchars($post["nom"] . " " . $post["prenom"]); ?></strong>
                    <p class="text-muted small mb-0"><?php echo $post["date_pub"]; ?></p>
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
                <div class="post-actions">
                <button class="btn btn-link like-btn" onclick="toggleLike(<?php echo $post['id']; ?>)">
                    <i class="far fa-heart"></i> Like (<span id="like-count-<?php echo $post['id']; ?>"><?php echo getLikeCount($post['id']); ?></span>)
                </button>
                <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#comments-<?php echo $post['id']; ?>">
                    <i class="far fa-comment"></i> Comment
                </button>
                <button class="btn btn-link" onclick="sharePost('<?php echo $post['id']; ?>')">
                    <i class="fas fa-share"></i> Share
                </button>
                </div>
                <!-- Comments Section (collapsible) -->
                <div class="comment-box collapse" id="comments-<?php echo $post['id']; ?>">
                <form method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="action" value="post_comment">
                    <input type="hidden" name="pub_id" value="<?php echo $post['id']; ?>">
                    <input type="text" name="comment_content" class="form-control mb-2" required placeholder="Ajouter un commentaire...">
                    <button type="submit" class="btn btn-outline-primary btn-sm w-100">Commenter</button>
                </form>
                <?php
                    $stmt = $conn->prepare("SELECT coms.*, etudiant.nom, etudiant.prenom FROM coms JOIN etudiant ON coms.etudiant_id = etudiant.id WHERE pub_id = ?");
                    $stmt->bind_param("i", $post["id"]);
                    $stmt->execute();
                    $commentsResult = $stmt->get_result();
                    while ($comment = $commentsResult->fetch_assoc()):
                ?>
                    <div class="comment mt-2">
                    <p>
                        <strong><?php echo htmlspecialchars($comment["nom"] . " " . $comment["prenom"]); ?></strong>
                        - <?php echo $comment["date_com"]; ?>
                    </p>
                    <p><?php echo nl2br(htmlspecialchars($comment["contenu"])); ?></p>
                    </div>
                <?php endwhile;
                    $stmt->close();
                ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview the selected file
        function previewFile() {
            const fileInput = document.querySelector('input[type=file]');
            const file = fileInput.files[0];
            const previewContainer = document.getElementById('file-preview-container');

            // Réinitialiser le conteneur d'aperçu
            previewContainer.innerHTML = '';
            previewContainer.style.display = 'none';

            if (!file) return;

            // Création d'un FileReader pour lire le fichier
            const reader = new FileReader();

            // Gestion de l'aperçu en fonction du type de fichier
            if (file.type.startsWith('image/')) {
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100%';
                    previewContainer.appendChild(img);
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else if (file.type.startsWith('video/')) {
                reader.onload = function(e) {
                    const video = document.createElement('video');
                    video.src = e.target.result;
                    video.controls = true;
                    video.style.width = '100%';
                    previewContainer.appendChild(video);
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else if (file.type === 'application/pdf') {
                // Pour les PDFs, vous pouvez afficher une icône ou un message
                const icon = document.createElement('i');
                icon.className = 'fas fa-file-pdf fa-3x';
                previewContainer.appendChild(icon);
                previewContainer.style.display = 'block';
            } else {
                // Pour les autres types de fichiers, afficher une icône générique
                const icon = document.createElement('i');
                icon.className = 'fas fa-file fa-3x';
                previewContainer.appendChild(icon);
                previewContainer.style.display = 'block';
            }
        }
        // Toggle like using AJAX and update the like count
        function toggleLike(pubId) {
            fetch('./likeToggle.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'pub_id=' + encodeURIComponent(pubId) + '&csrf_token=' + encodeURIComponent('<?php echo $_SESSION['csrf_token']; ?>'),
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('like-count-' + pubId).textContent = data.likeCount;
            })
            .catch(error => console.error('Error:', error));
        }

        // Share the post link by copying it to the clipboard
        function sharePost(pubId) {
            const postUrl = window.location.origin + window.location.pathname + '?post=' + pubId;
            navigator.clipboard.writeText(postUrl).then(() => {
                alert('Post link copied to clipboard!');
            }).catch(err => {
                console.error('Could not copy text: ', err);
            });
        }
    </script>
</body>
</html>
