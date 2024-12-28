<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1e1e1e, #333);
            color: #f8f9fa;
        }

        h1, h2 {
            text-align: center;
            font-weight: 600;
            color: #ffffff;
        }

        h3 {
            color: #d6d6d6;
            padding-bottom: 10px;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 30px;
            background-color: #2c2c2c;
            border-radius: 8px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #1e1e1e;
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #444;
        }

        table th {
            background-color: #333;
            color: #ffffff;
        }

        table tr:nth-child(even) {
            background-color: #2a2a2a;
        }

        table tr:hover {
            background-color: #444;
            transition: background-color 0.3s;
        }

        .back {
            text-align: center;
            margin-top: 30px;
        }

        .back a {
            padding: 12px 24px;
            background-color: #444;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .back a:hover {
            background-color: #555;
        }

        @media (max-width: 768px) {
            table th, table td {
                padding: 10px;
            }

            .back a {
                font-size: 14px;
                padding: 10px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="header">
            <h1>Payment History</h1>
        </header>

        <section>
            <h3>Transaction Receipt</h3>

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Paid At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Franklin Anyaya</td>
                        <td>₱1400.00</td>
                        <td>Cash</td>
                        <td>Approved</td>
                        <td>2023-07-05</td>
                    </tr>
                    <tr>
                        <td>Alex Ormilla</td>
                        <td>₱700.00</td>
                        <td>Cash</td>
                        <td>Approved</td>
                        <td>2023-08-10</td>
                    </tr>
                    <tr>
                        <td>Eugene Velasco</td>
                        <td>₱2100.00</td>
                        <td>Cash</td>
                        <td>Approved</td>
                        <td>2023-09-15</td>
                    </tr>
                    <tr>
                        <td>Mark Reyniel Anthony</td>
                        <td>₱1400.00</td>
                        <td>Cash</td>
                        <td>Approved</td>
                        <td>2023-10-20</td>
                    </tr>
                    <tr>
                        <td>Satoru Gojo</td>
                        <td>₱700.00</td>
                        <td>Cash</td>
                        <td>Approved</td>
                        <td>2023-11-25</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <div class="back">
            <a href="{{route('admin.dashboard')}}">Back to Dashboard</a>
        </div>
    </div>
</body>

</html>
