<?php
include_once "includes/header.php";

// Check if user is logged in
$isLoggedIn = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;

// Initialize variables
$center_id = $date = $time = "";
$center_id_err = $date_err = $time_err = "";
$appointment_success = false;

// Get center ID from URL if provided
if(isset($_GET['center']) && !empty($_GET['center'])) {
    $center_id = trim($_GET['center']);
}

// Check if it's an edit request
$isEdit = false;
$appointment_id = "";
if(isset($_GET['edit']) && !empty($_GET['edit']) && $isLoggedIn) {
    $isEdit = true;
    $appointment_id = trim($_GET['edit']);
    
    // Get appointment details
    $sql = "SELECT * FROM appointments WHERE id = ? AND donor_id = ?";
    if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $appointment_id, $_SESSION["user_id"]);
        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) == 1) {
                $appointment = mysqli_fetch_assoc($result);
                $center_id = $appointment['center_id'];
                $datetime = new DateTime($appointment['appointment_date']);
                $date = $datetime->format('Y-m-d');
                $time = $datetime->format('H:i');
            } else {
                // No valid appointment found
                header("location: dashboard.php");
                exit;
            }
        }
        mysqli_stmt_close($stmt);
    }
}

// Check if it's a cancel request
if(isset($_GET['cancel']) && !empty($_GET['cancel']) && $isLoggedIn) {
    $cancel_id = trim($_GET['cancel']);
    
    // Cancel the appointment
    $sql = "UPDATE appointments SET status = 'cancelled' WHERE id = ? AND donor_id = ?";
    if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $cancel_id, $_SESSION["user_id"]);
        if(mysqli_stmt_execute($stmt)) {
            // Redirect to dashboard
            header("location: dashboard.php");
            exit;
        }
        mysqli_stmt_close($stmt);
    }
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate center ID
    if(empty(trim($_POST["center_id"]))) {
        $center_id_err = "Please select a donation center.";
    } else {
        $center_id = trim($_POST["center_id"]);
    }
    
    // Validate date
    if(empty(trim($_POST["date"]))) {
        $date_err = "Please select a date.";
    } else {
        $date = trim($_POST["date"]);
        
        // Check if date is in the future
        $current_date = date('Y-m-d');
        if($date < $current_date) {
            $date_err = "The appointment date must be today or in the future.";
        }
    }
    
    // Validate time
    if(empty(trim($_POST["time"]))) {
        $time_err = "Please select a time.";
    } else {
        $time = trim($_POST["time"]);
    }
    
    // Check if user is logged in
    if(!$isLoggedIn) {
        // Redirect to login page with return URL
        $_SESSION['redirect_after_login'] = "appointment.php?center=" . $center_id;
        header("location: login.php");
        exit;
    }
    
    // Check input errors before inserting in database
    if(empty($center_id_err) && empty($date_err) && empty($time_err)) {
        
        // Combine date and time
        $appointment_date = $date . ' ' . $time;
        
        if($isEdit) {
            // Update existing appointment
            $sql = "UPDATE appointments SET center_id = ?, appointment_date = ? WHERE id = ? AND donor_id = ?";
            if($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "isii", $center_id, $appointment_date, $appointment_id, $_SESSION["user_id"]);
                if(mysqli_stmt_execute($stmt)) {
                    // Redirect to dashboard
                    header("location: dashboard.php");
                    exit;
                }
                mysqli_stmt_close($stmt);
            }
        } else {
            // Insert new appointment
            $sql = "INSERT INTO appointments (donor_id, center_id, appointment_date, status) VALUES (?, ?, ?, 'scheduled')";
            if($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "iis", $_SESSION["user_id"], $center_id, $appointment_date);
                if(mysqli_stmt_execute($stmt)) {
                    // Set success flag
                    $appointment_success = true;
                    
                    // Clear form data
                    $center_id = $date = $time = "";
                }
                mysqli_stmt_close($stmt);
            }
        }
    }
}

// Get donation centers
$centers = [];
$sql = "SELECT * FROM donation_centers ORDER BY name";
if($stmt = mysqli_prepare($conn, $sql)) {
    if(mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)) {
            $centers[] = $row;
        }
    }
    mysqli_stmt_close($stmt);
}
?>

<!-- Hero Section -->
<section class="bg-gray-800 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-white mb-4"><?php echo $isEdit ? 'Reschedule' : 'Schedule'; ?> Blood Donation Appointment</h1>
            <p class="text-gray-400 max-w-2xl mx-auto">Select a donation center, date, and time that works for you. Your donation can save up to three lives.</p>
        </div>
    </div>
</section>

<!-- Appointment Form -->
<section class="py-12 bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <?php if($appointment_success): ?>
                <div class="bg-green-900/50 border border-green-800 text-white px-4 py-3 rounded-lg mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle mt-1"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium">Appointment Scheduled Successfully!</h3>
                            <p class="mt-2">Thank you for scheduling a blood donation. We look forward to seeing you at the center. A confirmation email has been sent to your registered email address.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . ($isEdit ? "?edit=" . $appointment_id : "")); ?>" method="post" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Donation Center Selection -->
                            <div class="md:col-span-2">
                                <label for="center_id" class="block text-gray-300 mb-1">Donation Center</label>
                                <select name="center_id" id="center_id" class="w-full bg-gray-700 text-white border <?php echo (!empty($center_id_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600">
                                    <option value="">Select Donation Center</option>
                                    <?php foreach($centers as $center): ?>
                                        <option value="<?php echo $center['id']; ?>" <?php echo ($center_id == $center['id']) ? 'selected' : ''; ?>>
                                            <?php echo $center['name']; ?> - <?php echo $center['address']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-red-500 text-sm"><?php echo $center_id_err; ?></span>
                            </div>
                            
                            <!-- Date Selection -->
                            <div>
                                <label for="date" class="block text-gray-300 mb-1">Date</label>
                                <input type="date" name="date" id="date" min="<?php echo date('Y-m-d'); ?>" class="w-full bg-gray-700 text-white border <?php echo (!empty($date_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600" value="<?php echo $date; ?>">
                                <span class="text-red-500 text-sm"><?php echo $date_err; ?></span>
                            </div>
                            
                            <!-- Time Selection -->
                            <div>
                                <label for="time" class="block text-gray-300 mb-1">Time</label>
                                <select name="time" id="time" class="w-full bg-gray-700 text-white border <?php echo (!empty($time_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600">
                                    <option value="">Select Time</option>
                                    <option value="09:00" <?php echo ($time == "09:00") ? 'selected' : ''; ?>>9:00 AM</option>
                                    <option value="09:30" <?php echo ($time == "09:30") ? 'selected' : ''; ?>>9:30 AM</option>
                                    <option value="10:00" <?php echo ($time == "10:00") ? 'selected' : ''; ?>>10:00 AM</option>
                                    <option value="10:30" <?php echo ($time == "10:30") ? 'selected' : ''; ?>>10:30 AM</option>
                                    <option value="11:00" <?php echo ($time == "11:00") ? 'selected' : ''; ?>>11:00 AM</option>
                                    <option value="11:30" <?php echo ($time == "11:30") ? 'selected' : ''; ?>>11:30 AM</option>
                                    <option value="13:00" <?php echo ($time == "13:00") ? 'selected' : ''; ?>>1:00 PM</option>
                                    <option value="13:30" <?php echo ($time == "13:30") ? 'selected' : ''; ?>>1:30 PM</option>
                                    <option value="14:00" <?php echo ($time == "14:00") ? 'selected' : ''; ?>>2:00 PM</option>
                                    <option value="14:30" <?php echo ($time == "14:30") ? 'selected' : ''; ?>>2:30 PM</option>
                                    <option value="15:00" <?php echo ($time == "15:00") ? 'selected' : ''; ?>>3:00 PM</option>
                                    <option value="15:30" <?php echo ($time == "15:30") ? 'selected' : ''; ?>>3:30 PM</option>
                                    <option value="16:00" <?php echo ($time == "16:00") ? 'selected' : ''; ?>>4:00 PM</option>
                                    <option value="16:30" <?php echo ($time == "16:30") ? 'selected' : ''; ?>>4:30 PM</option>
                                </select>
                                <span class="text-red-500 text-sm"><?php echo $time_err; ?></span>
                            </div>
                        </div>
                        
                        <?php if(!$isLoggedIn): ?>
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <p class="text-gray-300 mb-2">
                                You need to be logged in to schedule an appointment. Please 
                                <a href="login.php" class="text-primary-500 hover:text-primary-400">login</a> or 
                                <a href="register.php" class="text-primary-500 hover:text-primary-400">register</a> first.
                            </p>
                        </div>
                        <?php endif; ?>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-4 rounded-lg transition">
                                <?php echo $isEdit ? 'Update Appointment' : 'Schedule Appointment'; ?>
                            </button>
                            
                            <?php if($isEdit): ?>
                            <a href="dashboard.php" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-4 rounded-lg transition text-center">
                                Cancel
                            </a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Preparation Tips -->
<section class="py-16 bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-2">Pre-Donation Tips</h2>
            <p class="text-gray-400">Follow these guidelines to ensure a smooth donation experience</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-900 p-6 rounded-lg">
                <div class="text-primary-500 text-3xl mb-4">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Eat Well</h3>
                <p class="text-gray-300">Have a healthy meal before your donation. Avoid fatty foods, but ensure you're not donating on an empty stomach.</p>
            </div>
            
            <div class="bg-gray-900 p-6 rounded-lg">
                <div class="text-primary-500 text-3xl mb-4">
                    <i class="fas fa-tint"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Stay Hydrated</h3>
                <p class="text-gray-300">Drink extra water and fluids in the days leading up to your donation, especially on the day of your appointment.</p>
            </div>
            
            <div class="bg-gray-900 p-6 rounded-lg">
                <div class="text-primary-500 text-3xl mb-4">
                    <i class="fas fa-id-card"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Bring ID</h3>
                <p class="text-gray-300">Bring a valid photo ID and your donor card if you have one. First-time donors may need additional identification.</p>
            </div>
            
            <div class="bg-gray-900 p-6 rounded-lg">
                <div class="text-primary-500 text-3xl mb-4">
                    <i class="fas fa-bed"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Get Rest</h3>
                <p class="text-gray-300">Have a good night's sleep before your donation. Being well-rested helps ensure a successful donation experience.</p>
            </div>
            
            <div class="bg-gray-900 p-6 rounded-lg">
                <div class="text-primary-500 text-3xl mb-4">
                    <i class="fas fa-pills"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Medication List</h3>
                <p class="text-gray-300">Bring a list of medications you're currently taking. Some medications may affect your eligibility to donate.</p>
            </div>
            
            <div class="bg-gray-900 p-6 rounded-lg">
                <div class="text-primary-500 text-3xl mb-4">
                    <i class="fas fa-tshirt"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Comfortable Clothing</h3>
                <p class="text-gray-300">Wear comfortable clothing with sleeves that can be rolled up above the elbow for easy access to your arm.</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-16 bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-2">Common Questions</h2>
            <p class="text-gray-400">Everything you need to know about the donation process</p>
        </div>
        
        <div class="max-w-3xl mx-auto space-y-4">
            <div class="bg-gray-800 rounded-lg p-6">
                <h3 class="text-lg font-bold text-white mb-2">How long does the donation process take?</h3>
                <p class="text-gray-300">The entire process takes about 1 hour, which includes registration, mini-physical, donation, and refreshments. The actual blood draw only takes about 8-10 minutes.</p>
            </div>
            
            <div class="bg-gray-800 rounded-lg p-6">
                <h3 class="text-lg font-bold text-white mb-2">Does donating blood hurt?</h3>
                <p class="text-gray-300">Most donors feel only a brief sting when the needle is inserted. The actual donation is relatively painless. Our staff is trained to make the experience as comfortable as possible.</p>
            </div>
            
            <div class="bg-gray-800 rounded-lg p-6">
                <h3 class="text-lg font-bold text-white mb-2">What if I need to reschedule my appointment?</h3>
                <p class="text-gray-300">You can reschedule or cancel your appointment through your dashboard or by calling the donation center directly. We appreciate at least 24 hours notice.</p>
            </div>
            
            <div class="bg-gray-800 rounded-lg p-6">
                <h3 class="text-lg font-bold text-white mb-2">Can I drive after donating blood?</h3>
                <p class="text-gray-300">Yes, most donors can drive after donating blood. However, we recommend taking it easy and waiting at least 10-15 minutes before leaving the donation center.</p>
            </div>
        </div>
    </div>
</section>

<!-- Eligibility Reminder -->
<section class="py-8 bg-primary-700">
    <div class="container mx-auto px-4 text-center">
        <h3 class="text-xl font-bold text-white mb-2">Donation Eligibility Reminder</h3>
        <p class="text-white opacity-90 max-w-3xl mx-auto">
            Most healthy adults can donate blood. You must be at least 17 years old, weigh at least 110 pounds, and be in good health.
            <a href="about.php#eligibility" class="underline">View full eligibility criteria</a>
        </p>
    </div>
</section>

<?php include_once "includes/footer.php"; ?> 