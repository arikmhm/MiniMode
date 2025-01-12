<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
    exit();
}
require "fungsi.php";

// Fetch statistik dari database
$total_produk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM produk"))['total'];

// Get statistik kategori
$kategori_stats = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT 
    COUNT(DISTINCT kategori) as total_kategori,
    SUM(CASE WHEN stok < 10 THEN 1 ELSE 0 END) as stok_menipis,
    SUM(stok) as total_stok
    FROM produk"));

// Get data untuk chart kategori
$kategori_query = mysqli_query($koneksi, "SELECT kategori, COUNT(*) as count FROM produk GROUP BY kategori");
$kategori_labels = [];
$kategori_data = [];
while ($row = mysqli_fetch_assoc($kategori_query)) {
    $kategori_labels[] = $row['kategori'];
    $kategori_data[] = $row['count'];
}

// Get data untuk chart stok per kategori
$stok_query = mysqli_query($koneksi, "SELECT kategori, SUM(stok) as total_stok FROM produk GROUP BY kategori");
$stok_per_kategori_data = [];
$stok_per_kategori_labels = [];
while ($row = mysqli_fetch_assoc($stok_query)) {
    $stok_per_kategori_labels[] = $row['kategori'];
    $stok_per_kategori_data[] = $row['total_stok'];
}

// Get produk dengan stok menipis
$produk_menipis = mysqli_query($koneksi, "SELECT * FROM produk WHERE stok < 10 ORDER BY stok ASC LIMIT 5");

// Get produk terbaru
$produk_terbaru = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY created_at DESC LIMIT 5");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - MiniMode Kids Fashion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
    <script src="bootstrap4/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/page.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/dashboard_style.css">




    <style>
        

        

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .icon-wrapper {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .icon-wrapper.pink {
            background: rgba(255, 105, 180, 0.1);
            color: #FF69B4;
        }

        .icon-wrapper.purple {
            background: rgba(147, 112, 219, 0.1);
            color: #9370DB;
        }

        .icon-wrapper.blue {
            background: rgba(100, 149, 237, 0.1);
            color: #6495ED;
        }

        .icon-wrapper.red {
            background: rgba(255, 69, 0, 0.1);
            color: #FF4500;
        }

        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            height: 400px;
        }

        .product-list {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            height: 400px;
            overflow-y: auto;
        }

        .product-item {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.3s ease;
        }

        .product-item:hover {
            background-color: #FFF5F6;
        }

        .stock-warning {
            color: #FF4500;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <?php require "sidebar.html"; ?>

    <nav class="navbar navbar-expand navbar-light shadow-sm py-3">
        <div class="container-fluid">
            <h1 class="h3 mb-0">Dashboard MiniMode</h1>
            
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
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="icon-wrapper pink">
                        <i class="fas fa-tshirt fa-lg"></i>
                    </div>
                    <h3 class="mb-1"><?php echo $total_produk; ?></h3>
                    <p class="text-muted mb-0">Total Produk</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="icon-wrapper purple">
                        <i class="fas fa-tags fa-lg"></i>
                    </div>
                    <h3 class="mb-1"><?php echo $kategori_stats['total_kategori']; ?></h3>
                    <p class="text-muted mb-0">Kategori Produk</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="icon-wrapper blue">
                        <i class="fas fa-box-open fa-lg"></i>
                    </div>
                    <h3 class="mb-1"><?php echo $kategori_stats['total_stok']; ?></h3>
                    <p class="text-muted mb-0">Total Stok</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="icon-wrapper red">
                        <i class="fas fa-exclamation-triangle fa-lg"></i>
                    </div>
                    <h3 class="mb-1"><?php echo $kategori_stats['stok_menipis']; ?></h3>
                    <p class="text-muted mb-0">Stok Menipis</p>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="chart-container">
                    <h5 class="mb-4">Distribusi Produk per Kategori</h5>
                    <canvas id="kategoriChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h5 class="mb-4">Stok per Kategori</h5>
                    <canvas id="stokChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Lists Row -->
        <div class="row">
            <div class="col-md-6">
                <div class="product-list">
                    <h5 class="mb-4">Produk Stok Menipis</h5>
                    <?php while($produk = mysqli_fetch_assoc($produk_menipis)): ?>
                    <div class="product-item">
                        <div class="d-flex align-items-center">
                            <div class="mr-3">
                                <i class="fas fa-tshirt text-danger"></i>
                            </div>
                            <div>
                                <h6 class="mb-1"><?php echo $produk['nama_produk']; ?></h6>
                                <small class="text-muted d-block">
                                    <?php echo $produk['kategori']; ?> - 
                                    Size <?php echo $produk['ukuran']; ?>
                                </small>
                                <small class="stock-warning">
                                    <i class="fas fa-exclamation-circle"></i>
                                    Stok: <?php echo $produk['stok']; ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-list">
                    <h5 class="mb-4">Produk Terbaru</h5>
                    <?php while($produk = mysqli_fetch_assoc($produk_terbaru)): ?>
                    <div class="product-item">
                        <div class="d-flex align-items-center">
                            <div class="mr-3">
                                <i class="fas fa-tshirt text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1"><?php echo $produk['nama_produk']; ?></h6>
                                <small class="text-muted d-block">
                                    <?php echo $produk['kategori']; ?> - 
                                    Size <?php echo $produk['ukuran']; ?>
                                </small>
                                <small class="text-success">
                                    Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart Kategori
        const kategoriCtx = document.getElementById('kategoriChart').getContext('2d');
        new Chart(kategoriCtx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($kategori_labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($kategori_data); ?>,
                    backgroundColor: [
                        'rgba(255, 105, 180, 0.8)',
                        'rgba(147, 112, 219, 0.8)',
                        'rgba(100, 149, 237, 0.8)',
                        'rgba(255, 182, 193, 0.8)',
                        'rgba(221, 160, 221, 0.8)',
                        'rgba(176, 196, 222, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Chart Stok
        const stokCtx = document.getElementById('stokChart').getContext('2d');
        new Chart(stokCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($stok_per_kategori_labels); ?>,
                datasets: [{
                    label: 'Jumlah Stok',
                    data: <?php echo json_encode($stok_per_kategori_data); ?>,
                    backgroundColor: 'rgba(255, 105, 180, 0.8)',
                    borderColor: 'rgba(255, 105, 180, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    });
    </script>
</body>
</html>