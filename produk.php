<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>MiniMode - Kelola Produk</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
    <script src="bootstrap4/js/bootstrap.js"></script>
    

    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/page.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/dashboard_style.css">


    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .search-container {
            position: relative;
            max-width: 300px;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #E2E8F0;
            border-radius: 0.5rem;
            background-color: white;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
        }

        .btn-add {
            background: #FF69B4;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            background: #FF1493;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .table-container {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .table th {
            background-color: #FFF5F6;
            color: #666;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border: none;
        }

        .table td {
            vertical-align: middle;
            border-color: #f0f0f0;
        }

        .kategori-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            background: rgba(255, 105, 180, 0.1);
            color: #FF69B4;
        }

        .stok-warning {
            color: #FF4500;
            font-weight: 500;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 0.375rem;
        }

        .btn-outline-primary {
            color: #FF69B4;
            border-color: #FF69B4;
        }

        .btn-outline-primary:hover {
            background: #FF69B4;
            border-color: #FF69B4;
            color: white;
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            background: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .main-content {
            padding: 2rem;
        }

        /* Animasi untuk rows */
        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #FFF5F6;
        }
    </style>
</head>
<body>
    <?php require "sidebar.html"; ?>

    <nav class="navbar navbar-expand navbar-light shadow-sm py-3">
        <div class="container-fluid">
            <h1 class="h3 mb-0">Kelola Produk</h1>
            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="fas fa-user mr-2"></i><?php echo $_SESSION['username']; ?>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="main-content">
        <div class="page-header">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="search" class="search-input" 
                       placeholder="Cari produk..." autofocus>
            </div>
            
            <a href="tambah_produk.php" class="btn-add">
                <i class="fas fa-plus"></i>
                Tambah Produk
            </a>
        </div>

        <div id="feedback" class="alert" style="display:none;"></div>
        <div class="table-container">
            <div id="result"></div>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>