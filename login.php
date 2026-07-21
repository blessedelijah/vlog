<?php include "function.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <title>Sign In || Vloggy</title>
</head>
<body>
<?php Login();?>
    <section id="loginFail-modal"></section>
    <section id="signIn_wrapper">
        <article id="inner-signIn">
            <p>
                <a href="index.php">Go back to home</a>
            </p>
            <form action="" method="post">
                <h2 id="welcome-back">Welcome back to Vloggy</h2>
                <div id="inputDiv">
                    <input type="email" name="email" placeholder="Enter your email address">
                </div>
                <div id="inputDiv">
                    <input type="password" name="password" id="passwd" placeholder="Enter your password">
                    <i class="fa-regular fa-eye"></i>
                    <i class="fa-regular fa-eye-slash"></i>
                </div>
                <div id="loginBtnDiv">
                    <button id="loginBtn" name="loginBtn">Login</button>
                </div>
                
                <p id="account-yet">Don't have an account yet? <a href="signup.php" id="signUptag">Sign Up</a></p>
            </form>
            <div id="signIn-logo">
                <h1>Vloggy</h1>
            </div>
        </article>
    </section>

    <script src="js/script.js"></script>
</body>
</html>