{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login • Raninshaa Kitchen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;}
        body{
            font-family:'Poppins',sans-serif;
            background:linear-gradient(135deg,#a8e6cf,#dcedc1);
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:20px;
        }
        .login-card{
            background:#fff;
            border-radius:24px;
            overflow:hidden;
            width:100%;
            max-width:440px;
            box-shadow:0 20px 60px rgba(129,199,132,0.25);
        }
        .header{
            background:linear-gradient(135deg,#81c784,#66bb6a);
            padding:50px 40px;
            text-align:center;
            color:white;
        }
        .logo{
            width:100px;
            height:100px;
            border-radius:50%;
            border:6px solid rgba(255,255,255,0.3);
            margin-bottom:20px;
        }
        .header h2{font-size:28px;font-weight:600;margin-bottom:8px;}
        .header p{font-size:15px;opacity:0.9;}

        .body{padding:40px;}
        .alert{
            padding:14px 18px;
            border-radius:12px;
            margin-bottom:20px;
            font-size:14px;
            display:flex;
            align-items:center;
            gap:10px;
        }
        .alert-success{background:#e8f5e9;color:#2e7d32;border-left:5px solid #66bb6a;}
        .alert-error{background:#ffebee;color:#c62828;border-left:5px solid #ef5350;}

        .form-group{margin-bottom:24px;}
        label{font-weight:500;color:#333;margin-bottom:8px;display:block;}
        input[type="text"],input[type="password"]{
            width:100%;
            padding:16px 18px;
            border:2px solid #e0e0e0;
            border-radius:14px;
            font-size:15px;
            background:#fafafa;
            transition:all .3s;
        }
        input:focus{
            outline:none;
            border-color:#81c784;
            background:white;
            box-shadow:0 0 0 5px rgba(129,199,132,0.15);
        }
        .error-message{color:#e91e63;font-size:13px;margin-top:6px;}

        button[type="submit"]{
            width:100%;
            padding:18px;
            background:linear-gradient(135deg,#66bb6a,#4caf50);
            color:white;
            border:none;
            border-radius:14px;
            font-size:17px;
            font-weight:600;
            cursor:pointer;
            transition:all .3s;
            box-shadow:0 8px 25px rgba(102,187,106,0.4);
        }
        button[type="submit"]:hover{
            transform:translateY(-4px);
            box-shadow:0 15px 35px rgba(102,187,106,0.5);
        }

        .register-link{
            text-align:center;
            margin-top:28px;
            color:#555;
            font-size:14px;
        }
        .register-link a{
            color:#4caf50;
            font-weight:600;
            text-decoration:none;
        }
        .register-link a:hover{color:#388e3c;text-decoration:underline;}
    </style>
</head>
<body>

<div class="login-card">
    <div class="header">
        <img src="{{ asset('storage/img/logo-raninshaa.jpg') }}" alt="Raninshaa Kitchen" class="logo">
        <h2>Selamat Datang Kembali</h2>
        <p>Sistem Penjualan Kue • Raninshaa Kitchen</p>
    </div>

    <div class="body">
        @if(session('error'))
            <div class="alert alert-error">Warning {{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">Check {{ session('success') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required autofocus>
                @error('username')<span class="error-message">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
                @error('password')<span class="error-message">{{ $message }}</span>@enderror
            </div>

            <button type="submit">Login</button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
    </div>
</div>

</body>
</html>