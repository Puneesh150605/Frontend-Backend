<?php
session_start();
include_once "database/config.php";
?>
<!DOCTYPE html>
<html lang="en" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Blood Donation System</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Montserrat', 'sans-serif']
                    },
                    colors: {
                        primary: {
                            50: '#fff1f1',
                            100: '#ffdfdf',
                            200: '#ffc5c5',
                            300: '#ff9c9c',
                            400: '#ff6464',
                            500: '#ff3a3a',
                            600: '#ff1c1c',
                            700: '#e50000',
                            800: '#c00000',
                            900: '#9d0808',
                            950: '#520000',
                        },
                        accent: {
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                        },
                    },
                    boxShadow: {
                        'neon': '0 0 5px theme("colors.primary.500"), 0 0 20px rgba(255, 0, 0, 0.2)',
                        'soft': '0 2px 10px rgba(0, 0, 0, 0.1), 0 10px 15px -3px rgba(0, 0, 0, 0.05)',
                        'inner-glow': 'inset 0 0 20px rgba(255, 58, 58, 0.2)'
                    },
                    animation: {
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 8s infinite',
                        'float-delay': 'float 8s 2s infinite',
                        'spin-slow': 'spin 8s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0) rotate(0deg)' },
                            '50%': { transform: 'translateY(-20px) rotate(10deg)' },
                        }
                    },
                },
            },
        }
    </script>
    
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS Animation Library -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- Base Styles -->
    <style>
        /* Full page preloader */
        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #111827;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }
        
        .loader-container {
            position: relative;
            width: 100px;
            height: 100px;
        }
        
        .blood-drop {
            position: absolute;
            width: 60px;
            height: 60px;
            background: #ff3a3a;
            border-radius: 50% 50% 50% 5px;
            transform: rotate(45deg);
            left: 50%;
            top: 50%;
            margin-left: -30px;
            margin-top: -30px;
            animation: dripping 2s infinite ease-in-out;
            box-shadow: 0 0 20px rgba(255, 58, 58, 0.5);
        }
        
        .drop-shadow {
            position: absolute;
            width: 60px;
            height: 10px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 50%;
            left: 50%;
            bottom: 10px;
            margin-left: -30px;
            filter: blur(2px);
            animation: shadow 2s infinite ease-in-out;
        }
        
        @keyframes dripping {
            0%, 100% {
                transform: rotate(45deg) translateY(0);
            }
            50% {
                transform: rotate(45deg) translateY(15px);
            }
        }
        
        @keyframes shadow {
            0%, 100% {
                transform: scale(1);
                opacity: 0.2;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.4;
            }
        }
        
        body {
            background-color: #111827;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        main {
            flex: 1;
        }
        
        /* Floating blood cells animation */
        .floating-blood-cells {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: -1;
        }
        
        .blood-cell {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(255, 58, 58, 0.5), rgba(255, 58, 58, 0.1));
            box-shadow: inset 2px -2px 10px rgba(0, 0, 0, 0.2);
            filter: blur(1px);
            animation: float-cell 20s linear infinite;
            opacity: 0.4;
        }
        
        @keyframes float-cell {
            0% {
                transform: translateY(100vh) translateX(0) rotate(0deg);
            }
            100% {
                transform: translateY(-20vh) translateX(20px) rotate(360deg);
            }
        }
        
        /* Corner decoration */
        .corner-decoration {
            position: absolute;
            top: 0;
            right: 0;
            width: 250px;
            height: 250px;
            pointer-events: none;
            overflow: hidden;
            z-index: -1;
        }
        
        .corner-circle {
            position: absolute;
            border-radius: 50%;
            transform-origin: top right;
        }
        
        .corner-circle:nth-child(1) {
            width: 300px;
            height: 300px;
            top: -150px;
            right: -150px;
            background: radial-gradient(circle at center, rgba(255, 58, 58, 0.3) 0%, rgba(255, 58, 58, 0) 70%);
            animation: pulse 8s infinite alternate;
        }
        
        .corner-circle:nth-child(2) {
            width: 200px;
            height: 200px;
            top: -100px;
            right: -100px;
            background: radial-gradient(circle at center, rgba(124, 58, 237, 0.2) 0%, rgba(124, 58, 237, 0) 70%);
            animation: pulse 6s 1s infinite alternate;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 20px;
            height: 20px;
            background-color: #ff3a3a;
            color: white;
            border-radius: 50%;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 10px rgba(255, 58, 58, 0.5);
            animation: pulse 2s infinite;
        }
        
        /* Nav styles */
        .nav-link {
            position: relative;
            transition: all 0.3s;
        }
        
        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background: linear-gradient(to right, #ff3a3a, #7c3aed);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover:after,
        .nav-link.active:after {
            width: 100%;
        }
        
        .nav-link.active {
            color: white;
            font-weight: 500;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 0.8;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
        }
        
        /* Glassmorphism */
        .glassmorphism {
            background: rgba(31, 41, 55, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.36);
        }
        
        /* Main menu animation */
        .menu-hover-effect {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .menu-hover-effect:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 58, 58, 0.2), rgba(124, 58, 237, 0));
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 0.5rem;
            z-index: -1;
        }
        
        .menu-hover-effect:hover:before {
            opacity: 1;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <!-- Page loader -->
    <div id="page-loader">
        <div class="loader-container">
            <div class="blood-drop"></div>
            <div class="drop-shadow"></div>
        </div>
    </div>
    
    <!-- Floating Blood Cells Background -->
    <div class="floating-blood-cells">
        <?php
        for ($i = 0; $i < 20; $i++) {
            $size = rand(20, 60);
            $left = rand(0, 100);
            $delay = rand(0, 30);
            $duration = rand(30, 60);
            echo "<div class='blood-cell' style='width: {$size}px; height: {$size}px; left: {$left}%; animation-delay: {$delay}s; animation-duration: {$duration}s;'></div>";
        }
        ?>
    </div>
    
    <!-- Corner Decoration -->
    <div class="corner-decoration">
        <div class="corner-circle"></div>
        <div class="corner-circle"></div>
    </div>
    
    <!-- Navigation -->
    <header class="relative z-10">
        <nav class="bg-gray-900/90 backdrop-blur-md border-b border-gray-800">
            <div class="container mx-auto px-4">
                <div class="flex justify-between h-16">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="index.php" class="flex items-center">
                            <div class="relative w-10 h-10 flex items-center justify-center mr-2 bg-gradient-to-br from-primary-600 to-primary-700 rounded-full shadow-neon overflow-hidden group">
                                <i class="fas fa-heartbeat text-white text-xl"></i>
                                <div class="absolute inset-0 bg-gradient-to-br from-primary-500 to-accent-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="hidden md:block">
                                <span class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-accent-400 font-display">BloodLink</span>
                                <span class="block text-[10px] text-gray-400 -mt-1">Connecting Lives Through Donation</span>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Desktop Menu -->
                    <div class="hidden md:flex md:items-center md:space-x-6">
                        <a href="index.php" class="nav-link text-gray-300 hover:text-white px-3 py-2 text-sm font-medium menu-hover-effect <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a>
                        <a href="donation_centers.php" class="nav-link text-gray-300 hover:text-white px-3 py-2 text-sm font-medium menu-hover-effect <?php echo basename($_SERVER['PHP_SELF']) == 'donation_centers.php' ? 'active' : ''; ?>">Donation Centers</a>
                        <a href="request_blood.php" class="nav-link text-gray-300 hover:text-white px-3 py-2 text-sm font-medium menu-hover-effect <?php echo basename($_SERVER['PHP_SELF']) == 'request_blood.php' ? 'active' : ''; ?>">Request Blood</a>
                        <a href="about.php" class="nav-link text-gray-300 hover:text-white px-3 py-2 text-sm font-medium menu-hover-effect <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">About</a>
                        <a href="contact.php" class="nav-link text-gray-300 hover:text-white px-3 py-2 text-sm font-medium menu-hover-effect <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact</a>
                    </div>
                    
                    <!-- Authentication -->
                    <div class="hidden md:flex md:items-center md:ml-6">
                        <?php
                        // Check if user is logged in
                        if (isset($_SESSION['user_id'])) {
                            // User is logged in
                            $is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
                        ?>
                            <div class="relative ml-3">
                                <div>
                                    <button id="user-menu-button" type="button" class="relative flex items-center bg-gray-800 text-sm focus:outline-none focus:ring-1 focus:ring-primary-500 focus:border-primary-500 p-1.5 px-3 rounded-full" aria-expanded="false" aria-haspopup="true">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-8 h-8 rounded-full overflow-hidden bg-gray-700 flex items-center justify-center">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                            <div class="flex flex-col items-start">
                                                <span class="text-gray-300 text-sm"><?php echo $_SESSION['name']; ?></span>
                                                <span class="text-xs text-gray-500"><?php echo $_SESSION['email']; ?></span>
                                            </div>
                                        </div>
                                        <?php if ($is_admin): ?>
                                        <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-primary-100 bg-primary-700 rounded-full">
                                            Admin
                                        </span>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION['unread_notifications']) && $_SESSION['unread_notifications'] > 0): ?>
                                        <div class="notification-badge"><?php echo $_SESSION['unread_notifications']; ?></div>
                                        <?php endif; ?>
                                    </button>
                                </div>
                                
                                <!-- Dropdown menu -->
                                <div id="user-dropdown" class="hidden glassmorphism rounded-lg absolute right-0 z-50 mt-2 w-48 origin-top-right divide-y divide-gray-700 shadow-lg focus:outline-none transform opacity-0 scale-95 transition-all duration-200">
                                    <div class="py-1">
                                        <a href="dashboard.php" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-4 py-2 text-sm">Dashboard</a>
                                        <a href="user_profile.php" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-4 py-2 text-sm">My Profile</a>
                                        <a href="appointments.php" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-4 py-2 text-sm">My Appointments</a>
                                        <?php if ($is_admin): ?>
                                        <a href="admin/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-4 py-2 text-sm">
                                            Admin Panel
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="py-1">
                                        <a href="logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-4 py-2 text-sm">Logout</a>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <!-- User is not logged in -->
                            <div class="flex items-center space-x-3">
                                <a href="login.php" class="bg-transparent hover:bg-gray-700 text-gray-300 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-300">Login</a>
                                <a href="register.php" class="bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-300 shadow-sm hover:shadow-md">Register</a>
                            </div>
                        <?php } ?>
                    </div>
                    
                    <!-- Mobile menu button -->
                    <div class="flex items-center -mr-2 md:hidden">
                        <button id="mobile-menu-button" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-800 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Mobile menu, show/hide based on menu state -->
            <div id="mobile-menu" class="hidden md:hidden bg-gray-900/95 backdrop-filter backdrop-blur-md border-b border-gray-800">
                <div class="py-2 space-y-1 px-4">
                    <a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'bg-gray-800 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-700'; ?> block px-3 py-2 rounded-md text-base font-medium">Home</a>
                    <a href="donation_centers.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'donation_centers.php' ? 'bg-gray-800 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-700'; ?> block px-3 py-2 rounded-md text-base font-medium">Donation Centers</a>
                    <a href="request_blood.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'request_blood.php' ? 'bg-gray-800 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-700'; ?> block px-3 py-2 rounded-md text-base font-medium">Request Blood</a>
                    <a href="about.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'bg-gray-800 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-700'; ?> block px-3 py-2 rounded-md text-base font-medium">About</a>
                    <a href="contact.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'bg-gray-800 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-700'; ?> block px-3 py-2 rounded-md text-base font-medium">Contact</a>
                </div>
                
                <div class="border-t border-gray-800 pt-4 pb-3">
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <div class="flex items-center px-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-white"><?php echo $_SESSION['name']; ?></div>
                                <div class="text-sm font-medium text-gray-400"><?php echo $_SESSION['email']; ?></div>
                            </div>
                            <?php if (isset($_SESSION['unread_notifications']) && $_SESSION['unread_notifications'] > 0): ?>
                            <div class="ml-auto bg-primary-600 rounded-full px-2 py-0.5 text-xs text-white">
                                <?php echo $_SESSION['unread_notifications']; ?> new
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="mt-3 space-y-1 px-4">
                            <a href="dashboard.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Dashboard</a>
                            <a href="user_profile.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">My Profile</a>
                            <a href="appointments.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">My Appointments</a>
                            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                            <a href="admin/index.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Admin Panel</a>
                            <?php endif; ?>
                            <a href="logout.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Logout</a>
                        </div>
                    <?php } else { ?>
                        <div class="flex justify-between px-4 pt-2">
                            <a href="login.php" class="w-full mr-2 bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium text-center">Login</a>
                            <a href="register.php" class="w-full ml-2 bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md text-sm font-medium text-center">Register</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </header>
    
    <main class="flex-grow relative">
        <!-- Header scripts - position here to ensure DOM is loaded -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Mobile menu toggle
                const mobileMenuButton = document.getElementById('mobile-menu-button');
                const mobileMenu = document.getElementById('mobile-menu');
                
                if (mobileMenuButton && mobileMenu) {
                    mobileMenuButton.addEventListener('click', function() {
                        mobileMenu.classList.toggle('hidden');
                        
                        // Toggle icon
                        const icon = mobileMenuButton.querySelector('i');
                        if (icon.classList.contains('fa-bars')) {
                            icon.classList.remove('fa-bars');
                            icon.classList.add('fa-times');
                        } else {
                            icon.classList.remove('fa-times');
                            icon.classList.add('fa-bars');
                        }
                    });
                }
                
                // User dropdown menu
                const userMenuButton = document.getElementById('user-menu-button');
                const userDropdown = document.getElementById('user-dropdown');
                
                if (userMenuButton && userDropdown) {
                    userMenuButton.addEventListener('click', function() {
                        userDropdown.classList.toggle('hidden');
                        
                        // Animation
                        if (userDropdown.classList.contains('hidden')) {
                            userDropdown.classList.remove('opacity-100', 'scale-100');
                            userDropdown.classList.add('opacity-0', 'scale-95');
                        } else {
                            userDropdown.classList.remove('opacity-0', 'scale-95');
                            userDropdown.classList.add('opacity-100', 'scale-100');
                        }
                    });
                    
                    // Close dropdown when clicking outside
                    document.addEventListener('click', function(event) {
                        if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                            userDropdown.classList.add('hidden', 'opacity-0', 'scale-95');
                            userDropdown.classList.remove('opacity-100', 'scale-100');
                        }
                    });
                }
                
                // Hide page loader when content is loaded
                const pageLoader = document.getElementById('page-loader');
                if (pageLoader) {
                    setTimeout(() => {
                        pageLoader.style.opacity = '0';
                        pageLoader.style.visibility = 'hidden';
                    }, 800);
                }
            });
        </script>
    </main>
</body>
</html> 