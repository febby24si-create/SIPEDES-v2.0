<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - SIPEDES</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #ffc107;
            --primary-dark: #7c3aed;
            --secondary: #ec4899;
            --accent: #06b6d4;
            --success: #10b981;
            --danger: #ef4444;
            --dark: #0f172a;
            --dark-card: #1e293b;
            --dark-light: #334155;
            --gray: #94a3b8;
            --light: #f1f5f9;
        }

        * {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Background Image with Overlay */
        .bg-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                url('{{ asset('assets/images/nature.jpg') }}') center/cover no-repeat;
            z-index: 0;
            animation: subtleZoom 20s ease-in-out infinite alternate;
        }

        @keyframes subtleZoom {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.05);
            }
        }

        /* Animated Background Particles */
        .bg-decoration {
            position: fixed;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .bg-decoration span {
            position: absolute;
            display: block;
            width: 20px;
            height: 20px;
            background: rgba(139, 92, 246, 0.2);
            animation: float 25s linear infinite;
            bottom: -150px;
            border-radius: 50%;
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.3);
        }

        .bg-decoration span:nth-child(1) {
            left: 25%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
            animation-duration: 20s;
        }

        .bg-decoration span:nth-child(2) {
            left: 10%;
            width: 40px;
            height: 40px;
            animation-delay: 2s;
            animation-duration: 12s;
        }

        .bg-decoration span:nth-child(3) {
            left: 70%;
            width: 60px;
            height: 60px;
            animation-delay: 4s;
            animation-duration: 18s;
        }

        .bg-decoration span:nth-child(4) {
            left: 40%;
            width: 50px;
            height: 50px;
            animation-delay: 0s;
            animation-duration: 18s;
        }

        .bg-decoration span:nth-child(5) {
            left: 85%;
            width: 70px;
            height: 70px;
            animation-delay: 6s;
            animation-duration: 22s;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
            }
        }

        .login-container {
            width: 100%;
            max-width: 1000px;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(139, 92, 246, 0.1);
            animation: slideUp 0.6s ease-out;
            border: 1px solid rgba(139, 92, 246, 0.2);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-left {
            background:
                url('{{ asset('assets/images/nature.jpg') }}') center/cover no-repeat;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgb(108, 137, 0), rgba(102, 155, 53, 0.4));
            z-index: 0;
        }

        .login-left::after {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
            z-index: 0;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 0.3;
                transform: scale(1);
            }
            50% {
                opacity: 0.6;
                transform: scale(1.1);
            }
        }

        .logo-container {
            position: relative;
            z-index: 1;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 100px;
            height: 100px;
            background: rgba(139, 92, 246, 0.3);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            animation: logoFloat 3s ease-in-out infinite;
            box-shadow: 0 8px 32px rgba(139, 92, 246, 0.4);
        }

        /* ======================================================= */
        /* 💡 ATURAN BARU UNTUK GAMBAR LOGO */
        /* ======================================================= */
        .logo-icon .logo-img {
            max-width: 100%;
            max-height: 100%;
            height: auto;
            width: auto;
            object-fit: contain; /* Memastikan seluruh gambar terlihat di dalam wadah */
        }
        /* ======================================================= */

        .logo-icon i {
            font-size: 50px;
            color: white;
            filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
        }

        @keyframes logoFloat {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .login-left h2 {
            font-weight: 800;
            font-size: 32px;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        .login-left p {
            font-size: 16px;
            opacity: 0.95;
            margin-bottom: 30px;
            font-weight: 500;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        .village-info {
            background: rgba(15, 23, 42, 0.4);
            padding: 20px;
            border-radius: 16px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 1;
        }

        .village-info p {
            margin: 8px 0;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
        }

        .village-info i {
            font-size: 16px;
            color: var(--accent);
        }

    .login-right {
        padding: 60px 50px;
        background: url('{{ asset('assets/images/dark.jpg') }}') center/cover no-repeat;
        backdrop-filter: blur(15px) saturate(150%);
        -webkit-backdrop-filter: blur(15px) saturate(150%);
        border-left: 1px solid rgba(255, 255, 255, 0.2);
    }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h4 {
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 8px;
            font-size: 28px;
        }

        .login-header p {
            color: var(--gray);
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            font-weight: 600;
            color: #e2e8f0;
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 18px;
            z-index: 2;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: rgba(15, 23, 42, 0.6);
            color: #f1f5f9;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.2);
            background: rgba(225, 228, 12, 0.8);
        }

        .form-control::placeholder {
            color: #64748b;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            font-size: 18px;
            z-index: 2;
            transition: color 0.3s;
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            border: 2px solid rgba(139, 92, 246, 0.3);
            border-radius: 4px;
            cursor: pointer;
            background: rgba(15, 23, 42, 0.6);
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-label {
            color: var(--gray);
            font-size: 14px;
            cursor: pointer;
        }

        .btn-primary {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(139, 92, 246, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgb(217, 255, 1);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            backdrop-filter: blur(10px);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .alert .btn-close {
            margin-left: auto;
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }

        hr {
            border: none;
            border-top: 1px solid rgba(139, 92, 246, 0.2);
            margin: 30px 0;
        }

        .text-center a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.3s;
        }

        .text-center a:hover {
            color: var(--secondary);
        }

        .copyright {
            text-align: center;
            margin-top: 30px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .small {
            font-size: 13px;
            color: var(--gray);
        }

        /* Glow effect */
        .glow {
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(212, 255, 0, 0.15), transparent);
            border-radius: 50%;
            filter: blur(40px);
            animation: glow 8s ease-in-out infinite;
        }

        .glow:nth-child(1) {
            top: -150px;
            left: -150px;
        }

        .glow:nth-child(2) {
            bottom: -150px;
            right: -150px;
            animation-delay: 4s;
        }

        @keyframes glow {
            0%, 100% {
                opacity: 0.3;
            }
            50% {
                opacity: 0.6;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-left {
                padding: 40px 30px;
            }

            .login-right {
                padding: 40px 30px;
            }

            .login-left h2 {
                font-size: 26px;
            }

            .login-header h4 {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 10px;
            }

            .login-left {
                padding: 30px 20px;
            }

            .login-right {
                padding: 30px 20px;
            }

            .logo-icon {
                width: 80px;
                height: 80px;
            }

            .logo-icon i {
                font-size: 40px;
            }

            .login-left h2 {
                font-size: 24px;
            }

            .login-header h4 {
                font-size: 22px;
            }

            .form-control {
                padding: 12px 12px 12px 44px;
            }

            .btn-primary {
                padding: 12px;
            }
        }
        /* Tambahkan aturan responsif berikut di bagian paling bawah, SETELAH semua CSS yang ada */

/* Tablet Landscape & Small Desktop */
@media (max-width: 1024px) {
    .login-container {
        max-width: 90%;
    }
    
    .login-left, .login-right {
        padding: 50px 35px;
    }
    
    .login-left h2 {
        font-size: 28px;
    }
    
    .login-header h4 {
        font-size: 26px;
    }
}

/* Tablet Portrait */
@media (max-width: 768px) {
    body {
        padding: 15px;
        overflow-y: auto;
    }
    
    .login-container {
        max-width: 100%;
        margin: 20px 0;
    }
    
    .login-card {
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
    }
    
    .login-left, .login-right {
        padding: 40px 30px;
    }
    
    .login-left::after {
        animation: none;
        opacity: 0.3;
    }
    
    .village-info {
        padding: 15px;
        font-size: 13px;
    }
    
    .bg-decoration span {
        display: none; /* Nonaktifkan partikel animasi untuk performa mobile */
    }
}

/* Mobile Large */
@media (max-width: 576px) {
    body {
        padding: 10px;
        align-items: flex-start;
        min-height: 100vh;
        overflow-y: auto;
    }
    
    .login-container {
        margin: 10px 0 30px;
        max-width: 100%;
    }
    
    .login-card {
        border-radius: 18px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }
    
    .row {
        display: flex;
        flex-direction: column;
    }
    
    .col-lg-5, .col-lg-7 {
        width: 100%;
    }
    
    .login-left {
        padding: 35px 25px;
        border-bottom: 1px solid rgba(139, 92, 246, 0.2);
    }
    
    .login-right {
        padding: 35px 25px;
        border-left: none;
    }
    
    .logo-icon {
        width: 85px;
        height: 85px;
    }
    
    .logo-icon .logo-img {
        max-width: 70px;
        max-height: 70px;
    }
    
    .login-left h2 {
        font-size: 26px;
        margin-bottom: 8px;
    }
    
    .login-left p {
        font-size: 14px;
        margin-bottom: 25px;
    }
    
    .login-header h4 {
        font-size: 24px;
        margin-bottom: 6px;
    }
    
    .login-header p {
        font-size: 14px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        font-size: 13px;
    }
    
    .form-control {
        padding: 13px 16px 13px 45px;
        font-size: 14px;
        border-radius: 10px;
    }
    
    .input-icon {
        font-size: 16px;
        left: 14px;
    }
    
    .password-toggle {
        right: 14px;
        font-size: 16px;
    }
    
    .btn-primary {
        padding: 13px;
        font-size: 15px;
        border-radius: 10px;
    }
    
    .btn-primary:hover {
        transform: none; /* Nonaktifkan efek hover di mobile untuk UX yang lebih baik */
    }
    
    .form-check-label {
        font-size: 13px;
    }
    
    .alert {
        padding: 12px 14px;
        font-size: 13px;
    }
    
    .text-center a {
        font-size: 13px;
    }
    
    .copyright {
        margin-top: 25px;
        font-size: 13px;
        padding: 0 10px;
    }
    
    .bg-image {
        animation: none; /* Nonaktifkan animasi zoom untuk performa mobile */
    }
    
    .glow {
        display: none; /* Sembunyikan efek glow untuk performa mobile */
    }
}

/* Mobile Small (Galaxy Fold, iPhone SE, dll) */
@media (max-width: 375px) {
    body {
        padding: 8px;
    }
    
    .login-left, .login-right {
        padding: 30px 20px;
    }
    
    .logo-icon {
        width: 75px;
        height: 75px;
        border-radius: 20px;
    }
    
    .logo-icon .logo-img {
        max-width: 60px;
        max-height: 60px;
    }
    
    .login-left h2 {
        font-size: 24px;
    }
    
    .login-left p {
        font-size: 13px;
    }
    
    .login-header h4 {
        font-size: 22px;
    }
    
    .village-info {
        padding: 12px;
    }
    
    .village-info p {
        font-size: 12px;
        margin: 6px 0;
    }
    
    .form-control {
        padding: 12px 14px 12px 42px;
        font-size: 13px;
    }
    
    .input-icon {
        left: 13px;
    }
    
    .btn-primary {
        padding: 12px;
        font-size: 14px;
    }
    
    .copyright {
        font-size: 12px;
        margin-top: 20px;
    }
}

/* Landscape Orientation untuk Mobile */
@media (max-height: 600px) and (orientation: landscape) {
    body {
        padding: 10px;
        align-items: flex-start;
    }
    
    .login-container {
        max-width: 95%;
        margin: 10px auto;
    }
    
    .login-left, .login-right {
        padding: 25px 20px;
    }
    
    .logo-icon {
        width: 70px;
        height: 70px;
        margin-bottom: 15px;
    }
    
    .logo-icon .logo-img {
        max-width: 50px;
        max-height: 50px;
    }
    
    .login-left h2 {
        font-size: 22px;
        margin-bottom: 5px;
    }
    
    .login-left p {
        font-size: 12px;
        margin-bottom: 15px;
    }
    
    .village-info {
        padding: 10px;
        font-size: 11px;
    }
    
    .village-info p {
        margin: 4px 0;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .copyright {
        margin-top: 20px;
        font-size: 12px;
    }
}

/* Aksesibilitas untuk input di iOS */
@media (max-width: 768px) {
    input, 
    button, 
    textarea, 
    select {
        font-size: 16px !important; /* Mencegah zoom otomatis di iOS */
    }
}

/* Mencegah overflow horizontal */
@media (max-width: 576px) {
    * {
        max-width: 100%;
    }
    
    .login-container,
    .login-card,
    .login-left,
    .login-right,
    .row,
    .col-lg-5,
    .col-lg-7 {
        max-width: 100%;
        overflow-x: hidden;
    }
}
    </style>
</head>

<body>
    <div class="bg-image"></div>

    <div class="bg-decoration">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="login-container">
        <div class="glow"></div>
        <div class="glow"></div>

        <div class="card login-card">
            <div class="row g-0">
                <div class="col-lg-5 login-left">
                    <div class="logo-container">
                        <div class="logo-icon">
                            <img src={{ asset('assets/images/logo3.png') }} alt="Logo SIPEDES" class="logo-img">
                        </div>
                        <h2>SIPEDES</h2>
                        <p>Sistem Informasi Pemerintahan Desa</p>
                    </div>

                    <div class="village-info">
                        <p><i class="fas fa-map-marker-alt"></i> Desa Koto Baru III Jorong</p>
                        <p><i class="fas fa-location-dot"></i> Kec. Baso, Kab. Agam</p>
                        <p><i class="fas fa-phone"></i> 088708230676</p>
                        <p><i class="fas fa-envelope"></i> desa.kotobaru@pemdes.go.id</p>
                    </div>
                </div>

                <div class="col-lg-7 login-right">
                    <div class="login-header">
                        <h4>Selamat Datang</h4>
                        <p>Masuk untuk melanjutkan ke sistem</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <i class="fas fa-exclamation-triangle"></i> {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-wrapper">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" class="form-control" id="email"
                                        name="email" value="{{ old('email') }}"
                                        placeholder="nama@contoh.com" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" class="form-control" id="password"
                                        name="password" placeholder="Masukkan password" required>
                                <button type="button" class="password-toggle" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Masuk
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small class="small">Gunakan akun yang diberikan oleh admin desa</small>
                    </div>

                    <hr>
                    <div class="text-center">
                        <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Belum punya akun? Daftar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright">
            © {{ date('Y') }} Pemerintah Desa Koto Baru III Jorong — SIPEDES
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>