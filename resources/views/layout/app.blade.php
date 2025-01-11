<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        #sidebar {
            height: 100vh;
        }
    </style>
</head>
<body class="bg-light">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-dark text-white">
            <div class="sidebar-header text-center py-4">
                <h4 class="text-uppercase fw-bold">Library Admin</h4>
            </div>
            <ul class="list-unstyled components">
                <li class="my-2">
                    <a href="{{ route('admin.dashboard') }}" class="text-white d-flex align-items-center px-3 py-2">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{ route('admin.upload') }}" class="text-white d-flex align-items-center px-3 py-2">
                        <i class="fas fa-upload me-2"></i> Upload Books
                    </a>
                </li>

                
                <li class="my-2">
                    <a href="{{ route('logout') }}" class="text-white d-flex align-items-center px-3 py-2"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /Sidebar -->

        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <button class="btn btn-dark" id="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <span class="navbar-text ms-auto">
                        <strong>Welcome, {{ Auth::user()->name }}</strong>
                    </span>
                </div>
            </nav>

            <div class="container py-4">
                @yield('content')
            </div>
        </div>
        <!-- /Page Content -->
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Sidebar Toggle Script -->
    <script>
        const menuToggle = document.getElementById("menu-toggle");
        const sidebar = document.getElementById("sidebar");
        menuToggle.addEventListener("click", () => {
            sidebar.classList.toggle("d-none");
        });
    </script>
</body>
</html>
