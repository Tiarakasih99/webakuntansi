<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Adésté & Co. | Event Organizer</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <style>
      :root{
        --accent-a: linear-gradient(135deg,#6f68ff,#8ac6ff 60%);
        --accent-b: linear-gradient(135deg,#ff9ab6,#ffd27a 60%);
        --muted: #7b7b7b;
        --card-bg: #ffffff;
        --radius: 25px
      }
      
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0
      }
      
      html,body {
        height: 100%
      }
      
      body {
        font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        color: #12263a;
        background: #ffffff;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        line-height: 1.45;
        overflow-x: hidden
      }
      
      a {
        color:inherit
      }

      /* NAV */
      nav {
        position: fixed;
        top: 33px;
        left: 33px;
        right: 33px;
        z-index: 90;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        border-radius: 15px;
        background: rgba(255,255,255,0.5);
        backdrop-filter: blur(5px) saturate(100%);
        box-shadow: 0 5px 20px rgba(20,40,60,0.10);
        transition: transform .50s cubic-bezier(.5,.10,.5,1), background .5s
      }
      
      nav.scrolled {
        transform: translateY(-5px);
        background: rgba(255,255,255,0.85)
      }
      
      .nav-left{
        display: flex;
        align-items: center;
        gap: 15px
      }
      
      .brand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #0f1724;
        font-weight: 700;
        font-size: 1.05rem;
        letter-spacing: 0.3px
      }
      
      .nav-links{
        display: flex;
        gap: 20px;
        align-items: center
      }
      
      .nav-links a{
        text-decoration: none;
        color: var(--muted);
        font-weight: 700;
        padding: 7px 10px;
        border-radius: 7px;
        transition: all .25s ease
      }
      
      .nav-links a:hover{
        color: #1f2a44;
        transform: translateY(-3px)
      }
      
      .nav-links a.active {
        background: linear-gradient(135deg, #6f68ff, #8ac6ff);
        color: white
      }
      
      .btn-ghost{
        padding: 7px 14px;
        border-radius: 7px;
        font-weight: 700;
        color: white;
        background: linear-gradient(135deg, #6f68ff, #8ac6ff);
        box-shadow: 0 10px 30px rgba(110,105,255,0.20);
        text-decoration:none
      }
      
      .hero {
        width: 100%;
        min-height: 100vh;
        height: 825px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: flex-end
      }
      
      .hero .bg {
        position: absolute;
        inset: 0;
        background-image: url('/img/herosect.png');
        background-size: cover;
        background-position: center;
        z-index: -1
      }
      
      .hero-inner{
        position: relative;
        text-align: center;
        color: white;
        padding: 435px 185px 0 0
      }
      
      .hero-ctas{
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap
      }
      
      .btn-primary{
        padding: 15px 20px;
        border-radius: 25px;
        font-weight: 700;
        border: 0;
        cursor: pointer;
        background: linear-gradient(135deg,#6f68ff,#8ac6ff);
        color: white;
        box-shadow: 0 10px 30px rgba(110,105,255,0.20);
        transition: transform .25s ease, box-shadow .25s ease
      }
      
      .btn-primary:hover{
        transform: translateY(-3px);
        box-shadow: 0 20px 40px rgba(110,105,255,0.20)
      }
      
      .section {
        padding: clamp(50px,5vw,100px) 25px;
        max-width: 1200px;
        margin: 0 auto;
        border-radius: 25px
      }
      
      .h2 {
        font-size: 25px;
        font-weight: 750;
        color: #0f1724;
        margin-bottom: 10px;
        text-align: center
      }
      
      .lead {
        text-align: center;
        color: var(--muted);
        max-width: 825px;
        margin: 0 auto 35px;
        font-weight: 500;
        line-height: 1.5
      }
      
      .grid {
        display: grid;
        gap: 20px
      }
      
      .grid.cols-3 {
        grid-template-columns: repeat(auto-fit, minmax(250px,1fr))
      }
      
      .card {
        background: var(--card-bg);
        border-radius: var(--radius);
        padding:25px;
        box-shadow: 0 10px 30px rgba(20,30,50,0.10);
        transition: transform .35s cubic-bezier(.2,.10,.2,2), box-shadow .25s;
        will-change: transform
      }
      
      .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(5, 7, 10, 0.1)
      }
      
      .card .icon {
        width: 65px;
        height: 65px;
        border-radius: 15px;
        display: grid;
        place-items: center;
        font-size: 25px;
        color: white;
        margin-bottom: 15px;
        background: linear-gradient(135deg, #6f68ff, #8ac6ff);
        box-shadow: 0 10px 25px rgba(110,105,255,0.15)
      }
      
      .card h4 {
        margin: 0 0 7px 0;
        font-size: 18px;
        font-weight: 700;
        color: #0f1724
      }
  
      .card p {
        color: var(--muted);
        margin: 0;
        margin-bottom: 7px;
        font-size: 13px;
        line-height: 1.5
      }
      
      .tag-list {
        display: flex;
        flex-wrap: wrap;
        gap: 7px
      }
      
      .tag-list span {
        background: #DCDEF7;
        margin-top: 5px;
        padding: 5px 10px;
        font-size: 13px;
        border-radius: 7px;
        color: #4b4f67;
        font-weight: 500
      }
      
      .pricing {
        display: flex;
        gap: 35px;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 50px
      }
      
      .pricing .plan {
        width: 275px;
        border-radius: 15px;
        padding:20px;
        background: linear-gradient(180deg, #fff, #fbfbff);
        box-shadow: 0 15px 30px rgba(10,15,40,0.05);
        text-align: center;
        position: relative;
      }
  
      .pricing .badge {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #6f68ff, #8ac6ff);
        color: white;
        padding: 5px 15px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 700;
        box-shadow: 0 10px 20px rgba(110,105,255,0.20);
      }
      
      .price {
        font-weight: 750;
        font-size: 25px;
        color: #0f1724;
        margin-bottom: 10px;
      }

      .pricing-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
      }
  
      .pricing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 45px rgba(10, 15, 40, 0.10);
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
      .gallery-row {
        display: flex;
        justify-content: center; 
        gap: 25px;
        width: 90%;
        margin: 25px auto;
      }
      
      .gallery-card {
        width: 30%;
        height: 15vw;
        border-radius: 20px;
        box-shadow: 0 8px 22px rgba(0,0,0,0.05);
        overflow: hidden;
      }
      
      .slider {
        position: relative;
        height: 100%;
        width: 100%;
        overflow: hidden;
        border-radius: 12px;
      }
      
      .slides {
        display: flex;
        transition: transform .4s ease;
      }
      
      .slides img {
        width: 100%;
        height: 100%;
        border-radius: 5px;
        flex-shrink: 0;
        object-fit: cover;
      }
      
      .slider button {
        position:absolute;
        top:50%;
        transform:translateY(-50%);
        background:none;
        border:none;
        color:#fff;
        padding: 0px;
        cursor:pointer;
        font-size:50px;
        font-weight:500;
        z-index: 10; 
      }
      
      .slider .next { right:10px; }
      .slider .prev { left:10px; }
  
      /* CONTACT FORM */
      .form {
        max-width:860px;
        margin:0 auto;
        display:grid;
        gap:12px;
        grid-template-columns: 1fr 1fr;
      }
      .form input, .form textarea {
        grid-column: span 2;
        padding:12px 14px;
        border-radius:10px;
        border:1px solid #e9eef6;
        font-size:14px;
        outline:none;
      }
      
      .form .half {
        grid-column: span 1;
      }
      
      .form button {
        grid-column: span 2;
        padding:12px 18px;
        border-radius:10px;
        background: linear-gradient(135deg,#6f68ff,#8ac6ff);
        color:white;
        font-weight:700;
        border:0;
      }
      
      /* FOOTER */
      footer {
        height:auto;
        margin-top:35px;
        padding:44px 24px;
        background:#0f1724;
        color:white;
        border-top-left-radius:28px;
        border-top-right-radius:28px;
      }
      
      footer .foot-inner {
        max-width:1200px;
        margin:0 auto;
        display:flex;
        gap:24px;
        flex-wrap:wrap;
        align-items:center;
        justify-content:space-between
      }
      
      footer small{
        color: #bfc8d6
      }
      
      footer .socials {
        display: flex;
        gap: 18px;
        font-size: 22px;
      }
      
      footer .socials a {
        color: #bfc8d6;
        text-decoration: none;
        transition: 0.25s ease;
      }
      
      footer .socials a:hover {
        color: #ffffff;
        transform: translateY(-3px);
      }
      
      /* ===== RESPONSIVE ===== */
      /* Tablet */
      @media (max-width: 992px) {
        .gallery-row {
          flex-wrap: wrap;
        }
        .gallery-card {
          flex: 0 0 calc(50% - 10px);
        }
      }
      
      /* HP */
      @media (max-width: 600px) {
        .gallery-card {
          flex: 0 0 100%;
        }
      }
      
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
          Adésté & Co.
        </a>
      </div>
      
      <div class="nav-links" id="navLinks">
        <a href="#home" class="nav-link">Home</a>
        <a href="#about" class="nav-link">About</a>
        <a href="#services" class="nav-link">Services</a>
        <a href="#pricing" class="nav-link">Pricing</a>
        <a href="#gallery" class="nav-link">Gallery</a>
        <a href="#contact" class="nav-link">Contact</a>
      </div>
      
      <a class="btn-ghost" href="/login">Login</a>
    </nav>
  
    <!-- HERO -->
    <header class="hero" id="home">
      <div class="bg" aria-label="hero image"></div>
      
      <div class="hero-inner">
        <div class="hero-ctas">
          <button class="btn-primary" id="btnServices">Explore Services</button>
        </div>
      </div>
    </header>
  
    <!-- ABOUT -->
    <section id="about" class="section">
      <div class="h2">About Adésté</div>
      <p class="lead">
        We turn ideas into experiences that speak with emotion and timeless elegance.<br>
        Driven by creativity and guided by detail, we blend artistry with strategy to produce events that captivate.<br>
        Every experience we create is crafted with intention—immersive, refined, and distinctly yours.
      </p>
    </section>
  
    <!-- SERVICES -->
    <section id="services" class="section" style="background:linear-gradient(180deg, #CDC8EA, #fbfdff);">
      <div class="h2">Our Services</div>
  
      <div class="grid cols-3" id="servicesGrid" style="margin-top:25px">
        <div class="card">
          <div class="icon"><i class="bi bi-briefcase-fill"></i></div>
          <h4>Corporate Events</h4>
          <p>Professional, strategic, and seamless events for businesses.</p>
          <div class="tag-list">
            <span>Seminars</span>
            <span>Product Launches</span>
            <span>Workshops</span>
            <span>Award Nights</span>
            <span>Team Building</span>
          </div>
        </div>
        
        <div class="card">
          <div class="icon"><i class="bi bi-heart-fill"></i></div>
          <h4>Private Celebrations</h4>
          <p>Intimate, elegant, and personalized events crafted with care.</p>
          <div class="tag-list">
            <span>Weddings</span>
            <span>Engagements</span>
            <span>Birthdays</span>
            <span>Anniversaries</span>
            <span>Family Gatherings</span>
          </div>
        </div>
  
        <div class="card">
          <div class="icon"><i class="bi bi-music-note-list"></i></div>
          <h4>Festivals & Public Events</h4>
          <p>Large-scale productions designed to captivate audiences.</p>
          <div class="tag-list">
            <span>Brand Activations</span>
            <span>Festivals</span>
            <span>Concerts</span>
            <span>Community Events</span>
            <span>Charity Galas</span>
          </div>
        </div>
      </div>
    </section>
  
    <!-- PRICING -->
    <section id="pricing" class="section">
      <div class="h2">Packages</div>
  
      <div class="pricing" id="pricingCards">
        <div class="plan pricing-card">
          <h4>Silver</h4>
          <div class="price">Rp25.000.000</div>
          <p class="lead" style="margin-bottom:15px">Essential planning for intimate events.</p>
          <ul class="mini-list">
            <li>Concept Guidance</li>
            <li>Standard Decoration</li>
            <li>Basic Coordination</li>
            <li>Standard Documentation</li>
          </ul>
          <button class="btn-primary btnContact">Choose</button>
        </div>
  
        <div class="plan pricing-card" style="background: linear-gradient(135deg,#fdf8ff,#eef4ff)">
          <div class="badge">Most Popular</div>
          <h4>Gold</h4>
          <div class="price">Rp60.000.000</div>
          <p class="lead" style="margin-bottom:15px">Full-service planning with elevated production.</p>
          <ul class="mini-list">
            <li>Concept Development</li>
            <li>Premium Decoration</li>
            <li>Technical Support</li>
            <li>Premium Documentation</li>
          </ul>
          <button class="btn-primary btnContact">Choose</button>
        </div>
  
        <div class="plan pricing-card">
          <h4>Platinum</h4>
          <div class="price">Rp99.000.000+</div>
          <p class="lead" style="margin-bottom:15px">Full-customized planning & premium production.</p>
          <ul class="mini-list">
            <li>Custom Event Concept</li>
            <li>Premium Decor & Styling</li>
            <li>VIP Coordination</li>
            <li>Full Documentation</li>
          </ul>
          <button class="btn-primary btnContact">Choose</button>
        </div>
      </div>
    </section>
  
    <!-- GALLERY -->
    <section id="gallery" class="section" style="background:linear-gradient(180deg,#fbfdff,#ffffff);">
      <div class="h2">Event Gallery</div>
      
      <div class="gallery-row">
        <!-- Card 1 -->
        <div class="gallery-card">
          <div class="slider">
            <div class="slides">
              <img src="/img/event1.jpg" alt="event1">
              <img src="/img/event2.jpg" alt="event2">
              <img src="/img/event3.jpg" alt="event3">
              <img src="/img/event4.jpg" alt="event4">
              <img src="/img/event5.jpg" alt="event5">
            </div>
            <button class="prev">‹</button>
            <button class="next">›</button>
          </div>
        </div>
        
        <!-- Card 2 -->
        <div class="gallery-card">
          <div class="slider">
            <div class="slides">
              <img src="/img/event6.jpg" alt="event6">
              <img src="/img/event7.jpg" alt="event7">
              <img src="/img/event8.jpg" alt="event8">
              <img src="/img/event9.jpg" alt="event9">
              <img src="/img/event10.jpg" alt="event10">
            </div>
            <button class="prev">‹</button>
            <button class="next">›</button>
          </div>
        </div>
        
        <!-- Card 3 -->
        <div class="gallery-card">
          <div class="slider">
            <div class="slides">
              <img src="/img/event11.jpg" alt="event11">
              <img src="/img/event12.jpg" alt="event12">
              <img src="/img/event13.png" alt="event13">
              <img src="/img/event14.jpg" alt="event14">
              <img src="/img/event15.jpg" alt="event15">
            </div>
            <button class="prev">‹</button>
            <button class="next">›</button>
          </div>
        </div>
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
        
        <div style="text-align:center;">
          <small>© {{ date('Y') }} Adésté & Co. All Rights Reserved.</small>
        </div>
        
        <div class="socials">
          <a href="https://www.tiktok.com" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
          <a href="https://www.instagram.com/" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
          <a href="https://x.com/" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
        </div>
      </div>
    </footer>
    
    <script>
      // Init GSAP + ScrollTrigger
      gsap.registerPlugin(ScrollTrigger);
  
      // nav hide-on-scroll small effect
      const nav = document.getElementById('nav');
      let lastScroll = 0;
      window.addEventListener('scroll', () => {
        const s = window.scrollY;
        if (s > 30) nav.classList.add('scrolled'); else nav.classList.remove('scrolled');
        lastScroll = s;
      });
  
      const sections = document.querySelectorAll("section");
      const navLinks = document.querySelectorAll(".nav-links .nav-link");
  
      window.addEventListener("scroll", () => {
          let current = "";
  
          sections.forEach(sec => {
              const top = window.scrollY;
              const offset = sec.offsetTop - 150;
              const height = sec.offsetHeight;
              const id = sec.getAttribute("id");
  
              if (top >= offset && top < offset + height) {
                  current = id;
              }
          });
  
          navLinks.forEach(link => {
              link.classList.remove("active");
              if (link.getAttribute("href") === "#" + current) {
                  link.classList.add("active");
              }
          });
      });
  
      // Stagger-in services
      gsap.from("#servicesGrid .card", {
        y: 0, opacity: 0, duration: .8, ease: "power2.out", stagger: 0.14,
        scrollTrigger: { trigger: "#servicesGrid", start: "top 75%" }, clearProps: "transform"
      });
  
      gsap.from("#pricingCards .pricing-card", {
        y: 0, opacity: 0, duration: .8, ease: "power2.out", stagger: 0.12,
        scrollTrigger: { trigger: "#pricingCards", start: "top 80%" }, clearProps: "transform"
      });
  
      document.getElementById('btnServices').addEventListener('click', () => {
        document.querySelector('#services').scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
  
      document.querySelectorAll('.btnContact').forEach(btn => {
        btn.addEventListener('click', () => {
          document.querySelector('#contact').scrollIntoView({behavior: 'smooth', block: 'start'});
        });
      });
  
      function handleContact(){
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const msg = document.getElementById('message').value.trim();
        if(!name||!email||!msg){ alert('Please fill all fields.'); return; }
  
        gsap.to('footer', { y: -6, duration: .18, yoyo: true, repeat: 1, ease: "power1.inOut" });
        alert('Thanks ' + name + '! We received your message — we will contact you soon.');
        document.querySelector('.form').reset();
      }
  
      document.querySelectorAll(".gallery-card").forEach((card) => {
        const slides = card.querySelector(".slides");
        const imgs = slides.querySelectorAll("img");
        const prev = card.querySelector(".prev");
        const next = card.querySelector(".next");
        
        let index = 0;
        
        function update() {
          slides.style.transform = `translateX(-${index * 100}%)`;
        }
        
        prev.onclick = () => {
          index = (index - 1 + imgs.length) % imgs.length;
          update();
        };
        
        next.onclick = () => {
          index = (index + 1) % imgs.length;
          update();
        };
      });
  
      function createSlider(slideClass, prevBtn, nextBtn) {
        let index = 0;
        const slides = document.querySelector(slideClass);
        const total = slides.children.length;
        
        document.querySelector(prevBtn).addEventListener('click', () => move(-1));
        document.querySelector(nextBtn).addEventListener('click', () => move(1));
        
        function move(dir) {
          index = (index + dir + total) % total;
          slides.style.transform = `translateX(-${index * 100}%)`;
        }
      }
      
      createSlider('.slides1', '.prev1', '.next1');
      createSlider('.slides2', '.prev2', '.next2');
      createSlider('.slides3', '.prev3', '.next3');
    </script>
  </body>
</html>