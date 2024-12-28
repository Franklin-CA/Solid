    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">
        <style>
            body {
                font-family: 'Roboto', sans-serif;
                margin: 0;
                padding: 0;
                background: linear-gradient(135deg, #1e1e1e, #333);
                color: #f8f9fa;
            }

            h1,
            h2 {
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

            .header {
                text-align: center;
                margin-bottom: 30px;
            }

            .nav {
                background-color: #444;
                padding: 15px;
                text-align: center;
                margin-bottom: 20px;
                border-radius: 8px;
            }

            .nav a {
                color: #fff;
                text-decoration: none;
                margin: 0 20px;
                font-weight: 600;
                padding: 12px;
                border-radius: 5px;
                transition: background-color 0.3s;
            }

            .nav a:hover {
                background-color: #555;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                background-color: #1e1e1e;
                border-radius: 8px;
                overflow: hidden;
            }

            table th,
            table td {
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

            .status {
                font-weight: bold;
            }

            .status.pending {
                color: #ffc107;
            }

            .status.approved {
                color: #28a745;
            }

            .status.rejected {
                color: #dc3545;
            }

            .actions button {
                background-color: #007bff;
                color: white;
                border: none;
                padding: 8px 16px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
                margin-right: 8px;
            }

            .actions button.reject {
                background-color: #b30000;
            }

            .actions button.delete {
                background-color: #444;
            }

            .actions button:hover {
                opacity: 0.9;
                transform: translateY(-2px);
            }

            .logout {
                text-align: center;
                margin-top: 30px;
            }

            .logout button {
                padding: 12px 24px;
                background-color: #444;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                transition: background-color 0.3s;
            }

            .logout button:hover {
                background-color: #555;
            }

            .logout button:focus {
                outline: none;
            }

            .alert {
                padding: 15px;
                margin-bottom: 20px;
                border-radius: 5px;
                color: white;
                text-align: center;
            }

            .alert-success {
                background-color: #28a745;
            }

            .alert-error {
                background-color: #dc3545;
            }

            @media (max-width: 768px) {
                .nav a {
                    display: block;
                    margin: 10px 0;
                    font-size: 14px;
                }

                table th,
                table td {
                    padding: 10px;
                }

                .logout button {
                    font-size: 14px;
                    padding: 10px 20px;
                }
            }

            /* Modal Styling */
            .modal-content {
                background-color: #333;
                color: #fff;
                border-radius: 8px;
                padding: 20px;
            }

            .modal-header {
                border-bottom: 1px solid #444;
            }

            .modal-footer {
                border-top: 1px solid #444;
            }

            .modal-footer .btn {
                padding: 8px 16px;
                margin: 5px;
            }

            .modal-footer .btn-primary {
                background-color: #007bff;
            }

            .modal-footer .btn-secondary {
                background-color: #444;
            }

            .modal-body {
                font-size: 1.1rem;
            }
        </style>
    </head>

    <body>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="container">
            <header class="header">
                <h1>Admin Panel</h1>
                <h2>Welcome, {{ Auth::user()->name }}</h2>
            </header>

            <!-- Navigation Menu -->
                <nav class="nav">
                    <a href="{{ route('admin.storeUser') }}">Add Member</a>
                    <a href="{{ route('admin.paymentHistory', auth()->user()->id) }}">View Payment History</a>
                </nav>

                <section>
                    <h3>Member List</h3>

                    @if ($users->isNotEmpty())
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Paid Date</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->paid_date ? $user->paid_date->format('Y-m-d') : 'N/A' }}</td>
                                        <td>{{ $user->expiry_date ? $user->expiry_date->format('Y-m-d') : 'N/A' }}</td>
                                        <td>
                                            <span class="status {{ $user->payment_status }}">
                                                {{ ucfirst($user->payment_status) }}
                                            </span>
                                        </td>
                                        <td class="actions">
                                            @if ($user->payment_status === 'pending')
                                                <form method="POST" action="{{ route('admin.subscription.handle', $user->id) }}"
                                                    style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="action" value="approve">
                                                    <button type="submit">Approve</button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.subscription.handle', $user->id) }}"
                                                    style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="action" value="reject">
                                                    <button type="submit" class="reject">Reject</button>
                                                </form>
                                            @endif
                                            <form method="POST" action="{{ route('admin.deleteUser', $user->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No users available.</p>
                    @endif
                </section>

                <div class="logout">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
        </div>
    </body>

    </html>