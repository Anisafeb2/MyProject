@extends('layouts.app')

@section('content')
<!-- Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;600&display=swap');

  body {
    font-family: 'Montserrat', sans-serif;
    margin: 0;
    background: linear-gradient(135deg, #0f112b, #1b1e3e);
    color: #f1f1f1;
    overflow-x: hidden;
  }

  .hero {
    min-height: 100vh;
    background: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1470&q=80') center / cover no-repeat;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2rem;
  }

  .hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(15, 15, 45, 0.8), rgba(15, 15, 45, 0.95));
    backdrop-filter: blur(10px);
    border-radius: 20px;
  }

  .glass-card {
    position: relative;
    z-index: 2;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 3rem;
    max-width: 850px;
    text-align: center;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    animation: fadeIn 1s ease-out;
  }

  .logo-title {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.6rem;
    margin-bottom: 1rem;
    animation: fadeInDown 1s ease-out;
  }

  .logo-title i {
    font-size: 2rem;
    color: #b197fc;
  }

  .logo-title span {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: #ffffff;
  }

  .hero-tagline {
    font-size: 0.95rem;
    font-weight: 600;
    color: #b3b3f0;
    letter-spacing: 1px;
    margin-bottom: 0.6rem;
    text-transform: uppercase;
    animation: fadeIn 1.5s ease-out;
  }

  .divider {
    width: 80px;
    height: 2px;
    background-color: #8e2de2;
    margin: 0 auto 1.5rem;
    border-radius: 5px;
    animation: fadeIn 1.5s ease-out;
  }

  .hero-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.8rem;
    margin-bottom: 1rem;
    color: #ffffff;
    animation: fadeInUp 1.5s ease-out;
  }

  .hero-subtitle {
    font-size: 1.2rem;
    color: #d0d0e0;
    margin-bottom: 2rem;
    animation: fadeInUp 1.7s ease-out;
  }

  .hero-buttons {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    flex-wrap: wrap;
    animation: fadeIn 2s ease-out;
  }

  .hero-buttons a {
    text-decoration: none;
    padding: 0.9rem 2rem;
    border-radius: 40px;
    font-weight: 600;
    transition: 0.3s;
    display: inline-block;
  }

  .btn-primary-hero {
    background: linear-gradient(135deg, #8e2de2, #4a00e0);
    color: #fff;
    border: none;
  }

  .btn-primary-hero:hover {
    opacity: 0.9;
    transform: scale(1.05);
  }

  .btn-outline-hero {
    background: transparent;
    border: 2px solid #8e2de2;
    color: #8e2de2;
  }

  .btn-outline-hero:hover {
    background: #8e2de2;
    color: #fff;
    transform: scale(1.05);
  }

  .scroll-down {
    margin-top: 2.5rem;
    font-size: 2rem;
    color: #b197fc;
    cursor: pointer;
    animation: bounce 2s infinite;
  }

  @keyframes fadeIn {
    0% {opacity: 0;}
    100% {opacity: 1;}
  }

  @keyframes fadeInDown {
    0% {opacity: 0; transform: translateY(-20px);}
    100% {opacity: 1; transform: translateY(0);}
  }

  @keyframes fadeInUp {
    0% {opacity: 0; transform: translateY(20px);}
    100% {opacity: 1; transform: translateY(0);}
  }

  @keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(10px); }
  }

  footer {
    background: #0f112b;
    padding: 1.2rem;
    text-align: center;
    color: #888aaa;
    font-size: 0.9rem;
  }
</style>

<div class="hero" id="hero">
  <div class="glass-card">
    <div class="logo-title">
      <i class="fas fa-book-reader"></i>
      <span>LiteraNet</span>
    </div>

    <div class="hero-tagline">Perpustakaan Digital Modern</div>
    <div class="divider"></div>

    <h1 class="hero-title">Selamat Datang di LiteraNet</h1>
    <p class="hero-subtitle">Jelajahi dunia pengetahuan tanpa batas. Kelola buku, anggota, dan peminjaman dengan sistem yang modern dan efisien.</p>

    <div class="hero-buttons">
      <a href="{{ route('login') }}" class="btn-primary-hero">Login</a>
      <a href="{{ route('register') }}" class="btn-outline-hero">Daftar</a>
    </div>

    <div class="scroll-down" id="scrollDown" title="Scroll ke bawah">
      ↓
    </div>
  </div>
</div>

<footer>
  &copy; 2025 LiteraNet. All rights reserved.
</footer>

<script>
  document.getElementById('scrollDown').addEventListener('click', () => {
    const footer = document.querySelector('footer');
    footer.scrollIntoView({ behavior: 'smooth' });
  });
</script>
@endsection
