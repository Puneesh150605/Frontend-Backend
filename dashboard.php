<?php
include_once "includes/header.php";

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Get user role and ID
$user_id = $_SESSION["user_id"];
$role = $_SESSION["role"];

// Fetch user's donation history
$donations = [];
$sql = "SELECT * FROM blood_inventory WHERE donor_id = ? ORDER BY donation_date DESC";
if($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    if(mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)) {
            $donations[] = $row;
        }
    }
    mysqli_stmt_close($stmt);
}

// Fetch user's appointments
$appointments = [];
$sql = "SELECT a.*, c.name as center_name, c.address FROM appointments a 
        JOIN donation_centers c ON a.center_id = c.id 
        WHERE a.donor_id = ? ORDER BY a.appointment_date DESC";
if($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    if(mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }
    }
    mysqli_stmt_close($stmt);
}

// Fetch user's blood requests (if recipient)
$requests = [];
if($role == "recipient") {
    $sql = "SELECT * FROM donation_requests WHERE requester_id = ? ORDER BY request_date DESC";
    if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_assoc($result)) {
                $requests[] = $row;
            }
        }
        mysqli_stmt_close($stmt);
    }
}

// Fetch user information
$user_info = [];
$sql = "SELECT * FROM users WHERE id = ?";
if($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    if(mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) == 1) {
            $user_info = mysqli_fetch_assoc($result);
        }
    }
    mysqli_stmt_close($stmt);
}
?>

<!-- Hero Section -->
<section class="bg-gray-800 py-8">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white">Welcome, <?php echo htmlspecialchars($_SESSION["name"]); ?></h1>
                <p class="text-gray-400 mt-1">Manage your blood donation activities and appointments</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="appointment.php" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    Schedule New Donation
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Dashboard Content -->
<section class="py-12 bg-gray-900">
    <div class="container mx-auto px-4">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="bg-primary-600/20 p-3 rounded-full mr-4">
                        <i class="fas fa-tint text-primary-500 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Total Donations</p>
                        <h3 class="text-2xl font-bold text-white"><?php echo count($donations); ?></h3>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="bg-blue-600/20 p-3 rounded-full mr-4">
                        <i class="fas fa-calendar-check text-blue-500 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Upcoming Appointments</p>
                        <h3 class="text-2xl font-bold text-white">
                            <?php 
                                $upcoming = 0;
                                foreach($appointments as $appointment) {
                                    if($appointment['status'] == 'scheduled' && strtotime($appointment['appointment_date']) > time()) {
                                        $upcoming++;
                                    }
                                }
                                echo $upcoming;
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="bg-green-600/20 p-3 rounded-full mr-4">
                        <i class="fas fa-heartbeat text-green-500 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Lives Potentially Saved</p>
                        <h3 class="text-2xl font-bold text-white"><?php echo count($donations) * 3; ?></h3>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="bg-yellow-600/20 p-3 rounded-full mr-4">
                        <i class="fas fa-clock text-yellow-500 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Next Eligible Donation</p>
                        <h3 class="text-2xl font-bold text-white">
                            <?php 
                                $lastDonation = !empty($donations) ? $donations[0]['donation_date'] : null;
                                if($lastDonation) {
                                    $nextEligible = date('M d, Y', strtotime($lastDonation . ' + 56 days'));
                                    echo $nextEligible;
                                } else {
                                    echo "Now";
                                }
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabs -->
        <div class="bg-gray-800 rounded-lg overflow-hidden mb-8">
            <div class="border-b border-gray-700">
                <div class="flex flex-wrap -mb-px">
                    <button class="tab-btn active inline-block p-4 text-primary-500 border-b-2 border-primary-500 rounded-t-lg" onclick="openTab(event, 'appointments')">
                        Appointments
                    </button>
                    <button class="tab-btn inline-block p-4 text-gray-400 hover:text-gray-300 border-b-2 border-transparent rounded-t-lg" onclick="openTab(event, 'donation-history')">
                        Donation History
                    </button>
                    <?php if($role == "recipient"): ?>
                    <button class="tab-btn inline-block p-4 text-gray-400 hover:text-gray-300 border-b-2 border-transparent rounded-t-lg" onclick="openTab(event, 'blood-requests')">
                        Blood Requests
                    </button>
                    <?php endif; ?>
                    <button class="tab-btn inline-block p-4 text-gray-400 hover:text-gray-300 border-b-2 border-transparent rounded-t-lg" onclick="openTab(event, 'profile')">
                        My Profile
                    </button>
                </div>
            </div>
            
            <!-- Tab content -->
            <div class="p-6">
                <!-- Appointments Tab -->
                <div id="appointments" class="tab-content block">
                    <h3 class="text-xl font-bold text-white mb-4">Upcoming Appointments</h3>
                    
                    <?php if(empty($appointments)): ?>
                        <div class="bg-gray-700 rounded-lg p-4 text-center">
                            <p class="text-gray-300">You don't have any scheduled appointments.</p>
                            <a href="appointment.php" class="text-primary-500 hover:text-primary-400 mt-2 inline-block">Schedule a donation</a>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-700">
                                        <th class="px-4 py-3 text-left text-white">Date & Time</th>
                                        <th class="px-4 py-3 text-left text-white">Donation Center</th>
                                        <th class="px-4 py-3 text-left text-white">Status</th>
                                        <th class="px-4 py-3 text-right text-white">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700">
                                    <?php foreach($appointments as $appointment): ?>
                                        <?php if($appointment['status'] == 'scheduled' && strtotime($appointment['appointment_date']) > time()): ?>
                                            <tr>
                                                <td class="px-4 py-3 text-gray-300">
                                                    <?php echo date('M d, Y h:i A', strtotime($appointment['appointment_date'])); ?>
                                                </td>
                                                <td class="px-4 py-3 text-gray-300">
                                                    <?php echo $appointment['center_name']; ?><br>
                                                    <span class="text-gray-500 text-sm"><?php echo $appointment['address']; ?></span>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <span class="bg-green-900/50 text-green-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        Scheduled
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 text-right">
                                                    <a href="appointment.php?edit=<?php echo $appointment['id']; ?>" class="text-blue-500 hover:text-blue-400 mr-3">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="appointment.php?cancel=<?php echo $appointment['id']; ?>" class="text-red-500 hover:text-red-400">
                                                        <i class="fas fa-times-circle"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <h3 class="text-xl font-bold text-white mt-8 mb-4">Past Appointments</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-700">
                                        <th class="px-4 py-3 text-left text-white">Date & Time</th>
                                        <th class="px-4 py-3 text-left text-white">Donation Center</th>
                                        <th class="px-4 py-3 text-left text-white">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700">
                                    <?php 
                                    $pastFound = false;
                                    foreach($appointments as $appointment): 
                                        if($appointment['status'] != 'scheduled' || strtotime($appointment['appointment_date']) <= time()):
                                            $pastFound = true;
                                    ?>
                                        <tr>
                                            <td class="px-4 py-3 text-gray-300">
                                                <?php echo date('M d, Y h:i A', strtotime($appointment['appointment_date'])); ?>
                                            </td>
                                            <td class="px-4 py-3 text-gray-300">
                                                <?php echo $appointment['center_name']; ?>
                                            </td>
                                            <td class="px-4 py-3">
                                                <?php if($appointment['status'] == 'completed'): ?>
                                                    <span class="bg-blue-900/50 text-blue-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        Completed
                                                    </span>
                                                <?php elseif($appointment['status'] == 'cancelled'): ?>
                                                    <span class="bg-red-900/50 text-red-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        Cancelled
                                                    </span>
                                                <?php elseif($appointment['status'] == 'no-show'): ?>
                                                    <span class="bg-yellow-900/50 text-yellow-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        No-show
                                                    </span>
                                                <?php else: ?>
                                                    <span class="bg-gray-700 text-gray-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        <?php echo ucfirst($appointment['status']); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php 
                                        endif;
                                    endforeach; 
                                    
                                    if(!$pastFound):
                                    ?>
                                        <tr>
                                            <td colspan="3" class="px-4 py-3 text-center text-gray-500">No past appointments found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Donation History Tab -->
                <div id="donation-history" class="tab-content hidden">
                    <h3 class="text-xl font-bold text-white mb-4">Your Donation History</h3>
                    
                    <?php if(empty($donations)): ?>
                        <div class="bg-gray-700 rounded-lg p-4 text-center">
                            <p class="text-gray-300">You haven't made any donations yet.</p>
                            <a href="appointment.php" class="text-primary-500 hover:text-primary-400 mt-2 inline-block">Schedule your first donation</a>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-700">
                                        <th class="px-4 py-3 text-left text-white">Donation Date</th>
                                        <th class="px-4 py-3 text-left text-white">Blood Type</th>
                                        <th class="px-4 py-3 text-left text-white">Quantity (ml)</th>
                                        <th class="px-4 py-3 text-left text-white">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700">
                                    <?php foreach($donations as $donation): ?>
                                        <tr>
                                            <td class="px-4 py-3 text-gray-300">
                                                <?php echo date('M d, Y', strtotime($donation['donation_date'])); ?>
                                            </td>
                                            <td class="px-4 py-3 font-bold text-primary-500">
                                                <?php echo $donation['blood_type']; ?>
                                            </td>
                                            <td class="px-4 py-3 text-gray-300">
                                                <?php echo $donation['quantity_ml']; ?> ml
                                            </td>
                                            <td class="px-4 py-3">
                                                <?php if($donation['status'] == 'available'): ?>
                                                    <span class="bg-green-900/50 text-green-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        Available
                                                    </span>
                                                <?php elseif($donation['status'] == 'reserved'): ?>
                                                    <span class="bg-yellow-900/50 text-yellow-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        Reserved
                                                    </span>
                                                <?php else: ?>
                                                    <span class="bg-blue-900/50 text-blue-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        Used
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if($role == "recipient"): ?>
                <!-- Blood Requests Tab -->
                <div id="blood-requests" class="tab-content hidden">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-white">Your Blood Requests</h3>
                        <a href="request_blood.php" class="bg-primary-600 hover:bg-primary-700 text-white text-sm py-2 px-4 rounded transition">
                            New Request
                        </a>
                    </div>
                    
                    <?php if(empty($requests)): ?>
                        <div class="bg-gray-700 rounded-lg p-4 text-center">
                            <p class="text-gray-300">You haven't made any blood requests yet.</p>
                            <a href="request_blood.php" class="text-primary-500 hover:text-primary-400 mt-2 inline-block">Request blood</a>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-700">
                                        <th class="px-4 py-3 text-left text-white">Request Date</th>
                                        <th class="px-4 py-3 text-left text-white">Blood Type</th>
                                        <th class="px-4 py-3 text-left text-white">Quantity</th>
                                        <th class="px-4 py-3 text-left text-white">Urgency</th>
                                        <th class="px-4 py-3 text-left text-white">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700">
                                    <?php foreach($requests as $request): ?>
                                        <tr>
                                            <td class="px-4 py-3 text-gray-300">
                                                <?php echo date('M d, Y', strtotime($request['request_date'])); ?>
                                            </td>
                                            <td class="px-4 py-3 font-bold text-primary-500">
                                                <?php echo $request['blood_type']; ?>
                                            </td>
                                            <td class="px-4 py-3 text-gray-300">
                                                <?php echo $request['quantity_ml']; ?> ml
                                            </td>
                                            <td class="px-4 py-3">
                                                <?php if($request['urgency'] == 'critical'): ?>
                                                    <span class="bg-red-900/50 text-red-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        Critical
                                                    </span>
                                                <?php elseif($request['urgency'] == 'high'): ?>
                                                    <span class="bg-orange-900/50 text-orange-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        High
                                                    </span>
                                                <?php elseif($request['urgency'] == 'medium'): ?>
                                                    <span class="bg-yellow-900/50 text-yellow-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        Medium
                                                    </span>
                                                <?php else: ?>
                                                    <span class="bg-blue-900/50 text-blue-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        Low
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-4 py-3">
                                                <?php if($request['status'] == 'pending'): ?>
                                                    <span class="bg-yellow-900/50 text-yellow-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        Pending
                                                    </span>
                                                <?php elseif($request['status'] == 'fulfilled'): ?>
                                                    <span class="bg-green-900/50 text-green-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        Fulfilled
                                                    </span>
                                                <?php else: ?>
                                                    <span class="bg-red-900/50 text-red-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                        Cancelled
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <!-- Profile Tab -->
                <div id="profile" class="tab-content hidden">
                    <h3 class="text-xl font-bold text-white mb-4">My Profile</h3>
                    
                    <div class="bg-gray-700 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-gray-400 text-sm mb-1">Full Name</p>
                                <p class="text-white"><?php echo htmlspecialchars($user_info['name']); ?></p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 text-sm mb-1">Email Address</p>
                                <p class="text-white"><?php echo htmlspecialchars($user_info['email']); ?></p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 text-sm mb-1">Phone Number</p>
                                <p class="text-white"><?php echo !empty($user_info['phone']) ? htmlspecialchars($user_info['phone']) : 'Not provided'; ?></p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 text-sm mb-1">Blood Type</p>
                                <p class="text-white font-bold text-primary-500"><?php echo !empty($user_info['blood_type']) ? htmlspecialchars($user_info['blood_type']) : 'Not specified'; ?></p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 text-sm mb-1">Last Donation Date</p>
                                <p class="text-white">
                                    <?php 
                                        echo !empty($user_info['last_donation_date']) ? date('M d, Y', strtotime($user_info['last_donation_date'])) : 'No donations yet'; 
                                    ?>
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 text-sm mb-1">Account Type</p>
                                <p class="text-white capitalize"><?php echo htmlspecialchars($user_info['role']); ?></p>
                            </div>
                            
                            <?php if(!empty($user_info['address'])): ?>
                            <div class="md:col-span-2">
                                <p class="text-gray-400 text-sm mb-1">Address</p>
                                <p class="text-white"><?php echo htmlspecialchars($user_info['address']); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mt-6 flex flex-col sm:flex-row gap-4">
                            <a href="profile.php" class="bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded transition">
                                Edit Profile
                            </a>
                            <a href="change_password.php" class="bg-gray-600 hover:bg-gray-500 text-white text-center py-2 px-4 rounded transition">
                                Change Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Eligibility Reminder -->
<section class="py-8 bg-primary-700">
    <div class="container mx-auto px-4 text-center">
        <h3 class="text-xl font-bold text-white mb-2">Donation Eligibility Reminder</h3>
        <p class="text-white opacity-90 max-w-3xl mx-auto">
            Most healthy adults can donate blood every 56 days. Ensure you're well-rested, hydrated, and have eaten before donation.
            <a href="about.php#eligibility" class="underline">View full eligibility criteria</a>
        </p>
    </div>
</section>

<!-- JavaScript for Tabs -->
<script>
    function openTab(evt, tabName) {
        // Hide all tab content
        const tabContents = document.getElementsByClassName("tab-content");
        for (let i = 0; i < tabContents.length; i++) {
            tabContents[i].classList.add("hidden");
            tabContents[i].classList.remove("block");
        }
        
        // Remove active class from all tab buttons
        const tabButtons = document.getElementsByClassName("tab-btn");
        for (let i = 0; i < tabButtons.length; i++) {
            tabButtons[i].classList.remove("active");
            tabButtons[i].classList.remove("text-primary-500");
            tabButtons[i].classList.remove("border-primary-500");
            tabButtons[i].classList.add("text-gray-400");
            tabButtons[i].classList.add("border-transparent");
        }
        
        // Show the selected tab content
        document.getElementById(tabName).classList.remove("hidden");
        document.getElementById(tabName).classList.add("block");
        
        // Add active class to the clicked button
        evt.currentTarget.classList.add("active");
        evt.currentTarget.classList.add("text-primary-500");
        evt.currentTarget.classList.add("border-primary-500");
        evt.currentTarget.classList.remove("text-gray-400");
        evt.currentTarget.classList.remove("border-transparent");
    }
</script>

<?php include_once "includes/footer.php"; ?> 