<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modern Login</title>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        height: 100vh;
        width: 100vw;
        overflow: hidden;
    }

    .background {
        width: 100%;
        height: 100%;
        background-image:
            linear-gradient(to bottom right, rgba(157,178,220,0.7), rgba(14,45,108,0.8)),
            url("https://images.unsplash.com/photo-1521791136064-7986c2920216");
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding-right: 80px;
    }

    .login-box {
        width: 360px;
        padding: 40px 35px;
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(18px);
        border: 1px solid rgba(255,255,255,0.2);
        box-shadow: 0 0 30px rgba(0,0,0,0.45);
        animation: fadeIn 0.8s ease forwards;
        transform: translateY(20px);
        opacity: 0;
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .glass-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        border-radius: 22px;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(12px);
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.35);
        box-shadow: 0 10px 28px rgba(0,0,0,0.25);
    }

    .glass-icon::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #9db2dc 0%, #0e2d6c 100%);
        opacity: 0.4;
    }

    .glass-icon i {
        font-size: 32px;
        color: white;
        z-index: 2;
    }

    .login-title {
        text-align: center;
        color: white;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 25px;
    }

    .input-group {
        margin-bottom: 18px;
        position: relative;
    }

    .input-group input {
        width: 100%;
        padding: 12px 40px 12px 15px;
        border-radius: 12px;
        border: none;
        background: rgba(255,255,255,0.22);
        color: white;
        font-size: 14px;
        outline: none;
        backdrop-filter: blur(4px);
    }

    .input-group input::placeholder {
        color: #f1f1f1;
    }

    .input-group i {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: white;
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: white;
        margin-bottom: 20px;
    }

    .remember-forgot a {
        color: #cfe0ff;
        text-decoration: none;
    }

    .login-btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        background: linear-gradient(120deg, #9db2dc, #0e2d6c, #9db2dc);
        background-size: 200% 200%;
        color: white;
        cursor: pointer;
        font-weight: 600;
        transition: 0.4s ease-in-out;
    }

    .login-btn:hover {
        background-position: right center;
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(0,0,0,0.25);
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

</head>
<body>

<div class="background">

    <form action="{{ route('login.process') }}" method="POST" class="login-box">
        @csrf

        <div class="glass-icon">
            <i class="fa-solid fa-right-to-bracket"></i>
        </div>

        <div class="login-title">Login</div>

        @if ($errors->any())
            <div style="color: #ffdede; margin-bottom:10px; text-align:center;">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="input-group">
            <input type="text" name="email" placeholder="Email" required>
            <i class="fa fa-user"></i>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
            <i class="fa fa-lock"></i>
        </div>

        <div class="remember-forgot">
            <label><input type="checkbox" name="remember"> Remember me</label>
        </div>

        <button type="submit" class="login-btn">LOGIN</button>

    </form>

</div>

</body>
</html>
