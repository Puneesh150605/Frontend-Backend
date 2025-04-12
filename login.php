<?php 
include_once "includes/header.php";

// Initialize variables
$email = $password = "";
$email_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if email is empty
    if(empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, name, email, password, role FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1) {                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $name, $email, $hashed_password, $role);
                    
                    if(mysqli_stmt_fetch($stmt)) {
                        if(password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["name"] = $name;
                            $_SESSION["role"] = $role;
                            
                            // Redirect user to appropriate page
                            if($role == "admin") {
                                header("location: admin/index.php");
                            } else {
                                header("location: dashboard.php");
                            }
                        } else {
                            // Password is not valid
                            $login_err = "Invalid email or password.";
                        }
                    }
                } else {
                    // Email doesn't exist
                    $login_err = "Invalid email or password.";
                }
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
    <div class="max-w-md mx-auto bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-white">Welcome Back</h2>
                <p class="text-gray-400 mt-1">Login to your BloodLink account</p>
            </div>
            
            <?php if(!empty($login_err)): ?>
                <div class="bg-red-900/50 border border-red-800 text-white px-4 py-3 rounded-lg mb-4">
                    <?php echo $login_err; ?>
                </div>
            <?php endif; ?>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="space-y-4">
                <div>
                    <label for="email" class="block text-gray-300 mb-1">Email</label>
                    <input type="email" name="email" id="email" class="w-full bg-gray-700 text-white border <?php echo (!empty($email_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600" value="<?php echo $email; ?>">
                    <span class="text-red-500 text-sm"><?php echo $email_err; ?></span>
                </div>
                
                <div>
                    <label for="password" class="block text-gray-300 mb-1">Password</label>
                    <input type="password" name="password" id="password" class="w-full bg-gray-700 text-white border <?php echo (!empty($password_err)) ? 'border-red-500' : 'border-gray-600'; ?> rounded-lg p-3 focus:outline-none focus:ring-1 focus:ring-primary-600">
                    <span class="text-red-500 text-sm"><?php echo $password_err; ?></span>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="bg-gray-700 border-gray-600 rounded text-primary-600 focus:ring-primary-600">
                        <label for="remember" class="text-gray-300 ml-2">Remember me</label>
                    </div>
                    <a href="forgot_password.php" class="text-primary-500 hover:text-primary-400 text-sm">Forgot Password?</a>
                </div>
                
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-4 rounded-lg transition">
                    Login
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-gray-400">
                    Don't have an account? 
                    <a href="register.php" class="text-primary-500 hover:text-primary-400">Register now</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?> 