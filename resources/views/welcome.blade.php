<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GraySteelFitness - Welcome</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            color: white;
            background: #111 url('assets/gymbackgroundwelcome.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .navbar {
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            transition: background-color 0.3s ease-in-out;
        }

        .navbar-brand {
            font-weight: bold;
            color: #f8f9fa;
        }

        .navbar-brand:hover {
            color: #ff5722;
        }

        .nav-link {
            color: #f8f9fa;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #ff5722;
        }

        .welcome-section {
            padding: 100px 20px;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 20px;
            box-shadow: 0 12px 18px rgba(0, 0, 0, 0.4);
        }

        .welcome-section h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .welcome-section p {
            font-size: 1.3rem;
            margin-bottom: 40px;
            font-weight: 300;
        }

        .cta-btn {
            background-color: #ff5722;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            font-size: 1.1rem;
            transition: background-color 0.3s, transform 0.3s ease;
        }

        .cta-btn:hover {
            background-color: #e64a19;
            transform: translateY(-5px);
        }

        footer {
            background-color: #212121;
            color: #bbb;
            padding: 20px 0;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
            box-shadow: 0 -5px 10px rgba(0, 0, 0, 0.3);
        }

        /* Navbar hover effect */
        .navbar:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">GraySteel Fitness</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Welcome Section -->
    <section class="welcome-section">
        <h1>Welcome to GraySteel Fitness</h1>
        <p>Your journey to strength begins here. Join the GraySteel community to start your fitness transformation today!</p>
        <a href="/register" class="cta-btn">Join Now</a>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 GraySteelFitness. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
