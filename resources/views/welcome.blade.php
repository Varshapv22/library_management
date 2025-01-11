<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Library Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            color: #fff;
            font-family: Arial, sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        h1 {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .btn-custom {
            background-color: #ffcc00;
            border: none;
            color: #333;
            font-weight: bold;
            padding: 12px 25px;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #ffa500;
        }
    </style>
</head>
<body>
    <div>
        <h1>Welcome to Library Management System</h1>
        
        <div>
            @guest
                <a href="{{ route('login') }}" class="btn btn-custom">Login</a>
                <a href="{{ route('register') }}" class="btn btn-custom">Register</a>
            @else
                <a href="{{ route('member.books') }}" class="btn btn-custom">Explore Books</a>
            @endguest
        </div>
    </div>
</body>
</html>
