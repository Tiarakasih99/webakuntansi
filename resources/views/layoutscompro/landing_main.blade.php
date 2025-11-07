<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Company Profile | Event Organizer')</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-white text-gray-800">
 
  <nav class="bg-white shadow-md fixed w-full z-10">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center" style="background-color : #7F6169">
      <a href="/" class="text-2xl font-bold text-indigo-600" style="color : #fffdfcff;">Adésté & Co.</a>
      <div class="space-x-6 hidden md:flex" style="color : #fffdfcff">
        <a href="#home" class="hover:text-indigo-600">Home</a>
        <a href="#about" class="hover:text-indigo-600">About</a>
        <a href="#services" class="hover:text-indigo-600">Services</a>
        <a href="#pricing" class="hover:text-indigo-600">Pricing</a>
        <a href="#contact" class="hover:text-indigo-600">Contact</a>
      </div>
      <a href="/admin/login" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700" style="background-color: #F5E1E0; color : #7F6169;">Admin Login</a>
    </div>
  </nav>

  <main class="pt-04">
    @yield('content')
  </main>

  <footer class="bg-gray-900 text-gray-200 mt-16">
    <div class="max-w-7xl mx-auto px-4 py-10 grid md:grid-cols-3 gap-8">
      <div>
        <h3 class="font-bold text-lg mb-3">désté & Co.</h3>
        <p>Kami membantu Anda mewujudkan acara yang berkesan dan profesional.</p>
      </div>
      <div>
        <h3 class="font-bold text-lg mb-3">Quick Links</h3>
        <ul>
          <li><a href="#home" class="hover:text-white">Home</a></li>
          <li><a href="#services" class="hover:text-white">Services</a></li>
          <li><a href="#pricing" class="hover:text-white">Pricing</a></li>
          <li><a href="#contact" class="hover:text-white">Contact</a></li>
        </ul>
      </div>
      <div>
        <h3 class="font-bold text-lg mb-3">Contact</h3>
        <p>📍 Batam, Indonesia</p>
        <p>📞 +62 812 3456 7890</p>
        <p>📧 info@auraeo.com</p>
      </div>
    </div>
    <div class="bg-gray-800 text-center py-4 text-sm">
      © 2025 Aura Event Organizer. All Rights Reserved.
    </div>
  </footer>
</body>
</html>
