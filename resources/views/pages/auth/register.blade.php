<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registrasi - SIPEDES</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #8b5cf6;
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
        /* .bg-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                url('https://images.unsplash.com/photo-1587474260584-136574528ed5?q=80&w=2070') center/cover no-repeat;
            z-index: 0;
            animation: subtleZoom 20s ease-in-out infinite alternate;
        } */
         /* Background Image with Overlay */
        .bg-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('assets/img/mountain.jpg') }}') center/cover no-repeat;
            z-index: 0;
            animation: subtleZoom 20s ease-in-out infinite alternate;
        }


        @keyframes subtleZoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.05); }
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

        .register-container {
            width: 100%;
            max-width: 1100px;
            position: relative;
            z-index: 1;
        }

        .register-card {
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

        .register-left {
            background: 
                url('{{ asset('assets/img/mountain.jpg') }}') center/cover no-repeat;            
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

        .register-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.4), rgba(236, 72, 153, 0.4));
            z-index: 0;
        }

        .register-left::after {
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

        .logo-icon i {
            font-size: 50px;
            color: white;
            filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .register-left h2 {
            font-weight: 800;
            font-size: 32px;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        .register-left p {
            font-size: 16px;
            opacity: 0.95;
            margin-bottom: 25px;
            font-weight: 500;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        .features-list {
            margin-top: 20px;
            position: relative;
            z-index: 1;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            padding: 12px 16px;
            background: rgba(15, 23, 42, 0.4);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            text-align: left;
        }

        .feature-item:hover {
            background: rgba(15, 23, 42, 0.6);
            transform: translateX(5px);
        }

        .feature-item i {
            font-size: 18px;
            color: var(--accent);
        }

        .register-right {
            padding: 50px 45px;
            background: rgba(30, 41, 59, 0.8);
        }

        .register-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .register-header h4 {
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 8px;
            font-size: 28px;
        }

        .register-header p {
            color: var(--gray);
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #e2e8f0;
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid rgba(139, 92, 246, 0.3);
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: rgba(15, 23, 42, 0.6);
            color: #f1f5f9;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.2);
            background: rgba(15, 23, 42, 0.8);
        }

        .form-control::placeholder {
            color: #64748b;
        }

        .password-strength {
            height: 6px;
            border-radius: 3px;
            margin-top: 8px;
            background: rgba(15, 23, 42, 0.6);
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .strength-weak {
            background: #ef4444;
            width: 25%;
        }

        .strength-medium {
            background: #f59e0b;
            width: 50%;
        }

        .strength-strong {
            background: #10b981;
            width: 75%;
        }

        .strength-very-strong {
            background: #06b6d4;
            width: 100%;
        }

        .role-option {
            border: 2px solid rgba(139, 92, 246, 0.3);
            border-radius: 12px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(15, 23, 42, 0.4);
            text-align: center;
        }

        .role-option:hover {
            border-color: var(--primary);
            background: rgba(15, 23, 42, 0.6);
            transform: translateY(-3px);
        }

        .role-option.active {
            border-color: var(--primary);
            background: rgba(139, 92, 246, 0.2);
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.3);
        }

        .role-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .role-option h6 {
            color: #f1f5f9;
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 16px;
        }

        .role-option p {
            color: var(--gray);
            font-size: 13px;
            margin: 0;
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
            box-shadow: 0 8px 30px rgba(139, 92, 246, 0.5);
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

        .invalid-feedback {
            color: #fca5a5;
            font-size: 13px;
            margin-top: 5px;
        }

        .is-invalid {
            border-color: var(--danger) !important;
        }

        hr {
            border: none;
            border-top: 1px solid rgba(139, 92, 246, 0.2);
            margin: 25px 0;
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

        .small, .text-muted {
            font-size: 13px;
            color: var(--gray);
        }

        .glow {
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.15), transparent);
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
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .register-left, .register-right {
                padding: 40px 30px;
            }

            .register-left h2 {
                font-size: 26px;
            }

            .register-header h4 {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 10px;
            }

            .register-left, .register-right {
                padding: 30px 20px;
            }

            .logo-icon {
                width: 80px;
                height: 80px;
            }

            .logo-icon i {
                font-size: 40px;
            }

            .register-left h2 {
                font-size: 24px;
            }

            .register-header h4 {
                font-size: 22px;
            }

            .form-control {
                padding: 12px 14px;
            }

            .btn-primary {
                padding: 12px;
            }
        }
    </style>
</head>

<body>
    <!-- Background Image -->
    <div class="bg-image"></div>

    <!-- Animated Background Particles -->
    <div class="bg-decoration">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="register-container">
        <div class="glow"></div>
        <div class="glow"></div>
        
        <div class="card register-card">
            <div class="row g-0">
                <!-- Left Side -->
                <div class="col-lg-5 register-left">
                    <div class="logo-container">
                        <div class="logo-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h2>SIPEDES</h2>
                        <p>Sistem Informasi Pemerintahan Desa</p>
                    </div>
                    
                    <div class="features-list">
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Digitalisasi administrasi desa</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Pelayanan masyarakat efisien</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Transparansi pengelolaan desa</span>
                        </div>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="col-lg-7 register-right">
                    <div class="register-header">
                        <h4>Buat Akun Baru</h4>
                        <p>Lengkapi data untuk mendaftar</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i> Terdapat kesalahan pada form
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}"
                                   placeholder="Masukkan nama lengkap" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}"
                                   placeholder="nama@contoh.com" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" id="password" placeholder="Buat password" required>
                                <div class="password-strength">
                                    <div class="password-strength-bar" id="password-strength-bar"></div>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" class="form-control"
                                       name="password_confirmation" placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Pilih Role</label>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <div class="role-option" data-role="admin">
                                        <div class="role-icon">
                                            <i class="fas fa-crown" style="color: #f59e0b;"></i>
                                        </div>
                                        <h6>Administrator</h6>
                                        <p>Akses penuh sistem</p>
                                        <input class="d-none" type="radio" name="role" value="admin" {{ old('role') == 'admin' ? 'checked' : '' }}>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <div class="role-option active" data-role="operator">
                                        <div class="role-icon">
                                            <i class="fas fa-user" style="color: #06b6d4;"></i>
                                        </div>
                                        <h6>Operator</h6>
                                        <p>Akses terbatas</p>
                                        <input class="d-none" type="radio" name="role" value="operator" {{ old('role') == 'operator' ? 'checked' : '' }} checked>
                                    </div>
                                </div>
                            </div>
                            @error('role')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Daftar
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small class="small">Pastikan data yang dimasukkan valid</small>
                    </div>

                    <hr>
                    <div class="text-center">
                        <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Sudah punya akun? Login</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright">
            © {{ date('Y') }} Pemerintah Desa Koto Baru III Jorong — SIPEDES
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Role selection
        document.querySelectorAll('.role-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.role-option').forEach(opt => {
                    opt.classList.remove('active');
                });
                this.classList.add('active');
                const radioInput = this.querySelector('input[type="radio"]');
                radioInput.checked = true;
            });
        });

        // Password strength indicator
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('password-strength-bar');
        
        if (passwordInput && strengthBar) {
            passwordInput.addEventListener('input', function(e) {
                const password = e.target.value;
                const strength = checkPasswordStrength(password);
                
                strengthBar.className = 'password-strength-bar';
                
                if (password.length > 0) {
                    strengthBar.classList.add(`strength-${strength.level}`);
                }
            });
        }

        function checkPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 6) strength++;
            if (password.match(/[a-z]+/)) strength++;
            if (password.match(/[A-Z]+/)) strength++;
            if (password.match(/[0-9]+/)) strength++;
            if (password.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/)) strength++;

            if (strength <= 2) return { level: 'weak' };
            if (strength <= 3) return { level: 'medium' };
            if (strength <= 4) return { level: 'strong' };
            return { level: 'very-strong' };
        }

        // Password confirmation validation
        const confirmPasswordInput = document.querySelector('input[name="password_confirmation"]');
        if (confirmPasswordInput) {
            confirmPasswordInput.addEventListener('input', function(e) {
                const password = passwordInput.value;
                const confirm = e.target.value;
                e.target.classList.toggle('is-invalid', password !== confirm && confirm.length > 0);
            });
        }
    </script>
</body>
</html>