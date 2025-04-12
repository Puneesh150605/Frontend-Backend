<?php
include_once "includes/header.php";

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Define variables and initialize with user data
$user_id = $_SESSION["user_id"];
$name = $email = $blood_type = $phone = $address = "";
$name_err = $email_err = $blood_type_err = $phone_err = "";
$update_success = false;

// Blood type options
$blood_types = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];

// Get user data
$sql = "SELECT * FROM users WHERE id = ?";
if($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    if(mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $email = $row['email'];
            $blood_type = $row['blood_type'];
            $phone = $row['phone'];
            $address = $row['address'];
        }
    }
    mysqli_stmt_close($stmt);
}

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
        $email_err = "Please enter an email.";
    } else {
        // Check if email is already taken by another user
        $sql = "SELECT id FROM users WHERE email = ? AND id != ?";
        if($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "si", $param_email, $user_id);
            $param_email = trim($_POST["email"]);
            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate blood type (optional)
    if(!empty($_POST["blood_type"]) && !in_array($_POST["blood_type"], $blood_types)) {
        $blood_type_err = "Please select a valid blood type.";
    } else {
        $blood_type = !empty($_POST["blood_type"]) ? $_POST["blood_type"] : NULL;
    }
    
    // Validate phone (optional but must be valid if provided)
    if(!empty(trim($_POST["phone"]))) {
        // Simple validation - can be enhanced based on region
        if(!preg_match("/^[0-9]{10,15}$/", trim($_POST["phone"]))) {
            $phone_err = "Please enter a valid phone number.";
        } else {
            $phone = trim($_POST["phone"]);
        }
    } else {
        $phone = NULL;
    }
    
    // Address is optional
    $address = !empty($_POST["address"]) ? trim($_POST["address"]) : NULL;
    
    // Check input errors before updating in database
    if(empty($name_err) && empty($email_err) && empty($blood_type_err) && empty($phone_err)) {
        
        // Prepare an update statement
        $sql = "UPDATE users SET name = ?, email = ?, blood_type = ?, phone = ?, address = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssi", $param_name, $param_email, $param_blood_type, $param_phone, $param_address, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_blood_type = $blood_type;
            $param_phone = $phone;
            $param_address = $address;
            $param_id = $user_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)) {
                // Update session variables
                $_SESSION["name"] = $name;
                $_SESSION["email"] = $email;
                
                // Set success flag
                $update_success = true;
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<!-- Hero Section -->
<section class="bg-gray-800 py-8">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white">Edit Profile</h1>
                <p class="text-gray-400 mt-1">Update your personal information</p>
            </div>
            <div>
                <a href="dashboard.php" class="bg-gray-700 hover:bg-gray-600 text-white py-2 px-4 rounded-lg transition flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Profile Form -->
<section class="py-12 bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <?php if($update_success): ?>
                <div class="bg-green-900/50 border border-green-800 text-white px-4 py-3 rounded-lg mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle mt-1"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium">Profile Updated Successfully!</h3>
                            <p class="mt-2">Your profile information has been updated.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                                <label for="blood_type" class="block text-gray-300 mb-1">Blood Type (Optional)</label>
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
                                <label for="phone" class="block text-gray-300 mb-1">Phone Number (Optional)</label>
                                <input type="text" name="phone" id="phone" class="w-full bg-gray-700 text-white border <?php echo (!empty($phone_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600" value="<?php echo $phone; ?>">
                                <span class="text-red-500 text-sm"><?php echo $phone_err; ?></span>
                            </div>
                        </div>
                        
                        <div>
                            <label for="address" class="block text-gray-300 mb-1">Address (Optional)</label>
                            <textarea name="address" id="address" rows="3" class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600"><?php echo $address; ?></textarea>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-4 rounded-lg transition">
                                Update Profile
                            </button>
                            <a href="change_password.php" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-4 rounded-lg transition text-center">
                                Change Password
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Security Notice -->
<section class="py-8 bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto bg-gray-900 rounded-lg p-6">
            <h2 class="text-xl font-bold text-white mb-4">Security Notice</h2>
            <p class="text-gray-300 mb-4">Your personal information is protected and will only be used for the purposes of the blood donation system. We follow strict privacy and security guidelines to ensure your data remains confidential.</p>
            <div class="flex flex-col md:flex-row gap-4 mt-4">
                <a href="privacy_policy.php" class="text-primary-500 hover:text-primary-400 inline-flex items-center">
                    <i class="fas fa-shield-alt mr-2"></i>
                    Privacy Policy
                </a>
                <a href="terms.php" class="text-primary-500 hover:text-primary-400 inline-flex items-center">
                    <i class="fas fa-file-contract mr-2"></i>
                    Terms of Service
                </a>
                <a href="contact.php" class="text-primary-500 hover:text-primary-400 inline-flex items-center">
                    <i class="fas fa-headset mr-2"></i>
                    Contact Support
                </a>
            </div>
        </div>
    </div>
</section>

<?php include_once "includes/footer.php"; ?> 