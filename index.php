<?php include_once "includes/header.php"; ?>

<!-- Hero Section -->
<section class="relative min-h-[90vh] flex items-center overflow-hidden" id="hero-section">
    <!-- Animated Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-accent-900/50 to-gray-900">
        <!-- Particle Canvas -->
        <canvas id="particle-canvas" class="absolute inset-0 z-0 opacity-30"></canvas>
        
        <!-- Blood Cell Animations -->
        <div class="blood-cell-container">
            <?php for($i = 0; $i < 15; $i++): ?>
                <div class="blood-cell" style="--delay: <?php echo mt_rand(0, 20) / 10; ?>s; --size: <?php echo mt_rand(15, 40); ?>px; --speed: <?php echo mt_rand(20, 40); ?>s; --left: <?php echo mt_rand(1, 99); ?>%"></div>
            <?php endfor; ?>
        </div>
        
        <!-- Red Wave -->
        <div class="absolute bottom-0 left-0 right-0 h-24 overflow-hidden">
            <svg class="absolute bottom-0 w-full" viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg">
                <path fill="url(#gradient1)" fill-opacity="0.2" d="M0,80L34.3,82.7C68.6,85,137,91,206,96C274.3,101,343,107,411,96C480,85,549,59,617,53.3C685.7,48,754,64,823,64C891.4,64,960,48,1029,42.7C1097.1,37,1166,43,1234,58.7C1302.9,75,1371,101,1406,114.7L1440,128L1440,120L1405.7,120C1371.4,120,1303,120,1234,120C1165.7,120,1097,120,1029,120C960,120,891,120,823,120C754.3,120,686,120,617,120C548.6,120,480,120,411,120C342.9,120,274,120,206,120C137.1,120,69,120,34,120L0,120Z"></path>
                <defs>
                    <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#ff4d4d;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#7c3aed;stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>
            <svg class="absolute bottom-0 w-full" viewBox="0 0 1440 110" xmlns="http://www.w3.org/2000/svg">
                <path fill="url(#gradient2)" fill-opacity="0.3" d="M0,64L34.3,69.3C68.6,75,137,85,206,90.7C274.3,96,343,96,411,85.3C480,75,549,53,617,48C685.7,43,754,53,823,58.7C891.4,64,960,64,1029,58.7C1097.1,53,1166,43,1234,48C1302.9,53,1371,75,1406,85.3L1440,96L1440,120L1405.7,120C1371.4,120,1303,120,1234,120C1165.7,120,1097,120,1029,120C960,120,891,120,823,120C754.3,120,686,120,617,120C548.6,120,480,120,411,120C342.9,120,274,120,206,120C137.1,120,69,120,34,120L0,120Z"></path>
                <defs>
                    <linearGradient id="gradient2" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#7c3aed;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#0ea5e9;stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-12 items-center">
            <div class="text-center lg:text-left" data-aos="fade-right" data-aos-duration="1000">
                <div class="flex items-center justify-center lg:justify-start mb-6">
                    <div class="pulse-ring relative">
                        <div class="w-3 h-3 bg-gradient-to-r from-primary-500 to-accent-500 rounded-full"></div>
                    </div>
                    <h3 class="ml-3 text-transparent bg-clip-text bg-gradient-to-r from-primary-200 to-accent-200 font-semibold tracking-wide uppercase">Donate Today, Save Tomorrow</h3>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-extrabold text-white mb-6 leading-tight">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-accent-400">Blood</span> Donation 
                    <span class="relative inline-block">
                        Saves
                        <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 138 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.61868 1.55321C12.1187 1.18346 17.6328 1.07424 23.1429 0.947618C32.6733 0.739878 42.2051 0.542852 51.7356 0.424772C54.7662 0.384578 57.7996 0.384578 60.8302 0.325051C70.5724 0.128024 80.3146 0.0703666 90.0568 0.0127094C98.1078 -0.0290092 106.155 0.0127094 114.206 0.207879C118.723 0.325051 123.239 0.482909 127.756 0.759358C132.318 1.04025 136.84 1.35955 138 1.55321C136.928 1.74687 132.318 2.06617 127.756 2.34707C123.304 2.62797 118.838 2.78582 114.262 2.90296C106.255 3.09663 98.2102 3.16271 90.1632 3.18379C80.4454 3.20378 70.7336 3.14616 61.0381 2.88534C57.982 2.82617 54.9222 2.74692 51.8694 2.66877C42.3724 2.42802 32.8712 2.18727 23.4141 2.16618C17.9332 2.14727 12.4482 2.24103 6.78281 2.5083C4.86348 2.5083 2.94415 2.6095 1.0715 2.67013C0.428602 2.67013 0 2.67013 0 2.5083C0 2.34707 0.428602 2.34707 1.0715 2.34707C2.90091 2.27035 4.72984 2.22528 6.61868 2.16618" stroke="url(#redPurple)" stroke-width="3"/>
                            <defs>
                                <linearGradient id="redPurple" x1="0" y1="0" x2="100%" y2="0">
                                    <stop offset="0%" stop-color="#ff4d4d" />
                                    <stop offset="100%" stop-color="#7c3aed" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </span>
                    Lives
                </h1>
                
                <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-lg mx-auto lg:mx-0">Join our mission to ensure blood is available for those who need it most. Your donation today could save up to three lives.</p>
                
                <div class="flex flex-col sm:flex-row sm:items-center gap-4 justify-center lg:justify-start">
                    <a href="register.php" class="btn-gradient group relative inline-flex items-center justify-center overflow-hidden rounded-lg px-8 py-4 font-semibold text-white shadow-md">
                        <span class="relative flex items-center">
                            Become a Donor
                            <svg class="ml-2 -mr-1 w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </a>
                    
                    <a href="donation_centers.php" class="glassmorphism relative inline-flex items-center justify-center overflow-hidden rounded-lg px-8 py-4 font-semibold text-white transition duration-300 ease-out hover:shadow-neon">
                        <span class="relative flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            Find Donation Centers
                        </span>
                    </a>
                </div>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-12">
                    <div class="glassmorphism p-3 rounded-lg border border-gray-700/50 text-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="counter text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-accent-500" data-count="10000">0</div>
                        <p class="text-gray-400 text-sm">Registered Donors</p>
                    </div>
                    <div class="glassmorphism p-3 rounded-lg border border-gray-700/50 text-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="counter text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-accent-500" data-count="5200">0</div>
                        <p class="text-gray-400 text-sm">Blood Donations</p>
                    </div>
                    <div class="glassmorphism p-3 rounded-lg border border-gray-700/50 text-center" data-aos="fade-up" data-aos-delay="300">
                        <div class="counter text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-accent-500" data-count="75">0</div>
                        <p class="text-gray-400 text-sm">Donation Centers</p>
                    </div>
                    <div class="glassmorphism p-3 rounded-lg border border-gray-700/50 text-center" data-aos="fade-up" data-aos-delay="400">
                        <div class="counter text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-accent-500" data-count="15000">0</div>
                        <p class="text-gray-400 text-sm">Lives Saved</p>
                    </div>
                </div>
            </div>
            
            <div class="relative max-w-md mx-auto lg:max-w-full" data-aos="fade-left" data-aos-duration="1000">
                <!-- 3D Blood Drop Animation -->
                <div class="relative">
                    <div class="blood-drop-3d">
                        <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_vmollw2k.json" background="transparent" speed="1" loop autoplay class="w-full max-w-[400px] mx-auto"></lottie-player>
                    </div>
                    
                    <!-- Floating Cards -->
                    <div class="absolute top-1/2 -left-5 transform -translate-y-1/2 w-32 h-32 glassmorphism rounded-lg p-4 border border-gray-700/50 animate-float shadow-xl shadow-neon">
                        <div class="flex justify-center items-center h-full text-center">
                            <div>
                                <i class="fas fa-tint text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-accent-500 text-xl mb-2"></i>
                                <p class="text-white text-sm font-semibold">One donation saves three lives</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="absolute bottom-10 -right-5 w-36 h-36 glassmorphism rounded-lg p-4 border border-gray-700/50 animate-float animation-delay-1000 shadow-xl shadow-neon-blue">
                        <div class="flex justify-center items-center h-full text-center">
                            <div>
                                <div class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-500 to-accent-500 text-xl font-bold mb-1">4.5M</div>
                                <p class="text-white text-sm font-semibold">Americans need blood yearly</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-center">
            <div class="w-6 h-10 border-2 border-gray-400 rounded-full mx-auto relative">
                <span class="absolute top-1 left-1/2 transform -translate-x-1/2 w-1.5 h-1.5 bg-gradient-to-r from-primary-500 to-accent-500 rounded-full animate-scroll-down"></span>
            </div>
        </div>
    </div>
</section>

<style>
    /* Blood cell animations */
    .blood-cell-container {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    
    .blood-cell {
        position: absolute;
        width: var(--size);
        height: var(--size);
        background: radial-gradient(circle at 40% 40%, rgba(255, 0, 0, 0.3), rgba(255, 0, 0, 0.1));
        border-radius: 50%;
        bottom: -50px;
        left: var(--left);
        animation: float-up var(--speed) linear infinite;
        animation-delay: var(--delay);
        opacity: 0.4;
    }
    
    @keyframes float-up {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 0.4;
        }
        90% {
            opacity: 0.4;
        }
        100% {
            transform: translateY(-100vh) rotate(720deg);
            opacity: 0;
        }
    }
    
    /* Pulse ring animation */
    .pulse-ring {
        position: relative;
    }
    
    .pulse-ring::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        animation: pulse-ring 2s infinite;
    }
    
    @keyframes pulse-ring {
        0% {
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
        }
    }
    
    /* Scroll down animation */
    @keyframes scroll-down {
        0% {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
        75% {
            opacity: 1;
            transform: translateX(-50%) translateY(200%);
        }
        100% {
            opacity: 0;
            transform: translateX(-50%) translateY(250%);
        }
    }
    
    .animate-scroll-down {
        animation: scroll-down 1.5s ease-in-out infinite;
    }
    
    /* Floating animation */
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animation-delay-1000 {
        animation-delay: 1s;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Swiper
        const bloodImpactSwiper = new Swiper('.blood-impact-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
            effect: 'coverflow',
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
        });
        
        // Particle canvas background
        const canvas = document.getElementById('particle-canvas');
        const ctx = canvas.getContext('2d');
        
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        
        const particles = [];
        const particleCount = 100;
        
        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 2 + 1;
                this.speedX = Math.random() * 1 - 0.5;
                this.speedY = Math.random() * 1 - 0.5;
                
                // Create gradient colors for particles
                const colors = [
                    [255, Math.floor(Math.random() * 50), Math.floor(Math.random() * 50)], // Red variations
                    [Math.floor(Math.random() * 50), Math.floor(Math.random() * 50), 255], // Blue variations
                    [Math.floor(Math.random() * 50), 0, Math.floor(Math.random() * 150) + 100] // Purple variations
                ];
                
                const colorSet = colors[Math.floor(Math.random() * colors.length)];
                this.color = `rgba(${colorSet[0]}, ${colorSet[1]}, ${colorSet[2]}, ${Math.random() * 0.5})`;
            }
            
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                
                if (this.x > canvas.width || this.x < 0) this.speedX *= -1;
                if (this.y > canvas.height || this.y < 0) this.speedY *= -1;
            }
            
            draw() {
                ctx.fillStyle = this.color;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }
        
        function init() {
            for (let i = 0; i < particleCount; i++) {
                particles.push(new Particle());
            }
        }
        
        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            for (let i = 0; i < particles.length; i++) {
                particles[i].update();
                particles[i].draw();
                
                // Create connections between particles
                for (let j = i; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const distance = Math.sqrt(dx * dx + dy * dy);
                    
                    if (distance < 100) {
                        ctx.beginPath();
                        ctx.strokeStyle = `rgba(255, 0, 0, ${0.1 - distance/1000})`;
                        ctx.lineWidth = 0.2;
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.stroke();
                    }
                }
            }
            
            requestAnimationFrame(animate);
        }
        
        init();
        animate();
        
        // Resize canvas on window resize
        window.addEventListener('resize', function() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
        
        // Counter animation
        const counters = document.querySelectorAll('.counter');
        const speed = 200;
        
        function animateValue(counter, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                
                // Use easeOutQuad for smooth animation
                const easeProgress = 1 - (1 - progress) * (1 - progress);
                
                counter.innerHTML = Math.floor(progress * (end - start) + start).toLocaleString();
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }
        
        const handleIntersect = (entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-count'));
                    animateValue(counter, 0, target, 2000);
                    
                    // Unobserve after animation
                    observer.unobserve(counter);
                }
            });
        };
        
        // Set up Intersection Observer
        const observer = new IntersectionObserver(handleIntersect, {
            threshold: 0.2
        });
        
        counters.forEach(counter => {
            observer.observe(counter);
        });
    });
</script>

<!-- Blood Availability -->
<section class="bg-gradient-dark py-12">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-white mb-2">Current Blood Availability</h2>
            <p class="text-gray-400">Check the current blood inventory levels</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
            <?php
            // Blood types and their criticality levels
            $bloodTypes = [
                'A+' => ['level' => 'medium', 'percentage' => 70],
                'A-' => ['level' => 'critical', 'percentage' => 20],
                'B+' => ['level' => 'high', 'percentage' => 50],
                'B-' => ['level' => 'low', 'percentage' => 85],
                'AB+' => ['level' => 'medium', 'percentage' => 65],
                'AB-' => ['level' => 'critical', 'percentage' => 15],
                'O+' => ['level' => 'high', 'percentage' => 40],
                'O-' => ['level' => 'critical', 'percentage' => 10]
            ];
            
            foreach ($bloodTypes as $type => $data) {
                $colorClass = '';
                $levelText = '';
                
                switch ($data['level']) {
                    case 'critical':
                        $colorClass = 'from-red-700 to-red-900';
                        $levelText = 'Critical';
                        break;
                    case 'high':
                        $colorClass = 'from-orange-600 to-orange-800';
                        $levelText = 'Urgent';
                        break;
                    case 'medium':
                        $colorClass = 'from-yellow-600 to-yellow-800';
                        $levelText = 'Moderate';
                        break;
                    case 'low':
                        $colorClass = 'from-green-600 to-green-800';
                        $levelText = 'Adequate';
                        break;
                }
            ?>
            <div class="glassmorphism rounded-lg p-4 text-center hover:shadow-neon transition duration-300">
                <div class="text-2xl font-bold mb-2"><?php echo $type; ?></div>
                <div class="w-full bg-gray-600 rounded-full h-4 mb-2">
                    <div class="h-4 rounded-full bg-gradient-to-r <?php echo $colorClass; ?>" style="width: <?php echo $data['percentage']; ?>%"></div>
                </div>
                <div class="text-sm <?php echo ($data['level'] == 'critical') ? 'text-red-400' : (($data['level'] == 'high') ? 'text-orange-400' : (($data['level'] == 'medium') ? 'text-yellow-400' : 'text-green-400')); ?>">
                    <?php echo $levelText; ?>
                </div>
            </div>
            <?php } ?>
        </div>
        
        <div class="mt-8 text-center">
            <a href="request_blood.php" class="btn-gradient hover:bg-primary-700 text-white font-bold py-3 px-6 rounded-lg inline-block">
                Request Blood
            </a>
        </div>
    </div>
</section>

<!-- Swipe to Explore Section -->
<section class="py-16 bg-gradient-dark relative overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-white mb-2">Why Donate Blood?</h2>
        </div>
        
        <!-- Swiper Container -->
        <div class="swiper-container blood-impact-swiper">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="modern-card h-96 p-6 flex flex-col justify-center">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-primary-500 to-accent-500 flex items-center justify-center mx-auto mb-6 shadow-neon">
                            <i class="fas fa-user-friends text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-center text-white mb-4">Save Lives</h3>
                        <p class="text-gray-300 text-center mb-6">Every 2 seconds, someone in the U.S. needs blood. A single donation can save up to 3 lives.</p>
                        <div class="glassmorphism p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary-700 to-accent-700 flex items-center justify-center mr-4">
                                    <i class="fas fa-heartbeat text-white"></i>
                                </div>
                                <div>
                                    <p class="text-white font-bold">4.5 Million</p>
                                    <p class="text-gray-400 text-sm">Americans need blood annually</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="modern-card h-96 p-6 flex flex-col justify-center">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-secondary-500 to-accent-500 flex items-center justify-center mx-auto mb-6 shadow-neon-blue">
                            <i class="fas fa-hospital text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-center text-white mb-4">Emergency Response</h3>
                        <p class="text-gray-300 text-center mb-6">In emergency situations, there's often no time to match blood types. Type O negative is needed immediately.</p>
                        <div class="glassmorphism p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-secondary-700 to-accent-700 flex items-center justify-center mr-4">
                                    <i class="fas fa-ambulance text-white"></i>
                                </div>
                                <div>
                                    <p class="text-white font-bold">21 Million</p>
                                    <p class="text-gray-400 text-sm">Blood transfusions yearly</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="modern-card h-96 p-6 flex flex-col justify-center">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-accent-500 to-primary-500 flex items-center justify-center mx-auto mb-6 shadow-neon-purple">
                            <i class="fas fa-child text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-center text-white mb-4">Support Children</h3>
                        <p class="text-gray-300 text-center mb-6">Children with cancer, premature infants, and children having surgery need blood and platelets from donors.</p>
                        <div class="glassmorphism p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-accent-700 to-primary-700 flex items-center justify-center mr-4">
                                    <i class="fas fa-hospital-alt text-white"></i>
                                </div>
                                <div>
                                    <p class="text-white font-bold">100,000+</p>
                                    <p class="text-gray-400 text-sm">Children need donors</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Slide 4 -->
                <div class="swiper-slide">
                    <div class="modern-card h-96 p-6 flex flex-col justify-center">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-green-500 to-blue-500 flex items-center justify-center mx-auto mb-6 shadow-neon-blue">
                            <i class="fas fa-notes-medical text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-center text-white mb-4">Health Benefits</h3>
                        <p class="text-gray-300 text-center mb-6">Donating blood can reduce harmful iron stores, reduce the risk of heart disease, and help your liver stay healthy.</p>
                        <div class="glassmorphism p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-green-700 to-blue-700 flex items-center justify-center mr-4">
                                    <i class="fas fa-heart text-white"></i>
                                </div>
                                <div>
                                    <p class="text-white font-bold">16% Reduced</p>
                                    <p class="text-gray-400 text-sm">Risk of heart disease</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="swiper-pagination mt-6"></div>
            
            <!-- Navigation Buttons -->
            <div class="swiper-button-next text-white"></div>
            <div class="swiper-button-prev text-white"></div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="py-16 bg-gradient-dark">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="modern-card p-6 rounded-lg text-center transform hover:scale-105 transition duration-300 shadow-neon">
                <div class="text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-accent-500 text-4xl mb-2">
                    <i class="fas fa-users"></i>
                </div>
                <div class="text-3xl font-bold text-white mb-2">10,000+</div>
                <div class="text-gray-400">Registered Donors</div>
            </div>
            
            <div class="modern-card p-6 rounded-lg text-center transform hover:scale-105 transition duration-300 shadow-neon-blue">
                <div class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-500 to-accent-500 text-4xl mb-2">
                    <i class="fas fa-tint"></i>
                </div>
                <div class="text-3xl font-bold text-white mb-2">5,200+</div>
                <div class="text-gray-400">Blood Donations</div>
            </div>
            
            <div class="modern-card p-6 rounded-lg text-center transform hover:scale-105 transition duration-300 shadow-neon-purple">
                <div class="text-transparent bg-clip-text bg-gradient-to-r from-accent-500 to-primary-500 text-4xl mb-2">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="text-3xl font-bold text-white mb-2">75+</div>
                <div class="text-gray-400">Donation Centers</div>
            </div>
            
            <div class="modern-card p-6 rounded-lg text-center transform hover:scale-105 transition duration-300 shadow-neon">
                <div class="text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-secondary-500 text-4xl mb-2">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="text-3xl font-bold text-white mb-2">15,000+</div>
                <div class="text-gray-400">Lives Saved</div>
            </div>
        </div>
    </div>
</section>

<!-- How it works -->
<section class="py-16 bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-2">How Blood Donation Works</h2>
            <p class="text-gray-400">Simple process, extraordinary impact</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-900 p-6 rounded-lg">
                <div class="bg-primary-600 w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-xl mb-4">1</div>
                <h3 class="text-xl font-bold text-white mb-2">Registration</h3>
                <p class="text-gray-400">Sign up as a donor, provide your details and medical history to ensure donation safety.</p>
            </div>
            
            <div class="bg-gray-900 p-6 rounded-lg">
                <div class="bg-primary-600 w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-xl mb-4">2</div>
                <h3 class="text-xl font-bold text-white mb-2">Donation</h3>
                <p class="text-gray-400">Visit a donation center, undergo a quick health check, and donate blood in a safe environment.</p>
            </div>
            
            <div class="bg-gray-900 p-6 rounded-lg">
                <div class="bg-primary-600 w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-xl mb-4">3</div>
                <h3 class="text-xl font-bold text-white mb-2">Saving Lives</h3>
                <p class="text-gray-400">Your donation is processed, tested, and distributed to hospitals to help those in need.</p>
            </div>
        </div>
        
        <div class="text-center mt-10">
            <a href="about.php" class="text-primary-500 hover:text-primary-400 inline-flex items-center">
                Learn more about the donation process
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Blood types info -->
<section class="py-16 bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-2">Blood Type Compatibility</h2>
            <p class="text-gray-400">Understanding blood types can help save lives</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full bg-gray-800 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="px-4 py-3 text-left text-white">Blood Type</th>
                        <th class="px-4 py-3 text-left text-white">Can Donate To</th>
                        <th class="px-4 py-3 text-left text-white">Can Receive From</th>
                        <th class="px-4 py-3 text-left text-white">Population</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <tr class="hover:bg-gray-700">
                        <td class="px-4 py-3 font-bold text-primary-500">A+</td>
                        <td class="px-4 py-3 text-gray-300">A+, AB+</td>
                        <td class="px-4 py-3 text-gray-300">A+, A-, O+, O-</td>
                        <td class="px-4 py-3 text-gray-300">~34%</td>
                    </tr>
                    <tr class="hover:bg-gray-700">
                        <td class="px-4 py-3 font-bold text-primary-500">A-</td>
                        <td class="px-4 py-3 text-gray-300">A+, A-, AB+, AB-</td>
                        <td class="px-4 py-3 text-gray-300">A-, O-</td>
                        <td class="px-4 py-3 text-gray-300">~6%</td>
                    </tr>
                    <tr class="hover:bg-gray-700">
                        <td class="px-4 py-3 font-bold text-primary-500">B+</td>
                        <td class="px-4 py-3 text-gray-300">B+, AB+</td>
                        <td class="px-4 py-3 text-gray-300">B+, B-, O+, O-</td>
                        <td class="px-4 py-3 text-gray-300">~9%</td>
                    </tr>
                    <tr class="hover:bg-gray-700">
                        <td class="px-4 py-3 font-bold text-primary-500">B-</td>
                        <td class="px-4 py-3 text-gray-300">B+, B-, AB+, AB-</td>
                        <td class="px-4 py-3 text-gray-300">B-, O-</td>
                        <td class="px-4 py-3 text-gray-300">~2%</td>
                    </tr>
                    <tr class="hover:bg-gray-700">
                        <td class="px-4 py-3 font-bold text-primary-500">AB+</td>
                        <td class="px-4 py-3 text-gray-300">AB+ only</td>
                        <td class="px-4 py-3 text-gray-300">All Types</td>
                        <td class="px-4 py-3 text-gray-300">~3%</td>
                    </tr>
                    <tr class="hover:bg-gray-700">
                        <td class="px-4 py-3 font-bold text-primary-500">AB-</td>
                        <td class="px-4 py-3 text-gray-300">AB+, AB-</td>
                        <td class="px-4 py-3 text-gray-300">A-, B-, AB-, O-</td>
                        <td class="px-4 py-3 text-gray-300">~1%</td>
                    </tr>
                    <tr class="hover:bg-gray-700">
                        <td class="px-4 py-3 font-bold text-primary-500">O+</td>
                        <td class="px-4 py-3 text-gray-300">O+, A+, B+, AB+</td>
                        <td class="px-4 py-3 text-gray-300">O+, O-</td>
                        <td class="px-4 py-3 text-gray-300">~38%</td>
                    </tr>
                    <tr class="hover:bg-gray-700">
                        <td class="px-4 py-3 font-bold text-primary-500">O-</td>
                        <td class="px-4 py-3 text-gray-300">All Types</td>
                        <td class="px-4 py-3 text-gray-300">O- only</td>
                        <td class="px-4 py-3 text-gray-300">~7%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-16 bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-2">Donor Stories</h2>
            <p class="text-gray-400">Hear from those who have made a difference</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-900 p-6 rounded-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gray-700 rounded-full mr-4"></div>
                    <div>
                        <h3 class="text-white font-bold">Sarah Johnson</h3>
                        <p class="text-gray-400 text-sm">Regular Donor</p>
                    </div>
                </div>
                <p class="text-gray-300">"I've been donating blood regularly for five years. Knowing that my donation could save up to three lives gives me immense satisfaction. The process is quick and the staff is always friendly."</p>
            </div>
            
            <div class="bg-gray-900 p-6 rounded-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gray-700 rounded-full mr-4"></div>
                    <div>
                        <h3 class="text-white font-bold">Michael Chen</h3>
                        <p class="text-gray-400 text-sm">First-time Donor</p>
                    </div>
                </div>
                <p class="text-gray-300">"I was nervous about donating blood for the first time, but the staff made me feel comfortable. The process was much easier than I expected, and now I plan to donate regularly."</p>
            </div>
            
            <div class="bg-gray-900 p-6 rounded-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gray-700 rounded-full mr-4"></div>
                    <div>
                        <h3 class="text-white font-bold">Amanda Rodriguez</h3>
                        <p class="text-gray-400 text-sm">Blood Recipient</p>
                    </div>
                </div>
                <p class="text-gray-300">"After a serious accident, I needed multiple blood transfusions. I'm alive today because of generous blood donors. Now I volunteer at blood drives to give back to the community that saved me."</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="bg-primary-700 rounded-lg p-8 md:p-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-4">Ready to Make a Difference?</h2>
                    <p class="text-white text-lg mb-6">Your donation can save up to three lives. Register today and be someone's hero.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="register.php" class="bg-white text-primary-700 hover:bg-gray-100 font-bold py-3 px-6 rounded-lg transition text-center">
                            Become a Donor
                        </a>
                        <a href="donation_centers.php" class="bg-primary-600 hover:bg-primary-800 text-white font-bold py-3 px-6 rounded-lg transition text-center border border-white">
                            Find Centers
                        </a>
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    <div class="text-center">
                        <div class="text-white text-6xl font-bold mb-2">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <p class="text-white text-xl">One donation can save multiple lives</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Recent Blog Posts -->
<section class="py-16 bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-white">Latest News & Articles</h2>
            <a href="blog.php" class="text-primary-500 hover:text-primary-400 inline-flex items-center">
                View all
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-900 rounded-lg overflow-hidden">
                <div class="h-48 bg-gray-700"></div>
                <div class="p-6">
                    <div class="text-gray-400 text-sm mb-2">June 14, 2025 | World Blood Donor Day</div>
                    <h3 class="text-xl font-bold text-white mb-2">The Importance of Regular Blood Donation</h3>
                    <p class="text-gray-300 mb-4">Learn why regular blood donation is crucial for maintaining adequate blood supplies and how it benefits your health.</p>
                    <a href="#" class="text-primary-500 hover:text-primary-400 inline-flex items-center">
                        Read more
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            
            <div class="bg-gray-900 rounded-lg overflow-hidden">
                <div class="h-48 bg-gray-700"></div>
                <div class="p-6">
                    <div class="text-gray-400 text-sm mb-2">May 28, 2025 | Health</div>
                    <h3 class="text-xl font-bold text-white mb-2">Myths About Blood Donation Debunked</h3>
                    <p class="text-gray-300 mb-4">We address common misconceptions about blood donation that might be preventing potential donors from contributing.</p>
                    <a href="#" class="text-primary-500 hover:text-primary-400 inline-flex items-center">
                        Read more
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            
            <div class="bg-gray-900 rounded-lg overflow-hidden">
                <div class="h-48 bg-gray-700"></div>
                <div class="p-6">
                    <div class="text-gray-400 text-sm mb-2">May 15, 2025 | Technology</div>
                    <h3 class="text-xl font-bold text-white mb-2">New Technologies in Blood Storage</h3>
                    <p class="text-gray-300 mb-4">Discover the latest advancements in blood storage technology that are extending shelf life and improving accessibility.</p>
                    <a href="#" class="text-primary-500 hover:text-primary-400 inline-flex items-center">
                        Read more
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once "includes/footer.php"; ?> 