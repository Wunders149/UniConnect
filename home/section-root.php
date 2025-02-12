<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hireo - Job Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .section-parent {
            background-image: url('./images/baobab.png');
            background-size: cover;
            background-position: bottom;
        }
        .hero-section {
            padding: 80px 0;
            background-image: linear-gradient(to right, #fff, transparent);
        }
        .stat-box {
            padding: 30px;
            margin: 15px 0;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .stat-box:hover {
            box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.5);
            transform: translateY(-30px);
        }
        .category-card {
            background: white;
            padding: 20px;
            margin: 10px 0;
            border-radius: 8px;
            transition: transform 0.3s;
        }
        .category-card:hover {
            transform: translateY(-5px);
        }
        .number-badge {
            font-size: 24px;
            color: #007bff;
            font-weight: bold;
        }
        .annonce {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        .annonce .card {
            width: 30%;
            cursor: pointer;
        }
        .annonce .card div:nth-child(1){
            color: #fff;
        }
        .annonce .card:hover {
            box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>

<!-- Hero Section -->
<section class='section-parent'>
<div class="hero-section">
    <div class="container text-center">
        <h1 class="mb-4 fw-bold">UniConnect - Ecosysteme Numerique Universtaire</h1>
        <p class="lead mb-5 fw-bold">Plateforme web centralisant les services academiques et sociaux pour les etudiants, <br> enseignants et associations universtaires.</p>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4>Quel formation cherchez-vous ?</h4>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Etablissement ou matiere ou titre d'evenement...">
                    <button class="btn btn-primary" type="button">Rechercher</button>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Service en ligne</span>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<!-- Statistics Section -->
<section class="container my-5">
<h2 class="text-center mb-5">Categories Accademique</h2>
    <div class="row text-center">
        <div class="col-md-3">
            <div class="stat-box">
                <i class="fs-3 m-3 text-secondary fa-solid fa-school"></i>
                <h3 class="number-badge">20+</h3>
                <p>Universtes</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <i class="fs-3 m-3 text-secondary fa-solid fa-graduation-cap"></i>
                <h3 class="number-badge">30+</h3>
                <p>Parcours</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <i class="fs-3 m-3 text-secondary fa-solid fa-calendar"></i>
                <h3 class="number-badge">1,382</h3>
                <p>Evenement</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <i class="fs-3 m-3 text-secondary fa-solid fa-book"></i>
                <h3 class="number-badge">500</h3>
                <p>Cours Accademique</p>
            </div>
        </div>
    </div>
</section>

<!-- Job Categories -->
<section class="container my-5">
    <h2 class="text-center mb-5">Derniere Annonce</h2>
    
    <div class="annonce">

    <div class="card">
        <div class="list-group list-group-flush">
            <div class="list-group-item bg-success">
                Institut Superieur T..(IST)
            </div>
            <div class="list-group-item">
                <p class='fw-bold'>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas, odio?
                </p>
            </div>
            <div class="list-group-item"> <a href="#">Visiter l'annonce ></a> </div>
        </div>
    </div>

    <div class="card">
        <div class="list-group list-group-flush">
            <div class="list-group-item bg-secondary">
                Institut Superieur T..(IST)
            </div>
            <div class="list-group-item">
                <p class='fw-bold'>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas, odio?
                </p>
            </div>
            <div class="list-group-item"> <a href="#">Visiter l'annonce ></a> </div>
        </div>
    </div>

    <div class="card">
        <div class="list-group list-group-flush">
            <div class="list-group-item bg-primary">
                ISSTM
            </div>
            <div class="list-group-item">
                <p class='fw-bold'>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas, odio?
                </p>
            </div>
            <div class="list-group-item"> <a href="#">Visiter l'annonce ></a> </div>
        </div>
    </div>

    <div class="card">
        <div class="list-group list-group-flush">
            <div class="list-group-item bg-warning">
                UGM
            </div>
            <div class="list-group-item">
                <p class='fw-bold'>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas, odio?
                </p>
            </div>
            <div class="list-group-item"> <a href="#">Visiter l'annonce ></a> </div>
        </div>
    </div>

    <div class="card">
        <div class="list-group list-group-flush">
            <div class="list-group-item" style=' height: 100%; display: grid; place-content: center;'>
                <p class='fw-bold' style='color: #000!important;'>
                    Voir plus >
                </p>
            </div>
        </div>
    </div>

    </div>

</section>

<!-- Job Categories -->
<section class="container my-5">
    <h2 class="text-center mb-5">Cours que vous devriez voir</h2>


</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>