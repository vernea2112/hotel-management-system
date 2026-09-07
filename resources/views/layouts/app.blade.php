<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'HMS') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #e74c3c;
            --success-color: #27ae60;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        .sidebar {
            background-color: var(--primary-color);
            min-height: 100vh;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.7);
            padding: 10px 20px;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255,255,255,.1);
            border-left-color: var(--secondary-color);
        }
        .card {
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,.15);
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: #1a252f;
            border-color: #1a252f;
        }
        .btn-danger {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        .badge-status {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
        }
        .stat-card {
            padding: 20px;
            border-radius: 10px;
            color: white;
            text-align: center;
        }
        .stat-card.guests {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .stat-card.rooms {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .stat-card.reservations {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .stat-card.revenue {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
        .main-content {
            padding: 30px;
        }
        .page-header {
            margin-bottom: 30px;
        }
        .page-header h1 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 10px;
        }
    </style>
    @yield('styles')
</head>
<body>
    @auth
        <div class="d-flex">
            <!-- Sidebar -->
            <nav class="sidebar" style="width: 250px;">
                <div class="px-3 mb-4">
                    <h5 class="text-white"><i class="bi bi-building"></i> HMS</h5>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                            <i class="bi bi-speedometer2"></i> {{ __('messages.dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('guests.*') ? 'active' : '' }}" href="{{ route('guests.index') }}">
                            <i class="bi bi-people"></i> {{ __('messages.guests') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}" href="{{ route('rooms.index') }}">
                            <i class="bi bi-door-closed"></i> {{ __('messages.rooms') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('reservations.*') ? 'active' : '' }}" href="{{ route('reservations.index') }}">
                            <i class="bi bi-calendar-check"></i> {{ __('messages.reservations') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('payments.*') ? 'active' : '' }}" href="{{ route('payments.index') }}">
                            <i class="bi bi-credit-card"></i> {{ __('messages.billing') }}
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="#" id="reportsDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-graph-up"></i> {{ __('messages.reports') }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="reportsDropdown">
                            <li><a class="dropdown-item" href="{{ route('reports.occupancy') }}">{{ __('models.occupancy_rate') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('reports.revenue') }}">{{ __('messages.billing') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('reports.guest') }}">{{ __('messages.guests') }}</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown mt-4">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-globe"></i> {{ app()->getLocale() == 'pt' ? 'Português' : 'English' }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="{{ url('/lang/en') }}">English</a></li>
                            <li><a class="dropdown-item" href="{{ url('/lang/pt') }}">Português</a></li>
                        </ul>
                    </li>
                </ul>
                <hr class="bg-white opacity-10">
                <div class="px-3">
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger w-100">
                            <i class="bi bi-box-arrow-left"></i> {{ __('messages.logout') }}
                        </button>
                    </form>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="flex-grow-1">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid">
                        <span class="navbar-text text-white ms-auto">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </span>
                    </div>
                </nav>

                <!-- Page Content -->
                <div class="main-content">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ __('messages.error') }}!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    @else
        @yield('content')
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
