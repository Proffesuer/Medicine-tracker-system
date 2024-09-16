<?php

require_once '../config.php';
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php?page=login&error=notloggedin');
    exit();
}

// The rest of your protected page code goes here
// Assuming you have fetched the user's name from the database
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    // Prepare and execute the SQL query to fetch the image field
    $stmt = $connection->prepare("SELECT image FROM user WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();

    // Close the statement
    $stmt->close();

    // Check if an image exists for the user
    if ($image) {
        $image_url = 'uploads/' . htmlspecialchars($image);
    } else {
        // Default image or placeholder if no image exists
        $image_url = 'https://i.imgur.com/hczKIze.jpg';
    }
} else {
    // Default image or placeholder if no user is logged in
    $image_url = 'https://i.imgur.com/hczKIze.jpg';
}

// Close the database connection

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");:root{--header-height: 3rem;--nav-width: 68px;--first-color: #4723D9;--first-color-light: #AFA5D9;--white-color: #F7F6FB;--body-font: 'Nunito', sans-serif;--normal-font-size: 1rem;--z-fixed: 100}*,::before,::after{box-sizing: border-box}body{position: relative;margin: var(--header-height) 0 0 0;padding: 0 1rem;font-family: var(--body-font);font-size: var(--normal-font-size);transition: .5s}a{text-decoration: none}.header{width: 100%;height: var(--header-height);position: fixed;top: 0;left: 0;display: flex;align-items: center;justify-content: space-between;padding: 0 1rem;background-color: var(--white-color);z-index: var(--z-fixed);transition: .5s}.header_toggle{color: var(--first-color);font-size: 1.5rem;cursor: pointer}.header_img{width: 35px;height: 35px;display: flex;justify-content: center;border-radius: 50%;overflow: hidden}.header_img img{width: 40px}.l-navbar{position: fixed;top: 0;left: -30%;width: var(--nav-width);height: 100vh;background-color: var(--first-color);padding: .5rem 1rem 0 0;transition: .5s;z-index: var(--z-fixed)}.nav{height: 100%;display: flex;flex-direction: column;justify-content: space-between;overflow: hidden}.nav_logo, .nav_link{display: grid;grid-template-columns: max-content max-content;align-items: center;column-gap: 1rem;padding: .5rem 0 .5rem 1.5rem}.nav_logo{margin-bottom: 2rem}.nav_logo-icon{font-size: 1.25rem;color: var(--white-color)}.nav_logo-name{color: var(--white-color);font-weight: 700}.nav_link{position: relative;color: var(--first-color-light);margin-bottom: 1.5rem;transition: .3s}.nav_link:hover{color: var(--white-color)}.nav_icon{font-size: 1.25rem}.show{left: 0}.body-pd{padding-left: calc(var(--nav-width) + 1rem)}.active{color: var(--white-color)}.active::before{content: '';position: absolute;left: 0;width: 2px;height: 32px;background-color: var(--white-color)}.height-100{height:100vh}@media screen and (min-width: 768px){body{margin: calc(var(--header-height) + 1rem) 0 0 0;padding-left: calc(var(--nav-width) + 2rem)}.header{height: calc(var(--header-height) + 1rem);padding: 0 2rem 0 calc(var(--nav-width) + 2rem)}.header_img{width: 40px;height: 40px}.header_img img{width: 45px}.l-navbar{left: 0;padding: 1rem 1rem 0 0}.show{width: calc(var(--nav-width) + 156px)}.body-pd{padding-left: calc(var(--nav-width) + 188px)}}
    </style>
    <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body id="body-pd1">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i>Welcome <?php echo htmlentities($_SESSION['username']);?></div>
        <div>Medical Tracker System</div>
        
        <div class="header_img">
        <img src="<?php echo htmlspecialchars($image_url); ?>" alt="User Image">
</div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">MTS ADMIN</span> </a>
                <div class="nav_list"> <a href="admin_dashboard.php" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 
                <a href="#" class="nav_link" onclick="loadContent('reminder.php')"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Reminders</span> </a> 
                <a href="#" class="nav_link" onclick="loadContent('prescription.php')"> <i class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Prescriptions</span> </a> 
                <a href="#" class="nav_link" onclick="loadContent('medicine.php')"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Medicine</span> </a>
                <a href="#" class="nav_link"  onclick="loadContent('users.php')"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span> </a> 
                 <a href="#" class="nav_link" onclick="loadContent('reviews.php')"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Reviews</span> </a> </div>
            </div> <a href="logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="content" id="content">
        <br><br><br>
        <h4>Main Dashboard</h4>
        <?php 
        // Queries and output
        $queries = [
            'reminder' => "SELECT COUNT(*) as reminder_count FROM reminder",
            'prescription' => "SELECT COUNT(*) as prescription_count FROM prescription",
            'medicine' => "SELECT COUNT(*) as medicine_count FROM medicine",
            'reviews' => "SELECT COUNT(*) as reviews_count FROM reviews",
            'user' => "SELECT COUNT(*) as user_count FROM user"
        ];

        $titles = [
            'reminder' => 'Reminders',
            'prescription' => 'Prescriptions',
            'medicine' => 'Medicines',
            'reviews' => 'Reviews',
            'user' => 'Users'
        ];

        $counter = 0; // To keep track of the number of cards in the current row
        echo "<div class='row'>"; // Start the first row

        foreach ($queries as $key => $query) {
            $result = mysqli_query($connection, $query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row[$key . '_count'];
                $title = $titles[$key];

                // Determine the card color based on the count value
                if ($count > 20) {
                    $colorClass = 'card-red';
                } elseif ($count > 10) {
                    $colorClass = 'card-green';
                } else {
                    $colorClass = 'card-blue';
                }

                echo "
                <div class='col-md-4 mb-4'>
                    <div class='card $colorClass'>
                        <div class='card-body'>
                            <h5 class='card-title'>$title</h5>
                            <p class='card-text'>Number of $title: $count</p>
                        </div>
                    </div>
                </div>";

                $counter++;

                // Start a new row after every 3 cards
                if ($counter % 3 == 0) {
                    echo "</div><div class='row'>"; // Close the current row and start a new one
                }
            } else {
                echo "
                <div class='col-md-4 mb-4'>
                    <div class='card card-red'>
                        <div class='card-body'>
                            <h5 class='card-title'>$title</h5>
                            <p class='card-text'>Error: " . mysqli_error($connection) . "</p>
                        </div>
                    </div>
                </div>";

                $counter++;

                // Start a new row after every 3 cards
                if ($counter % 3 == 0) {
                    echo "</div><div class='row'>"; // Close the current row and start a new one
                }
            }
        }

        // Close the last row if there are less than 3 cards
        if ($counter % 3 != 0) {
            echo "</div>";
        }

        // Close the database connection
        mysqli_close($connection);
        ?>
        </div>
    </div>

    </div>
    <!--Container Main end-->
  <script src="../plugins/script.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
   
   const showNavbar = (toggleId, navId, bodyId, headerId) =>{
   const toggle = document.getElementById(toggleId),
   nav = document.getElementById(navId),
   bodypd = document.getElementById(bodyId),
   headerpd = document.getElementById(headerId)
   
   // Validate that all variables exist
   if(toggle && nav && bodypd && headerpd){
   toggle.addEventListener('click', ()=>{
   // show navbar
   nav.classList.toggle('show')
   // change icon
   toggle.classList.toggle('bx-x')
   // add padding to body
   bodypd.classList.toggle('body-pd')
   // add padding to header
   headerpd.classList.toggle('body-pd')
   })
   }
   }
   
   showNavbar('header-toggle','nav-bar','body-pd','header')
   
   /*===== LINK ACTIVE =====*/
   const linkColor = document.querySelectorAll('.nav_link')
   
   function colorLink(){
   if(linkColor){
   linkColor.forEach(l=> l.classList.remove('active'))
   this.classList.add('active')
   }
   }
   linkColor.forEach(l=> l.addEventListener('click', colorLink))
   
    // Your code to run since DOM is loaded and ready
   });
</script>

<script>
    // Get today's date in YYYY-MM-DD format
    const today = new Date().toISOString().split('T')[0];

    // Set the min attribute of the date input to today
    document.getElementById('date').setAttribute('min', today);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>