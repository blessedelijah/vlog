<?php
    // Start output buffering and session
    ob_start();
    session_start();   

    // Enable error reporting for debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Create a new MySQLi connection to the 'vlog' database
    $conn = new mysqli('localhost', 'root', '', 'vlog');

    // Check for connection errors
    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }else{
         // Uncomment below to confirm connection
         //echo "Database connected successfully";
    }
   

   
    // Function to handle user registration
    function register(){
        global $conn;

        if (!isset($_POST['registerBtn'])) {
            return;
        }

        // Sanitize inputs
        $username = htmlspecialchars($_POST['username']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $confirmpassword = htmlspecialchars($_POST['confirmpassword']);

        // Check password match
        if ($password !== $confirmpassword) {
            echo '
            <section id="loginSuccess-modal">
                <article id="box-con" class="animate__animated  animate__bounceInUp">
                    <div id="exitSucessIcon">x</div>
                    <div id="successIconBox">
                        <img id="chekmark" src="img/close.png" alt="">
                    </div>
                    <h2 id="passemail">Passwords does not match</h2>
                </article>
            </section>';
            return;
        }

        // Check password length
        if (strlen($password) < 5) {
            echo '
            <section id="loginSuccess-modal">
                <article id="box-con" class="animate__animated  animate__bounceInUp">
                    <div id="exitSucessIcon">x</div>
                    <div id="successIconBox">
                        <img id="chekmark" src="img/close.png" alt="">
                    </div>
                    <h2 id="passemail">Password is too short</h2>
                </article>
            </section>';
            return;
        }

        // Check email exists
        $checkemail = "SELECT * FROM signup WHERE `email` = '$email'";
        $Emailresult = $conn->query($checkemail);
        if (mysqli_num_rows($Emailresult) > 0) {
            echo '
            <section id="loginSuccess-modal">
                <article id="box-con" class="animate__animated  animate__bounceInUp">
                    <div id="exitSucessIcon">x</div>
                    <div id="successIconBox">
                        <img id="chekmark" src="img/close.png" alt="">
                    </div>
                    <h2 id="passemail">Email already exist</h2>
                </article>
            </section>';
            return;
        }

        // Check username exists
        $checkusername = "SELECT * FROM signup WHERE `username` = '$username'";
        $Usernameresult = $conn->query($checkusername);
        if (mysqli_num_rows($Usernameresult) > 0) {
            echo '
            <section id="loginSuccess-modal">
                <article id="box-con" class="animate__animated  animate__bounceInUp">
                    <div id="exitSucessIcon">x</div>
                    <div id="successIconBox">
                        <img id="chekmark" src="img/close.png" alt="">
                    </div>
                    <h2 id="passemail">Username already exist</h2>
                </article>
            </section>';
            return;
        }

        // Insert new user
        $sql = "INSERT INTO signup
            (`username`, `firstname`, `lastname`, `email`, `password`, `confirmpassword`,`user_role`)
            VALUES ('$username','$firstname','$lastname','$email','$password','$confirmpassword', 'subscriber')";
        $result = $conn->query($sql);

        if ($result) {
            echo '
            <section id="loginSuccess-modal">
                <article id="box-con" class="animate__animated  animate__bounceInUp">
                    <div id="exitSucessIcon">x</div>
                    <div id="successIconBox">
                        <img id="chekmark" src="img/checkmark-min.png" alt="">
                    </div>
                    <h2>Successful</h2>
                    <div id="dashbtn"><a href="login.php">Login</a></div>
                </article>
            </section>';
        } else {
            echo 'Registration Failed';
            die("Query failed" . mysqli_error($conn));
        }
    }

    function Login() {
        global $conn;

        // Only proceed if login button is pressed
        if (!isset($_POST['loginBtn'])) {
            return;
        }

        // Sanitize inputs
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        // Query for user with matching email and password
        $sql = "SELECT * FROM signup WHERE `email` = '$email' AND `password` = '$password'";
        $result = $conn->query($sql);

        // If one user found, log in
        if (mysqli_num_rows($result) === 1) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            // $_SESSION['role'] = $row['role'];
            // if($row['role'] === 'candidate'){
            //      header('Location: ./user/candidate.php');
            // } else {
            //     header('Location: ./employer/index.php');
            // }
            header('Location: ./dashboard/index.php');
            exit();
        }else{
                 // Login failed
            echo '<section id="loginSuccess-modal">
                <article id="box-con" class="animate__animated  animate__bounceInUp">
                    <div id="exitSucessIcon">x</div>
                    <div id="successIconBox">
                        <img id="chekmark" src="img/close.png" alt="">
                    </div>
                    <h2 id="passemail">Email or Password not correct</h2>
                </article>
            </section>';
        }

    }

    function AddVlog(){
        global $conn;

        // Only proceed if form is submitted
        if (!isset($_POST['submitvlogbtn'])) {
            return;
        }

        // Check for logged in user
        if (!isset($_SESSION['username'])) {
            echo '<h1>User not logged in</h1>';
            return;
        }
        $username = $_SESSION['username'];

        // Check if image is uploaded
        if (empty($_FILES['vlogimage']['name'])) {
            echo '<h1>Image is not selected, please select one before clicking on upload button</h1>';
            return;
        }

        // Sanitize and escape input
        $vlogtitle = mysqli_escape_string($conn, htmlspecialchars($_POST['vlogtitle']));
        $vlogdescription = mysqli_escape_string($conn, htmlspecialchars($_POST['vlogdescription']));
        $vlogcategory = mysqli_escape_string($conn, htmlspecialchars($_POST['vlogcategory']));

        // Image file details
        $file_name = $_FILES['vlogimage']['name'];
        $file_size = $_FILES['vlogimage']['size'];
        $file_tmp = $_FILES['vlogimage']['tmp_name'];
        $unique_string = uniqid();
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = ['png', 'jpg', 'jpeg'];

        // Validate file extension
        if (!in_array($file_ext, $allowed_extensions)) {
            echo '<h1>File Extension not allowed</h1>';
            return;
        }

        // Validate file size
        if ($file_size > 1000000) {
            echo '<h1>Image size should not be more than 1mb</h1>';
            return;
        }

        // Move uploaded file
        $target_dir = './img/' . $unique_string . "." . $file_ext;
        $vlogimg_url = $unique_string . "." . $file_ext;
        move_uploaded_file($file_tmp, $target_dir);

        // Insert vlog post
        $sql = "INSERT INTO vlogposts (`vlogtitle`, `vlogdescription`, `vlogcategory`, `vlogimage`, `username`)
                VALUES ('$vlogtitle','$vlogdescription','$vlogcategory','$vlogimg_url','$username')";
        $result = $conn->query($sql);

        if ($result) {
            echo '<section id="loginSuccess-modal">
                    <article id="box-con" class="animate__animated  animate__bounceInUp">
                        <div id="exitSucessIcon">x</div>
                        <div id="successIconBox">
                            <img id="chekmark" src="img/checkmark-min.png" alt="">
                        </div>
                        <h2>Upload Successful</h2>
                    </article>
                  </section>';
        } else {
            echo '<section id="loginSuccess-modal">
                    <article id="box-con" class="animate__animated  animate__bounceInUp">
                        <div id="exitSucessIcon">x</div>
                        <div id="successIconBox">
                            <img id="chekmark" src="img/close.png" alt="">
                        </div>
                        <h2>Upload Failed</h2>
                    </article>
                  </section>';
            die("Query failed" . mysqli_error($conn));
        }
    }

 // Function to fetch and display the latest 5 vlog posts
function GetAllPost(){
    // Access the global database connection
    global $conn;

    // SQL query to select the latest 5 vlog posts from the database, ordered by id in descending order
    $sql = "SELECT * FROM vlogposts order by id desc limit 5";
    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if($result == true){
        // Loop through each row in the result
        foreach($result as $row){
            // Assign the row data to variables for easier access
            $id = $row['id'];
            $vlogtitle = $row['vlogtitle'];
            $vlogdescription = $row['vlogdescription'];
            $vlogcategory = $row['vlogcategory'];
            $vlogimg = $row['vlogimage'];
            $username = $row['username'];
            $vlogdate = $row['vlogdate'];

            // Split the vlog description into an array of words using space as a separator
            // This is done to limit the description length later
            $vlogdescription = explode(' ', $vlogdescription);

            // Limit the description to the first 10 words, then rejoin the array into a string
            // This ensures the description is short and concise
            $vlogdescription = implode(' ', array_slice($vlogdescription, 0, 10));

            // Output the HTML structure for each post
            // This includes the post's image, category, date, and a truncated description with a "Continue Reading" button
            echo '';
            echo '<article id="blogPost">
                    <div id="blogImgBox" class="animate__animated"><img src="dashboard/img/'.$vlogimg.'" loading="lazy" alt=""></div>
                    <div id="blogWriteUps">
                        <ul>
                            <li> <span id="circle1"></span>'.$vlogcategory.'</li>
                            <li>'.$vlogdate.'</li>
                            <li>3 min read</li>
                        </ul>
                        <h2>
                            '.$vlogtitle.'
                        </h2>
                        <p>
                            '.$vlogdescription.'...
                        </p>
                        <a href="single_page.php?id='.$id.'"><button id="conti-read">Continue Reading</button></a>
                    </div>
                </article>';
        }
    }
}


    // function GetAllPost(){
    //     global $conn;
    
    //     // $per_page = 4;
    
    //     // if(isset($_GET['page'])){
    
    //     //     $page = $_GET['page'];
    
    //     // }else{
    //     //     $page = '';
    //     // }
    
    //     // if($page == '' || $page == 1){
    
    //     //     $pageStartLimit = 0;
    //     // }else{
    //     //     $pageStartLimit = ($page * $per_page) - $per_page;
    //     // }
    
    
    //     // $QueryPostCount = "SELECT * FROM vlogposts order by id";
    //     // $resultCount = $conn->query($QueryPostCount);
    //     // $AllPostCount = mysqli_num_rows($resultCount);
    
    
    //     // $num_pages = ceil($AllPostCount/$per_page);
    
    //     // $sql = "SELECT * FROM vlogposts order by id desc limit $pageStartLimit, $per_page";
    //     $sql = "SELECT * FROM vlogposts order by id desc limit 5";
    //     $result = $conn->query($sql);
    
    //     if($result == true){
    //         foreach($result as $row){
    //             $id = $row['id'];
    //             $vlogtitle = $row['vlogtitle'];
    //             $vlogdescription = $row['vlogdescription'];
    //             $vlogcategory = $row['vlogcategory'];
    //             $vlogimg = $row['vlogimage'];
    //             $username = $row['username'];
    //             $vlogdate = $row['vlogdate'];
    
    //             //Split The text into an array of words
    //             $vlogdescription = explode(' ', $vlogdescription );
    
    //             //Convert the array back to string again
    //             $vlogdescription = implode(' ', array_slice($vlogdescription, 0, 10));
    
    //             echo '<article id="blogPost">
    //             <div id="blogImgBox" class="animate__animated"><img src="dashboard/img/'.$vlogimg.'" loading="lazy" alt=""></div>
    //             <div id="blogWriteUps">
    //                 <ul>
    //                     <li> <span id="circle1"></span>'.$vlogcategory.'</li>
    //                     <li>'.$vlogdate.'</li>
    //                     <li>3 min read</li>
    //                 </ul>
    //                 <h2>
    //                     '.$vlogtitle.'
    //                 </h2>
    //                 <p>
    //                     '.$vlogdescription.'...
    //                 </p>
    //                 <a href="single_page.php?id='.$id.'"><button id="conti-read">Continue Reading</button></a>
    //             </div>
    //         </article>';
    //         }
    //     }
    
    //     // echo '<ul id="pagination_con">';
    
    //     // for($i = 1; $i <= $num_pages; $i++){
    
    //     //     echo '<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
         
    //     // }
    //     // echo'</ul>';
    //     // echo '<ul id="pagination_con">';
    
    //     // for($i = 1; $i <= $num_pages; $i++){
    
    //     //     if($i == $page){
    //     //         echo '
    //     //         <li class="page_active"><a href="index.php?page='.$i.'">'.$i.'</a></li>
    //     //     '; 
    //     //     }else{
    //     //         echo '
    //     //         <li><a href="index.php?page='.$i.'">'.$i.'</a></li>
    //     //     ';
    //     //     }
    //     // }
    
    //     // echo'</ul>';

    // }

    
    function getSinglePost(){
        global $conn; // Use the global database connection
    
        // Check if the 'id' parameter is set in the URL
        if(isset($_GET['id'])){
    
           $single_page_id = $_GET['id']; // Get the post ID from the URL
           
           // Query to fetch the post details based on the ID
           $sql = "SELECT * FROM vlogposts WHERE `id` = '$single_page_id'";
    
           $result = $conn->query($sql); // Execute the query
           if($result){
                // Loop through the result to fetch the post details
                foreach($result as $value){
                    
                    // Extract post details
                    $vlogtitle = $value['vlogtitle'];
                    $vlogdescription = $value['vlogdescription'];
                    $vlogcategory = $value['vlogcategory'];
                    $vlogimage = $value['vlogimage'];
                    $vlogdate = $value['vlogdate'];
    
                    // Output the post details in HTML format
                    echo '';
                    
                    echo '<article id="Cate_Date_Read">
                    <div id="singlePageCate">'.$vlogcategory.'</div>
                    <div id="singlePageDate">'.$vlogdate.'</div>
                    <div id="singlePageRead">3 min read</div>
                </article>
                <h1 id="single_headline">'.$vlogtitle.'</h1>
                <article id="singleImagBox">
                    <img src="dashboard/img/'.$vlogimage.'" alt="">
                </article>
                <p>'.$vlogdescription.'</p>';
    
                }
           }
        }
    }
    
    function post_views() {
        global $conn; // Use the global database connection
        
        // Check if the 'id' parameter is set in the URL
        if(isset($_GET['id'])){
            $postid =  $_GET['id']; // Get the post ID from the URL
    
            // Query to increment the view count for the post
            $sql = "UPDATE vlogposts SET `vlog_view` = `vlog_view` + 1 where `id` = '$postid'";
            $result = $conn->query($sql); // Execute the query
        }
    }

    function GetTrendingPost(){
        global $conn; // Use the global database connection
    
        // SQL query to fetch the top 5 trending posts based on the number of views
        $sql = "SELECT * FROM vlogposts order by vlog_view desc limit 5";
        $result = $conn->query($sql); // Execute the query
    
        $num = 1; // Initialize a counter for numbering the trending posts
    
        // Check if the query execution was successful
        if($result == true){
            // Loop through the result set to fetch each trending post
            foreach($result as $value){
                $id = $value['id']; // Get the post ID
                $vlogtitle = $value['vlogtitle']; // Get the post title
                $vlogimage = $value['vlogimage']; // Get the post image
                $vlogdate = $value['vlogdate']; // Get the post date
    
                // Output the HTML structure for displaying the trending post
                echo '<section id="featured-arti-sec">
                <div id="featured-arti-imgbox">
                    <p id="numbers">'.$num.'</p> <!-- Display the ranking number -->
                    <img src="dashboard/img/'.$vlogimage.'" alt=""> <!-- Display the post image -->
                </div>
                <div id="featured-arti-writeup">
                    <a href="single_page.php?id='.$id.'"><h2>'.$vlogtitle.'</h2></a> <!-- Link to the single post page -->
                    <p class="date-featured">'.$vlogdate.'</p> <!-- Display the post date -->
                </div>
            </section>';
    
                $num++; // Increment the counter for the next post
            }
        }
    }

function GetCategoryPost(){
    global $conn; // Use the global database connection

    // Check if the 'cat' parameter is set in the URL
    if(isset($_GET['cat'])){
        $categoryTitle = $_GET['cat']; // Get the category title from the URL
    }

    // Query to fetch vlog posts that belong to the specified category, ordered by ID in descending order
    $sql = "SELECT * FROM vlogposts WHERE `vlogcategory` = '$categoryTitle' order by id desc limit 6";
    $result = $conn->query($sql); // Execute the query

    // Check if the query execution was successful
    if($result == true){
        // Check if there are any posts in the specified category
        if(mysqli_num_rows($result) > 0){
            // Loop through each post in the result set
            foreach($result as $row){
                $id = $row['id']; // Get the post ID
                $vlogtitle = $row['vlogtitle']; // Get the post title
                $vlogdescription = $row['vlogdescription']; // Get the post description
                $vlogcategory = $row['vlogcategory']; // Get the post category
                $vlogimg = $row['vlogimage']; // Get the post image
                $vlogdate = $row['vlogdate']; // Get the post date
    
                // Split the vlog description into an array of words
                $vlogdescription = explode(' ', $vlogdescription);
    
                // Convert the array back to a string with only the first 10 words
                $vlogdescription = implode(' ', array_slice($vlogdescription, 0, 10));
    
                // Output the HTML structure for each post
                echo '';
                
                echo '<article id="blogPost">
                <div id="blogImgBox" class="animate__animated"><img src="dashboard/img/'.$vlogimg.'" alt=""></div>
                <div id="blogWriteUps">
                    <ul>
                        <li> <span id="circle1"></span>'.$vlogcategory.'</li>
                        <li>'.$vlogdate.'</li>
                        <li>3 min read</li>
                    </ul>
                    <h2>
                        '.$vlogtitle.'
                    </h2>                              
                    <p>
                        '.$vlogdescription.'...
                    </p>
                    <a href="single_page.php?id='.$id.'"><button id="conti-read">Continue Reading</button></a>
                </div>
            </article>';
            }
        } else {
            // If no posts are found in the specified category, display a message
            echo '<h1>No Post found in this Category.</h1>';
        }
    }else{
         die("Query failed" . mysqli_error($conn));
    }
}

function CheckProfileImage_FrontEnd(){
    global $conn;

    if(isset($_SESSION['username'])){

        $username = $_SESSION['username'];

        $sql = "SELECT * FROM signup WHERE `username` = '$username'";
         
        $result = $conn->query($sql);

        if($result){
            foreach($result as $value){
                $profileImage = $value['profileimage'];
                    
                if(empty($profileImage)){
                    echo '<a href="dashboard/index.php">
                        <div id="frontImgIcon">
                            <img src="dashboard/img/user.png" alt="profile-pix">
                        </div>
                    </a>';
                }else{
                    echo '<a href="dashboard/index.php">
                        <div id="frontImgIcon">
                            <img src="dashboard/img/'.$profileImage.'" alt="profile-pix">
                        </div>
                    </a>';
                }
            }
        }

    }
}

function CheckProfileImageDashHeader(){
    global $conn; // Use the global database connection

    // Check if the user is logged in by verifying the session variable
    if(isset($_SESSION['username'])){

        $username = $_SESSION['username']; // Get the logged-in username from the session

        // Query to fetch the user's profile image from the signup table
        $sql = "SELECT * FROM signup WHERE `username` = '$username'";
         
        $result = $conn->query($sql); // Execute the query

        // Check if the query execution was successful
        if($result){
            
            // Loop through the result to fetch the user's profile image
            foreach($result as $value){
                $profileImage = $value['profileimage']; // Get the profile image URL

                // Check if the profile image is empty
                if(empty($profileImage)){
                    // Display a default profile image if no image is set
                    echo '<img src="img/user.png" alt="profile-pix">';
                }else{
                    // Display the user's profile image
                    echo '<img src="img/'.$profileImage.'" alt="profile-pix">';
                }
            }
        }

    }
}

function CheckProfileImage2(){
    global $conn;

    if(isset($_SESSION['username'])){

        $username = $_SESSION['username'];

        $sql = "SELECT * FROM signup WHERE `username` = '$username'";
         
        $result = $conn->query($sql);

        if($result){
            
            foreach($result as $value){
                $profileImage = $value['profileimage'];

                if(empty($profileImage)){
                    echo '<a href="profile.php">
                        <div id="frontImgIcon">
                            <img src="dashboard/img/user.png" alt="profile-pix">
                        </div>
                    </a>';
                }else{
                    echo '<a href="dashboard/index.php">
                        <div id="frontImgIcon">
                            <img src="dashboard/img/'.$profileImage.'" alt="profile-pix">
                        </div>
                    </a>';
                }
            }
        }

    }
}

function AllAdminVlogs() {
    global $conn;

    if (!isset($_SESSION['username'])) {
        return;
    }

    $username = $_SESSION['username'];

    // Get user role
    $sql2 = "SELECT user_role FROM signup WHERE `username` = '$username'";
    $result2 = $conn->query($sql2);
    $user_role = '';
    if ($result2 && $result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
        $user_role = $row['user_role'];
    }

    // Build query based on role


    
    if ($user_role === 'admin') {
        $sql = "SELECT * FROM vlogposts ORDER BY id DESC LIMIT 8";
    } else {
        $sql = "SELECT * FROM vlogposts WHERE `username` = '$username' ORDER BY id DESC LIMIT 8";
    }

    $result = $conn->query($sql);

    if (!$result) {
        return;
    }

    foreach ($result as $row) {
        $id = $row['id'];
        $vlogtitle = $row['vlogtitle'];
        $vlogdescription = implode(' ', array_slice(explode(' ', $row['vlogdescription']), 0, 10));
        $vlogcategory = $row['vlogcategory'];
        $vlogimg = $row['vlogimage'];
        $vlogdate = $row['vlogdate'];
        $vlogViewCount = $row['vlog_view'];

        echo '<section id="listed_prop_container">
            <div class="title_con">
                <article id="img_box">
                    <img src="img/' . $vlogimg . '" alt="">
                </article>
                <article id="writeup_con">
                    <p class="estate_name">' . $vlogtitle . '</p>
                    <p class="estate_address">' . $vlogdescription . '....</p>
                </article>
            </div>
            <div class="date_con">
                <p>' . $vlogdate . '</p>
            </div>
        
            <div class="status_con">
                <p>' . $vlogcategory . '</p>
            </div>
            <div class="view_con">
                <p>' . $vlogViewCount . '</p>
            </div>
            <div class="action_con">
                <a href="edit.php?id=' . $id . '"><p><i class="fa-regular fa-pen-to-square"></i></p></a>
                <a href="delete.php?id=' . $id . '"><p><i class="fi fi-rs-trash"></i></p></a>
            </div>
        </section>';
    }
}

function getProfile(){
    global $conn; // Use the global database connection

    // Check if the user is logged in by verifying the session variable
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username']; // Get the logged-in username from the session

        // Query to fetch the user's profile details from the signup table
        $sql = "SELECT * FROM signup WHERE `username` = '$username'";
        $result = $conn->query($sql); // Execute the query

        // Check if the query execution was successful
        if($result == true){
            // Loop through the result to fetch the user's profile details
            foreach($result as $row){
                
                // Extract profile details
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $email = $row['email'];
                ?>
                <!-- Display the profile information form -->
                <article id="profile-info_container">
                    <form id="profile-info-block" method="post" enctype="multipart/form-data">
                        <h1>Profile Information</h1>
                        <div id="image_block">
                            <?php CheckProfileImage(); // Display the user's profile image ?>
                        </div>
                        <!-- Input field to upload a new profile image -->
                        <input type="file" style="display: none;" name="updateimg" id="chooseProfile">
                        <article id="personal_details1">
                            <div>
                                <label for="">First Name</label>
                                <!-- Display the user's first name -->
                                <input type="text" name="firstname" value="<?php echo $firstname; ?>">
                            </div>
                            <div>
                                <label for="">Last Name</label>
                                <!-- Display the user's last name -->
                                <input type="text" name="lastname" value="<?php echo $lastname; ?>">
                            </div>
                            <div>
                                <label for="">Email</label>
                                <!-- Display the user's email -->
                                <input type="text" name="email" value="<?php echo $email; ?>">
                            </div>
                        </article>
                        <!-- Button to submit the form and update the profile -->
                        <button type="submit" name="updateProfile" id="updateProfile">Update Profile</button>
                    </form>
                </article>

           <?php }
        }
    }
}

function CheckProfileImage(){
    global $conn; // Use the global database connection

    // Check if the user is logged in by verifying the session variable
    if(isset($_SESSION['username'])){

        $username = $_SESSION['username']; // Get the logged-in username from the session

        // Query to fetch the user's profile image from the signup table
        $sql = "SELECT * FROM signup WHERE `username` = '$username'";
         
        $result = $conn->query($sql); // Execute the query

        // Check if the query execution was successful
        if($result){
            
            // Loop through the result to fetch the user's profile image
            foreach($result as $value){
                $profileImage = $value['profileimage']; // Get the profile image URL

                // Check if the profile image is empty
                if(empty($profileImage)){
                    // Display a default profile image if no image is set
                    echo '<img src="img/user.png" alt="profile-pix" id="profile-pix">';
                }else{
                    // Display the user's profile image
                    echo '<img src="img/'.$profileImage.'" alt="profile-pix" id="profile-pix">';
                }
            }
        }

    }
}


function UpdateProfile()
{
    global $conn;

    // Ensure the form is submitted and the user is logged in
    if (!isset($_POST['updateProfile'], $_SESSION['username'])) {
        return;
    }

    $username  = $_SESSION['username'];
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname  = htmlspecialchars($_POST['lastname']);
    $email     = htmlspecialchars($_POST['email']);

    // Check if an image file is uploaded
    if (!empty($_FILES['updateimg']['name'])) {
        $fileName   = $_FILES['updateimg']['name'];
        $fileSize   = $_FILES['updateimg']['size'];
        $fileTmp    = $_FILES['updateimg']['tmp_name'];
        $uniqueName = uniqid();

        // Extract file extension
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExt = ['png', 'jpg', 'jpeg'];

        // Validate extension and size
        if (!in_array($fileExt, $allowedExt)) {
            echo 'Invalid file type. Only PNG, JPG, and JPEG are allowed.';
            return;
        }

        if ($fileSize > 1000000) {
            echo 'File size exceeds 1MB.';
            return;
        }

        // Set target path
        $profileImgUrl = $uniqueName . "." . $fileExt;
        $targetDir     = './img/' . $profileImgUrl;

        // Move uploaded file
        if (move_uploaded_file($fileTmp, $targetDir)) {
            
            $sql = "UPDATE signup 
                       SET firstname   = '$firstname',
                           lastname    = '$lastname',
                           profileimage = '$profileImgUrl',
                           email       = '$email'
                     WHERE username   = '$username'";
            $result = $conn->query($sql);

            if ($result) {
                $_SESSION['profile'] = 'Profile Updated Successfully';
                header('Location: profile.php');
                exit;
            }
        } else {
            echo 'Failed to upload file.';
            return;
        }

    } else {
        // Update without changing the image
        $sql = "UPDATE signup 
                   SET firstname = '$firstname',
                       lastname  = '$lastname',
                       email     = '$email'
                 WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result) {
            $_SESSION['profile'] = 'Profile Updated Successfully';
            header('Location: profile.php');
            exit;
        }
    }

    // Fallback error message
    echo 'Cannot Update Profile';
}




function postCount(){
    // Use global connection variable
    global $conn;
    
    // Check if the user is logged in
    if(isset($_SESSION['username'])){

        // Get the username from the session
        $username = $_SESSION['username'];

        // Query to get all posts by the logged-in user
        $QueryPostCount = "SELECT * FROM vlogposts WHERE `username` = '$username' ORDER BY id";
        $resultCount = $conn->query($QueryPostCount);

        // Count the number of posts returned by the query
        $AllPostCount = $resultCount->num_rows;

        // Output the total post count
        echo $AllPostCount;
    }
}





function ChangePassword() {
    global $conn;

    // Only proceed if form is submitted and user is logged in
    if (!isset($_POST['changePass'], $_SESSION['username'])) {
        return;
    }

    $username = $_SESSION['username'];
    $oldPass = htmlspecialchars($_POST['oldPass']);
    $newPass = htmlspecialchars($_POST['newPass']);
    $confirmNewPass = htmlspecialchars($_POST['confirmPass']);

    // Check if new password matches confirmation
    if ($newPass !== $confirmNewPass) {
        echo 'New Password does not match the confirm password';
        return;
    }

    // Check if old password is correct
    $sql = "SELECT id FROM signup WHERE `password` = '$oldPass' AND `username` = '$username'";
    $result = $conn->query($sql);

    if (!$result || $result->num_rows !== 1) {
        echo 'Old password is incorrect';
        return;
    }

    $row = $result->fetch_assoc();
    $id = $row['id'];

    // Update password
    $sql2 = "UPDATE signup SET `password` = '$newPass', `confirmpassword` = '$newPass' WHERE `id` = '$id'";
    $result2 = $conn->query($sql2);

    if ($result2) {
        echo 'Password Updated Successfully';
    } else {
        echo 'Failed to update password';
    }
}


function getVlogSearch(){
    global $conn;

    if(isset($_POST['searchbtn'])){

        $search = htmlspecialchars($_POST['search']);
        $search= $conn->real_escape_string($search);

        
        $sql = "SELECT * FROM vlogposts WHERE 
                vlogtitle LIKE '%$search%' OR  
                vlogcategory LIKE '%$search%' ORDER BY id DESC";

        $result = $conn->query($sql);

        // Check if the query was successful
        if($result == true && mysqli_num_rows($result) > 0){
            // Loop through each vlog post and display its details
            foreach($result as $row){
                $id = $row['id'];
                $vlogtitle = $row['vlogtitle'];
                $vlogdescription = $row['vlogdescription'];
                $vlogcategory = $row['vlogcategory'];
                $vlogimg = $row['vlogimage'];
                $vlogdate = $row['vlogdate'];
                $vlogViewCount = $row['vlog_view'];

                // Truncate the vlog description to the first 10 words
                $vlogdescription = explode(' ', $vlogdescription);
                $vlogdescription = implode(' ', array_slice($vlogdescription, 0, 10));

                // Output the HTML structure for the vlog post
                echo '<section id="listed_prop_container">
                <div class="title_con">
                    <article id="img_box">
                        <img src="img/'.$vlogimg.'" alt="">
                    </article>
                    <article id="writeup_con">
                        <p class="estate_name">'.$vlogtitle.'</p>
                        <p class="estate_address">'.$vlogdescription.'....</p>
                    </article>
                </div>
                <div class="date_con">
                    <p>'.$vlogdate.'</p>
                </div>
                <div class="status_con">
                    <p>'.$vlogcategory.'</p>
                </div>
                <div class="view_con">
                    <p>'.$vlogViewCount.'</p>
                </div>
                <div class="action_con">
                    <a href="edit.php?id='.$id.'"><p><i class="fa-regular fa-pen-to-square"></i></p></a>
                    <a href="delete.php?id='.$id.'"><p><i class="fi fi-rs-trash"></i></p></a>
                </div>
            </section>';
            }
        }else{
            echo '<h2>No Search Record Found</h2>';
        }
    }
}

function addComment(){
    global $conn;

    if(isset($_POST['commentbtn']) && isset($_GET['id']) && isset($_SESSION['username'])){

        $comment = htmlspecialchars($_POST['comment']);
        $postid = $_GET['id'];
        $username = $_SESSION['username'];

          $sql = "INSERT INTO comment_table
                (`username`, `post_id`, `comment`)
                VALUES ('$username','$postid',' $comment')";

                $result = $conn->query($sql);
                if(!$result){
                    echo 'error occurred while adding comment';
             }
    }


}

function getComment(){
    global $conn;

    if(isset($_GET['id'])){

        $postid = $_GET['id'];

        $sql = "SELECT * FROM comment_table WHERE `post_id` = '$postid' ORDER BY id DESC";
        $result = $conn->query($sql);

        if($result == true && mysqli_num_rows($result) > 0){
            foreach($result as $row){
                $username = $row['username'];
                $comment = $row['comment'];
                $date = $row['created_date'];

                echo '<div class="comment-box">
                        <p class="comment-username">'.$username.'</p>
                        <p class="comment-text">'.$comment.'</p>
                        <p class="comment-date">'.$date.'</p>
                    </div><br>';
            }
        }else{
            echo '<h2>No Comments Yet</h2>';
        }
    }
}














?>
