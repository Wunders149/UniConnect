<style>
    .message-liste {
        overflow-y: auto;
    }
    .message-liste li{
        background: red;
        margin: 10px;
        border-radius: 15px;
        border:2px solid 1px;
        background:rgb(235, 235, 235);
    }
    .message-liste li a {
        text-decoration: none!important;
    }
    .message-liste li:hover {
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
        transition: all .4s ease;
        transform: translateY(-5px);
    }
    .message-content {
        overflow-y: auto;
    }
</style>

<?php
require_once "../db.php";

$user_id = $_SESSION["user_id"];
// $mp_id = $_GET["id"];
$mp_id = 1;

// Sélectionner les informations de l'utilisateur par email
$sql = "SELECT * FROM sender WHERE id_etudiant = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message"])) {
  $content = $_POST["message"];
  $role = 'etudiant';
  $stmt_insert = $conn->prepare("INSERT INTO stock_message (id_sender, id_user, contenue, role) VALUES (?, ?, ?, ?)");
  $stmt_insert->bind_param("iiss", $mp_id, $user_id, $content, $role);
  $stmt_insert->execute();
  $stmt_insert->close();
}

?>

<section>
  <div class="container py-1">

    <div class="">
      <div class="d-flex justify-content-between">

        <div class="" id="chat3" style="width: 30vw;">
            <div class="card-body">

                <!-- partie liste  -->
              <div class="">

                <div class="p-3">

                  <div class="input-group rounded mb-3">
                    <input type="search" class="form-control rounded" placeholder="Recherche votre prof" aria-label="Search"
                      aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                      <i class="fas fa-search"></i>
                    </span>
                  </div>

                  <div data-mdb-perfect-scrollbar-init class='message-liste' style="position: relative; height: 400px">
                    <ul class="list-unstyled mb-0">

                    <?php while ($row = $result->fetch_assoc()): ?>
                      <li class="p-2">
                        <a href="#!" class="d-flex justify-content-between">
                          <div class="d-flex flex-row">
                            <div>
                              <img
                                src="../images/IMG_5882.jpeg"
                                alt="avatar" class="rounded-circle d-flex align-self-center me-3" width="60">
                              <span class="badge bg-success badge-dot"></span>
                            </div>
                            <div class="pt-1">
                              <p class="fw-bold mb-0"><?=$row['nom_professeur']?></p>
                              <p class="small text-muted">Hello, Are you there?</p>
                            </div>
                          </div>
                          <div class="pt-1">
                            <p class="small text-muted mb-1">Maintenant</p>
                            <span class="badge bg-danger rounded-pill float-end">3</span>
                          </div>
                        </a>
                      </li>
                      <?php endwhile; ?>

                    </ul>
                  </div>

                </div>

              </div>
               
            </div>

        </div>

        <div class="" id="chat3" style="width: 50vw; border-radius: 15px; background:rgb(235, 235, 235);">
            <div class="card-body">

            <!-- partie profil  -->
                <div class="d-flex flex-row m-2">
                    <div>
                        <img
                            src="../images/IMG_5882.jpeg"
                            alt="avatar" class="rounded-circle d-flex align-self-center me-3" width="50">
                    </div>
                    <div class="pt-1">
                        <p class="fw-bold mb-0">Kate Moss</p>
                    </div>
                </div>

                <!-- partie message  -->
              
                <div class="p-3 pe-3 message-content" data-mdb-perfect-scrollbar-init
                  style="position: relative; height: 400px">

                  <div class="d-flex flex-row justify-content-start">
                    <div>
                            <img
                                src="../images/IMG_5882.jpeg"
                                alt="avatar" class="rounded-circle d-flex align-self-center border mt-0" width="60">
                    </div>
                    <div>
                      <p class="small p-2 ms-3 mb-1 rounded-3 bg-body-tertiary">Neque porro
                        quisquam
                        est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non
                        numquam
                        eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                      <p class="small ms-3 mb-3 rounded-3 text-muted float-end">12:00 PM | Aug 13</p>
                    </div>
                  </div>

                  <div class="d-flex justify-content-end align-items-start">
                    <div>
                      <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">Ut enim ad minima veniam,
                        quis
                        nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea
                        commodi
                        consequatur?</p>
                      <p class="small me-3 mb-3 rounded-3 text-muted">12:00 PM | Aug 13</p>
                    </div>
                    <div>
                        <img
                            src="../images/IMG_5882.jpeg"
                            alt="avatar" class="rounded-circle d-flex align-self-center border mt-0" width="60">
                    </div>
                  </div>

                  <div class="d-flex flex-row justify-content-start">
                    <div>
                            <img
                                src="../images/IMG_5882.jpeg"
                                alt="avatar" class="rounded-circle d-flex align-self-center border mt-0" width="60">
                    </div>
                    <div>
                      <p class="small p-2 ms-3 mb-1 rounded-3 bg-body-tertiary">Neque porro
                        quisquam
                        est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non
                        numquam
                        eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                      <p class="small ms-3 mb-3 rounded-3 text-muted float-end">12:00 PM | Aug 13</p>
                    </div>
                  </div>

                  <div class="d-flex justify-content-end align-items-start">
                    <div>
                      <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">Ut enim ad minima veniam,
                        quis
                        nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea
                        commodi
                        consequatur?</p>
                      <p class="small me-3 mb-3 rounded-3 text-muted">12:00 PM | Aug 13</p>
                    </div>
                    <div>
                        <img
                            src="../images/IMG_5882.jpeg"
                            alt="avatar" class="rounded-circle d-flex align-self-center border mt-0" width="60">
                    </div>
                  </div>

                  <div class="d-flex flex-row justify-content-start">
                    <div>
                            <img
                                src="../images/IMG_5882.jpeg"
                                alt="avatar" class="rounded-circle d-flex align-self-center border mt-0" width="60">
                    </div>
                    <div>
                      <p class="small p-2 ms-3 mb-1 rounded-3 bg-body-tertiary">Neque porro
                        quisquam
                        est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non
                        numquam
                        eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                      <p class="small ms-3 mb-3 rounded-3 text-muted float-end">12:00 PM | Aug 13</p>
                    </div>
                  </div>

                  <div class="d-flex justify-content-end align-items-start">
                    <div>
                      <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">Ut enim ad minima veniam,
                        quis
                        nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea
                        commodi
                        consequatur?</p>
                      <p class="small me-3 mb-3 rounded-3 text-muted">12:00 PM | Aug 13</p>
                    </div>
                    <div>
                        <img
                            src="../images/IMG_5882.jpeg"
                            alt="avatar" class="rounded-circle d-flex align-self-center border mt-0" width="60">
                    </div>
                  </div>

                </div>

                <form methode='POST' class="text-muted d-flex justify-content-start align-items-center pe-3 p-3 m-2">
                  <input type="text" name='message' class="form-control form-control-lg" id="exampleFormControlInput2"
                    placeholder="Type message" required>
                  <a class="ms-1 text-muted" href="#!"><i class="fas fa-paperclip"></i></a>
                  <a class="ms-3 text-muted" href="#!"><i class="fas fa-smile"></i></a>
                  <button type='submit' class="ms-3"><i class="fas fa-paper-plane"></i></button>
                </form>
               
            </div>

        </div>

      </div>
    </div>

  </div>
</section>