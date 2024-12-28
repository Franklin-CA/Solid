<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('Title', 'GraySteelFitness')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: white;
            background: #111 url('/assets/gym-background-home.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .navbar {
            border-bottom: 2px solid #333;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .nav-link {
            font-size: 1.2rem;
            color: #ccc;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #fff;
        }

        .membership-card {
            background-color: #222;
            color: white;
            border: 1px solid #444;
        }

        .membership-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .membership-card .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .membership-card .btn-primary:hover {
            background-color: #0056b3;
        }

        h2 {
            color: white;
        }

        .receipt-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #222;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }

        .alert-info {
            background-color: #333;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">GraySteel Fitness</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Plans</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Payment Receipt -->
    @if(session('success'))
        <div class="receipt-container mt-5">
            <h4 class="text-center text-success mb-4" style="font-size: 1.75rem; font-weight: bold;">Payment Receipt</h4>
            <div class="alert alert-info p-4">
                <table class="table table-borderless text-light mb-0" style="font-size: 1.1rem;">
                    <tbody>
                        <tr>
                            <th scope="row" class="text-right" style="width: 50%;">Plan:</th>
                            <td class="text-white">{{ session('plan') }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-right">Amount to Pay:</th>
                            <td class="text-white">₱{{ number_format(session('amount'), 2) }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-right">Expected Paid Date:</th>
                            <td class="text-white">{{ session('paid_date') }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-right">Expiry Date:</th>
                            <td class="text-white">{{ session('expiry_date') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p class="text-center mt-3 text-light" style="font-size: 1rem;">
                <strong>Please take a screenshot of this receipt and show it to the admin for approval.</strong>
            </p>
        </div>
        <br><br><br><br><br>    
    @endif
    <!-- Membership Plans Section -->
    <section id="membership" class="container py-5">
        <h2 class="text-center mb-5 text-white">Membership Plans</h2>
        <div class="row justify-content-center">
            @foreach ([['name' => 'Basic Plan', 'price' => 700, 'desc' => 'Access to gym facilities during standard days.', 'moreDesc' => 'The Basic Plan provides access to gym equipment and facilities on weekdays only. It’s perfect for beginners or those who want a cost-effective option.'], ['name' => 'Premium Plan', 'price' => 1400, 'desc' => 'Includes unlimited classes and extra benefits.', 'moreDesc' => 'The Premium Plan offers unlimited access to all group classes, including yoga, pilates, and Zumba, with extended gym hours. Additional perks include discounts on merchandise.'], ['name' => 'VIP Plan', 'price' => 2100, 'desc' => 'All-inclusive access to gym, premium classes, and personal coaching.', 'moreDesc' => 'The VIP Plan includes everything in the Premium Plan, plus personal coaching sessions, priority access to equipment, and complimentary nutrition consultations.']] as $plan)
                <div class="col-md-4 mb-4">
                    <div class="card membership-card shadow-sm border-0">
                        <img class="card-img-top"
                            src="{{ $plan['name'] === 'Basic Plan' ? '/assets/basic-plan.png' : ($plan['name'] === 'Premium Plan' ? '/assets/premium-plan.png' : '/assets/vip-plan.png') }}"
                            alt="{{ $plan['name'] }}">
                        <div class="card-body text-center">
                            <h5 class="card-title text-white">{{ $plan['name'] }}</h5>
                            <p class="card-text text-muted">{{ $plan['desc'] }}</p>
                            <p class="card-text"><strong>₱{{ number_format($plan['price'], 2) }}/month</strong></p>
                            <button class="btn btn-info mb-2" data-toggle="modal"
                                data-target="#{{ Str::slug($plan['name'], '-') }}-modal">View More</button>
                            @if(Auth::check())
                                <a href="{{ route('admin.paymentform', ['id' => Auth::user()->id, 'plan' => $plan['name'], 'amount' => $plan['price']]) }}"
                                    class="btn btn-dark mt-2 w-100">Subscribe</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-secondary mt-2 w-100">Login to Join Now</a>
                            @endif
                        </div>
                    </div>
                </div>



                <!-- Modal for View More -->
                <div class="modal fade" id="{{ Str::slug($plan['name'], '-') }}-modal" tabindex="-1" role="dialog"
                    aria-labelledby="{{ Str::slug($plan['name'], '-') }}-modal-label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content bg-dark text-light">
                            <div class="modal-header border-bottom border-0">
                                <h5 class="modal-title" id="{{ Str::slug($plan['name'], '-') }}-modal-label">
                                    {{ $plan['name'] }} - Details
                                </h5>
                                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>{{ $plan['moreDesc'] }}</p>
                            </div>
                            <div class="modal-footer border-top border-0">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                @if(Auth::check())
                                    <a href="{{ route('admin.paymentform', ['id' => Auth::user()->id, 'plan' => $plan['name'], 'amount' => $plan['price']]) }}"
                                        class="btn btn-light">Subscribe</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary">Login to Join</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>



    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @yield('content')
</body>

</html>