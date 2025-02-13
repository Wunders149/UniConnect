<?php
session_start();
include '../db.php'; // Connexion à la base de données

// Activer le rapport d'erreur pour MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    die("Accès refusé. Veuillez vous connecter.");
}

$user_id = $_SESSION['user_id'];

// Envoi d'un message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $message = trim($_POST['message']);

    if (!empty($message)) {
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, message, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $user_id, $message);
        $stmt->execute();
        $stmt->close();
    }
}

// Modification d'un message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_message'])) {
    $message_id = intval($_POST['message_id']);
    $new_message = trim($_POST['new_message']);

    if (!empty($new_message)) {
        $stmt = $conn->prepare("UPDATE messages SET message = ?, updated_at = NOW() WHERE id = ? AND sender_id = ?");
        $stmt->bind_param("sii", $new_message, $message_id, $user_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Suppression d'un message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_message'])) {
    $message_id = intval($_POST['message_id']);

    $stmt = $conn->prepare("DELETE FROM messages WHERE id = ? AND sender_id = ?");
    $stmt->bind_param("ii", $message_id, $user_id);
    $stmt->execute();
    $stmt->close();
}

// Récupération des messages
$messages = [];
$stmt = $conn->prepare("SELECT m.id, m.message, m.created_at, m.sender_id, 
                               CONCAT(e.nom, ' ', e.prenom) AS sender
                        FROM messages m 
                        JOIN etudiant e ON m.sender_id = e.id 
                        ORDER BY m.created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Messagerie</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 90%;
            max-width: 600px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #1877f2;
            margin-bottom: 15px;
        }
        .message-box {
            max-height: 400px;
            overflow-y: auto;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fafafa;
        }
        .message {
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 12px;
            max-width: 80%;
            position: relative;
            word-wrap: break-word;
        }
        .sent {
            background-color: #1877f2;
            color: white;
            align-self: flex-end;
        }
        .received {
            background-color: #e4e6eb;
            color: black;
            align-self: flex-start;
        }
        .message-form {
            display: flex;
            gap: 12px;
            margin-top: 15px;
        }
        .message-form textarea {
            width: 100%;
            padding: 12px;
            border-radius: 25px;
            border: 1px solid #ccc;
            resize: none;
            font-size: 14px;
        }
        .message-form button {
            background-color: #1877f2;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
        }
        .actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            font-size: 12px;
        }
        .actions form {
            display: inline;
        }
        .actions button {
            border: none;
            background: none;
            color: #1877f2;
            cursor: pointer;
        }
        .actions input[type="text"] {
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 5px;
        }
        .message small {
            position: absolute;
            bottom: 5px;
            right: 10px;
            font-size: 10px;
            color: #888;
        }
        @media (max-width: 600px) {
            .container {
                width: 100%;
                padding: 10px;
            }
            .message-form button {
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Messagerie</h2>

    <div class="message-box" id="messageBox">
        <?php foreach ($messages as $msg): ?>
            <div class="message <?= ($msg['sender_id'] == $_SESSION['user_id']) ? 'sent' : 'received' ?>">
                <strong><?= htmlspecialchars($msg['sender']) ?>:</strong> 
                <?= htmlspecialchars($msg['message']) ?>
                <small><?= date("d M Y, H:i", strtotime($msg['created_at'])) ?></small>

                <?php if ($msg['sender_id'] == $_SESSION['user_id']): ?>
                    <div class="actions">
                        <form method="POST">
                            <input type="hidden" name="message_id" value="<?= $msg['id'] ?>">
                            <input type="text" name="new_message" placeholder="Modifier" required>
                            <button type="submit" name="edit_message">✏️</button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="message_id" value="<?= $msg['id'] ?>">
                            <button type="submit" name="delete_message" onclick="return confirm('Supprimer ce message ?')">🗑️</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <form method="POST" class="message-form">
        <textarea name="message" placeholder="Écrire un message..." required></textarea>
        <button type="submit" name="send_message">Envoyer</button>
    </form>
</div>

<script>
    // Défilement automatique vers le dernier message
    document.addEventListener("DOMContentLoaded", function () {
        let messageBox = document.getElementById("messageBox");
        messageBox.scrollTop = messageBox.scrollHeight;
    });
</script>

</body>
</html>
