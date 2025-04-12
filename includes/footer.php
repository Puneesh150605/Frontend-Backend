    </main>
    
    <!-- Waves Divider with Animation -->
    <div class="relative h-24 bg-gray-900">
        <div class="wave-container">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(220, 38, 38, 0.1)" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(124, 58, 237, 0.07)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(220, 38, 38, 0.05)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(31, 41, 55, 1)" />
                </g>
            </svg>
        </div>
    </div>
    
    <!-- 3D Blood Cells Visualization -->
    <div class="blood-cells-3d">
        <div class="cell-container">
            <?php for ($i = 0; $i < 12; $i++): 
                $size = rand(30, 70);
                $opacity = rand(2, 6) / 10;
                $posX = rand(5, 95);
                $posY = rand(10, 80);
                $delay = rand(0, 10) / 10;
                $speed = rand(8, 15);
                $blur = rand(0, 3);
            ?>
            <div class="blood-cell" style="--size: <?php echo $size; ?>px; --opacity: <?php echo $opacity; ?>; --pos-x: <?php echo $posX; ?>%; --pos-y: <?php echo $posY; ?>%; --delay: <?php echo $delay; ?>s; --speed: <?php echo $speed; ?>s; --blur: <?php echo $blur; ?>px;"></div>
            <?php endfor; ?>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-800 relative">
        <div class="container mx-auto px-4 pt-12 pb-8">
            <!-- Footer Top Section -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <!-- About -->
                <div data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center mb-4">
                        <div class="relative w-10 h-10 flex items-center justify-center mr-2 bg-gradient-to-br from-primary-600 to-primary-700 rounded-full shadow-neon overflow-hidden group">
                            <i class="fas fa-heartbeat text-white text-xl"></i>
                            <div class="absolute inset-0 bg-gradient-to-br from-primary-500 to-accent-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div>
                            <span class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-accent-400 font-display">BloodLink</span>
                            <span class="block text-[10px] text-gray-400 -mt-1">Connecting Lives Through Donation</span>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">BloodLink is a comprehensive blood donation platform connecting donors with recipients through a safe, efficient ecosystem, ensuring that life-saving blood reaches those in need, when they need it most.</p>
                    <div class="mt-4 flex items-center space-x-2">
                        <div class="flex-shrink-0 w-3 h-3 rounded-full bg-green-500 animate-pulse"></div>
                        <span class="text-gray-300 text-xs">Online & Ready to Serve</span>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-white text-lg font-bold mb-4 relative inline-block">
                        Quick Links
                        <span class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-primary-500"></span>
                    </h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="index.php" class="text-gray-400 hover:text-white text-sm transition flex items-center group">
                                <i class="fas fa-chevron-right text-primary-500 text-xs mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="donation_centers.php" class="text-gray-400 hover:text-white text-sm transition flex items-center group">
                                <i class="fas fa-chevron-right text-primary-500 text-xs mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                                Donation Centers
                            </a>
                        </li>
                        <li>
                            <a href="request_blood.php" class="text-gray-400 hover:text-white text-sm transition flex items-center group">
                                <i class="fas fa-chevron-right text-primary-500 text-xs mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                                Request Blood
                            </a>
                        </li>
                        <li>
                            <a href="about.php" class="text-gray-400 hover:text-white text-sm transition flex items-center group">
                                <i class="fas fa-chevron-right text-primary-500 text-xs mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="contact.php" class="text-gray-400 hover:text-white text-sm transition flex items-center group">
                                <i class="fas fa-chevron-right text-primary-500 text-xs mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-white text-lg font-bold mb-4 relative inline-block">
                        Contact Us
                        <span class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-primary-500"></span>
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start group">
                            <span class="flex-shrink-0 w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-3 group-hover:bg-primary-600 transition-colors duration-300">
                                <i class="fas fa-map-marker-alt text-primary-500 group-hover:text-white transition-colors duration-300"></i>
                            </span>
                            <span class="text-gray-400 text-sm leading-tight">123 Blood Avenue, Medical District<br>New York, NY 10001</span>
                        </li>
                        <li class="flex items-start group">
                            <span class="flex-shrink-0 w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-3 group-hover:bg-primary-600 transition-colors duration-300">
                                <i class="fas fa-phone text-primary-500 group-hover:text-white transition-colors duration-300"></i>
                            </span>
                            <span class="text-gray-400 text-sm">+1 (800) BLOOD-HELP</span>
                        </li>
                        <li class="flex items-start group">
                            <span class="flex-shrink-0 w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-3 group-hover:bg-primary-600 transition-colors duration-300">
                                <i class="fas fa-envelope text-primary-500 group-hover:text-white transition-colors duration-300"></i>
                            </span>
                            <span class="text-gray-400 text-sm">contact@bloodlink.com</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Connect -->
                <div data-aos="fade-up" data-aos-delay="400">
                    <h3 class="text-white text-lg font-bold mb-4 relative inline-block">
                        Stay Connected
                        <span class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-primary-500"></span>
                    </h3>
                    <div class="flex space-x-3 mb-6">
                        <a href="#" class="w-9 h-9 bg-gray-700 rounded-full flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-700 rounded-full flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-700 rounded-full flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-700 rounded-full flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                    <div>
                        <h4 class="text-white text-sm font-semibold mb-3">Subscribe to our newsletter</h4>
                        <form class="relative">
                            <input type="email" placeholder="Your email" class="w-full bg-gray-700 text-white px-4 pr-12 py-3 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary-600 placeholder-gray-500">
                            <button type="submit" class="absolute right-1 top-1/2 transform -translate-y-1/2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg w-10 h-10 flex items-center justify-center transition-colors duration-300">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                        <p class="text-gray-500 text-xs mt-2">Get updates on blood drives, events, and donation opportunities.</p>
                    </div>
                </div>
            </div>
            
            <!-- Blood Type Compatibility Card -->
            <div class="bg-gray-900/80 backdrop-blur rounded-xl p-6 mb-10" data-aos="fade-up">
                <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                    <h3 class="text-white text-lg font-bold mb-2 md:mb-0">Blood Type Compatibility</h3>
                    <a href="blood_types.php" class="text-primary-500 hover:text-primary-400 text-sm transition flex items-center">
                        Learn more
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="text-center group">
                        <div class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center mx-auto mb-2 group-hover:bg-primary-600/20 transition-colors duration-300">
                            <span class="text-primary-500 font-bold">O-</span>
                        </div>
                        <p class="text-gray-300 text-xs">Universal<br>Donor</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center mx-auto mb-2 group-hover:bg-primary-600/20 transition-colors duration-300">
                            <span class="text-primary-500 font-bold">AB+</span>
                        </div>
                        <p class="text-gray-300 text-xs">Universal<br>Recipient</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center mx-auto mb-2 group-hover:bg-primary-600/20 transition-colors duration-300">
                            <span class="text-primary-500 font-bold">O+</span>
                        </div>
                        <p class="text-gray-300 text-xs">Most<br>Common</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center mx-auto mb-2 group-hover:bg-primary-600/20 transition-colors duration-300">
                            <span class="text-primary-500 font-bold">B-</span>
                        </div>
                        <p class="text-gray-300 text-xs">Rarest<br>Type</p>
                    </div>
                </div>
            </div>
            
            <!-- Bottom Section -->
            <div class="border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center">
                <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4 mb-4 md:mb-0">
                    <p class="text-gray-400 text-sm">© 2025 BloodLink. All rights reserved.</p>
                    <div class="flex items-center space-x-1">
                        <div class="w-1 h-1 bg-gray-600 rounded-full hidden md:block"></div>
                        <span class="text-gray-400 text-sm">Made with <i class="fas fa-heart text-primary-500 text-xs animate__animated animate__heartBeat animate__infinite"></i> for saving lives</span>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <a href="privacy_policy.php" class="text-gray-400 hover:text-white text-sm transition">Privacy Policy</a>
                    <a href="terms.php" class="text-gray-400 hover:text-white text-sm transition">Terms of Service</a>
                    <a href="faq.php" class="text-gray-400 hover:text-white text-sm transition">FAQ</a>
                </div>
            </div>
        </div>
        
        <!-- Back to top button -->
        <button id="back-to-top" class="fixed bottom-6 right-6 bg-primary-600 hover:bg-primary-700 text-white w-10 h-10 rounded-full shadow-lg flex items-center justify-center transition-all duration-300 transform translate-y-20 opacity-0 z-50">
            <i class="fas fa-chevron-up"></i>
        </button>
    </footer>
    
    <!-- Chatbot widget -->
    <div id="chatbot-widget" class="fixed bottom-6 left-6 z-50">
        <div id="chatbot-container" class="hidden glassmorphism rounded-xl shadow-xl w-80 md:w-96 overflow-hidden transform transition-transform duration-300">
            <div class="bg-gradient-to-r from-primary-700 to-primary-600 p-4 flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-robot text-primary-600"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-bold font-display">BloodLink Assistant</h3>
                        <div class="flex items-center mt-0.5">
                            <div class="w-2 h-2 bg-green-400 rounded-full mr-1.5 animate-pulse"></div>
                            <span class="text-xs text-white/80">Online</span>
                        </div>
                    </div>
                </div>
                <button id="close-chatbot" class="text-white/80 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4 h-96 overflow-y-auto" id="chatbot-messages">
                <div class="flex mb-4">
                    <div class="w-8 h-8 bg-primary-100 rounded-full flex-shrink-0 flex items-center justify-center mr-2">
                        <i class="fas fa-robot text-primary-600 text-sm"></i>
                    </div>
                    <div class="bg-gray-700/50 rounded-lg p-3 max-w-[80%]">
                        <p class="text-white text-sm">Hello! I'm BloodLink Assistant. How can I help you today?</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 p-3">
                <form id="chatbot-form" class="flex items-center">
                    <input type="text" id="chatbot-input" placeholder="Type your message..." class="w-full bg-gray-700/50 text-white border-none rounded-lg py-2 px-3 focus:outline-none focus:ring-1 focus:ring-primary-500 placeholder-gray-400">
                    <button type="submit" class="ml-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg w-9 h-9 flex items-center justify-center flex-shrink-0 transition-colors">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
        <button id="open-chatbot" class="bg-primary-600 hover:bg-primary-700 text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center transition-colors">
            <i class="fas fa-comments text-xl"></i>
        </button>
    </div>
    
    <!-- Add new wave animation styles to the bottom of the page -->
    <style>
        /* Wave Animation */
        .wave-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }
        
        .waves {
            position: relative;
            width: 100%;
            height: 100px;
            margin-bottom: -7px;
        }
        
        .parallax > use {
            animation: move-forever 25s cubic-bezier(.55, .5, .45, .5) infinite;
        }
        
        .parallax > use:nth-child(1) {
            animation-delay: -2s;
            animation-duration: 7s;
        }
        
        .parallax > use:nth-child(2) {
            animation-delay: -3s;
            animation-duration: 10s;
        }
        
        .parallax > use:nth-child(3) {
            animation-delay: -4s;
            animation-duration: 13s;
        }
        
        .parallax > use:nth-child(4) {
            animation-delay: -5s;
            animation-duration: 20s;
        }
        
        @keyframes move-forever {
            0% {
                transform: translate3d(-90px, 0, 0);
            }
            100% {
                transform: translate3d(85px, 0, 0);
            }
        }
        
        /* 3D Blood Cells */
        .blood-cells-3d {
            position: absolute;
            top: -120px;
            left: 0;
            width: 100%;
            height: 200px;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }
        
        .cell-container {
            position: relative;
            width: 100%;
            height: 100%;
        }
        
        .blood-cell {
            position: absolute;
            width: var(--size);
            height: var(--size);
            background: radial-gradient(circle at 30% 30%, rgba(255, 0, 0, var(--opacity)), rgba(170, 0, 0, calc(var(--opacity) - 0.2)));
            border-radius: 50%;
            filter: blur(var(--blur));
            top: var(--pos-y);
            left: var(--pos-x);
            transform: translateY(0) scale(0.8);
            opacity: 0;
            animation: float-3d-cell var(--speed) ease-out var(--delay) infinite;
            box-shadow: inset 5px -5px 10px rgba(0, 0, 0, 0.3);
        }
        
        @keyframes float-3d-cell {
            0% {
                transform: translateY(100px) scale(0.8) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            80% {
                opacity: 0.8;
            }
            100% {
                transform: translateY(-100px) scale(1.2) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
    
    <!-- Back to top script -->
    <script>
        // Back to top button functionality
        const backToTopButton = document.getElementById('back-to-top');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('translate-y-20', 'opacity-0');
                backToTopButton.classList.add('translate-y-0', 'opacity-100');
            } else {
                backToTopButton.classList.remove('translate-y-0', 'opacity-100');
                backToTopButton.classList.add('translate-y-20', 'opacity-0');
            }
        });
        
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Chatbot functionality
        const openChatbotButton = document.getElementById('open-chatbot');
        const closeChatbotButton = document.getElementById('close-chatbot');
        const chatbotContainer = document.getElementById('chatbot-container');
        const chatbotForm = document.getElementById('chatbot-form');
        const chatbotInput = document.getElementById('chatbot-input');
        const chatbotMessages = document.getElementById('chatbot-messages');
        
        openChatbotButton.addEventListener('click', () => {
            chatbotContainer.classList.remove('hidden');
            openChatbotButton.classList.add('hidden');
            setTimeout(() => {
                chatbotInput.focus();
            }, 300);
        });
        
        closeChatbotButton.addEventListener('click', () => {
            chatbotContainer.classList.add('hidden');
            openChatbotButton.classList.remove('hidden');
        });
        
        chatbotForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const message = chatbotInput.value.trim();
            
            if (message !== '') {
                // Add user message
                chatbotMessages.innerHTML += `
                    <div class="flex justify-end mb-4">
                        <div class="bg-primary-600 rounded-lg p-3 max-w-[80%]">
                            <p class="text-white text-sm">${message}</p>
                        </div>
                    </div>
                `;
                
                chatbotInput.value = '';
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
                
                // Simulate typing
                setTimeout(() => {
                    chatbotMessages.innerHTML += `
                        <div class="flex mb-4">
                            <div class="w-8 h-8 bg-primary-100 rounded-full flex-shrink-0 flex items-center justify-center mr-2">
                                <i class="fas fa-robot text-primary-600 text-sm"></i>
                            </div>
                            <div class="bg-gray-700/50 rounded-lg p-3 max-w-[80%]">
                                <p class="text-white text-sm">Thanks for your message! This is a demo chatbot. In a real implementation, I would provide helpful information about blood donation.</p>
                            </div>
                        </div>
                    `;
                    
                    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
                }, 1000);
            }
        });
        
        // Initialize AOS animation library
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-out',
                once: true
            });
        });
    </script>
</body>
</html> 