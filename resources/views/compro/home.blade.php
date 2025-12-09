<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Adésté & Co. | Event Organizer</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

  <style>
    :root{
      --accent-a: linear-gradient(135deg,#6f68ff,#8ac6ff 60%);
      --accent-b: linear-gradient(135deg,#ff9ab6,#ffd27a 60%);
      --muted: #6b6b6b;
      --glass: rgba(255,255,255,0.72);
      --card-bg: #ffffff;
      --radius: 14px;
    }

    *{box-sizing:border-box; margin:0; padding:0}
    html,body{height:100%}
    body{
      font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      color: #12263a;
      background: #ffffff;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      line-height:1.45;
      overflow-x:hidden;
    }

    a{color:inherit}
    img{max-width:100%;display:block}

    /* NAVBAR (glass) */
    nav {
      position: fixed;
      top: 18px;
      left: 24px;
      right: 24px;
      z-index: 90;
      display:flex;
      align-items:center;
      justify-content:space-between;
      padding:12px 18px;
      border-radius: 12px;
      background: rgba(255,255,255,0.6);
      backdrop-filter: blur(8px) saturate(120%);
      box-shadow: 0 6px 22px rgba(18,38,58,0.08);
      transition: transform .45s cubic-bezier(.2,.9,.2,1), background .3s;
    }

    nav.scrolled {
      transform: translateY(-6px);
      background: rgba(255,255,255,0.85);
    }

    .nav-left{display:flex;align-items:center;gap:14px}
    .brand {
      display:flex;
      align-items:center;
      gap:10px;
      text-decoration:none;
      color:#0f1724;
      font-weight:700;
      font-size:1.05rem;
      letter-spacing:0.2px;
    }
    .brand img{height:36px; width:auto; border-radius:8px; object-fit:cover}

    .nav-links{display:flex;gap:20px; align-items:center}
    .nav-links a{
      text-decoration:none;
      color:var(--muted);
      font-weight:600;
      padding:8px 10px;
      border-radius:8px;
      transition:all .22s ease;
    }
    .nav-links a:hover{color:#1f2a44; transform:translateY(-3px);}

    .btn-ghost{
      padding:8px 14px;
      border-radius:10px;
      font-weight:700;
      color:white;
      background: linear-gradient(135deg,#6f68ff,#a7a1ff);
      box-shadow: 0 10px 30px rgba(111,104,255,0.18);
      text-decoration:none;
    }

    /* HERO */
    .hero {
      width: auto;
      min-height: 100vh;
      height: 770px;
      position:relative;
      display:flex;
      align-items:center;
      justify-content:flex-end;
    }

    .hero .bg {
      position:absolute;
      inset:0;
      background-image: url('/img/herosect.png');
      background-size:cover;
      background-position:center;
      z-index:-1;
    }

    .hero-inner{
      position:relative;
      text-align:center;
      color:white;
      padding:435px 185px 0 0;
    }

    .hero-ctas{display:flex;gap:14px;justify-content:center;flex-wrap:wrap}
    .btn-primary{
      padding:12px 20px;border-radius:12px;font-weight:700;border:0;cursor:pointer;
      background: linear-gradient(135deg,#6f68ff,#8ac6ff);
      color:white; box-shadow: 0 10px 30px rgba(111,104,255,0.16);
      transition: transform .18s ease, box-shadow .18s ease;
    }
    .btn-primary:hover{transform: translateY(-4px); box-shadow: 0 18px 40px rgba(111,104,255,0.22);}

    .btn-outline{
      padding:12px 18px;border-radius:12px;font-weight:700;border:1px solid rgba(255,255,255,0.16);
      background:transparent;color:white; transition:all .18s;
    }
    .btn-outline:hover{background: rgba(255,255,255,0.06)}

    /* SECTIONS */
    .section {
      padding: clamp(50px,5vw,100px) 25px;
      max-width:1200px;
      margin: 0 auto;
      border-radius: 25px;
    }

    .h2 {
      font-size: 25px;
      font-weight:800;
      color: #0f1724;
      margin-bottom:10px;
      text-align:center;
    }
    
    .lead {
      text-align:center;
      color:var(--muted);
      max-width:820px;
      margin:0 auto 35px;
      font-weight:500;
      line-height:1.5;
    }
    
    /* SERVICES GRID */
    .grid {
      display:grid;
      gap:20px;
    }
    .grid.cols-3 { grid-template-columns: repeat(auto-fit, minmax(250px,1fr)); }
    .card {
      background: var(--card-bg);
      border-radius: var(--radius);
      padding:25px;
      box-shadow: 0 10px 30px rgba(20,30,50,0.10);
      transition: transform .35s cubic-bezier(.2,.10,.2,1), box-shadow .35s;
      will-change:transform;
    }
    .card:hover{transform:translateY(-10px); box-shadow: 0 25px 50px rgba(5, 7, 10, 0.1);}

    .card .icon {
      width:65px;height:65px;border-radius:15px;
      display:grid;place-items:center;font-size:25px;color:white;margin-bottom:15px;
      background: linear-gradient(135deg,#6f68ff,#8ac6ff);
      box-shadow: 0 8px 22px rgba(111,104,255,0.12);
    }
    .card h4{ margin:0 0 8px 0; font-size:18px; font-weight:700; color:#0f1724 }
    .card p{color:var(--muted); margin:0; font-size:13px; line-height:1.5}

    .card ul.mini-list {
      margin: 10px 0 0 0;
      padding-left: 20px;
      color: var(--muted);
      font-size: 13px;
      line-height: 1.5;
    }
    
    .card ul.mini-list li {
      margin-bottom: 5px;
    }
    
    .sub {
      margin: 10px 0 15px;
      color: var(--muted);
    }
    
    .tag-list {
      display: flex;
      flex-wrap: wrap;
      gap: 5px;
    }
    
    .tag-list span {
      background: #DCDEF7;
      margin-top: 5px;
      padding: 5px 10px;
      font-size: 13px;
      border-radius: 10px;
      color: #4b4f67;
      font-weight: 500;
    }
    
    /* PRICING */
    .pricing {
      display:flex;
      gap:35px;
      justify-content:center;
      flex-wrap:wrap;
      margin-top:25px;
    }
    
    .pricing .plan {
      width: 275px;
      border-radius: 15px;
      padding:20px;
      background: linear-gradient(180deg, #fff, #fbfbff);
      box-shadow: 0 15px 30px rgba(10,15,40,0.05);
      text-align: center;
      position:relative;
    }

    .pricing .badge {
      position: absolute;
      top: -15px;
      left: 50%;
      transform: translateX(-50%);
      background: linear-gradient(135deg, #6f68ff, #8ac6ff);
      color: white;
      padding: 6px 14px;
      border-radius: 12px;
      font-size: 12px;
      font-weight: 700;
      box-shadow: 0 8px 20px rgba(111,104,255,0.18);
    }
    
    .price {
      font-weight: 750;
      font-size: 25px;
      color: #0f1724;
      margin-bottom: 10px;
    }

    .pricing-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 24px 45px rgba(8, 16, 40, 0.10);
    }
    
    .pricing-card h4 {
      font-size: 20px;
      margin-bottom: 6px;
      font-weight: 800;
      color: #0f1724;
    }

    .pricing-card .lead {
      font-size: 14px;
      color: var(--muted);
      margin-bottom: 20px;
      line-height: 1.5;
    }
    
    .mini-list {
      text-align: left;
      margin: 10px 0 20px 0;
      padding-left: 25px;
      color: var(--muted);
      font-size: 13px;
      line-height: 1.5;
    }

    .mini-list li {
      margin-bottom: 5px;
    }

    /* GALLERY */
    .masonry { display:grid; grid-template-columns: repeat(auto-fit, minmax(180px,1fr)); gap:12px }
    .masonry .tile { border-radius:12px; overflow:hidden; box-shadow: 0 8px 20px rgba(8,16,40,0.06); }
    .masonry img{width:100%; height:100%; object-fit:cover; display:block; transition: transform .35s }

    .masonry img:hover{ transform: scale(1.04) }

    /* CONTACT FORM */
    .form {
      max-width:860px; margin:0 auto; display:grid; gap:12px; grid-template-columns: 1fr 1fr;
    }
    .form input, .form textarea {
      grid-column: span 2;
      padding:12px 14px; border-radius:10px; border:1px solid #e9eef6; font-size:14px; outline:none;
    }
    .form .half { grid-column: span 1; }
    .form button {
      grid-column: span 2; padding:12px 18px; border-radius:10px; background: linear-gradient(135deg,#6f68ff,#8ac6ff); color:white; font-weight:700; border:0;
    }

    /* FOOTER */
    footer {
      margin-top:36px; padding:44px 24px; background:#0f1724; color:white; border-top-left-radius:28px; border-top-right-radius:28px;
    }
    footer .foot-inner { max-width:1200px; margin:0 auto; display:flex; gap:24px; flex-wrap:wrap; align-items:center; justify-content:space-between }
    footer small{ color: #bfc8d6 }

    /* RESPONSIVE */
    @media (max-width:900px){
      nav{ padding:12px 14px }
      .nav-links{display:none}
      .hero { min-height:700px }
      .hero-title{ font-size: clamp(28px, 7.4vw, 40px) }
      .form{ grid-template-columns: 1fr }
      .form input, .form textarea, .form button { grid-column: auto }
    }
  </style>
</head>
<body>

  <!-- NAV -->
  <nav id="nav">
    <div class="nav-left">
      <a href="#home" class="brand">
        {{-- jika punya logo: <img src="{{ asset('img/logo.png') }}" alt="logo"> --}}
        Adésté & Co.
      </a>
    </div>

    <div class="nav-links" id="navLinks">
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#services">Services</a>
      <a href="#pricing">Pricing</a>
      <a href="#gallery">Gallery</a>
      <a href="#contact">Contact</a>
    </div>

    <a class="btn-ghost" href="/admin/login">Admin</a>
  </nav>

  <!-- HERO -->
  <header class="hero" id="home">
    <div class="bg" id="heroBg" role="img" aria-label="hero image"></div>

    <div class="hero-inner">
      <div class="hero-ctas">
        <button class="btn-primary" id="btnServices">Explore Services</button>
      </div>
    </div>
  </header>

  <!-- ABOUT -->
  <section id="about" class="section">
    <div class="h2">About Adésté</div>
    <p class="lead">We turn ideas into experiences that speak with emotion and timeless elegance.<br>
    Driven by creativity and guided by detail, we blend artistry with strategy to produce events that captivate.<br>
    Every experience we create is crafted with intention—immersive, refined, and distinctly yours.</p>
  </section>

  <!-- SERVICES -->
  <section id="services" class="section" style="background:linear-gradient(180deg, #CDC8EA, #fbfdff);">
    <div class="h2">Our Services</div>

    <div class="grid cols-3" id="servicesGrid" style="margin-top:25px">
      <div class="card">
        <div class="icon"><i class="bi bi-briefcase-fill"></i></div>
        <h4>Corporate Events</h4>
        <p>Professional, strategic, and seamless events for businesses.
          <div class="tag-list">
            <span>Product Launches</span>
            <span>Workshops</span>
            <span>Seminars</span>
            <span>Award Nights</span>
            <span>Team Building</span>
          </div>
        </p>
      </div>
      
      <div class="card">
        <div class="icon"><i class="bi bi-heart-fill"></i></div>
        <h4>Private Celebrations</h4>
        <p>Intimate, elegant, and personalized events crafted with care.
          <div class="tag-list">
            <span>Weddings</span>
            <span>Engagements</span>
            <span>Birthdays</span>
            <span>Anniversaries</span>
            <span>Family Gatherings</span>
          </div>
        </p>
      </div>

      <div class="card">
        <div class="icon"><i class="bi bi-music-note-list"></i></div>
        <h4>Festivals & Public Events</h4>
        <p>Large-scale productions designed to captivate audiences.
          <div class="tag-list">
            <span>Festivals</span>
            <span>Concerts</span>
            <span>Community Events</span>
            <span>Charity Galas</span>
            <span>Brand Activations</span>
          </div>
        </p>
      </div>
    </div>
  </section>

  <!-- PRICING -->
  <section id="pricing" class="section">
    <div class="h2">Packages</div>

    <div class="pricing" id="pricingCards">
      <div class="plan pricing-card">
        <h4>Silver</h4>
        <div class="price">Rp10.000.000</div>
        <p class="lead" style="margin-bottom:15px">Essential planning for intimate events.
          <div class="mini-list">
            <li>Concept Guidance</li>
            <li>Standard Decoration</li>
            <li>Basic Coordination</li>
            <li>Standard Documentation</li>
          </div>
        </p>
        <button class="btn-primary">Choose</button>
      </div>

      <div class="plan pricing-card" style="background: linear-gradient(135deg,#fdf8ff,#eef4ff)">
        <div class="badge">Most Popular</div>
        <h4>Gold</h4>
        <div class="price">Rp25.000.000</div>
        <p class="lead" style="margin-bottom:15px">Full-service planning with elevated production.
          <div class="mini-list">
            <li>Concept Development</li>
            <li>Premium Decoration</li>
            <li>Technical Support</li>
            <li>Premium Documentation</li>
          </div>
        </p>
        <button class="btn-primary">Choose</button>
      </div>

      <div class="plan pricing-card">
        <h4>Platinum</h4>
        <div class="price">Rp40.000.000+</div>
        <p class="lead" style="margin-bottom:15px">Full-customized planning & premium production.
          <ul class="mini-list">
            <li>Custom Event Concept</li>
            <li>Premium Decor & Styling</li>
            <li>VIP Coordination</li>
            <li>Full Documentation</li>
          </ul>
        </p>
        <button class="btn-primary">Choose</button>
      </div>
    </div>
  </section>

  <!-- GALLERY -->
  <section id="gallery" class="section" style="background:linear-gradient(180deg,#fbfdff,#ffffff);">
    <div class="h2">Event Gallery</div>

    <div class="masonry" id="galleryGrid" style="margin-top:18px">
      <div class="tile"><img src="/img/event1.jpg" alt="event 1"></div>
      <div class="tile"><img src="/img/event2.jpg" alt="event 2"></div>
      <div class="tile"><img src="/img/event3.jpg" alt="event 3"></div>
      <div class="tile"><img src="/img/event4.jpg" alt="event 4"></div>
    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact" class="section">
    <div class="h2">Contact Us</div>
    <p class="lead">Interested to plan your next event? Send us a message or request a proposal.</p>

    <form class="form" onsubmit="event.preventDefault(); handleContact();">
      <input type="text" id="name" placeholder="Your name" required>
      <input type="email" id="email" placeholder="Email address" required>
      <textarea id="message" placeholder="Tell us about your event" rows="5" required></textarea>
      <button type="submit">Send Message</button>
    </form>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="foot-inner">
      <div>
        <div style="font-weight:800; font-size:18px; color:#fff;">Adésté & Co.</div>
        <small>Premium Event Management</small>
      </div>
      <div style="text-align:center">
        <small>© {{ date('Y') }} Adésté & Co. All rights reserved.</small>
      </div>
      <div style="text-align:right">
        <small>📍 Batam • 📧 info@adeste.co</small>
      </div>
    </div>
  </footer>

  <!-- SCRIPTS: GSAP animations + small helpers -->
  <script>
    // Init GSAP + ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);

    // // Hero parallax-ish scale on load, simple tilt with scroll
    // gsap.from(".hero-content, .hero-title, .hero-sub", {
    //   opacity: 0, y: 30, duration: 1, ease: "power3.out", stagger: 0.12
    // });

    // gentle bg scale when scrolling
    // gsap.to("#heroBg", {
    //   scale: 1.08,
    //   ease: "none",
    //   scrollTrigger: {
    //     trigger: ".hero",
    //     start: "top top",
    //     end: "bottom top",
    //     scrub: 1
    //   }
    // });

    // nav hide-on-scroll small effect
    const nav = document.getElementById('nav');
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
      const s = window.scrollY;
      if (s > 30) nav.classList.add('scrolled'); else nav.classList.remove('scrolled');
      lastScroll = s;
    });

    // // Stagger-in services
    // gsap.from("#servicesGrid .card", {
    //   y: 20, opacity: 0, duration: .8, ease: "power2.out", stagger: 0.14,
    //   scrollTrigger: { trigger: "#servicesGrid", start: "top 75%" }
    // });

    // pricing cards
    gsap.from("#pricingCards .pricing-card", {
      y: 18, opacity: 0, duration: .8, ease: "power2.out", stagger: 0.12,
      scrollTrigger: { trigger: "#pricingCards", start: "top 80%" }
    });

    // gallery tiles
    gsap.from("#galleryGrid .tile", {
      y: 18, opacity: 0, duration: .8, ease: "power2.out", stagger: 0.08,
      scrollTrigger: { trigger: "#galleryGrid", start: "top 80%" }
    });

    // CTA button nav-to-services
    document.getElementById('btnServices').addEventListener('click', () => {
      document.querySelector('#services').scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    // Simple contact handler (just show toast)
    function handleContact(){
      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();
      const msg = document.getElementById('message').value.trim();
      if(!name||!email||!msg){ alert('Please fill all fields.'); return; }
      // temporary: show success micro-interaction
      gsap.to('footer', { y: -6, duration: .18, yoyo: true, repeat: 1, ease: "power1.inOut" });
      alert('Thanks ' + name + '! We received your message — we will contact you soon.');
      document.querySelector('.form').reset();
    }

    // small accessibility improvement: add focus outlines for keyboard users
    (function(){
      let usingMouse = true;
      window.addEventListener('mousedown', ()=> usingMouse=true);
      window.addEventListener('keydown', ()=> usingMouse=false);
      document.querySelectorAll('a, button, input, textarea').forEach(el=>{
        el.addEventListener('focus', ()=> {
          if(!usingMouse) el.style.outline = '3px solid rgba(111,104,255,0.18)';
        });
        el.addEventListener('blur', ()=> el.style.outline = 'none');
      });
    })();
  </script>
</body>
</html>