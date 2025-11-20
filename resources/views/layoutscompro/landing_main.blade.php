<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Company Profile | Event Organizer')</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      color: #333;
      background-color: #fff;
    }

    /* === NAVBAR === */
    nav {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background-color: #7F6169;
      padding: 15px 60px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 100;
    }

    nav .logo {
      font-size: 1.6rem;
      font-weight: 700;
      color: #fffdfc;
      text-decoration: none;
    }

    nav .menu a {
      color: #fffdfc;
      text-decoration: none;
      margin: 0 15px;
      font-weight: 500;
      transition: 0.3s;
    }

    nav .menu a:hover {
      color: #F5E1E0;
    }

    nav .login-btn {
      background-color: #F5E1E0;
      color: #7F6169;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }

    nav .login-btn:hover {
      background-color: #fff;
    }

    /* === HERO SECTION === */
    .hero {
      background: url('{{ asset('img/herosection.png') }}') no-repeat center center;
      background-size: cover;
      height: 100vh;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
      margin-top: 65px;
      margin: 70px;
      margin-bottom: 70 px;
    }

    /* === ABOUT SECTION (contoh lanjut ke konten bawah) === */
    #about {
      padding: 100px 80px;
      max-width: 1200px;
      margin: 0 auto;
    }

    #about h2 {
      font-size: 2.2rem;
      color: #7F6169;
      margin-bottom: 20px;
      text-align: center;
    }

    #about p {
      font-size: 1.1rem;
      line-height: 1.7;
      text-align: center;
      color: #444;
    }

    /* === FOOTER === */
    footer {
      background-color: #111;
      color: #ccc;
      padding: 50px 80px 20px;
    }

    footer .footer-container {
      max-width: 1200px;
      margin: auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
    }

    footer h3 {
      color: #fff;
      margin-bottom: 15px;
    }

    footer a {
      color: #ccc;
      text-decoration: none;
    }

    footer a:hover {
      color: #fff;
    }

    footer .bottom {
      text-align: center;
      margin-top: 30px;
      background-color: #222;
      padding: 15px;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <!-- NAVBAR -->
  <nav>
    <a href="/" class="logo">Adésté & Co.</a>
    <div class="menu">
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#services">Services</a>
      <a href="#pricing">Pricing</a>
      <a href="#contact">Contact</a>
    </div>
    <a href="/admin/login" class="login-btn">Admin Login</a>
  </nav>

  <!-- HERO SECTION -->
  <section class="hero" id="home">
    {{-- kalau mau nambah tulisan hero nanti bisa di sini --}}
  </section>

  <!-- ABOUT SECTION -->
  <section id="about">
    <h2>About Us</h2>
    <p>Adésté & Co. adalah event organizer profesional yang berfokus pada menciptakan momen berkesan
      dengan sentuhan elegan dan detail yang sempurna. Kami berkomitmen untuk menghadirkan pengalaman
      yang tak terlupakan bagi setiap klien kami.</p>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="footer-container">
      <div>
        <h3>Adésté & Co.</h3>
        <p>Kami membantu Anda mewujudkan acara yang berkesan dan profesional.</p>
      </div>
      <div>
        <h3>Quick Links</h3>
        <a href="#home">Home</a><br>
        <a href="#services">Services</a><br>
        <a href="#pricing">Pricing</a><br>
        <a href="#contact">Contact</a>
      </div>
      <div>
        <h3>Contact</h3>
        <p>📍 Batam, Indonesia</p>
        <p>📞 +62 812 3456 7890</p>
        <p>📧 info@auraeo.com</p>
      </div>
    </div>
    <div class="bottom">
      © 2025 Aura Event Organizer. All Rights Reserved.
    </div>
  </footer>
</body>
</html>
