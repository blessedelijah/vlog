<?php include "function.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"  />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> -->
    <title>Sign Up || Vloggy</title>
</head>
<body>
<?php register() ?>

<!-- <span id="success_box" class="animate__animated animate__fadeInRight">Registration was successful</span> -->
<!-- <span id="error_box" class="animate__animated animate__fadeInRight">Registration was not successful</span> -->


    <section id="signIn_wrapper">
        <article id="inner-signIn">
        <article id="inner-signIn">
            <p>
                <a href="index.php">Go back to home</a>
            </p>
            <form action="" method="post" >
                <h2 id="welcome-back">Sign Up to Vloggy</h2>
                <div id="inputDiv">
                    <input type="text" name="username" required placeholder="Enter your preferred username">
                </div>
                <div id="inputDiv">
                    <input type="text" name="firstname" required placeholder="Enter your first name">
                </div>
                <div id="inputDiv">
                    <input type="text" name="lastname" required placeholder="Enter your last name">
                </div>
                <div id="inputDiv">
                    <input type="email" name="email" required placeholder="Enter your email address">
                </div>
                <div id="inputDiv">
                    <input type="password" name="password" required id="passwd" placeholder="Enter your password">
                </div>
                <div id="inputDiv">
                    <input type="password" name="confirmpassword" required id="conpasswd" placeholder="Enter your confirm password">
        
                </div>
                <div id="loginBtnDiv">
                    <button name="registerBtn" type="submit" id="loginBtn">Register</button>
                </div>
                

                <!-- <p id="account-yet">Don't have an account yet? <a href="register.php" id="signUptag">Sign Up</a></p> -->
            </form>
            <div id="signIn-logo">
                <h1>Vloggy</h1>
            </div>
        </article>
    </section>

    <script src="js/script.js"></script>
</body>
</html>