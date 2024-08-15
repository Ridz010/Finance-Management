<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login SpendSmart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jim+Nightshade&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Poppins;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('https://i.pinimg.com/564x/50/c6/01/50c6016817f5962664b6bf10a7e21579.jpg');
            background-size: cover;            
        }

    /* Untuk layar dengan lebar maksimum 768px */
    @media only screen and (max-width: 768px) {
        .wrapper {
            width: 90%; /* Ubah lebar wrapper */
            padding: 20px; /* Ubah padding */
        }

        .wrapper h1 {
            font-size: 28px; /* Ubah ukuran font */
        }

        .input-box input {
            font-size: 14px; /* Ubah ukuran font input */
        }
    }

    /* Untuk layar dengan lebar maksimum 480px */
    @media only screen and (max-width: 480px) {
        .wrapper {
            width: 100%; /* Ubah lebar wrapper */
        }

        .wrapper h1 {
            font-size: 24px; /* Ubah ukuran font */
        }

        .input-box input {
            font-size: 12px; /* Ubah ukuran font input */
        }
    }


        .wrapper {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(10px);
            color: #fff;
            border-radius: 12px;
            padding: 30px 40px;
        }

        .wrapper h1 {
            font-size: 36px;
            text-align: center;
        }

        .wrapper .input-box {
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
        }

        .input-box input::placeholder {
            color: #fff;
        }

        .wrapper .remember-forgot {
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: -15px 0 15px;
        }

        .remember-forgot label input {
            accent-color: #fff;
            margin-right: 3px;
        }

        .remember-forgot a {
            color: #fff;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .wrapper .btn {
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

        .wrapper .register-link {
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0 15px;
        }

        .register-link p a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link p a:hover {
            text-decoration: underline;

        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form id="loginForm" action="{{ route('login') }}" method="POST">
            @csrf
            <h1>Login</h1>
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="input-box">
                <input type="text" name="email" placeholder="email" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="password" required>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" name="remember">Ingat Saya</label>
                <a href="{{ route('forgot-password-form')}}">Lupa Password</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="register-link">
                <p>Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </form>
    </div>
    <script>
        // Mengecek apakah pengguna berhasil login
        @if(session('success'))
            // Redirect ke halaman dashboard setelah login
            window.location.href = "{{ route('dashboard') }}";
        @endif
    </script>
</body>
</html>