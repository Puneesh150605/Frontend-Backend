<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - BloodLink</title>
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <?php include_once "includes/header.php"; ?>

<!-- Hero Section -->
<section class="py-20 bg-gradient-to-br from-gray-900 via-accent-900/30 to-gray-900 relative overflow-hidden">
    <canvas id="particle-canvas" class="absolute inset-0 z-0 opacity-20"></canvas>
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 text-white mb-10 md:mb-0" data-aos="fade-right" data-aos-duration="1000">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Making A Difference <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-accent-400">One Drop</span> At A Time</h1>
                <p class="text-xl text-white/90 mb-8 max-w-lg">BloodLink connects donors with those in need, creating a lifeline that saves thousands of lives each year.</p>
                <a href="appointment.php" class="btn-gradient inline-block text-white font-bold py-3 px-8 rounded-lg transition transform hover:scale-105 shadow-lg">
                    Donate Today
                </a>
            </div>
            <div class="md:w-1/2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="glassmorphism p-3 rounded-lg shadow-neon">
                    <img src="assets/images/about-hero.jpg" alt="Blood Donation Hero" class="rounded-lg transform rotate-2 hover:rotate-0 transition-transform duration-500 max-w-full h-auto">
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg class="w-full" viewBox="0 0 1440 110" xmlns="http://www.w3.org/2000/svg">
            <path fill="url(#aboutGradient)" fill-opacity="1" d="M0,64L34.3,69.3C68.6,75,137,85,206,90.7C274.3,96,343,96,411,85.3C480,75,549,53,617,48C685.7,43,754,53,823,58.7C891.4,64,960,64,1029,58.7C1097.1,53,1166,43,1234,48C1302.9,53,1371,75,1406,85.3L1440,96L1440,120L1405.7,120C1371.4,120,1303,120,1234,120C1165.7,120,1097,120,1029,120C960,120,891,120,823,120C754.3,120,686,120,617,120C548.6,120,480,120,411,120C342.9,120,274,120,206,120C137.1,120,69,120,34,120L0,120Z"></path>
            <defs>
                <linearGradient id="aboutGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#0f172a;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#1e293b;stop-opacity:1" />
                </linearGradient>
            </defs>
        </svg>
    </div>
</section>

<!-- Mission Section -->
<section class="py-20 bg-gradient-dark">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Our Mission</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-primary-500 to-accent-500 mx-auto mb-8 rounded-full"></div>
        </div>
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0" data-aos="fade-right" data-aos-duration="800">
                <div class="glassmorphism p-3 rounded-lg shadow-neon">
                    <img src="assets/images/mission.jpg" alt="Our Mission" class="rounded-lg max-w-full h-auto transform transition-all duration-300">
                </div>
            </div>
            <div class="md:w-1/2 md:pl-12" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                <h3 class="text-2xl font-bold text-white mb-6">Bridging the Gap Between Donors and Recipients</h3>
                <p class="text-gray-300 mb-6 leading-relaxed">Our mission at BloodLink is to create an efficient and reliable connection between blood donors and recipients, ensuring that lifesaving blood is available to everyone who needs it, whenever they need it.</p>
                <p class="text-gray-300 leading-relaxed">We strive to educate communities about the importance of regular blood donation and work tirelessly to remove barriers that prevent potential donors from contributing to this vital cause.</p>
                <div class="mt-8">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-700 to-accent-700 rounded-full flex items-center justify-center text-white mr-4">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <p class="font-semibold text-gray-300">Over 10,000 lives saved annually</p>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-700 to-accent-700 rounded-full flex items-center justify-center text-white mr-4">
                            <i class="fas fa-hospital-user"></i>
                        </div>
                        <p class="font-semibold text-gray-300">Supporting 50+ healthcare facilities</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Values Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Core Values</h2>
            <div class="w-24 h-1 bg-primary-500 mx-auto mb-8 rounded-full"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">These principles guide everything we do and represent our commitment to excellence in blood donation services.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="zoom-in" data-aos-delay="100">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 text-2xl mb-6">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Compassion</h3>
                <p class="text-gray-600">We approach our work with empathy and understanding, recognizing the profound impact blood donation has on recipients and their families.</p>
            </div>
            
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="zoom-in" data-aos-delay="200">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 text-2xl mb-6">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Safety</h3>
                <p class="text-gray-600">We maintain the highest standards of safety and quality in all our procedures, ensuring the wellbeing of both donors and recipients.</p>
            </div>
            
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="zoom-in" data-aos-delay="300">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 text-2xl mb-6">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Community</h3>
                <p class="text-gray-600">We believe in the power of community action and work to build networks of donors, volunteers, and healthcare partners.</p>
            </div>
            
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="zoom-in" data-aos-delay="400">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 text-2xl mb-6">
                    <i class="fas fa-lock"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Integrity</h3>
                <p class="text-gray-600">We operate with transparency and honesty in all our interactions, earning the trust of our donors, recipients, and partners.</p>
            </div>
            
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="zoom-in" data-aos-delay="500">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 text-2xl mb-6">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Innovation</h3>
                <p class="text-gray-600">We continuously seek new ways to improve our services, embracing technology and research to enhance the donation experience.</p>
            </div>
            
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="zoom-in" data-aos-delay="600">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 text-2xl mb-6">
                    <i class="fas fa-globe"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Accessibility</h3>
                <p class="text-gray-600">We strive to make blood donation services accessible to all communities, regardless of geographical location or social background.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Leadership Team</h2>
            <div class="w-24 h-1 bg-primary-500 mx-auto mb-8 rounded-full"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">Meet the dedicated professionals who guide our organization with expertise and passion.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="relative mb-6 mx-auto w-48 h-48 overflow-hidden rounded-full group">
                    <img src="assets/images/team/ceo.jpg" alt="Dr. Sarah Johnson" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-primary-600 bg-opacity-0 group-hover:bg-opacity-30 flex items-center justify-center transition-all duration-300">
                        <div class="flex space-x-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="#" class="text-white hover:text-red-200"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-white hover:text-red-200"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-1">Dr. Sarah Johnson</h3>
                <p class="text-primary-600 mb-3">Chief Executive Officer</p>
                <p class="text-gray-600 text-sm">Hematologist with over 15 years of experience in blood banking and transfusion medicine.</p>
            </div>
            
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="relative mb-6 mx-auto w-48 h-48 overflow-hidden rounded-full group">
                    <img src="assets/images/team/medical.jpg" alt="Dr. James Chen" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-primary-600 bg-opacity-0 group-hover:bg-opacity-30 flex items-center justify-center transition-all duration-300">
                        <div class="flex space-x-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="#" class="text-white hover:text-red-200"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-white hover:text-red-200"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-1">Dr. James Chen</h3>
                <p class="text-primary-600 mb-3">Medical Director</p>
                <p class="text-gray-600 text-sm">Board-certified in Transfusion Medicine with research focus on blood component therapies.</p>
            </div>
            
            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="relative mb-6 mx-auto w-48 h-48 overflow-hidden rounded-full group">
                    <img src="assets/images/team/operations.jpg" alt="Maria Rodriguez" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-primary-600 bg-opacity-0 group-hover:bg-opacity-30 flex items-center justify-center transition-all duration-300">
                        <div class="flex space-x-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="#" class="text-white hover:text-red-200"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-white hover:text-red-200"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-1">Maria Rodriguez</h3>
                <p class="text-primary-600 mb-3">Operations Director</p>
                <p class="text-gray-600 text-sm">Expert in healthcare logistics with experience scaling blood donation networks nationwide.</p>
            </div>
            
            <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                <div class="relative mb-6 mx-auto w-48 h-48 overflow-hidden rounded-full group">
                    <img src="assets/images/team/tech.jpg" alt="David Patel" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-primary-600 bg-opacity-0 group-hover:bg-opacity-30 flex items-center justify-center transition-all duration-300">
                        <div class="flex space-x-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="#" class="text-white hover:text-red-200"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-white hover:text-red-200"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-1">David Patel</h3>
                <p class="text-primary-600 mb-3">Technology Director</p>
                <p class="text-gray-600 text-sm">Pioneering innovative solutions for blood tracking and donor-recipient matching.</p>
            </div>
        </div>
    </div>
</section>

<!-- History Timeline -->
<section class="py-20 bg-gray-50 overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Journey</h2>
            <div class="w-24 h-1 bg-primary-500 mx-auto mb-8 rounded-full"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">Tracing our growth from a small local initiative to a nationwide blood donation network.</p>
        </div>
        
        <div class="relative">
            <!-- Timeline Line -->
            <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-primary-200"></div>
            
            <!-- Timeline Items -->
            <div class="relative z-10">
                <!-- 2010 -->
                <div class="flex flex-col md:flex-row items-center mb-16" data-aos="fade-right">
                    <div class="md:w-1/2 md:pr-16 text-right mb-8 md:mb-0">
                        <div class="bg-white p-6 rounded-lg shadow-lg ml-auto md:ml-0 max-w-md">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">2010</h3>
                            <h4 class="text-primary-600 font-semibold mb-3">Foundation</h4>
                            <p class="text-gray-600">BloodLink was founded by a group of medical professionals and community leaders concerned about blood shortages in local hospitals.</p>
                        </div>
                    </div>
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 rounded-full bg-primary-500 border-4 border-white flex items-center justify-center text-white">
                        <i class="fas fa-flag"></i>
                    </div>
                    <div class="md:w-1/2 md:pl-16"></div>
                </div>
                
                <!-- 2013 -->
                <div class="flex flex-col md:flex-row items-center mb-16" data-aos="fade-left">
                    <div class="md:w-1/2 md:pr-16"></div>
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 rounded-full bg-primary-500 border-4 border-white flex items-center justify-center text-white">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="md:w-1/2 md:pl-16 text-left mb-8 md:mb-0">
                        <div class="bg-white p-6 rounded-lg shadow-lg mr-auto md:mr-0 max-w-md">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">2013</h3>
                            <h4 class="text-primary-600 font-semibold mb-3">First Center</h4>
                            <p class="text-gray-600">Opened our first dedicated blood donation center, equipped with state-of-the-art facilities and staffed by specialized medical professionals.</p>
                        </div>
                    </div>
                </div>
                
                <!-- 2016 -->
                <div class="flex flex-col md:flex-row items-center mb-16" data-aos="fade-right">
                    <div class="md:w-1/2 md:pr-16 text-right mb-8 md:mb-0">
                        <div class="bg-white p-6 rounded-lg shadow-lg ml-auto md:ml-0 max-w-md">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">2016</h3>
                            <h4 class="text-primary-600 font-semibold mb-3">Digital Platform</h4>
                            <p class="text-gray-600">Launched our online platform to connect donors with recipients, allowing real-time tracking of blood needs and streamlining the donation process.</p>
                        </div>
                    </div>
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 rounded-full bg-primary-500 border-4 border-white flex items-center justify-center text-white">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <div class="md:w-1/2 md:pl-16"></div>
                </div>
                
                <!-- 2019 -->
                <div class="flex flex-col md:flex-row items-center mb-16" data-aos="fade-left">
                    <div class="md:w-1/2 md:pr-16"></div>
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 rounded-full bg-primary-500 border-4 border-white flex items-center justify-center text-white">
                        <i class="fas fa-expand-alt"></i>
                    </div>
                    <div class="md:w-1/2 md:pl-16 text-left mb-8 md:mb-0">
                        <div class="bg-white p-6 rounded-lg shadow-lg mr-auto md:mr-0 max-w-md">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">2019</h3>
                            <h4 class="text-primary-600 font-semibold mb-3">National Expansion</h4>
                            <p class="text-gray-600">Expanded operations to 10 states, partnering with over 30 hospitals and blood banks to create a nationwide network of blood donation services.</p>
                        </div>
                    </div>
                </div>
                
                <!-- 2022 -->
                <div class="flex flex-col md:flex-row items-center" data-aos="fade-right">
                    <div class="md:w-1/2 md:pr-16 text-right mb-8 md:mb-0">
                        <div class="bg-white p-6 rounded-lg shadow-lg ml-auto md:ml-0 max-w-md">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">2022</h3>
                            <h4 class="text-primary-600 font-semibold mb-3">Research Initiative</h4>
                            <p class="text-gray-600">Established the BloodLink Research Foundation to advance blood donation science, focusing on storage techniques and rare blood type compatibility.</p>
                        </div>
                    </div>
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 rounded-full bg-primary-500 border-4 border-white flex items-center justify-center text-white">
                        <i class="fas fa-microscope"></i>
                    </div>
                    <div class="md:w-1/2 md:pl-16"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-primary-600 text-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="mb-8 md:mb-0 md:w-2/3">
                <h2 class="text-3xl font-bold mb-4">Join Our Mission to Save Lives</h2>
                <p class="text-white/90 max-w-2xl">Whether you donate blood, volunteer at our centers, or spread awareness, your contribution can make a real difference in someone's life.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="appointment.php" class="bg-white text-primary-700 hover:bg-red-50 font-bold py-3 px-8 rounded-lg text-center shadow-lg transition">
                    Become a Donor
                </a>
                <a href="contact.php" class="bg-primary-700 hover:bg-primary-800 text-white border border-white/20 font-bold py-3 px-8 rounded-lg text-center shadow-lg transition">
                    Partner With Us
                </a>
            </div>
        </div>
    </div>
</section>

<!-- AOS Animation Library -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // AOS Animation Initialization
        AOS.init({
            duration: 800,
            easing: 'ease-out',
            once: true
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
    });
</script>

<?php include_once "includes/footer.php"; ?> 