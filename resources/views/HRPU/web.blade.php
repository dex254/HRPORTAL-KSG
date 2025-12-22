<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KSG - Adjunct Faculty Recruitment</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-yellow: rgb(197, 197, 56);
            --secondary-brown: #8B4513;
            --light-brown: #D2B48C;
            --dark-brown: #5D4037;
            --white: #FFFFFF;
            --off-white: #F5F5F5;
            --dark-gray: #333333;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: var(--dark-gray);
            background-color: var(--off-white);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            background: linear-gradient(135deg, var(--primary-yellow), var(--dark-brown));
            color: var(--white);
            padding: 2rem 0;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .logo img {
            height: 80px;
            margin-right: 15px;
        }
        
        .logo-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .logo-text p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .hero {
            background: url('https://via.placeholder.com/1200x500') center/cover no-repeat;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
            color: var(--white);
            text-align: center;
            padding: 0 20px;
            max-width: 800px;
        }
        
        .hero-content h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        
        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }
        
        .btn {
            display: inline-block;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 1rem;
            border: 2px solid transparent;
            cursor: pointer;
        }
        
        .btn-primary {
            background-color: var(--primary-yellow);
            color: var(--dark-gray);
        }
        
        .btn-primary:hover {
            background-color: transparent;
            border-color: var(--primary-yellow);
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .btn-secondary {
            background-color: var(--light-brown);
            color: var(--dark-gray);
        }
        
        .btn-secondary:hover {
            background-color: transparent;
            border-color: var(--light-brown);
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .about-section {
            padding: 5rem 0;
            background-color: var(--white);
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            font-family: 'Playfair Display', serif;
            color: var(--dark-brown);
            font-size: 2.2rem;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            display: block;
            width: 100px;
            height: 4px;
            background: var(--primary-yellow);
            margin: 15px auto;
        }
        
        .about-content {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
        }
        
        .about-text {
            flex: 1;
            min-width: 300px;
            padding: 0 20px;
        }
        
        .about-text p {
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        
        .campuses {
            flex: 1;
            min-width: 300px;
            background-color: var(--off-white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .campuses h3 {
            color: var(--dark-brown);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }
        
        .campuses ul {
            list-style-type: none;
        }
        
        .campuses li {
            margin-bottom: 1rem;
            padding-left: 25px;
            position: relative;
        }
        
        .campuses li::before {
            content: '→';
            color: var(--primary-yellow);
            position: absolute;
            left: 0;
            font-weight: bold;
        }
        
        footer {
            background: linear-gradient(135deg, var(--dark-brown), #000);
            color: var(--white);
            padding: 3rem 0;
            text-align: center;
        }
        
        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .footer-section {
            flex: 1;
            min-width: 250px;
            margin-bottom: 2rem;
            padding: 0 15px;
        }
        
        .footer-section h3 {
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
            color: var(--primary-yellow);
        }
        
        .footer-section p, .footer-section a {
            color: var(--off-white);
            margin-bottom: 0.5rem;
            display: block;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-section a:hover {
            color: var(--primary-yellow);
        }
        
        .copyright {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        @media (max-width: 768px) {
            .hero-content h2 {
                font-size: 2rem;
            }
            
            .hero-content p {
                font-size: 1rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                gap: 1rem;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="{{asset('') }}assets/images/KSG Logo (1).png" alt="KSG Logo">
                <div class="logo-text">
                    <h1>Kenya School of Government</h1>
                    <p>Enhancing Public Service Through Learning and Development</p>
                </div>
            </div>
        </div>
    </header>
    
    <section class="hero">
        <div class="hero-content">
            <h2>Join Our Adjunct Faculty</h2>
            <p>Contribute to shaping the future of public service in Kenya through training, research, and consultancy</p>
            <div class="cta-buttons">
                <a href="{{ route('HR.Login') }}" class="btn btn-primary">  KSG Staff Application </a>
                <a href="{{ route('HRPU.Login') }}" class="btn btn-secondary">Adjunct Faculty Applicants</a>
            </div>
        </div>
    </section>
    
    <section class="about-section">
        <div class="container">
            <h2 class="section-title">About Kenya School of Government</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>The Kenya School of Government (KSG) was established under the Kenya School of Government Act (2012) with the mandate to provide learning and development programs that enhance skills and competencies in public service.</p>
                    <p>We conduct research that informs public policy and offer expert consultancy services to improve standards of performance in public institutions. The School offers exciting programs for all levels in public service and has initiated relevant research projects.</p>
                    <p>KSG maintains an environment that is conducive to learning and research and has some of the most modern facilities required by both learners and facilitators.</p>
                </div>
                <div class="campuses">
                    <h3>Our Campuses</h3>
                    <ul>
                        <li>Lower Kabete</li>
                        <li>Baringo</li>
                        <li>Embu</li>
                        <li>Matuga</li>
                        <li>Mombasa</li>
                        <li>E-ldi</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>P.O. Box 23030-00604, Lower Kabete, Nairobi</p>
                <p>Phone: +254 20 401 5000</p>
                <p>Email: info@ksg.ac.ke</p>
            </div>
            
            
        </div>
        <div class="copyright">
            <p>&copy; 2023 Kenya School of Government. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>