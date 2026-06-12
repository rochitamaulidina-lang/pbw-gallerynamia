<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Gallery Namia</title>
    <meta name="description" content="Bringing Elegant Modest Fashion to Every Family with Hijabs, Gamis, Khimars, and Matching Kids Collections.">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', 'Inter', system-ui, sans-serif;
            background: #f4f6fa;
            min-height: 100vh;
        }

        /* ========== NAVIGATION (STICKY) ========== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(135deg, #0a192f 0%, #0f2a3f 100%);
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 4rem;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
        }

        .logo-img {
            height: 45px;
            width: 45px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            border: 2px solid rgba(255, 179, 71, 0.5);
            transition: all 0.3s ease;
        }

        .logo-img:hover {
            border-color: #ffb347;
            transform: scale(1.05);
        }

        .logo-text {
            color: white;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .nav-links a:hover {
            color: #ffb347;
        }

        .nav-cta {
            background: linear-gradient(95deg, #ffb347, #ff8c1a);
            color: white;
            padding: 0.6rem 1.8rem;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(255, 140, 26, 0.3);
        }

        .nav-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 140, 26, 0.4);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.8rem;
            color: white;
            cursor: pointer;
        }

        /* ========== HERO SECTION - SPLIT LAYOUT ========== */
        .hero-section {
            width: 100%;
            min-height: 100vh;
            position: relative;
            padding-top: 80px;
            background: linear-gradient(135deg, #0a192f 0%, #0f2a3f 100%);
        }

        .hero-container {
            position: relative;
            z-index: 1;
            max-width: 1400px;
            margin: 0 auto;
            padding: 5rem 4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 4rem;
            flex-wrap: wrap;
        }

        /* Left side - Text Content */
        .hero-content {
            flex: 1;
            max-width: 600px;
        }

        .hero-content .small-tag {
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #ffb347;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            color: white;
            margin-bottom: 1rem;
        }

        .hero-content .highlight {
            color: #ffb347;
        }

        .hero-content p {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
            margin-top: 1rem;
            line-height: 1.6;
        }

        .hero-buttons {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: linear-gradient(95deg, #ffb347, #ff8c1a);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 140, 26, 0.5);
        }

        .btn-outline {
            border: 2px solid #ffb347;
            color: #ffb347;
            padding: 0.75rem 1.8rem;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: rgba(0, 0, 0, 0.2);
        }

        .btn-outline:hover {
            background: rgba(255, 179, 71, 0.2);
            transform: translateY(-3px);
        }

        /* Right side - Frame untuk Foto */
        .hero-frame {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(2px);
            border-radius: 30px;
            padding: 1rem;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.3s ease;
        }

        .image-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 35px 55px rgba(0, 0, 0, 0.25);
        }

        .image-card img {
            width: 100%;
            max-width: 450px;
            height: auto;
            border-radius: 24px;
            object-fit: cover;
            display: block;
        }

        /* ========== SECTION UMUM ========== */
        section {
            padding: 5rem 4rem;
        }

        .section-container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
            color: #0a192f;
            margin-bottom: 0.5rem;
        }

        .section-sub {
            text-align: center;
            color: #666;
            margin-bottom: 3rem;
            font-size: 1rem;
        }

        .section-title span {
            background: linear-gradient(95deg, #ffb347, #ff8c1a);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* ========== ABOUT SECTION ========== */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .about-text h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0a192f;
            margin-bottom: 1rem;
        }

        .about-text p {
            color: #555;
            line-height: 1.7;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .about-stats {
            display: flex;
            gap: 2rem;
            margin-top: 1.5rem;
        }

        .stat-item h4 {
            font-size: 1.8rem;
            color: #ff8c1a;
        }

        .stat-item p {
            font-size: 0.85rem;
            color: #666;
        }

        .about-img img {
            width: 100%;
            border-radius: 24px;
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.1);
        }

        /* ========== HISTORY / JOURNEY ========== */
        .timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 3px;
            height: 100%;
            background: linear-gradient(180deg, #ffb347, #ff8c1a);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 3rem;
        }

        .timeline-content {
            width: calc(50% - 2rem);
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .timeline-item:nth-child(odd) .timeline-content {
            margin-left: auto;
        }

        .timeline-year {
            display: inline-block;
            background: linear-gradient(95deg, #ffb347, #ff8c1a);
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
        }

        .timeline-content h3 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .timeline-content p {
            font-size: 0.9rem;
            color: #555;
            line-height: 1.5;
        }

        .timeline-dot {
            position: absolute;
            top: 1.5rem;
            width: 14px;
            height: 14px;
            background: #ff8c1a;
            border-radius: 50%;
            box-shadow: 0 0 0 4px rgba(255, 140, 26, 0.2);
        }

        .timeline-item:nth-child(odd) .timeline-dot {
            left: calc(50% - 7px);
        }

        .timeline-item:nth-child(even) .timeline-dot {
            right: calc(50% - 7px);
        }

        /* ========== SERVICES SECTION ========== */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .service-card {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, rgba(255, 179, 71, 0.15), rgba(255, 140, 26, 0.1));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.2rem;
        }

        .service-icon i {
            font-size: 2rem;
            color: #ff8c1a;
        }

        .service-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .service-card p {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* ========== CONTACT SECTION ========== */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
        }

        .contact-info-card {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }

        .contact-icon {
            width: 45px;
            height: 45px;
            background: rgba(255, 140, 26, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .contact-icon i {
            font-size: 1.2rem;
            color: #ff8c1a;
        }

        .contact-item strong {
            font-size: 0.9rem;
        }

        .contact-item div {
            font-size: 0.9rem;
            color: #555;
        }

        .contact-form {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .contact-form h3 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .submit-btn {
            background: linear-gradient(95deg, #ffb347, #ff8c1a);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            width: 100%;
        }

        /* ========== FOOTER ========== */
        footer {
            background: #0a192f;
            color: #aaa;
            padding: 4rem 4rem 2rem;
            margin-top: 3rem;
        }

        .footer-container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .footer-col h4 {
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
            position: relative;
            display: inline-block;
        }

        .footer-col h4::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 40px;
            height: 2px;
            background: linear-gradient(95deg, #ffb347, #ff8c1a);
        }

        .footer-col p {
            font-size: 0.85rem;
            line-height: 1.6;
            margin-bottom: 0.5rem;
        }

        .footer-col a {
            color: #aaa;
            text-decoration: none;
            display: block;
            margin-bottom: 0.6rem;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .footer-col a:hover {
            color: #ffb347;
            transform: translateX(3px);
        }

        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
        }

        .footer-logo span {
            background: linear-gradient(95deg, #ffb347, #ff8c1a);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            width: 35px;
            height: 35px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .social-links a:hover {
            background: linear-gradient(95deg, #ffb347, #ff8c1a);
            transform: translateY(-3px);
        }

        .social-links i {
            font-size: 1rem;
        }

        .subscribe-form {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .subscribe-form input {
            padding: 10px 15px;
            border-radius: 40px;
            border: none;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
        }

        .subscribe-form input::placeholder {
            color: #aaa;
        }

        .subscribe-form button {
            background: linear-gradient(95deg, #ffb347, #ff8c1a);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .subscribe-form button:hover {
            transform: translateY(-2px);
        }

        .contact-info-footer p {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 0.8rem;
            font-size: 0.85rem;
        }

        .contact-info-footer i {
            color: #ffb347;
            width: 20px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.75rem;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 992px) {
            .nav-container {
                padding: 1rem 2rem;
            }

            section {
                padding: 3rem 2rem;
            }

            .hero-container {
                padding: 4rem 2rem;
                flex-direction: column;
                text-align: center;
            }

            .hero-content {
                max-width: 100%;
                text-align: center;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-content h1 {
                font-size: 2.8rem;
            }

            .about-grid,
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .timeline::before {
                left: 20px;
            }

            .timeline-content {
                width: calc(100% - 3rem);
                margin-left: 3rem !important;
            }

            .timeline-dot {
                left: 13px !important;
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                width: 100%;
                flex-direction: column;
                background: rgba(10, 25, 47, 0.95);
                padding: 1rem;
                border-radius: 12px;
            }

            .nav-links.active {
                display: flex;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero-container {
                padding: 3rem 1.5rem;
            }

            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 0.9rem;
            }

            .hero-content .small-tag {
                font-size: 0.8rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .footer-col h4::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .social-links {
                justify-content: center;
            }

            .contact-info-footer p {
                justify-content: center;
            }
        }

        @media (max-width: 550px) {
            .hero-container {
                padding: 2rem 1rem;
            }

            .hero-content h1 {
                font-size: 1.6rem;
            }

            .hero-buttons {
                gap: 0.8rem;
            }

            .btn-primary,
            .btn-outline {
                padding: 0.7rem 1.5rem;
                font-size: 0.85rem;
            }

            .image-card img {
                max-width: 280px;
            }

            .logo-img {
                height: 35px;
                width: 35px;
            }

            .logo-text {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <img src="images/logo.png" alt="Gallery Namia Logo" class="logo-img" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22%3E%3Ccircle cx=%2250%22 cy=%2250%22 r=%2245%22 fill=%22%23ffb347%22/%3E%3Ctext x=%2250%22 y=%2265%22 text-anchor=%22middle%22 fill=%22white%22 font-size=%2240%22 font-weight=%22bold%22%3EGN%3C/text%3E%3C/svg%3E'">
                <span class="logo-text">Gallery Namia</span>
            </a>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#history">History</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <a href="{{ route('login') }}" class="nav-cta"><span>Sign in</span></a>
            <button class="mobile-menu-btn">☰</button>
        </div>
    </nav>

    <!-- HOME Section - Split Layout dengan Frame -->
    <section id="home" class="hero-section">
        <div class="hero-container">
            <!-- Left Side - Text Content -->
            <div class="hero-content">
                <h1>Elegant <span class="highlight">Modest Fashion</span> for Every Family</h1>
                <p>Koleksi Hijab, Gamis, Khimar, dan Couple Anak. Gaya syar'i modern yang nyaman dan elegan.</p>
                <div class="hero-buttons">
                    <a href="#" class="btn-primary">Kelola Koleksi</a>
                    <a href="#" class="btn-outline">Lihat Pesanan</a>
                </div>
            </div>

            <!-- Right Side - Frame untuk Foto -->
            <div class="hero-frame">
                <div class="image-card">
                    <img src="images/produk.png" alt="Fashion Hijab Syar'i">
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT Section -->
    <section id="about">
        <div class="section-container">
            <div class="section-title">About <span>Us</span></div>
            <div class="section-sub">Your Daily Modest Fashion Choice</div>
            <div class="about-grid">
                <div class="about-text">
                    <h3>Simplifying Modest Fashion, One Family at a Time</h3>
                    <p>Gallery Namia adalah brand fashion muslimah yang telah berpengalaman lebih dari 10 tahun dalam menghadirkan busana muslimah yang nyaman, anggun, dan berkualitas. Kami berfokus pada produk gamis dan konveksi seragam muslimah dengan desain elegan serta bahan pilihan.</p>
                    <p>Gallery Namia mengembangkan usaha melalui kemitraan dan agen wilayah dengan mengutamakan kepercayaan, kebersamaan, dan pelayanan yang ramah. Kami berkomitmen mendukung perempuan Indonesia untuk tampil syar’i, percaya diri, dan berkelas.</p>
                    <div class="about-stats">
                        <div class="stat-item">
                            <h4>5000+</h4>
                            <p>Happy Customer</p>
                        </div>
                        <div class="stat-item">
                            <h4>350+</h4>
                            <p>Produk Terjual</p>
                        </div>
                        <div class="stat-item">
                            <h4>50+</h4>
                            <p>Collections</p>
                        </div>
                    </div>
                </div>
                <div class="about-img">
                    <img src="images/about.png" alt="About Us">
                </div>
            </div>
        </div>
    </section>

<!-- HISTORY / JOURNEY Section -->
<section id="history" style="background: #f0f4f8;">
    <div class="section-container">
        <div class="section-title">Our <span>Journey</span></div>
        <div class="section-sub">Lebih dari satu dekade tumbuh bersama mitra dan pelanggan</div>

        <div class="timeline">

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2010+</span>
                    <h3>Awal Berdiri</h3>
                    <p>Gallery Namia memulai perjalanan sebagai penyedia busana muslimah dengan fokus pada kualitas, kenyamanan, dan desain yang elegan.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2015+</span>
                    <h3>Pengembangan Kemitraan</h3>
                    <p>Mulai membangun jaringan distributor dan agen wilayah sebagai strategi utama dalam mengembangkan usaha secara berkelanjutan.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2020</span>
                    <h3>Pertumbuhan Penjualan</h3>
                    <p>Penjualan terus meningkat melalui pemasaran online dan offline serta dukungan dari mitra yang tersebar di berbagai wilayah.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2023 - Sekarang</span>
                    <h3>Ekspansi Produk & Seragam Custom</h3>
                    <p>Selain produk busana muslimah, Gallery Namia juga melayani pembuatan seragam custom untuk komunitas, sekolah, instansi, perusahaan, dan majelis taklim.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SERVICES Section -->
<section id="services">
    <div class="section-container">
        <div class="section-title">Product & <span>Services</span></div>
        <div class="section-sub">Produk unggulan dan layanan yang tersedia di Gallery Namia</div>

        <div class="services-grid">

            <div class="service-card">
                <div class="service-icon"><i class="fas fa-female"></i></div>
                <h3>Gamis</h3>
                <p>Gamis muslimah dengan desain elegan, bahan nyaman, lembut, dan menyerap keringat sehingga cocok digunakan dalam berbagai aktivitas sehari-hari.</p>
            </div>

            <div class="service-card">
                <div class="service-icon"><i class="fas fa-tshirt"></i></div>
                <h3>Set Gamis</h3>
                <p>Koleksi set gamis dengan model modern dan bahan berkualitas yang memberikan kenyamanan sekaligus tampilan syar'i yang berkelas.</p>
            </div>

            <div class="service-card">
                <div class="service-icon"><i class="fas fa-user-secret"></i></div>
                <h3>Scarf & Khimar</h3>
                <p>Scarf dan khimar berbahan voal premium yang nyaman digunakan, mudah dibentuk, serta tersedia dalam berbagai pilihan warna.</p>
            </div>

            <div class="service-card">
                <div class="service-icon"><i class="fas fa-user-check"></i></div>
                <h3>Bergo Jersey</h3>
                <p>Bergo berbahan jersey premium yang praktis, nyaman dipakai, dan cocok untuk menunjang aktivitas sehari-hari.</p>
            </div>

            <div class="service-card">
                <div class="service-icon"><i class="fas fa-user-tie"></i></div>
                <h3>Tunik</h3>
                <p>Tunik berbahan premium dengan desain simple dan elegan yang cocok digunakan untuk kegiatan formal maupun kasual.</p>
            </div>

            <div class="service-card">
                <div class="service-icon"><i class="fas fa-mosque"></i></div>
                <h3>Prayer Set, Jubah & Kemko</h3>
                <p>Perlengkapan ibadah dan busana muslim berkualitas dengan bahan yang lembut, ringan, dan nyaman digunakan dalam waktu lama.</p>
            </div>

            <div class="service-card">
                <div class="service-icon"><i class="fas fa-users"></i></div>
                <h3>Seragam Custom</h3>
                <p>Melayani pembuatan seragam custom untuk komunitas, sekolah, instansi, perusahaan, majelis taklim, dan berbagai kebutuhan lainnya.</p>
            </div>

            <div class="service-card">
                <div class="service-icon"><i class="fas fa-heart"></i></div>
                <h3>Sarimbit Series</h3>
                <p>Koleksi sarimbit keluarga dengan desain harmonis dan elegan untuk momen kebersamaan yang lebih istimewa.</p>
            </div>

        </div>
    </div>
</section>

    <!-- CONTACT Section -->
    <section id="contact">
        <div class="section-container">
            <div class="section-title">Let's <span>Connect</span></div>
            <div class="section-sub">Ada pertanyaan atau butuh bantuan? Tim kami siap membantu Anda.</div>
            <div class="contact-grid">
                <div class="contact-info-card">
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div><strong>Alamat</strong><br>Cibodas Raya No. 20 D, Karawaci, Tangerang</div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                        <div><strong>WhatsApp</strong><br>0857 1610 7394</div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fab fa-instagram"></i></div>
                        <div><strong>Instagram</strong><br>@gallery_namia</div>
                    </div>
                </div>
                <div class="contact-form">
                    <h3 style="margin-bottom: 1.5rem;">Kirim Pesan</h3>
                    <form>
                        <div class="form-group">
                            <input type="text" placeholder="Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Subjek">
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Pesan Anda..."></textarea>
                        </div>
                        <button type="submit" class="submit-btn">Kirim Pesan </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-col">
                    <div class="footer-logo">Gallery<span> Namia</span></div>
                    <p>Bringing Elegant Modest Fashion to Every Family with Hijabs, Gamis, Khimars, and Matching Kids Collections.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Menu</h4>
                    <a href="#home">Home</a>
                    <a href="#about">About Us</a>
                    <a href="#history">History</a>
                    <a href="#services">Services</a>
                    <a href="#contact">Contact</a>
                </div>

                <div class="footer-col">
                    <h4>Produk & Layanan</h4>
                    <a href="#">Gamis Muslimah</a>
                    <a href="#">Khimar & Hijab</a>
                    <a href="#">Sarimbit Series</a>
                    <a href="#">Seragam Custom</a>
                </div>

                <div class="footer-col">
                    <h4>Subscribe</h4>
                    <div class="subscribe-form">
                        <input type="email" placeholder="Your email address">
                        <button>Subscribe →</button>
                    </div>
                    <br>
                    <div class="contact-info-footer">
                        <p><i class="fas fa-phone"></i> +62 812 3456 7890</p>
                        <p><i class="fab fa-instagram"></i>@gallery_namia</p>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2025 Gallery Namia • Diksi Hera Berliana • All rights reserved. | All images are for demo purposes only</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileBtn = document.querySelector('.mobile-menu-btn');
        const navLinks = document.querySelector('.nav-links');

        if (mobileBtn) {
            mobileBtn.addEventListener('click', () => {
                navLinks.classList.toggle('active');
            });
        }

        // Smooth scroll untuk nav links
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId && targetId !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(targetId);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                        navLinks.classList.remove('active');
                    }
                }
            });
        });

        // Footer menu links smooth scroll
        document.querySelectorAll('.footer-col a[href^="#"]').forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId && targetId !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(targetId);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Tombol CTA
        document.querySelectorAll('.btn-primary, .btn-outline, .submit-btn, .subscribe-form button').forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (btn.classList.contains('submit-btn')) {
                    e.preventDefault();
                    alert('📨 Pesan terkirim! Admin akan segera merespon.');
                } else if (btn.closest('.subscribe-form')) {
                    e.preventDefault();
                    alert('✅ Terima kasih telah berlangganan!');
                } else if (btn.getAttribute('href') === '#') {
                    e.preventDefault();
                    alert('📋 Halaman manajemen akan segera hadir.');
                }
            });
        });
    </script>
</body>

</html>