<!DOCTYPE html>

<html lang="en">

<head>
    <title>MarketLink - Fresh From Farm To Your Home</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="MarketLink - Connect with local farmers and buy fresh products directly." name="description" />
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
        integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg=="
        referrerpolicy="no-referrer" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{ asset('customers/assets/css/index.css')}}" rel="stylesheet" />
    <link href="{{ asset('customers/assets/css/common.css')}}" rel="stylesheet" />

</head>
<style>
    :root {
        --primary: #2f6b3f;
        --primary-dark: #1f4d2e;
        --primary-light: #e0e7ff;
        --dark: #1b1b1b;
        --gray: #6c757d;
        --light: #f7f5ef;
        --border: #e9ecef;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
        --shadow-md: 0 6px 20px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 12px 32px rgba(0, 0, 0, 0.12);
        --radius: 14px;
        --transition: all 0.3s ease;
    }


    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', 'Segoe UI', Tahoma, sans-serif;
        color: #333;
        line-height: 1.6;
        overflow-x: hidden;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    a {
        text-decoration: none;
        transition: var(--transition);
    }


    .section-heading {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-heading span {
        color: var(--primary);
        font-weight: 700;
        letter-spacing: 3px;
        font-size: 13px;
        display: inline-block;
        padding: 5px 15px;
        background: var(--primary-light);
        border-radius: 50px;
        margin-bottom: 12px;
    }

    .section-heading h2 {
        font-weight: 800;
        font-size: 2.2rem;
        margin: 8px 0 12px;
        color: var(--dark);
    }

    .section-heading p {
        color: var(--gray);
        max-width: 600px;
        margin: 0 auto;
        font-size: 1rem;
    }


    .navbar {
        padding: 12px 0;
        transition: var(--transition);
    }

    .navbar-brand {
        font-size: 1.5rem;
    }

    .navbar-nav .nav-link {
        font-weight: 500;
        padding: 8px 16px !important;
        color: #333 !important;
        position: relative;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: var(--primary) !important;
    }

    .navbar-nav .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 16px;
        right: 16px;
        height: 2px;
        background: var(--primary);
        border-radius: 2px;
    }

    .btn-success {
        background: var(--primary);
        border-color: var(--primary);
        font-weight: 500;
        transition: var(--transition);
    }

    .btn-success:hover {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(25, 135, 84, 0.3);
    }

    .btn-outline-success {
        color: var(--primary);
        border-color: var(--primary);
        font-weight: 500;
    }

    .btn-outline-success:hover {
        background: var(--primary);
        border-color: var(--primary);
        transform: translateY(-2px);
    }


    .hero-section {
        position: relative;
        min-height: 600px;
        background: linear-gradient(135deg, #1f4d2e 0%, #2f6b3f 100%);
        overflow: hidden;
        display: flex;
        align-items: center;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 80%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
        border-radius: 50%;
    }

    .min-vh-75 {
        min-height: 600px;
    }

    .hero-content {
        padding: 60px 0;
    }

    .hero-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 20px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .hero-title {
        font-size: 3.2rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 20px;
    }

    .hero-text {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 30px;
        max-width: 550px;
    }

    .hero-stats {
        padding-top: 30px;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
    }

    .hero-stats h3 {
        font-size: 2rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 0;
    }

    .hero-stats p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 14px;
        margin: 0;
    }

    .hero-img {
        border-radius: var(--radius);
        filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.3));
    }

    @media (max-width: 991px) {
        .hero-title {
            font-size: 2.2rem;
        }

        .hero-section {
            min-height: auto;
        }

        .min-vh-75 {
            min-height: auto;
            padding: 40px 0;
        }
    }


    .feature-strip {
        background: #fff;
        border-bottom: 1px solid var(--border);
    }

    .feature-box {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        border-radius: 10px;
        transition: var(--transition);
    }

    .feature-box:hover {
        background: var(--primary-light);
    }

    .feature-box i {
        font-size: 28px;
        color: var(--primary);
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-light);
        border-radius: 10px;
    }

    .feature-box h6 {
        margin: 0;
        font-weight: 700;
        font-size: 15px;
    }

    .feature-box small {
        color: var(--gray);
        font-size: 12px;
    }


    .category-card {
        background: #fff;
        border-radius: var(--radius);
        padding: 25px 15px;
        text-align: center;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        cursor: pointer;
        height: 100%;
        border: 1px solid var(--border);
    }

    .category-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-md);
        border-color: var(--primary);
    }

    .category-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 15px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        transition: var(--transition);
    }

    .category-card:hover .category-icon {
        transform: scale(1.1) rotate(-5deg);
    }

    .category-card h6 {
        font-weight: 700;
        margin-bottom: 5px;
        font-size: 15px;
    }

    .category-card small {
        color: var(--gray);
        font-size: 12px;
    }


    .market-card {
        background: #fff;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .market-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .market-image {
        position: relative;
        overflow: hidden;
        height: 220px;
    }

    .market-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .market-card:hover .market-image img {
        transform: scale(1.1);
    }

    .market-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--primary);
        color: #fff;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }

    .market-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .market-body h5 {
        font-weight: 700;
        margin-bottom: 6px;
    }

    .market-location {
        color: var(--gray);
        font-size: 13px;
        margin-bottom: 10px;
    }

    .market-body p {
        color: #555;
        font-size: 14px;
        flex: 1;
    }

    .market-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }

    .market-rating {
        font-weight: 600;
        font-size: 14px;
    }

    .market-rating small {
        color: var(--gray);
        font-weight: 400;
    }


    .products-section {
        background: #f7f5ef;
    }

    .product-card {
        background: #fff;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .product-image {
        position: relative;
        height: 220px;
        overflow: hidden;
        background: #eff6ff;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.1);
    }

    .product-tag {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--primary);
        color: #fff;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .wishlist-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #fff;
        border: none;
        color: #333;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
    }

    .wishlist-btn:hover {
        background: var(--primary);
        color: #fff;
    }

    .product-info {
        padding: 18px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-cat {
        color: var(--primary);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1px;
    }

    .product-info h5 {
        font-weight: 700;
        margin: 6px 0;
        font-size: 1.05rem;
    }

    .product-rating {
        margin-bottom: 8px;
        color: #f97316;
        font-size: 13px;
    }

    .product-rating small {
        color: var(--gray);
        margin-left: 5px;
    }

    .product-info p {
        color: #666;
        font-size: 13px;
        flex: 1;
        margin-bottom: 12px;
    }

    .product-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 12px;
        border-top: 1px solid var(--border);
    }

    .product-footer strong {
        color: var(--primary);
        font-size: 1.1rem;
        font-weight: 700;
    }

    .product-footer strong small {
        color: var(--gray);
        font-weight: 400;
        font-size: 12px;
    }


    .fresh-vegetables {
        background: linear-gradient(135deg, #eff6ff 0%, #e9f1e7 100%);
    }

    .veg-card {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid #eff6ff;
    }

    .veg-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(25, 135, 84, 0.15);
        border-color: #2f6b3f;
    }

    .veg-img {
        position: relative;
        height: 220px;
        overflow: hidden;
        background: #eff6ff;
    }

    .veg-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .veg-card:hover .veg-img img {
        transform: scale(1.1);
    }

    .veg-tag {
        position: absolute;
        top: 12px;
        left: 12px;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #fff;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
    }

    .veg-tag.bg-success {
        background: #2f6b3f !important;
    }

    .veg-tag.bg-warning {
        background: #f97316 !important;
    }

    .veg-wish {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #fff;
        border: none;
        color: #333;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        font-size: 14px;
    }

    .veg-wish:hover {
        background: #2f6b3f;
        color: #fff;
        transform: scale(1.1);
    }

    .veg-body {
        padding: 18px 20px 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .veg-rating {
        color: #f97316;
        font-size: 12px;
        margin-bottom: 8px;
    }

    .veg-rating small {
        color: #6c757d;
        margin-left: 5px;
        font-weight: 500;
    }

    .veg-body h4 {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 6px;
        color: #1b1b1b;
    }

    .veg-body p {
        color: #6c757d;
        font-size: 13px;
        line-height: 1.5;
        flex: 1;
        margin-bottom: 14px;
    }

    .veg-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 14px;
        border-top: 1px solid #eff6ff;
        margin-top: auto;
    }

    .veg-price {
        color: #2f6b3f;
        font-weight: 800;
        font-size: 1.15rem;
    }

    .veg-price small {
        color: #6c757d;
        font-weight: 400;
        font-size: 12px;
    }

    .veg-footer .btn-success {
        background: #2f6b3f;
        border-color: #2f6b3f;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .veg-footer .btn-success:hover {
        background: #1f4d2e;
        border-color: #1f4d2e;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(25, 135, 84, 0.3);
    }


    .farmer-card {
        background: #fff;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        text-align: center;
        height: 100%;
    }

    .farmer-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .farmer-img {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .farmer-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .farmer-card:hover .farmer-img img {
        transform: scale(1.1);
    }

    .farmer-social {
        position: absolute;
        bottom: -50px;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        gap: 10px;
        padding: 12px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        transition: var(--transition);
    }

    .farmer-card:hover .farmer-social {
        bottom: 0;
    }

    .farmer-social a {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #fff;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .farmer-social a:hover {
        background: var(--primary);
        color: #fff;
    }

    .farmer-info {
        padding: 20px;
    }

    .farmer-info h5 {
        font-weight: 700;
        margin-bottom: 4px;
    }

    .farmer-info small {
        color: var(--gray);
        font-size: 12px;
    }

    .farmer-info p {
        color: #666;
        font-size: 13px;
        margin: 10px 0;
    }

    .farmer-stats {
        display: flex;
        justify-content: space-around;
        padding-top: 12px;
        border-top: 1px solid var(--border);
        font-size: 13px;
        color: var(--gray);
    }

    .farmer-stats span {
        display: flex;
        align-items: center;
        gap: 5px;
    }


    .how-section {
        background: #fff;
    }

    .step-card {
        background: #fff;
        padding: 40px 25px 30px;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        height: 100%;
        position: relative;
        border: 1px solid var(--border);
    }

    .step-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
    }

    .step-number {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 3rem;
        font-weight: 800;
        color: var(--primary-light);
        line-height: 1;
    }

    .step-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        box-shadow: 0 8px 20px rgba(25, 135, 84, 0.3);
        transition: var(--transition);
    }

    .step-card:hover .step-icon {
        transform: scale(1.1) rotate(10deg);
    }

    .step-card h5 {
        font-weight: 700;
        margin-bottom: 10px;
    }

    .step-card p {
        color: #666;
        font-size: 14px;
        margin: 0;
    }


    .testimonials-section {
        background: #f7f5ef;
    }

    .testimonial-card {
        background: #fff;
        padding: 30px;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        height: 100%;
        position: relative;
        border: 1px solid var(--border);
    }

    .testimonial-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .quote-icon {
        width: 50px;
        height: 50px;
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 15px;
    }

    .testimonial-card>p {
        color: #555;
        font-style: italic;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .testimonial-user {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }

    .testimonial-user img {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary-light);
    }

    .testimonial-user h6 {
        margin: 0;
        font-weight: 700;
        font-size: 15px;
    }

    .testimonial-user small {
        color: var(--gray);
        font-size: 12px;
    }

    .testimonial-user .stars {
        color: #f97316;
        font-size: 12px;
        margin-top: 2px;
    }


    .newsletter-section {
        background: #fff;
    }

    .newsletter-box {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        padding: 45px 40px;
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }

    .newsletter-box::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1), transparent);
        border-radius: 50%;
    }

    .newsletter-box h3 {
        color: #fff;
        font-weight: 800;
        margin-bottom: 8px;
        position: relative;
    }

    .newsletter-box p {
        color: rgba(255, 255, 255, 0.85);
        margin: 0;
        position: relative;
    }

    .newsletter-form {
        position: relative;
        z-index: 2;
    }

    .newsletter-form .form-control {
        border: none;
        padding: 14px 20px;
        border-radius: 50px;
        font-size: 14px;
    }

    .newsletter-form .btn {
        border-radius: 50px;
        background: #fff;
        color: var(--primary);
        font-weight: 700;
        border: none;
    }

    .newsletter-form .btn:hover {
        background: var(--dark);
        color: #fff;
    }

    @media (max-width: 767px) {
        .newsletter-box {
            padding: 30px 20px;
            text-align: center;
        }

        .newsletter-form {
            margin-top: 20px;
        }
    }


    .footer {
        background: #1b1b1b;
        color: #ccc;
    }

    .footer h5 {
        color: #fff;
        font-weight: 800;
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .footer h5 span {
        color: var(--primary);
    }

    .footer h6 {
        color: #fff;
        font-weight: 700;
        margin-bottom: 18px;
        font-size: 15px;
    }

    .footer p {
        color: #aaa;
        font-size: 14px;
        line-height: 1.7;
    }

    .footer a {
        display: block;
        color: #aaa;
        text-decoration: none;
        margin-bottom: 10px;
        font-size: 14px;
        transition: var(--transition);
    }

    .footer a:hover {
        color: var(--primary);
        padding-left: 5px;
    }

    .footer-social {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .footer-social a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #2a2a2a;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 0;
        transition: var(--transition);
    }

    .footer-social a:hover {
        background: var(--primary);
        transform: translateY(-3px);
        padding-left: 0;
    }

    .footer-bottom {
        border-top: 1px solid #333;
        color: #888;
    }

    .footer-bottom i {
        color: #dc3545;
    }


    @media (max-width: 991px) {
        .section-heading h2 {
            font-size: 1.8rem;
        }

        .navbar-nav {
            padding: 15px 0;
        }

        .navbar-nav .nav-link.active::after {
            display: none;
        }

        .veg-img {
            height: 200px;
        }
    }

    @media (max-width: 767px) {
        .section-heading h2 {
            font-size: 1.5rem;
        }

        .hero-stats {
            gap: 20px !important;
        }

        .hero-stats h3 {
            font-size: 1.5rem;
        }

        .footer {
            text-align: center;
        }

        .footer-social {
            justify-content: center;
        }
    }

    @media (max-width: 575px) {
        .hero-title {
            font-size: 1.7rem;
        }

        .section-heading {
            margin-bottom: 30px;
        }

        .veg-img {
            height: 240px;
        }

        .veg-body {
            padding: 15px;
        }
    }

    .hero-section {
        background: linear-gradient(135deg, #1f4d2e 0%, #2f6b3f 100%);
    }

    .hero-img {
        width: 100%;
        height: auto;
        max-height: 520px;
        object-fit: contain;
        object-position: center;
        border-radius: 22px;
        display: block;
        box-shadow: 0 18px 45px rgba(0, 0, 0, .22);
    }

    @media(max-width:991px) {
        .hero-img {
            height: 300px;
            margin-top: 10px
        }

        .hero-section {
            padding: 30px 0 45px
        }

        .hero-content {
            padding: 25px 0
        }

        .hero-title {
            font-size: 2rem
        }
    }

    @media(max-width:575px) {
        .hero-img {
            height: 240px;
            border-radius: 16px
        }

        .hero-title {
            font-size: 1.65rem
        }

        .hero-text {
            font-size: .95rem
        }
    }
</style>

<body class="{{ request()->routeIs('home') ? 'home-page' : '' }}">

    @if(request()->routeIs('home'))
        <video class="body-video" autoplay muted loop playsinline>
            <source src="{{ asset('customers/Videos/background.mp4.mp4') }}" type="video/mp4">
        </video>
    @endif

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('home') }}"
                aria-label="MarketLink Home">
                <img alt="MarketLink" class="me-2" height="45" src="{{ asset('customers/Images/logo.png') }}"
                    width="45" />
                Market<span class="text-success">Link</span>
            </a>
            <button class="navbar-toggler" data-bs-target="#menu" data-bs-toggle="collapse" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <form id="homeSearchForm" class="d-flex mx-lg-3 my-2 my-lg-0" role="search"><input id="homeSearch"
                        class="form-control form-control-sm" type="search" placeholder="Search products"
                        aria-label="Search products"><button class="btn btn-primary btn-sm ms-2"
                        type="submit">Search</button></form>
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('markets')}}">Markets</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('farmers')}}">Farmers</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('products') }}">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
               <!-- @guest
    <form action="{{ route('login') }}" method="GET">
        <button type="submit" class="btn btn-outline-success px-3">
            Login
        </button>
    </form>

    <form action="{{ route('register') }}" method="GET">
        <button type="submit" class="btn btn-success px-3">
            Register
        </button>
    </form>
@endguest

@auth
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf

        <button type="submit" class="btn btn-outline-danger px-3">
            Logout
        </button>
    </form>
@endauth -->

@auth
    <div class="dropdown">
        <button
            class="btn btn-success px-3 dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >
            <i class="bi bi-person-circle me-1"></i>
            {{ auth()->user()->name }}
        </button>

        <ul class="dropdown-menu dropdown-menu-end shadow-sm">

            @if(auth()->user()->role === 'customer')
                <li>
                    <a class="dropdown-item" href="{{ route('customer.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>
                        Customer Dashboard
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('myorders') }}">
                        <i class="bi bi-bag me-2"></i>
                        My Orders
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        <i class="bi bi-person me-2"></i>
                        My Profile
                    </a>
                </li>
            @endif

            <li>
                <hr class="dropdown-divider">
            </li>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout
                    </button>
                </form>
            </li>

        </ul>
    </div>
@else
    <a href="{{ route('userlogin') }}" class="btn btn-success px-3">
        Account
    </a>
@endauth


            </div>
        </div>
    </nav>


    @yield('main')

    <footer class="footer pt-5">
        <div class="container">
            <div class="row g-4 pb-4">
                <div class="col-lg-4">
                    <h5>Market<span>Link</span></h5>
                    <p>Connecting customers with farmers, fresh products and local markets.</p>
                    <div class="footer-social">
                        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
<a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
<a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
<a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
    <h6>Explore</h6>

    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('products') }}">Products</a>
    <a href="{{ route('farmers') }}">Farmers</a>
    <a href="{{ route('markets') }}">Markets</a>
</div>
                <div class="col-6 col-lg-3">
    <h6>Customer</h6>

    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a>
    <a href="{{ route('customer.dashboard') }}">Dashboard</a>
    <a href="{{ route('myorders') }}">My Orders</a>
</div>
                <div class="col-lg-3">
                    <h6>Contact</h6>
                    <p><i class="fa-solid fa-envelope me-2"></i>support@marketlink.com</p>
                    <p><i class="fa-solid fa-phone me-2"></i>+92 300 0000000</p>
                    <p><i class="fa-solid fa-location-dot me-2"></i>Karachi, Pakistan</p>
                </div>
            </div>
            <div class="footer-bottom text-center py-3">
                <small>© 2026 MarketLink. All Rights Reserved. Made with <i class="fa-solid fa-heart text-danger"></i>
                    in Pakistan</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>document.querySelectorAll(".newsletter-form").forEach(function (form) { form.addEventListener("submit", function (e) { e.preventDefault(); alert("Thanks! Your email has been noted."); form.reset(); }); }); document.getElementById("homeSearchForm")?.addEventListener("submit", function (e) { e.preventDefault(); const q = document.getElementById("homeSearch").value.trim(); window.location.href = "{{ route('products') }}" + (q ? "?search=" + encodeURIComponent(q) : ""); });</script>
</body>

</html>