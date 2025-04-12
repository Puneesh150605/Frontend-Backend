<?php
include_once "includes/header.php";

// Define variables and initialize with empty values
$name = $email = $password = $confirm_password = $blood_type = $phone = $address = "";
$name_err = $email_err = $password_err = $confirm_password_err = $blood_type_err = $phone_err = "";

// Blood type options
$blood_types = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];

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
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";     
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Validate blood type
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
    }
    
    // Get address if provided
    $address = !empty($_POST["address"]) ? trim($_POST["address"]) : NULL;
    
    // Get user role (default to donor if not specified)
    $role = !empty($_POST["role"]) && in_array($_POST["role"], ["donor", "recipient"]) 
            ? $_POST["role"] : "donor";
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($blood_type_err) && empty($phone_err)) {
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (name, email, password, blood_type, phone, address, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_name, $param_email, $param_password, $param_blood_type, $param_phone, $param_address, $param_role);
            
            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_blood_type = $blood_type;
            $param_phone = $phone;
            $param_address = $address;
            $param_role = $role;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: login.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-white">Create an Account</h2>
                <p class="text-gray-400 mt-1">Join the BloodLink community and start saving lives</p>
            </div>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-gray-300 mb-1">Password</label>
                        <input type="password" name="password" id="password" class="w-full bg-gray-700 text-white border <?php echo (!empty($password_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600">
                        <span class="text-red-500 text-sm"><?php echo $password_err; ?></span>
                    </div>
                    
                    <div>
                        <label for="confirm_password" class="block text-gray-300 mb-1">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="w-full bg-gray-700 text-white border <?php echo (!empty($confirm_password_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600">
                        <span class="text-red-500 text-sm"><?php echo $confirm_password_err; ?></span>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                
                <div>
                    <label class="block text-gray-300 mb-1">I am registering as</label>
                    <div class="flex space-x-4">
                        <div class="flex items-center">
                            <input type="radio" id="role_donor" name="role" value="donor" class="bg-gray-700 border-gray-600 text-primary-600 focus:ring-primary-600" checked>
                            <label for="role_donor" class="text-gray-300 ml-2">Donor</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="role_recipient" name="role" value="recipient" class="bg-gray-700 border-gray-600 text-primary-600 focus:ring-primary-600">
                            <label for="role_recipient" class="text-gray-300 ml-2">Recipient</label>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-start mt-4">
                    <input type="checkbox" id="terms" name="terms" class="bg-gray-700 border-gray-600 rounded text-primary-600 focus:ring-primary-600 mt-1" required>
                    <label for="terms" class="text-gray-300 ml-2">
                        I agree to the <a href="terms.php" class="text-primary-500 hover:text-primary-400">Terms of Service</a> and <a href="privacy_policy.php" class="text-primary-500 hover:text-primary-400">Privacy Policy</a>
                    </label>
                </div>
                
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-4 rounded-lg transition">
                    Register
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-gray-400">
                    Already have an account? 
                    <a href="login.php" class="text-primary-500 hover:text-primary-400">Login</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?> 