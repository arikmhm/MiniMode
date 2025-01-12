<!DOCTYPE html>
<html>
<head>
    <title>MiniMode - Kids Fashion Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: #FFD1DC;
            display: flex;
            align-items: center;
            justify-content: center; /* Diubah ke center */
            padding: 2rem;
        }

        .login-form {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            width: 300px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: auto; /* Tambahan untuk memastikan di tengah */
        }

        .brand-title {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
            color: #FF69B4;
            letter-spacing: 2px;
        }

        .brand-title h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0;
        }

        .brand-title p {
            font-size: 0.8rem;
            color: #666;
        }

        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: #FF69B4;
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 105, 180, 0.1);
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            cursor: pointer;
            font-size: 0.8rem;
        }

        .btn-login {
            width: 100%;
            padding: 0.6rem;
            background: #FF69B4;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-login:hover {
            background: #FF1493;
        }

        .alert {
            font-size: 0.8rem;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .login-form {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>

<body>
    <!-- PHP session dan validasi -->
    <?php session_start();
    if (isset($_POST['username'])) {
        require "fungsi.php";
        $username = $_POST['username'];
        $passw = $_POST['passw'];
        
        $stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $passw);
        $stmt->execute();
        $hasil = $stmt->get_result();
        
        if ($hasil->num_rows > 0) {
            $_SESSION['username'] = $username;
            header("location:dashboard.php");
        }
        $stmt->close();
    }
    ?>

    <div class="login-form">
        <div class="brand-title">
            <h1>Mini<br>Mode</h1>
            <p>Kids Fashion Store</p>
        </div>

        <?php if(isset($_POST['username']) && !isset($_SESSION['username'])): ?>
        <div class="alert alert-danger">
            Login gagal. Silakan coba lagi.
        </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-group">
                <label>Username</label>
                <input class="form-control" type="text" name="username" 
                       required autofocus>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <div class="password-field">
                    <input class="form-control" type="password" name="passw" 
                           required>
                    <span class="password-toggle" onclick="togglePassword()">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>

            <button class="btn-login" type="submit">Login</button>
        </form>
    </div>

    <script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
    <script src="bootstrap4/js/bootstrap.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.querySelector('input[type="password"]');
            const toggleIcon = document.querySelector('.password-toggle i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>