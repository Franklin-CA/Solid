<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #181818;
            color: #f8f9fa;
            height: 100%;
        }

        h1, h2 {
            text-align: center;
            color: #ffffff;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 40px;
            background-color: #2c2c2c;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.8);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            width: 100%;
            display: grid;
            gap: 20px;
            margin-top: 20px;
        }

        label {
            font-size: 16px;
            color: #d6d6d6;
            font-weight: 500;
        }

        .input-group {
            display: flex;
            flex-direction: column;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        select {
            padding: 16px;
            background-color: #333;
            color: #fff;
            border: 1px solid #444;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            width: 100%;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="date"]:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
        }

        input[type="submit"] {
            padding: 16px 32px;
            background-color: #000;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #999;
            transform: translateY(-2px);
        }

        .back {
            text-align: center;
            margin-top: 30px;
        }

        .back a {
            padding: 14px 28px;
            background-color: #444;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back a:hover {
            background-color: #555;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            width: 100%;
        }

        .alert-danger ul {
            list-style-type: none;
            padding: 0;
        }

        .alert-danger ul li {
            padding: 5px 0;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin-top: 20px;
            }

            input[type="submit"],
            .back a {
                font-size: 14px;
                padding: 12px 24px;
            }
        }

        /* Responsive Form */
        @media (max-width: 500px) {
            h1, h2 {
                font-size: 24px;
            }

            .container {
                padding: 15px;
            }

            input[type="submit"] {                
                font-size: 16px;
                padding: 14px 20px;
            }

            .back a {
                font-size: 14px;
                padding: 12px 24px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Add New Member</h1>
        <h2>Fill in the details below</h2>

        <form action="{{ route('admin.storeUser') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- First Name -->
            <div class="input-group">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" required>
            </div>

            <!-- Last Name -->
            <div class="input-group">
                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" required>
            </div>

            <!-- Email -->
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <!-- Password -->
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <!-- Confirm Password -->
            <div class="input-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <!-- Birthdate -->
            <div class="input-group">
                <label for="birthdate">Birthdate:</label>
                <input type="date" id="birthdate" name="birthdate" required>
            </div>

            <!-- Address -->
            <div class="input-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>

            <!-- Paid Date -->
            <div class="input-group">
                <label for="paid_date">Paid Date:</label>
                <input type="date" id="paid_date" name="paid_date">
            </div>

            <!-- Expiry Date -->
            <div class="input-group">
                <label for="expiry_date">Expiry Date:</label>
                <input type="date" id="expiry_date" name="expiry_date">
            </div>

            <!-- Payment Status -->
            <div class="input-group">
                <label for="payment_status">Payment Status:</label>
                <select id="payment_status" name="payment_status">
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            <!-- Account Status -->
            <div class="input-group">
                <label for="is_active">Account Status:</label>
                <select id="is_active" name="is_active">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <input type="submit" value="Set Membership">
        </form>

        <div class="back">
            <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
        </div>
    </div>

</body>

</html>
