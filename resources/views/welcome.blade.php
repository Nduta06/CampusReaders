@extends('layout')

@section('title', 'Welcome to CampusReaders')

@section('styles')
<style>
    /* Hero Section - Only for welcome page */
    .hero {
        padding: 80px 0;
        display: flex;
        align-items: center;
        gap: 50px;
    }

    .hero-content {
        flex: 1;
    }

    .hero-image {
        flex: 1;
        display: flex;
        justify-content: center;
    }

    .hero h1 {
        font-size: 3.5rem;
        margin-bottom: 20px;
        color: var(--text-dark);
        line-height: 1.2;
    }

    .hero p {
        font-size: 1.2rem;
        color: var(--text-light);
        margin-bottom: 30px;
        max-width: 90%;
    }

    .btn-get-started {
        background-color: var(--accent-beige);
        color: var(--text-dark);
        padding: 15px 30px;
        font-size: 1.1rem;
        border-radius: 8px;
        box-shadow: var(--shadow);
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
    }

    .btn-get-started:hover {
        background-color: var(--dark-beige);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .hero-image-placeholder {
        width: 100%;
        height: 400px;
        background-color: var(--dark-beige);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
    }

    .hero-image-placeholder::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--beige) 0%, var(--dark-beige) 100%);
        opacity: 0.7;
    }

    .book-icons {
        display: flex;
        gap: 20px;
        z-index: 1;
    }

    .book-icon {
        font-size: 60px;
        color: var(--accent-beige);
        animation: float 3s ease-in-out infinite;
    }

    .book-icon:nth-child(2) {
        animation-delay: 0.5s;
    }

    .book-icon:nth-child(3) {
        animation-delay: 1s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    /* Features Section - Only for welcome page */
    .features {
        padding: 80px 0;
        background-color: var(--white);
        border-radius: 20px 20px 0 0;
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title h2 {
        font-size: 2.5rem;
        color: var(--text-dark);
        margin-bottom: 15px;
    }

    .section-title p {
        color: var(--text-light);
        max-width: 600px;
        margin: 0 auto;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .feature-card {
        background-color: var(--beige);
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow);
    }

    .feature-icon {
        font-size: 40px;
        color: var(--accent-beige);
        margin-bottom: 20px;
    }

    .feature-card h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: var(--text-dark);
    }

    .feature-card p {
        color: var(--text-light);
    }

    /* Responsive Design for welcome page */
    @media (max-width: 768px) {
        .hero {
            flex-direction: column;
            text-align: center;
            padding: 50px 0;
        }

        .hero p {
            max-width: 100%;
        }

        .hero h1 {
            font-size: 2.5rem;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Welcome to CampusReaders</h1>
                <p>Your comprehensive library management system designed for educational institutions. Streamline book tracking, manage members, and enhance the reading experience for students and faculty.</p>
                
                @auth
                    <a href="{{ route('catalogue') }}" class="btn-get-started">Browse Books <i class="fas fa-arrow-right"></i></a>
                @else
                    <a href="{{ route('signup') }}" class="btn-get-started">Get Started <i class="fas fa-arrow-right"></i></a>
                @endauth
            </div>
            <div class="hero-image">
                <div class="hero-image-placeholder">
                    <div class="book-icons">
                        <i class="fas fa-book book-icon"></i>
                        <i class="fas fa-book-open book-icon"></i>
                        <i class="fas fa-bookmark book-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="section-title">
                <h2>Why Choose CampusReaders?</h2>
                <p>Our platform offers everything you need to efficiently manage your campus library</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-search feature-icon"></i>
                    <h3>Easy Book Discovery</h3>
                    <p>Find books quickly with our advanced search and filtering system.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-users feature-icon"></i>
                    <h3>Member Management</h3>
                    <p>Easily manage student and faculty accounts with our intuitive interface.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-chart-bar feature-icon"></i>
                    <h3>Analytics & Reports</h3>
                    <p>Gain insights into library usage with comprehensive reporting tools.</p>
                </div>
            </div>
        </div>
    </section>
@endsection