<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Gallery Namia</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* (Gaya CSS tetap sama, tidak diubah) */
        *{ margin:0; padding:0; box-sizing:border-box; }
        body{ font-family:'Poppins',sans-serif; background:#f5f7fb; min-height:100vh; }
        .container{ display:flex; min-height:100vh; }
        .left-panel{ flex:1; background:#F5F7FB; display:flex; justify-content:center; align-items:center; padding:60px; }
        .illustration{ text-align:center; max-width:400px; }
        .illustration img{ width:280px; max-width:100%; margin-bottom:30px; }
        .illustration h2{ font-size:32px; color:#1F2937; margin-bottom:12px; }
        .illustration p{ color:#6B7280; line-height:1.6; }
        .right-panel{ flex:1; display:flex; justify-content:center; align-items:center; background:white; padding:60px; }
        .form-wrapper{ width:100%; max-width:400px; }
        .form-wrapper h2{ font-size:30px; margin-bottom:5px; color:#1F2937; }
        .form-wrapper p{ color:#6B7280; margin-bottom:25px; }
        .form-group{ margin-bottom:18px; }
        .form-group label{ display:block; margin-bottom:6px; font-size:13px; font-weight:600; }
        .form-group input{ width:100%; padding:12px 15px; border:2px solid #E5E7EB; border-radius:14px; background:#F9FAFB; outline:none; }
        .form-group input:focus{ border-color:#ff8c1a; }
        .password-wrapper{ position:relative; }
        .password-wrapper input{ width:100%; padding-right:50px; }
        .toggle-password{ position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer; color:#9CA3AF; transition:.3s; }
        .toggle-password:hover{ color:#ff8c1a; }
        .remember{ display:flex; align-items:center; gap:8px; margin-bottom:20px; }
        .btn-login{ width:100%; border:none; padding:13px; border-radius:40px; cursor:pointer; color:white; font-weight:600; background:linear-gradient(95deg,#ffb347,#ff8c1a); }
        .btn-login:hover{ opacity:.9; }
        .error-box{ background:#FEE2E2; color:#DC2626; padding:12px; border-radius:10px; margin-bottom:15px; }
        .register{ margin-top:20px; text-align:center; }
        .register a{ color:#ff8c1a; text-decoration:none; font-weight:600; }
        @media(max-width:900px){ .container{ flex-direction:column; } .left-panel{ min-height:300px; } }
    </style>
</head>

<body>

<div class="container">
    <div class="left-panel">
        <div class="illustration">
            <img src="{{ asset('images/business-person.svg') }}" alt="Illustration">
            <h2>Start Your Journey</h2>
            <p>Access your account to manage your store</p>
        </div>
    </div>

    <div class="right-panel">
        <div class="form-wrapper">
            <h2>Sign In</h2>
            <p>Enter your account to proceed</p>

            @if ($errors->any())
                <div class="error-box">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Hapus readonly dan onfocus, cukup gunakan autocomplete dan javascript --}}
            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf

                <div class="form-group">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           id="email"
                           value=""
                           placeholder="Enter your email"
                           autocomplete="off"
                           required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password"
                               id="password"
                               name="password"
                               placeholder="Enter your password"
                               autocomplete="new-password"
                               required>
                        <span class="toggle-password" onclick="togglePassword()">
                            <i class="fa-regular fa-eye-slash" id="eyeIcon"></i>
                        </span>
                    </div>
                </div>

                <label class="remember">
                    <input type="checkbox" name="remember"> Remember me
                </label>

                <button type="submit" class="btn-login">Sign In</button>
            </form>

            @if (Route::has('register'))
                <div class="register">
                    Don't have an account?
                    <a href="{{ route('register') }}">Sign Up</a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (password.type === 'password') {
            password.type = 'text';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        } else {
            password.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    }

    // Kosongkan input saat load (mencegah autofill browser)
    document.addEventListener('DOMContentLoaded', function() {
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        if (email) email.value = '';
        if (password) password.value = '';
    });
</script>

</body>
</html>