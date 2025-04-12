<?php
include_once "includes/header.php";

// Initialize variables
$name = $email = $subject = $message = "";
$name_err = $email_err = $subject_err = $message_err = "";
$contact_success = false;

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate name
    if(empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }
    
    // Validate email
    if(empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
        
        // Check if email format is valid
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Please enter a valid email address.";
        }
    }
    
    // Validate subject
    if(empty(trim($_POST["subject"]))) {
        $subject_err = "Please enter a subject.";
    } else {
        $subject = trim($_POST["subject"]);
    }
    
    // Validate message
    if(empty(trim($_POST["message"]))) {
        $message_err = "Please enter your message.";
    } else {
        $message = trim($_POST["message"]);
    }
    
    // Check input errors before sending email
    if(empty($name_err) && empty($email_err) && empty($subject_err) && empty($message_err)) {
        
        // In a real application, this would send an email
        // For this example, we'll just set a success flag
        $contact_success = true;
        
        // Clear form data
        $name = $email = $subject = $message = "";
    }
}
?>

<!-- Hero Section -->
<section class="bg-gray-800 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-white mb-4">Contact Us</h1>
            <p class="text-gray-400 max-w-2xl mx-auto">Have questions or need assistance? Get in touch with our team and we'll be happy to help.</p>
        </div>
    </div>
</section>

<!-- Contact Methods -->
<section class="py-12 bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-gray-800 rounded-lg p-6 text-center">
                <div class="w-16 h-16 bg-primary-600/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-phone text-primary-500 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Call Us</h3>
                <p class="text-gray-300 mb-4">Our support team is available 24/7 to assist you with any questions.</p>
                <a href="tel:+18002343456" class="text-primary-500 font-bold">1-800-BLOOD-HELP</a>
            </div>
            
            <div class="bg-gray-800 rounded-lg p-6 text-center">
                <div class="w-16 h-16 bg-primary-600/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-envelope text-primary-500 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Email Us</h3>
                <p class="text-gray-300 mb-4">Send us an email and we'll get back to you within 24 hours.</p>
                <a href="mailto:contact@bloodlink.com" class="text-primary-500 font-bold">contact@bloodlink.com</a>
            </div>
            
            <div class="bg-gray-800 rounded-lg p-6 text-center">
                <div class="w-16 h-16 bg-primary-600/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-primary-500 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Visit Us</h3>
                <p class="text-gray-300 mb-4">Our headquarters is open Monday-Friday from 9am to 5pm.</p>
                <address class="text-primary-500 font-bold not-italic">
                    123 Blood Avenue<br>
                    City, Country 12345
                </address>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            <!-- Contact Form -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-white mb-6">Send Us a Message</h2>
                    
                    <?php if($contact_success): ?>
                        <div class="bg-green-900/50 border border-green-800 text-white px-4 py-3 rounded-lg mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle mt-1"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-lg font-medium">Message Sent Successfully!</h3>
                                    <p class="mt-2">Thank you for contacting us. We'll respond to your inquiry as soon as possible.</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-gray-300 mb-1">Your Name</label>
                                <input type="text" name="name" id="name" class="w-full bg-gray-700 text-white border <?php echo (!empty($name_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600" value="<?php echo $name; ?>">
                                <span class="text-red-500 text-sm"><?php echo $name_err; ?></span>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-gray-300 mb-1">Email Address</label>
                                <input type="email" name="email" id="email" class="w-full bg-gray-700 text-white border <?php echo (!empty($email_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600" value="<?php echo $email; ?>">
                                <span class="text-red-500 text-sm"><?php echo $email_err; ?></span>
                            </div>
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-gray-300 mb-1">Subject</label>
                            <input type="text" name="subject" id="subject" class="w-full bg-gray-700 text-white border <?php echo (!empty($subject_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600" value="<?php echo $subject; ?>">
                            <span class="text-red-500 text-sm"><?php echo $subject_err; ?></span>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-gray-300 mb-1">Message</label>
                            <textarea name="message" id="message" rows="5" class="w-full bg-gray-700 text-white border <?php echo (!empty($message_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600"><?php echo $message; ?></textarea>
                            <span class="text-red-500 text-sm"><?php echo $message_err; ?></span>
                        </div>
                        
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-6 rounded-lg transition">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- FAQ -->
            <div>
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
                    <h2 class="text-2xl font-bold text-white mb-6">Frequently Asked Questions</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-bold text-white mb-2">How can I volunteer with BloodLink?</h3>
                            <p class="text-gray-300">We welcome volunteers for various roles including donation drives, administrative support, and awareness campaigns. Please email volunteer@bloodlink.com for more information.</p>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-bold text-white mb-2">I have a question about my donation. Who should I contact?</h3>
                            <p class="text-gray-300">For questions about your specific donation, please contact our donor support team at donors@bloodlink.com or call our helpline with your donor ID ready.</p>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-bold text-white mb-2">How can I organize a blood drive at my organization?</h3>
                            <p class="text-gray-300">We're happy to help organize blood drives at schools, businesses, and community centers. Please fill out the blood drive request form on our website or contact our events team directly.</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-primary-700 rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-3">Emergency Contact</h3>
                    <p class="text-white mb-4">For urgent blood needs or medical emergencies, please contact our 24/7 emergency line:</p>
                    <a href="tel:+18008008000" class="text-white text-xl font-bold flex items-center">
                        <i class="fas fa-phone-alt mr-2"></i>
                        1-800-800-8000
                    </a>
                    <p class="text-white/80 mt-3 text-sm">This line is reserved for medical professionals and emergency situations only.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-12 bg-gray-800">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Our Locations</h2>
        <div id="headquarters-map" class="h-[400px] rounded-lg"></div>
    </div>
</section>

<!-- JavaScript for Map -->
<script>
    function initMap() {
        // Initialize headquarters map
        const hqMapElement = document.getElementById('headquarters-map');
        if (hqMapElement) {
            const hqLocation = { lat: 40.7128, lng: -74.0060 }; // Example coordinates (New York)
            
            const map = new google.maps.Map(hqMapElement, {
                center: hqLocation,
                zoom: 12,
                styles: [
                    // Dark mode map styles
                    { elementType: "geometry", stylers: [{ color: "#242f3e" }] },
                    { elementType: "labels.text.stroke", stylers: [{ color: "#242f3e" }] },
                    { elementType: "labels.text.fill", stylers: [{ color: "#746855" }] },
                    { featureType: "administrative.locality", elementType: "labels.text.fill", stylers: [{ color: "#d59563" }] },
                    { featureType: "poi", elementType: "labels.text.fill", stylers: [{ color: "#d59563" }] },
                    { featureType: "poi.park", elementType: "geometry", stylers: [{ color: "#263c3f" }] },
                    { featureType: "poi.park", elementType: "labels.text.fill", stylers: [{ color: "#6b9a76" }] },
                    { featureType: "road", elementType: "geometry", stylers: [{ color: "#38414e" }] },
                    { featureType: "road", elementType: "geometry.stroke", stylers: [{ color: "#212a37" }] },
                    { featureType: "road", elementType: "labels.text.fill", stylers: [{ color: "#9ca5b3" }] },
                    { featureType: "road.highway", elementType: "geometry", stylers: [{ color: "#746855" }] },
                    { featureType: "road.highway", elementType: "geometry.stroke", stylers: [{ color: "#1f2835" }] },
                    { featureType: "road.highway", elementType: "labels.text.fill", stylers: [{ color: "#f3d19c" }] },
                    { featureType: "transit", elementType: "geometry", stylers: [{ color: "#2f3948" }] },
                    { featureType: "transit.station", elementType: "labels.text.fill", stylers: [{ color: "#d59563" }] },
                    { featureType: "water", elementType: "geometry", stylers: [{ color: "#17263c" }] },
                    { featureType: "water", elementType: "labels.text.fill", stylers: [{ color: "#515c6d" }] },
                    { featureType: "water", elementType: "labels.text.stroke", stylers: [{ color: "#17263c" }] }
                ]
            });
            
            // Add marker for headquarters
            const hqMarker = new google.maps.Marker({
                position: hqLocation,
                map: map,
                title: "BloodLink Headquarters",
                icon: {
                    url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
                }
            });
            
            // Add info window
            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div style="color: #333; padding: 5px;">
                        <h3 style="font-weight: bold; margin-bottom: 5px;">BloodLink Headquarters</h3>
                        <p style="margin-bottom: 5px;">123 Blood Avenue, City</p>
                        <p style="margin-bottom: 5px;">Open Mon-Fri: 9am-5pm</p>
                    </div>
                `
            });
            
            hqMarker.addListener("click", () => {
                infoWindow.open(map, hqMarker);
            });
            
            // Auto open info window
            infoWindow.open(map, hqMarker);
        }
    }
</script>

<?php include_once "includes/footer.php"; ?> 