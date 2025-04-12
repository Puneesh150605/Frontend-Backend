<?php
include_once "includes/header.php";

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Define variables and initialize with empty values
$current_password = $new_password = $confirm_password = "";
$current_password_err = $new_password_err = $confirm_password_err = "";
$update_success = false;

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate current password
    if(empty(trim($_POST["current_password"]))) {
        $current_password_err = "Please enter your current password.";
    } else {
        $current_password = trim($_POST["current_password"]);
        
        // Verify current password
        $sql = "SELECT password FROM users WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $_SESSION["user_id"]);
            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)) {
                        if(!password_verify($current_password, $hashed_password)) {
                            $current_password_err = "The current password you entered is not correct.";
                        }
                    }
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate new password
    if(empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must have at least 6 characters.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";     
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before updating the database
    if(empty($current_password_err) && empty($new_password_err) && empty($confirm_password_err)) {
        
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["user_id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)) {
                // Password updated successfully
                $update_success = true;
                
                // Clear the form
                $current_password = $new_password = $confirm_password = "";
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
                <h1 class="text-3xl font-bold text-white">Change Password</h1>
                <p class="text-gray-400 mt-1">Update your account password for security</p>
            </div>
            <div>
                <a href="profile.php" class="bg-gray-700 hover:bg-gray-600 text-white py-2 px-4 rounded-lg transition flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Profile
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Password Form -->
<section class="py-12 bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <?php if($update_success): ?>
                <div class="bg-green-900/50 border border-green-800 text-white px-4 py-3 rounded-lg mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle mt-1"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium">Password Changed Successfully!</h3>
                            <p class="mt-2">Your password has been updated. Please use your new password for future logins.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="space-y-6">
                        <div>
                            <label for="current_password" class="block text-gray-300 mb-1">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="w-full bg-gray-700 text-white border <?php echo (!empty($current_password_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600">
                            <span class="text-red-500 text-sm"><?php echo $current_password_err; ?></span>
                        </div>
                        
                        <div>
                            <label for="new_password" class="block text-gray-300 mb-1">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="w-full bg-gray-700 text-white border <?php echo (!empty($new_password_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600">
                            <span class="text-red-500 text-sm"><?php echo $new_password_err; ?></span>
                            <p class="text-gray-500 text-sm mt-1">Password must be at least 6 characters long.</p>
                        </div>
                        
                        <div>
                            <label for="confirm_password" class="block text-gray-300 mb-1">Confirm New Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="w-full bg-gray-700 text-white border <?php echo (!empty($confirm_password_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600">
                            <span class="text-red-500 text-sm"><?php echo $confirm_password_err; ?></span>
                        </div>
                        
                        <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-4 rounded-lg transition">
                            Change Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Password Security Tips -->
<section class="py-12 bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-white mb-6">Password Security Tips</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-900 p-5 rounded-lg">
                    <div class="text-primary-500 text-2xl mb-3">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Use Strong Passwords</h3>
                    <p class="text-gray-300 text-sm">Create passwords with a mix of letters, numbers, and special characters. Aim for at least 12 characters when possible.</p>
                </div>
                
                <div class="bg-gray-900 p-5 rounded-lg">
                    <div class="text-primary-500 text-2xl mb-3">
                        <i class="fas fa-copy"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Avoid Reusing Passwords</h3>
                    <p class="text-gray-300 text-sm">Use different passwords for different accounts. This prevents all your accounts from being compromised if one password is leaked.</p>
                </div>
                
                <div class="bg-gray-900 p-5 rounded-lg">
                    <div class="text-primary-500 text-2xl mb-3">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Change Regularly</h3>
                    <p class="text-gray-300 text-sm">Update your passwords every 3-6 months for critical accounts, or immediately if you suspect a security breach.</p>
                </div>
                
                <div class="bg-gray-900 p-5 rounded-lg">
                    <div class="text-primary-500 text-2xl mb-3">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Use Two-Factor Authentication</h3>
                    <p class="text-gray-300 text-sm">When available, enable two-factor authentication for an extra layer of security beyond just your password.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once "includes/footer.php"; ?> 