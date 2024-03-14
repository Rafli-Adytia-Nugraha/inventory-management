<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-body">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Alita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Inventory Tracking
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/inventory-tracking">Inventory & Adjust Stock</a></li>
                            <li><a class="dropdown-item" href="/inventory-tracking/stock-movements">Stock Movements</a></li>
                            <li><a class="dropdown-item" href="/inventory-tracking/availability-report">Availability Reports</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Stock Management
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/stock-management">Transfer Stock</a></li>
                            <li><a class="dropdown-item" href="/stock-management/reconcile-stock">Reconcile Stock</a></li>
                            <li><a class="dropdown-item" href="/stock-management/stock-transfers">Stock Transfers Reports</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Purchase Orders
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Inventory & Adjust Stock</a></li>
                            <li><a class="dropdown-item" href="#">Stock Movements</a></li>
                            <li><a class="dropdown-item" href="#">Availability Reports</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Purchase Transactions
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Inventory & Adjust Stock</a></li>
                            <li><a class="dropdown-item" href="#">Stock Movements</a></li>
                            <li><a class="dropdown-item" href="#">Availability Reports</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Reorder Point Calculation
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Inventory & Adjust Stock</a></li>
                            <li><a class="dropdown-item" href="#">Stock Movements</a></li>
                            <li><a class="dropdown-item" href="#">Availability Reports</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Inventory Performance
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Inventory & Adjust Stock</a></li>
                            <li><a class="dropdown-item" href="#">Stock Movements</a></li>
                            <li><a class="dropdown-item" href="#">Availability Reports</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Stock Movements
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Inventory & Adjust Stock</a></li>
                            <li><a class="dropdown-item" href="#">Stock Movements</a></li>
                            <li><a class="dropdown-item" href="#">Availability Reports</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Inventory Costs
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Inventory & Adjust Stock</a></li>
                            <li><a class="dropdown-item" href="#">Stock Movements</a></li>
                            <li><a class="dropdown-item" href="#">Availability Reports</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="m-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('js')
</body>

</html>
