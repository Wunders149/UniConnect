<style>
    .section-parent {
        background-image: url('../images/baobab.png');
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
        gap: 30px;
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
        transform: translateY(-4px);
    }
    .cours {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    .cours .card:hover{
        cursor: pointer;
        background:rgba(63, 63, 63, 0.1);
        transition: all 0.3s ease;
        transform: translateY(-10px);
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    .cours .card img{
        max-width: 200px;
    }
</style>

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
                <h3 class="number-badge">500+</h3>
                <p>Cours Academique</p>
            </div>
        </div>
    </div>
</section>

<!-- Job Categories -->
<section class="container my-5">
    <h2 class="text-center mb-5">Annonce de ce dernier semaine</h2>
    
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
            <div class="list-group-item bg-info">
                ISMST
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
        <a href="../publication" style='text-decoration: none; height: 100%;'>
        <div class="list-group list-group-flush" style='display: grid; place-content: center; height: 100%'>
            <div class="list-group-item" style='color: #000!important;'>
                    Voir plus >
            </div>
        </div>
        </a>
    </div>

    </div>

</section>

<!-- Job Categories -->
<section class="container my-5">
    <h2 class="text-center mb-5">Cours de mon parcours pour cette semaine</h2>

    <div class="cours">

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="../images/pdf.png" class="img-fluid rounded-start p-4" alt="...">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">Méthodologie de la recherche en littérature</h5>
                <p class="card-text">Une recherche sur les œuvres, les auteurs, les courants littéraires, ou encore les théories critiques.</p>
                <p class="card-text"><small class="text-muted"><i class="fa-regular fa-clock"></i> il y a 2 mois</small></p>
            </div>
            </div>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="../images/docs.png" class="img-fluid rounded-start p-4" alt="...">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">Administratif et geo-politique</h5>
                <p class="card-text">Discipline qui traite de l'organisation des institutions publiques et de leur interaction avec les dynamiques géopolitiques..</p>
                <p class="card-text"><small class="text-muted"><i class="fa-regular fa-clock"></i> il y a 5 ans</small></p>
            </div>
            </div>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="../images/pptx.png" class="img-fluid rounded-start p-4" alt="...">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">Sociologie</h5>
                <p class="card-text">Chercher à comprendre comment les interactions sociales influencent nos actions.</p>
                <p class="card-text"><small class="text-muted"><i class="fa-regular fa-clock"></i> il y a 7 mois</small></p>
            </div>
            </div>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="../images/pdf.png" class="img-fluid rounded-start p-4" alt="...">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">HYDRAULIQUE</h5>
                <p class="card-text">Etudier le comportement des liquides, principalement l’eau, en mouvement ou au repos.</p>
                <p class="card-text"><small class="text-muted"><i class="fa-regular fa-clock"></i> il y a 2 ans</small></p>
            </div>
            </div>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="../images/pdf.png" class="img-fluid rounded-start p-4" alt="...">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">Méthodologie de la recherche en littérature</h5>
                <p class="card-text">Une recherche sur les œuvres, les auteurs, les courants littéraires, ou encore les théories critiques.</p>
                <p class="card-text"><small class="text-muted"><i class="fa-regular fa-clock"></i> il y a 2 mois</small></p>
            </div>
            </div>
        </div>
    </div>

    </div>
</section>