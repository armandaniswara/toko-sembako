<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Home</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet"/>
</head>
<x-navbar></x-navbar>
<body>
    <!-- Hero section start -->
    <section class="hero" id="home">
        <main class="content">
          <h1>Mari Kita <span>Belanja</span></h1>
          <p>
              Ayo Belanja Kebutuhan Harian Anda di Toko Sembako Plus!
          </p>
          <a href="#belanja" class="cta text-decoration-none">Beli Sekarang</a>
        </main>
      </section>
      <!-- Hero section end -->
  
      <!--about section start  -->
      <section id="about" class="about">
        <h2><span>Tentang</span> kami</h2>
  
        <div class="row">
          <div class="about-img">
            <img src="../img/tentang-toko.png" alt="Tentang Kami" />
          </div>
          <div class="content">
            <h3>Kenapa Memilih Toko Kami</h3>
            <p>
              Anda tidak perlu repot keluar rumah! Dengan fitur belanja online, Anda bisa memilih produk, melakukan checkout, dan membayar secara online dengan cepat dan aman.
            </p>
            <p>
              Belanja online di Toko Sembako Plus? Barang Anda akan dikirim dengan cepat dan aman sampai di rumah Anda.
            </p>
          </div>
        </div>
      </section>
      <!--about section end  -->
  
      <!-- Menu section start -->
      <section class="belanja" id="belanja">
        <h2><span>Pergi</span> Belanja</h2>
        <p>"Belanja praktis, harga ekonomis! Semua kebutuhan anda ada di sini!"</p>
        <div class="row">
          <div class="belanja-card">
            <img src="img/belanja/1.png" alt="latte" class="belanja-card-img">
            <h3 class="belanja-card-title">- latte -</h3>
            <p class="belanja-card-price">IDR 15k</p>
          </div>
          <div class="belanja-card">
            <img src="img/belanja/1.png" alt="latte" class="belanja-card-img">
            <h3 class="belanja-card-title">- latte -</h3>
            <p class="belanja-card-price">IDR 15k</p>
          </div>
          <div class="belanja-card">
            <img src="img/belanja/1.png" alt="latte" class="belanja-card-img">
            <h3 class="belanja-card-title">- latte -</h3>
            <p class="belanja-card-price">IDR 15k</p>
          </div>
          <div class="belanja-card">
            <img src="img/belanja/1.png" alt="latte" class="belanja-card-img">
            <h3 class="belanja-card-title">- latte -</h3>
            <p class="belanja-card-price">IDR 15k</p>
          </div>
          <div class="belanja-card">
            <img src="img/belanja/1.png" alt="latte" class="belanja-card-img">
            <h3 class="belanja-card-title">- latte -</h3>
            <p class="belanja-card-price">IDR 15k</p>
          </div>
          <div class="belanja-card">
            <img src="img/belanja/1.png" alt="latte" class="belanja-card-img">
            <h3 class="belanja-card-title">- latte -</h3>
            <p class="belanja-card-price">IDR 15k</p>
          </div>
        </div>
      </section>
      <!-- Menu section end -->
       
      <!-- contact section start -->
      <section class="contact" id="contact">
          <h2><span>Kontak</span> Kami</h2>
          <p>Kami siap membantu Anda. Jika Anda memiliki pertanyaan seputar produk, pemesanan, atau pengiriman, silakan hubungi kami melalui informasi di bawah ini. Tim kami akan merespons secepat mungkin.
          </p>
          <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.3838751535584!2d106.84678!3d-6.324572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69edb95a80be13%3A0x5706156d98d98716!2sJl.%20H.Remaih%20No.24%2C%20RT.2%2FRW.7%2C%20Baru%2C%20Kec.%20Ps.%20Rebo%2C%20Kota%20Jakarta%20Timur%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2013780!5e0!3m2!1sen!2sid!4v1745935690490!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <form action="" class="contact-form">
              <h2>Hubungi Kami</h2>
              <div class="our-contact">
                <i data-feather="phone" class="phone"></i>
                <p>+62 812 1963 2138</p>
              </div>
            </form>
          </div>
      </section>
      <!-- contact section end -->
  
      <!-- footer start -->
      <footer>
        <div class="socials">
          <a href="#"><i data-feather="instagram"></i></a>
          <a href="#"><i data-feather="twitter"></i></a>
          <a href="#"><i data-feather="facebook"></i></a>
        </div>
        <div class="links">
          <a href="#home">Home</a>
          <a href="#about">Tentang Kami</a>
          <a href="#belanja">Pergi Belanja</a>
          <a href="#contact">Kontak</a>
        </div>
        <div class="credit">
          <p class="">Created by <a href="">Arman Daniswara</a> | &copy; 2024.</p>
        </div>
      </footer>
</body>
<script>
    feather.replace();
  </script>
</html>