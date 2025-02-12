<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hireo - Job Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background-image: url('../images/baobab.jpg');
            background-size: cover;
            padding: 80px 0;
        }
        .stat-box {
            background: white;
            padding: 30px;
            margin: 15px 0;
            border-radius: 10px;
            text-align: center;
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
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>
<body>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="mb-4">Hire experts or be hired for any job, any time</h1>
        <p class="lead mb-5">Thousands of small businesses use Hireo to turn<br>their ideas into reality.</p>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4>What job you want?</h4>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Job Title or Keywords">
                    <button class="btn btn-success" type="button">Search</button>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Online Job</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="container my-5">
    <div class="row text-center">
        <div class="col-md-3">
            <div class="stat-box">
                <h3 class="number-badge">1,586</h3>
                <p>Jobs Posted</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <h3 class="number-badge">3,543</h3>
                <p>Tasks Posted</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <h3 class="number-badge">1,232</h3>
                <p>Freelancers</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <h3 class="number-badge">1,586</h3>
                <p>Jobs Posted</p>
            </div>
        </div>
    </div>
</section>

<!-- Job Categories -->
<section class="container my-5">
    <h2 class="text-center mb-5">Popular Job Categories</h2>
    
    <!-- First Row -->
    <div class="row">
        <div class="col-md-3">
            <div class="category-card">
                <div class="number-badge">612</div>
                <h4>Web & Software Dev</h4>
                <p>Software Engineer, Web/Mobile Developer & More</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="category-card">
                <div class="number-badge">113</div>
                <h4>Data Science & Analytics</h4>
                <p>Data Specialist/Scientist, Data Analyst & More</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="category-card">
                <div class="number-badge">186</div>
                <h4>Accounting & Consulting</h4>
                <p>Auditor, Accountant, Financial Analyst & More</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="category-card">
                <div class="number-badge">298</div>
                <h4>Writing & Translations</h4>
                <p>Copywriter, Creative Writer, Translator & More</p>
            </div>
        </div>
    </div>

    <!-- Second Row -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="category-card">
                <div class="number-badge">549</div>
                <h4>Sales & Marketing</h4>
                <p>Brand Manager, Marketing Coordinator & More</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="category-card">
                <div class="number-badge">873</div>
                <h4>Graphics & Design</h4>
                <p>Creative Director, Web Designer & More</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="category-card">
                <div class="number-badge">125</div>
                <h4>Digital Marketing</h4>
                <p>Marketing Analyst, Social Profile Admin & More</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="category-card">
                <div class="number-badge">445</div>
                <h4>Education & Training</h4>
                <p>Advisor, Coach Education Coordinator & More</p>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>