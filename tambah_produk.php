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
    <title>MiniMode - Tambah Produk</title>
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
        .form-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            background: #FF69B4;
            color: white;
            padding: 1rem 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .form-group label {
            font-weight: 500;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            border-color: #FF69B4;
            box-shadow: 0 0 0 2px rgba(255, 105, 180, 0.1);
        }

        select.form-control {
            height: auto !important;
            padding: 0.75rem 1rem;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23FF69B4' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px;
            padding-right: 2.5rem;
        }

        .btn-submit {
            background: #FF69B4;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: #FF1493;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background-color: transparent;
            color: #FF69B4;
            border: 1px solid #FF69B4;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            margin-right: 1rem;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: rgba(255, 105, 180, 0.1);
        }

        .required-field::after {
            content: " *";
            color: #dc3545;
        }

        .main-content {
            padding: 2rem;
        }
    </style>
</head>

<body>
    <?php require "sidebar.html"; ?>

    <nav class="navbar navbar-expand navbar-light shadow-sm py-3">
        <div class="container-fluid">
            <h1 class="h3 mb-0">Tambah Produk Baru</h1>
            
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
        <div class="form-section">
            <h4 class="section-title">Data Produk</h4>
            
            <form id="addProductForm">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required-field">Kode Produk</label>
                            <input type="text" class="form-control" name="kode_produk" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required-field">Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required-field">Kategori</label>
                            <select class="form-control" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Baju">Baju</option>
                                <option value="Celana">Celana</option>
                                <option value="Dress">Dress</option>
                                <option value="Rok">Rok</option>
                                <option value="Sepatu">Sepatu</option>
                                <option value="Aksesoris">Aksesoris</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required-field">Ukuran</label>
                            <select class="form-control" name="ukuran" required>
                                <option value="">Pilih Ukuran</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required-field">Stok</label>
                            <input type="number" class="form-control" name="stok" required min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required-field">Harga (Rp)</label>
                            <input type="number" class="form-control" name="harga" required min="0">
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-cancel" onclick="window.location.href='produk.php'">Batal</button>
                    <button type="submit" class="btn btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#addProductForm').submit(function(e) {
            e.preventDefault();
            
            $.ajax({
                url: 'sv_tambah_produk.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if(response === 'success') {
                        alert('Data produk berhasil disimpan');
                        window.location.href = 'produk.php';
                    } else {
                        alert('Gagal menyimpan data: ' + response);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menyimpan data');
                }
            });
        });
    });
    </script>
</body>
</html>