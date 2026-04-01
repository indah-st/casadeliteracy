<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Casa De Literacy</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
html{
    scroll-behavior:smooth;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    background:#ffffff;
    color:#222;
}

/* ===== NAVBAR ===== */
.navbar{
    position:fixed;
    top:0;
    width:100%;
    z-index:1000;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 60px;
    background:white;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.logo{
    display:flex;
    align-items:center;
    gap:10px;
}

.logo img{
    width:40px;
}

.logo h2{
    color:#03AC0E;
    font-size:22px;
}

.menu a{
    margin-left:30px;
    text-decoration:none;
    color:#333;
    font-weight:500;
    position:relative;
    padding-bottom:5px;
}

.menu a::after{
    content:"";
    position:absolute;
    left:0;
    bottom:0;
    width:0%;
    height:2px;
    background:#03AC0E;
    transition:0.3s;
}

.menu a:hover::after,
.menu a.active::after{
    width:100%;
}

.btn-login{
    background:#03AC0E;
    color:white !important;
    padding:8px 18px;
    border-radius:8px;
}

/* ===== HERO ===== */
.hero{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:140px 60px 80px;
}

.hero-text{
    width:50%;
}

.hero-text h1{
    font-size:50px;
    line-height:1.2;
}

.hero-text span{
    color:#03AC0E;
}

.hero-text p{
    margin:20px 0 30px;
    color:#555;
    max-width:500px;
}

.hero-image{
    width:50%;
    text-align:center;
}

.hero-image img{
    width:95%;
    max-width:500px;
}

/* ===== KONTAK ===== */
.kontak{
    background:linear-gradient(to right,#eafff0,#f6fffa);
    padding:100px 60px;
    text-align:center;
}

.kontak h2{
    font-size:36px;
    color:#03AC0E;
    margin-bottom:10px;
}

.kontak p{
    color:#555;
    margin-bottom:50px;
}

.kontak-container{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:25px;
}

.kontak-item{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(3,172,14,0.15);
    transition:0.3s;
}

.kontak-item:hover{
    transform:translateY(-6px);
}

.kontak-item h4{
    color:#03AC0E;
    margin-bottom:8px;
}

/* ===== RESPONSIVE ===== */
@media(max-width:900px){
    .hero{
        flex-direction:column;
        text-align:center;
    }

    .hero-text,.hero-image{
        width:100%;
    }

    .kontak-container{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:500px){
    .kontak-container{
        grid-template-columns:1fr;
    }

    .navbar{
        padding:15px 25px;
    }
}
</style>
</head>

<body>

<header class="navbar">
    <div class="logo">
        <img src="{{ asset('images/Logo.jpeg') }}" alt="Logo">
        <h2>Casa De Literacy</h2>
    </div>

    <nav class="menu">
        <a href="#beranda" class="active">Beranda</a>
        <a href="#kontak">Kontak</a>
        <a href="/login" class="btn-login">Login</a>
    </nav>
</header>

<section class="hero" id="beranda">
    <div class="hero-text">
        <h1>
            Bangun Budaya Membaca <br>
            <span>Bersama Casa De Literacy</span>
        </h1>
        <p>
            Membaca buku memberikan banyak manfaat bagi perkembangan intelektual dan karakter seseorang. 
            Melalui membaca, wawasan pengetahuan semakin luas, kemampuan berpikir kritis meningkat, serta daya 
            imajinasi dan kreativitas dapat berkembang dengan baik.
        </p>
    </div>

    <div class="hero-image">
        <img src="{{ asset('images/Literasi.jpeg') }}" alt="Literasi">
    </div>
</section>

<section class="kontak" id="kontak">
    <h2>Hubungi Kami</h2>
    <p>Casa De Literacy siap menjadi ruang literasi dan sumber pengetahuan bagi semua.</p>

    <div class="kontak-container">
        <div class="kontak-item">
            <h4>Email</h4>
            <p>casadeliteracy@gmail.com</p>
        </div>

        <div class="kontak-item">
            <h4>WhatsApp</h4>
            <p>+62 838-9333-4750</p>
        </div>

        <div class="kontak-item">
            <h4>Instagram</h4>
            <p>@casadeliteracy</p>
        </div>

        <div class="kontak-item">
            <h4>Alamat</h4>
            <p>Jl. Malioboro No. 101, Sosromenduran, Gedong Tengen, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55271.</p>
        </div>
    </div>
</section>

<script>
const menuLinks = document.querySelectorAll(".menu a");

menuLinks.forEach(link => {
    link.addEventListener("click", function () {
        // hapus active dari semua menu
        menuLinks.forEach(item => item.classList.remove("active"));

        // tambahin active ke yang diklik
        this.classList.add("active");
    });
});
</script>


</body>
</html>
