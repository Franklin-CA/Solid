@extends('layouts.mainprofile')

@section('content')
<div class="container">

    <style>
      
        body {
            background-color: #121212;
            /* Dark background */
            color: #ffffff;
            /* White text */
            font-family: Arial, sans-serif;
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

        .container {
            margin: 20px auto;
            max-width: 600px;
            padding: 20px;
        }

        .card {
            background-color: #1e1e1e;
            /* Dark gray for cards */
            border: 1px solid #333;
            /* Border in darker gray */
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .card-header {
            background-color: #2a2a2a;
            /* Medium gray header */
            padding: 10px 15px;
            font-weight: bold;
            font-size: 1.2em;
            border-bottom: 1px solid #333;
        }

        .card-body {
            padding: 15px;
        }

        p {
            margin: 8px 0;
            color: #dddddd;
            /* Light gray for text */
        }

        a.btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #f44336;
            /* Red button for logout */
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        a.btn:hover {
            background-color: #d32f2f;
            /* Darker red on hover */
        }

        form {
            margin-top: 10px;
        }
    </style>

<br><br><br>
<h1>Profile</h1>
    <div class="card">
        <div class="card-header">User Details</div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst($user->usertype) }}</p>
            <p><strong>Age:</strong>{{$user->age ?? 'N/A'}}</p>
            <p><strong>Address:</strong>{{$user->address ?? 'N/A'}}</p>
        </div>
    </div>
    
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        class="btn btn-danger mt-3">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
@endsection