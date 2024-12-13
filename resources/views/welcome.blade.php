<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Starting - Poliklinik BK</title>
    <!-- Bootstrap 4 -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin-top: 100px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 30px;
            padding: 10px 30px;
            font-size: 1.2rem;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .card {
            border: none;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .card-body {
            text-align: center;
        }
        .fa-user-circle {
            font-size: 4rem;
            margin-bottom: 20px;
        }
        h2 {
            color: #ffffff;
            font-size: 2rem;
            text-align: center;
            margin-top: 30px;
        }
        .admin-login {
            position: fixed;
            top: 10px;
            right: 10px;
            font-size: 1.5rem;
            color: #007bff;
            cursor: pointer;
            z-index: 1000;
        }
        .admin-login:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Tombol Login Admin -->
    <a href="{{ route('login.admin') }}" class="admin-login" title="Admin Login">
        <i class="fas fa-user-shield"></i>
    </a>

    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h2>POLIKLINIK BK</h2>
                <p class="lead">Sistem Temu Janji Pasien - Dokter</p>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <i class="fas fa-user-plus fa-user-circle"></i>
                    <h3>Registrasi Sebagai Pasien</h3>
                    <p>Jika Anda seorang pasien, silakan registrasi terlebih dahulu untuk melakukan pendaftaran.</p>
                    <a href="{{ route('register.pasien') }}" class="btn btn-custom">
                        <i class="fas fa-user-plus"></i> Daftar Sebagai Pasien
                    </a>
                </div>
                <div class="mb-4">
                    <i class="fas fa-sign-in-alt fa-user-circle"></i>
                    <h3>Login Sebagai Dokter</h3>
                    <p>Jika Anda seorang dokter, silakan login untuk memulai melayani pasien.</p>
                    <a href="{{route('login.dokter')}}" class="btn btn-custom">
                        <i class="fas fa-sign-in-alt"></i> Login Sebagai Dokter
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 4 and Font Awesome JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
