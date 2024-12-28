<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrayStillFitness - Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #212121;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            /* Adjust to center the main container and logo */
        }

        img.logo {
            margin-bottom: 20px;
            /* Add space between the logo and main container */
            width: 100px;
            /* Adjust size of the logo */
            height: auto;
        }

        .main-container {
            display: flex;
            width: 80%;
            max-width: 900px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .branding {
            background-color: #333;
            color: #fff;
            padding: 40px 20px;
            text-align: center;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .branding h1 {
            margin: 0;
            font-size: 36px;
        }

        .branding p {
            font-size: 18px;
            margin-top: 10px;
        }

        .container {
            flex: 1;
            padding: 20px 30px;
            text-align: center;
        }

        .container h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .container label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .container button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .container button:hover {
            background-color: #555;
        }

        .container footer {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }

        .container footer a {
            text-decoration: none;
            color: black;
        }

        .container footer h5 {
            margin: 0;
        }

        .logo {
            padding-bottom: 5%;
        }
    </style>
</head>

<body>

    <div class="main-container">
        <div class="branding">
            <div class="logo">
                <img src="./assets/GraySteelFitnessLogo.png" alt="Gray Steel Fitness Logo" width="150" height="150">
            </div>
            <h1>GraySteel Fitness</h1>
            <p>"Empowering You to Achieve Your Best Self"</p>
        </div>
        <div class="container">
            <h1>Login</h1>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>
            <footer>
                <a href="/register">
                    <h5>Create account</h5>
                </a>
            </footer>
        </div>
    </div>
</body>

</html>