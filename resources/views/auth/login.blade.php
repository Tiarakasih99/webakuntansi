<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>

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
        background-image: url('/img/log_in.png');
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding-right: 80px;
    }

    .login-box {
        width: 375px;
        padding: 40px 35px;
        border-radius: 22px;

        background: rgba(255, 255, 255, 0.10);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
    
        border: 1px solid rgba(255, 255, 255, 0.30);
    
        box-shadow:
            0 8px 25px rgba(0, 0, 0, 0.18),
            0 2px 8px rgba(255, 255, 255, 0.3) inset;
    
        animation: fadeIn 0.8s ease forwards;s
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
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.40);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.22), 0 0 18px rgba(255, 255, 255, 0.25) inset;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    
    .glass-icon::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.25), rgba(255,255,255,0.05));
        opacity: 0.5;
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
    
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        -webkit-text-fill-color: white !important;
        transition: background-color 5000s ease-in-out 0s;
        box-shadow: 0 0 0 1000px rgba(255,255,255,0.15) inset !important;
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: white;
        margin-bottom: 20px;
    }

    .remember-forgot label {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .remember-forgot input[type="checkbox"] {
        transform: scale(0.9);
        accent-color: white;
    }

    .login-btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        background: linear-gradient(120deg, #f7faffff);
        background-size: 200% 200%;
        color: white;
        cursor: pointer;
        font-weight: 600;
        color: #594D9B;
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

        <div class="login-title">Welcome, Admin</div>

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