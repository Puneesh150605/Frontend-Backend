<?php 
include_once "includes/header.php";

// Initialize variables
$name = $email = $phone = $hospital = $blood_type = $quantity = $urgency = $date_needed = $message = "";
$name_err = $email_err = $phone_err = $hospital_err = $blood_type_err = $quantity_err = $urgency_err = $date_needed_err = "";
$request_success = false;

// Blood type options
$blood_types = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];

// Urgency options
$urgency_options = ["low", "medium", "high", "critical"];

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
    }
    
    // Validate phone
    if(empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter a contact number.";
    } else {
        $phone = trim($_POST["phone"]);
    }
    
    // Validate hospital
    if(empty(trim($_POST["hospital"]))) {
        $hospital_err = "Please enter the hospital or medical facility.";
    } else {
        $hospital = trim($_POST["hospital"]);
    }
    
    // Validate blood type
    if(empty($_POST["blood_type"])) {
        $blood_type_err = "Please select a blood type.";
    } elseif(!in_array($_POST["blood_type"], $blood_types)) {
        $blood_type_err = "Please select a valid blood type.";
    } else {
        $blood_type = $_POST["blood_type"];
    }
    
    // Validate quantity
    if(empty(trim($_POST["quantity"]))) {
        $quantity_err = "Please enter the quantity needed.";
    } elseif(!is_numeric(trim($_POST["quantity"])) || trim($_POST["quantity"]) <= 0) {
        $quantity_err = "Please enter a valid quantity.";
    } else {
        $quantity = trim($_POST["quantity"]);
    }
    
    // Validate urgency
    if(empty($_POST["urgency"])) {
        $urgency_err = "Please select the urgency level.";
    } elseif(!in_array($_POST["urgency"], $urgency_options)) {
        $urgency_err = "Please select a valid urgency level.";
    } else {
        $urgency = $_POST["urgency"];
    }
    
    // Validate date needed
    if(empty(trim($_POST["date_needed"]))) {
        $date_needed_err = "Please enter the date needed.";
    } else {
        $date_needed = trim($_POST["date_needed"]);
        
        // Check if date is in the future
        $current_date = date('Y-m-d');
        if($date_needed < $current_date) {
            $date_needed_err = "The date needed must be today or in the future.";
        }
    }
    
    // Get additional message if provided
    $message = !empty($_POST["message"]) ? trim($_POST["message"]) : "";
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($phone_err) && empty($hospital_err) && 
       empty($blood_type_err) && empty($quantity_err) && empty($urgency_err) && empty($date_needed_err)) {
        
        // In a real application, we would insert the request into the database here
        // For this example, we'll just set a success flag
        $request_success = true;
        
        // Clear form data on success
        $name = $email = $phone = $hospital = $blood_type = $quantity = $urgency = $date_needed = $message = "";
    }
}
?>

<!-- Hero Section -->
<section class="bg-gray-800 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-white mb-4">Request Blood</h1>
            <p class="text-gray-400 max-w-2xl mx-auto">Need blood for a medical procedure or emergency? Fill out the form below to request blood from our network.</p>
        </div>
    </div>
</section>

<!-- Request Form -->
<section class="py-12 bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <?php if($request_success): ?>
                <div class="bg-green-900/50 border border-green-800 text-white px-4 py-3 rounded-lg mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle mt-1"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium">Request Submitted Successfully!</h3>
                            <p class="mt-2">Thank you for your blood request. Our team will review it and contact you shortly. Please keep your phone available.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Contact Information -->
                            <div class="space-y-6">
                                <h3 class="text-xl font-bold text-white">Contact Information</h3>
                                
                                <div>
                                    <label for="name" class="block text-gray-300 mb-1">Full Name</label>
                                    <input type="text" name="name" id="name" class="w-full bg-gray-700 text-white border <?php echo (!empty($name_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600" value="<?php echo $name; ?>">
                                    <span class="text-red-500 text-sm"><?php echo $name_err; ?></span>
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-gray-300 mb-1">Email</label>
                                    <input type="email" name="email" id="email" class="w-full bg-gray-700 text-white border <?php echo (!empty($email_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600" value="<?php echo $email; ?>">
                                    <span class="text-red-500 text-sm"><?php echo $email_err; ?></span>
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-gray-300 mb-1">Phone Number</label>
                                    <input type="tel" name="phone" id="phone" class="w-full bg-gray-700 text-white border <?php echo (!empty($phone_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600" value="<?php echo $phone; ?>">
                                    <span class="text-red-500 text-sm"><?php echo $phone_err; ?></span>
                                </div>
                                
                                <div>
                                    <label for="hospital" class="block text-gray-300 mb-1">Hospital/Medical Facility</label>
                                    <input type="text" name="hospital" id="hospital" class="w-full bg-gray-700 text-white border <?php echo (!empty($hospital_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600" value="<?php echo $hospital; ?>">
                                    <span class="text-red-500 text-sm"><?php echo $hospital_err; ?></span>
                                </div>
                            </div>
                            
                            <!-- Request Details -->
                            <div class="space-y-6">
                                <h3 class="text-xl font-bold text-white">Request Details</h3>
                                
                                <div>
                                    <label for="blood_type" class="block text-gray-300 mb-1">Blood Type Needed</label>
                                    <select name="blood_type" id="blood_type" class="w-full bg-gray-700 text-white border <?php echo (!empty($blood_type_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600">
                                        <option value="">Select Blood Type</option>
                                        <?php foreach($blood_types as $type): ?>
                                            <option value="<?php echo $type; ?>" <?php echo ($blood_type == $type) ? 'selected' : ''; ?>>
                                                <?php echo $type; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="text-red-500 text-sm"><?php echo $blood_type_err; ?></span>
                                </div>
                                
                                <div>
                                    <label for="quantity" class="block text-gray-300 mb-1">Quantity Needed (units)</label>
                                    <input type="number" name="quantity" id="quantity" min="1" class="w-full bg-gray-700 text-white border <?php echo (!empty($quantity_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600" value="<?php echo $quantity; ?>">
                                    <span class="text-red-500 text-sm"><?php echo $quantity_err; ?></span>
                                </div>
                                
                                <div>
                                    <label for="urgency" class="block text-gray-300 mb-1">Urgency Level</label>
                                    <select name="urgency" id="urgency" class="w-full bg-gray-700 text-white border <?php echo (!empty($urgency_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600">
                                        <option value="">Select Urgency</option>
                                        <option value="low" <?php echo ($urgency == "low") ? 'selected' : ''; ?>>Low - Within a week</option>
                                        <option value="medium" <?php echo ($urgency == "medium") ? 'selected' : ''; ?>>Medium - Within 3 days</option>
                                        <option value="high" <?php echo ($urgency == "high") ? 'selected' : ''; ?>>High - Within 24 hours</option>
                                        <option value="critical" <?php echo ($urgency == "critical") ? 'selected' : ''; ?>>Critical - Immediate</option>
                                    </select>
                                    <span class="text-red-500 text-sm"><?php echo $urgency_err; ?></span>
                                </div>
                                
                                <div>
                                    <label for="date_needed" class="block text-gray-300 mb-1">Date Needed</label>
                                    <input type="date" name="date_needed" id="date_needed" class="w-full bg-gray-700 text-white border <?php echo (!empty($date_needed_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600" value="<?php echo $date_needed; ?>">
                                    <span class="text-red-500 text-sm"><?php echo $date_needed_err; ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-gray-300 mb-1">Additional Details (Optional)</label>
                            <textarea name="message" id="message" rows="4" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600"><?php echo $message; ?></textarea>
                        </div>
                        
                        <div class="flex items-start">
                            <input type="checkbox" id="terms" name="terms" class="bg-gray-700 border-gray-600 rounded text-primary-600 focus:ring-primary-600 mt-1" required>
                            <label for="terms" class="text-gray-300 ml-2">
                                I confirm that this is a genuine medical request and the provided information is accurate.
                            </label>
                        </div>
                        
                        <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-4 rounded-lg transition">
                            Submit Blood Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process -->
<section class="py-16 bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-2">How the Request Process Works</h2>
            <p class="text-gray-400">What to expect after you submit a blood request</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-gray-900 p-6 rounded-lg text-center">
                <div class="w-16 h-16 bg-primary-700 rounded-full mx-auto flex items-center justify-center text-white text-xl font-bold mb-4">1</div>
                <h3 class="text-lg font-bold text-white mb-2">Submit Request</h3>
                <p class="text-gray-400">Fill out the blood request form with all necessary details and submit it.</p>
            </div>
            
            <div class="bg-gray-900 p-6 rounded-lg text-center">
                <div class="w-16 h-16 bg-primary-700 rounded-full mx-auto flex items-center justify-center text-white text-xl font-bold mb-4">2</div>
                <h3 class="text-lg font-bold text-white mb-2">Verification</h3>
                <p class="text-gray-400">Our team will verify your request and check blood availability in our network.</p>
            </div>
            
            <div class="bg-gray-900 p-6 rounded-lg text-center">
                <div class="w-16 h-16 bg-primary-700 rounded-full mx-auto flex items-center justify-center text-white text-xl font-bold mb-4">3</div>
                <h3 class="text-lg font-bold text-white mb-2">Confirmation</h3>
                <p class="text-gray-400">You'll receive confirmation when donors are found, along with delivery details.</p>
            </div>
            
            <div class="bg-gray-900 p-6 rounded-lg text-center">
                <div class="w-16 h-16 bg-primary-700 rounded-full mx-auto flex items-center justify-center text-white text-xl font-bold mb-4">4</div>
                <h3 class="text-lg font-bold text-white mb-2">Delivery</h3>
                <p class="text-gray-400">Blood will be delivered to the specified hospital or facility as per the request.</p>
            </div>
        </div>
    </div>
</section>

<!-- Urgent Needs -->
<section class="py-16 bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-lg overflow-hidden">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-white mb-6">Current Urgent Blood Needs</h2>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="px-4 py-3 text-left text-white">Blood Type</th>
                                <th class="px-4 py-3 text-left text-white">Location</th>
                                <th class="px-4 py-3 text-left text-white">Quantity Needed</th>
                                <th class="px-4 py-3 text-left text-white">Urgency</th>
                                <th class="px-4 py-3 text-right text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            <tr>
                                <td class="px-4 py-3 font-bold text-primary-500">O-</td>
                                <td class="px-4 py-3 text-gray-300">City General Hospital</td>
                                <td class="px-4 py-3 text-gray-300">3 units</td>
                                <td class="px-4 py-3">
                                    <span class="bg-red-900/50 text-red-300 text-xs font-medium px-2.5 py-0.5 rounded-full">Critical</span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <a href="appointment.php" class="bg-primary-600 hover:bg-primary-700 text-white text-xs py-1 px-3 rounded inline-block">Donate</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 font-bold text-primary-500">AB+</td>
                                <td class="px-4 py-3 text-gray-300">Memorial Medical Center</td>
                                <td class="px-4 py-3 text-gray-300">2 units</td>
                                <td class="px-4 py-3">
                                    <span class="bg-orange-900/50 text-orange-300 text-xs font-medium px-2.5 py-0.5 rounded-full">High</span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <a href="appointment.php" class="bg-primary-600 hover:bg-primary-700 text-white text-xs py-1 px-3 rounded inline-block">Donate</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 font-bold text-primary-500">B-</td>
                                <td class="px-4 py-3 text-gray-300">St. Luke's Hospital</td>
                                <td class="px-4 py-3 text-gray-300">1 unit</td>
                                <td class="px-4 py-3">
                                    <span class="bg-yellow-900/50 text-yellow-300 text-xs font-medium px-2.5 py-0.5 rounded-full">Medium</span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <a href="appointment.php" class="bg-primary-600 hover:bg-primary-700 text-white text-xs py-1 px-3 rounded inline-block">Donate</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6 text-center">
                    <p class="text-gray-400">If you're able to donate, please consider helping with these urgent needs.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-16 bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-2">Frequently Asked Questions</h2>
            <p class="text-gray-400">Common questions about blood requests</p>
        </div>
        
        <div class="max-w-3xl mx-auto space-y-4">
            <div class="bg-gray-900 rounded-lg p-6">
                <h3 class="text-lg font-bold text-white mb-2">Who can request blood?</h3>
                <p class="text-gray-300">Hospitals, medical facilities, patients, and their relatives can request blood. Verification will be required to process the request.</p>
            </div>
            
            <div class="bg-gray-900 rounded-lg p-6">
                <h3 class="text-lg font-bold text-white mb-2">Is there a fee for requesting blood?</h3>
                <p class="text-gray-300">While the blood itself is donated, there may be processing, testing, and transportation fees that apply. Please contact us for specific details.</p>
            </div>
            
            <div class="bg-gray-900 rounded-lg p-6">
                <h3 class="text-lg font-bold text-white mb-2">How quickly will I receive the blood after placing a request?</h3>
                <p class="text-gray-300">Delivery time depends on the urgency level, availability, and location. Critical requests are processed immediately, while others may take 24-48 hours.</p>
            </div>
            
            <div class="bg-gray-900 rounded-lg p-6">
                <h3 class="text-lg font-bold text-white mb-2">What if my specific blood type is not available?</h3>
                <p class="text-gray-300">We will work with our donor network to find compatible alternatives or arrange for emergency donation drives if necessary.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Support -->
<section class="py-16 bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="bg-primary-800 rounded-lg overflow-hidden">
            <div class="p-8 text-center">
                <h2 class="text-2xl font-bold text-white mb-4">Need Urgent Assistance?</h2>
                <p class="text-white text-lg mb-6">For emergency blood requests or immediate help, please contact our 24/7 support line.</p>
                <div class="text-white text-3xl font-bold mb-6">
                    <i class="fas fa-phone-alt mr-2"></i> 1-800-BLOOD-HELP
                </div>
                <p class="text-white text-sm">Our team is available round the clock to assist with urgent blood needs.</p>
            </div>
        </div>
    </div>
</section>

<?php include_once "includes/footer.php"; ?> 