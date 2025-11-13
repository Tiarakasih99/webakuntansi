@extends('layoutscompro.landing_main')

@section('title', 'Home - Adésté & Co.')

@section('content')
  <section id="home" 
  class="flex flex-col justify-center items-center text-center text-white h-screen w-full m-0 p-0 relative overflow-hidden"
  style="background: url('/images/bg-event.jpg') center/cover no-repeat;">
  
  <div class="absolute inset-0 bg-black bg-opacity-40"></div>
  
  <div class="relative z-10 p-10 rounded-lg">
  </div>
</section>


  <section id="about" class="py-20 max-w-7xl mx-auto px-6 text-center" style="background-color: #F5E1E0;">
    <h2 class="text-3xl font-bold mb-6" style="color : #7F6169;">About Us</h2>
    <p class="text-gray-600 leading-relaxed">Aura Event Organizer adalah perusahaan profesional yang berdiri sejak 2015, berfokus pada perencanaan dan pelaksanaan acara seperti pernikahan, konser, hingga acara korporasi. Kami menghadirkan pengalaman terbaik bagi setiap klien kami.</p>
  </section>

  <section id="services" class="py-20 bg-gray-50" style="background-color: #F5E1E0;">
    <div class="max-w-7xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold mb-10" style="color : #7F6169;">Our Services</h2>
      <div class="grid md:grid-cols-4 gap-8">
        <div class="p-6 bg-white rounded-xl shadow hover:shadow-lg">
          <h3 class="font-bold text-lg mb-2">💍 Wedding Organizer</h3>
          <p class="text-gray-600">Konsep dan pelaksanaan pernikahan profesional dari awal hingga akhir.</p>
        </div>
        <div class="p-6 bg-white rounded-xl shadow hover:shadow-lg">
          <h3 class="font-bold text-lg mb-2">💼 Corporate Event</h3>
          <p class="text-gray-600">Konferensi, seminar, dan acara perusahaan yang berkesan.</p>
        </div>
        <div class="p-6 bg-white rounded-xl shadow hover:shadow-lg">
          <h3 class="font-bold text-lg mb-2">🎤 Concert & Entertainment</h3>
          <p class="text-gray-600">Produksi panggung, lighting, dan manajemen talent profesional.</p>
        </div>
        <div class="p-6 bg-white rounded-xl shadow hover:shadow-lg">
          <h3 class="font-bold text-lg mb-2">🏛️ Exhibition & Launching</h3>
          <p class="text-gray-600">Pameran produk, grand opening, dan peluncuran brand.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="pricing" class="py-20" style="background-color: #F5E1E0;">
    <div class="max-w-7xl mx-auto px-6 text-center" >
      <h2 class="text-3xl font-bold mb-10" style="color : #7F6169;">Packages & Pricing</h2>
      <div class="grid md:grid-cols-3 gap-8" style= "color : #fffdfcff;">
        <div class="bg-white rounded-xl shadow p-8" style="background-color: #7F6169;">
          <h3 class="text-xl font-semibold mb-2">🥈 Silver</h3>
          <p class="text-gray-600 mb-4" style= "color : #fffdfcff;">Mulai dari</p>
          <p class="text-3xl font-bold mb-6">Rp 15.000.000</p>
          <ul class="text-gray-600 space-y-2 mb-6" style= "color : #fffdfcff;">
            <li>✨ Dekorasi dasar</li>
            <li>🎥 Dokumentasi</li>
            <li>🎤 MC</li>
          </ul>
          <a href="#contact" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700" style="background-color: #F5E1E0; color: #7F6169;">Pilih Paket</a>
        </div>

        <div class="bg-indigo-600 text-white rounded-xl shadow-lg p-8" style="background-color: #7F6169;">
          <h3 class="text-xl font-semibold mb-2">🥇 Gold</h3>
          <p class="text-indigo-200 mb-4" style ="color : #fffdfcff;">Mulai dari</p>
          <p class="text-3xl font-bold mb-6">Rp 25.000.000</p>
          <ul class="space-y-2 mb-6">
            <li>🌸 Full dekorasi</li>
            <li>💡 Lighting premium</li>
            <li>🎥 Dokumentasi profesional</li>
          </ul>
          <a href="#contact" class="bg-white text-indigo-600 px-6 py-2 rounded-md hover:bg-gray-100" style="background-color: #F5E1E0; color: #7F6169;">Pilih Paket</a>
        </div>

        <div class="bg-white rounded-xl shadow p-8" style="background-color: #7F6169;">
          <h3 class="text-xl font-semibold mb-2">💎 Platinum</h3>
          <p class="text-gray-600 mb-4" style ="color : #fffdfcff;">Mulai dari</p>
          <p class="text-3xl font-bold mb-6">Rp 40.000.000</p>
          <ul class="text-gray-600 space-y-2 mb-6" style ="color : #fffdfcff;">
            <li>🎨 Konsep custom</li>
            <li>🎥 Aftermovie</li>
            <li>🪩 Full support</li>
          </ul>
          <a href="#contact" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700" style="background-color: #F5E1E0; color: #7F6169;">Pilih Paket</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact" class="py-20 bg-gray-100" style="background-color: #F5E1E0;">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold mb-6"style="color: #7F6169;">Contact Us</h2>
      <p class="text-gray-600 mb-8">Hubungi kami untuk konsultasi atau permintaan proposal acara Anda.</p>
      <form class="space-y-4">
        <input type="text" placeholder="Nama Anda" class="w-full p-3 border rounded-md">
        <input type="email" placeholder="Email Anda" class="w-full p-3 border rounded-md">
        <textarea placeholder="Pesan" class="w-full p-3 border rounded-md h-32"></textarea>
        <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700"style="background-color: #7F6169; color: #F5E1E0;">Kirim Pesan</button>
      </form>
    </div>
  </section>
@endsection
