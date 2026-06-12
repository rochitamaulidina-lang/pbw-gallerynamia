<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Sign Up - Gallery Namia</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* (semua style tetap sama seperti kode Anda, tidak diubah) */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', system-ui, sans-serif; background: #f5f7fb; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-size: 13px; }
        .signup-container { display: flex; width: 100%; min-height: 100vh; overflow: hidden; }
        .left-panel { flex: 1; background: #F5F7FB; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 60px; position: relative; }
        .illustration-content { position: relative; z-index: 2; text-align: center; max-width: 400px; }
        .illustration-content img { max-width: 280px; width: 100%; margin-bottom: 32px; }
        .illustration-content h2 { font-size: 32px; font-weight: 700; color: #1F2937; margin-bottom: 16px; }
        .illustration-content p { font-size: 16px; color: #6B7280; line-height: 1.6; }
        .right-panel { flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; background: #ffffff; padding: 60px; }
        .form-wrapper { max-width: 400px; width: 100%; }
        .signup-header { margin-bottom: 28px; }
        .signup-header h2 { font-size: 28px; font-weight: 700; color: #1F2937; margin-bottom: 6px; }
        .signup-header p { color: #6B7280; font-size: 14px; }
        .alert-error { background: #FEE2E2; border: 1px solid #FECACA; border-radius: 12px; padding: 12px 16px; margin-bottom: 20px; color: #DC2626; font-size: 13px; font-weight: 500; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 12px 16px; background: #F9FAFB; border: 2px solid #E5E7EB; border-radius: 14px; font-size: 13px; color: #1F2937; transition: all 0.3s ease; outline: none; }
        .form-group input:focus { border-color: #ff8c1a; box-shadow: 0 0 0 3px rgba(255, 140, 26, 0.15); background: #ffffff; }
        .form-group input::placeholder { color: #9CA3AF; font-size: 12px; }
        .password-wrapper { position: relative; display: flex; align-items: center; }
        .password-wrapper input { width: 100%; padding: 12px 40px 12px 16px; }
        .toggle-password { position: absolute; right: 14px; cursor: pointer; color: #9CA3AF; font-size: 16px; background: transparent; border: none; display: flex; align-items: center; justify-content: center; }
        .toggle-password:hover { color: #ff8c1a; }
        .signup-btn { display: block; width: 100%; padding: 12px 16px; background: linear-gradient(95deg, #ffb347, #ff8c1a); border: none; border-radius: 40px; font-size: 14px; font-weight: 600; color: #ffffff; text-align: center; cursor: pointer; transition: all 0.3s ease; margin-bottom: 24px; box-shadow: 0 4px 12px rgba(255, 140, 26, 0.3); }
        .signup-btn:hover { background: linear-gradient(95deg, #ffa233, #ff7a0f); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(255, 140, 26, 0.4); }
        .separator { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
        .separator .line { flex: 1; height: 1px; background: #E5E7EB; }
        .separator span { font-size: 11px; color: #9CA3AF; }
        .social-buttons { display: flex; gap: 14px; margin-bottom: 24px; }
        .social-btn { flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 10px; background: #F9FAFB; border: 1px solid #E5E7EB; border-radius: 14px; cursor: pointer; transition: all 0.2s; }
        .social-btn:hover { background: #ffffff; border-color: #ff8c1a; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); }
        .social-btn svg { width: 18px; height: 18px; }
        .social-btn span { font-size: 13px; color: #374151; font-weight: 500; }
        .login-link { text-align: center; }
        .login-link p { font-size: 13px; color: #6B7280; }
        .login-link a { color: #ff8c1a; text-decoration: none; font-weight: 600; margin-left: 4px; }
        .login-link a:hover { text-decoration: underline; color: #ff6b1a; }
        @media (max-width: 900px) {
            .signup-container { flex-direction: column; }
            .left-panel { padding: 40px 24px; min-height: 320px; }
            .illustration-content h2 { font-size: 24px; }
            .illustration-content p { font-size: 14px; }
            .illustration-content img { max-width: 200px; margin-bottom: 24px; }
            .right-panel { padding: 40px 24px; }
            .form-wrapper { max-width: 100%; }
            .signup-header h2 { font-size: 24px; }
        }
        @media (max-width: 480px) {
            .social-btn span { display: none; }
            .social-btn { padding: 10px; }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="left-panel">
            <div class="illustration-content">
                <img src="{{ asset('images/business-person.svg') }}" alt="Business person">
                <h2>Join Us Today</h2>
                <p>Create your account to get started</p>
            </div>
        </div>
        <div class="right-panel">
            <div class="form-wrapper">
                <div class="signup-header">
                    <h2>Create Account</h2>
                    <p>Fill the form to register</p>
                </div>

                @if ($errors->any())
                    <div class="alert-error">
                        ⚠️ {{ $errors->first() }}
                    </div>
                @endif

                {{-- 
                    Modifikasi: 
                    - autocomplete="off" pada form dan input penting
                    - value email dan password dikosongkan (tidak pakai old)
                    - name tetap pakai old agar tidak hilang saat error
                --}}
                <form method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="Enter your full name" value="{{ old('name') }}" required autofocus autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email" value="" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="password" id="password" placeholder="Create a password" required autocomplete="new-password">
                            <button type="button" class="toggle-password" onclick="togglePassword('password', 'toggleIcon1')">
                                <i class="far fa-eye-slash" id="toggleIcon1"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required autocomplete="new-password">
                            <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                                <i class="far fa-eye-slash" id="toggleIcon2"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="signup-btn">Sign Up</button>
                </form>

                <div class="separator">
                    <div class="line"></div>
                    <span>Or continue with</span>
                    <div class="line"></div>
                </div>

                <div class="social-buttons">
                    <div class="social-btn">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 12.066C22 6.755 17.523 2.5 12 2.5C6.477 2.5 2 6.755 2 12.066C2 16.82 5.438 20.736 10 21.5V14.5H7.5V12.5H10V10.5C10 7.875 11.5 6.5 14 6.5C15.2 6.5 16.5 6.7 16.5 6.7V9.3H15.1C13.7 9.3 13.2 10.1 13.2 11V12.5H16.4L15.8 14.5H13.2V21.5C17.8 20.7 21.2 16.8 22 12.066Z" fill="#1877F2" />
                        </svg>
                        <span>Facebook</span>
                    </div>
                    <div class="social-btn">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25C22.56 11.47 22.49 10.72 22.36 10H12V14.26H17.92C17.66 15.63 16.88 16.79 15.71 17.57V20.34H19.28C21.36 18.42 22.56 15.6 22.56 12.25Z" fill="#4285F4" />
                            <path d="M12 23C14.97 23 17.46 22.02 19.28 20.34L15.71 17.57C14.73 18.22 13.48 18.61 12 18.61C9.12 18.61 6.71 16.68 5.87 14.06H2.18V16.92C3.99 20.52 7.7 23 12 23Z" fill="#34A853" />
                            <path d="M5.87 14.06C5.67 13.41 5.55 12.72 5.55 12C5.55 11.28 5.67 10.59 5.87 9.94V7.08H2.18C1.43 8.55 1 10.22 1 12C1 13.78 1.43 15.45 2.18 16.92L5.87 14.06Z" fill="#FBBC05" />
                            <path d="M12 5.39C13.62 5.39 15.06 5.96 16.21 7.03L19.36 3.88C17.45 2.12 14.97 1 12 1C7.7 1 3.99 3.48 2.18 7.08L5.87 9.94C6.71 7.32 9.12 5.39 12 5.39Z" fill="#EA4335" />
                        </svg>
                        <span>Google</span>
                    </div>
                </div>

                <div class="login-link">
                    <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }

        // Pastikan input email dan password benar-benar kosong saat halaman dimuat (mencegah autofill browser)
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirmation');
            
            if (emailInput) emailInput.value = '';
            if (passwordInput) passwordInput.value = '';
            if (confirmInput) confirmInput.value = '';
        });
    </script>
</body>
</html>