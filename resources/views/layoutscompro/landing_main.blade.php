<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Company Profile | Event Organizer')</title>

  <style>
     /* semua CSS kamu tetap sama, jangan hapus */
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

  <!-- PAGE CONTENT -->
  @yield('content')

  <!-- FOOTER -->
  <footer>
     ... footer tetap ...
  </footer>

</body>
</html>