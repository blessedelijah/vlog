<?php include "header.php";
    UpdateProfile();
    ChangePassword();

    if(isset($_SESSION['profile'])){
            $update_msg = $_SESSION['profile'];

            echo '<div id="success_box">'.$update_msg.'</div>';
            unset($_SESSION['profile']);

        }
?>

<section id="profile_container">
    <h1>My Profile</h1>
    <p>We are glad to see you again!</p>
    <?php getProfile(); ?>
    <!-- <article id="profile-info_container">
        <form id="profile-info-block">
            <h1>Profile Information</h1>
            <div id="image_block">
                <img src="img/user.png" alt="profile-pix">
            </div>
            <input type="file" id="chooseProfile">
            <article id="personal_details1">
                <div>
                    <label for="">First Name</label>
                    <input type="text" name="firstname">
                </div>
                <div>
                    <label for="">Last Name</label>
                    <input type="text" name="lastname">
                </div>
                <div>
                    <label for="">Email</label>
                    <input type="text" name="email">
                </div>
                <div>
                    <label for="">Phone Number 1</label>
                    <input type="text" name="phonenumber1">
                </div>
                <div>
                    <label for="">Phone Number 2</label>
                    <input type="text" name="phonenumber2">
                </div>
                <div>
                    <label for="">Company Name</label>
                    <input type="text" name="companyName">
                </div>
            </article>
            <article id="personal_details2">
                <div>
                    <label for="">Address</label>
                    <input type="text" name="address">
                </div>
                <div>
                    <label for="">About Me</label>
                    <textarea name="aboutme" id="" cols="30" rows="10"></textarea>
                </div>
            </article>
            <button type="submit" name="updateProfile" id="updateProfile">Update Profile</button>
        </form>
    </article> -->
    
    <article id="Change_Password_container">
        <h3>Change Password</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <div id="old_password">
                <label for="">Old Password</label>
                <input type="text" name="oldPass">
            </div>
            <article id="newPassword-container">
                <div id="new_password">
                    <label for="">New Password</label>
                    <input type="text" name="newPass">
                </div>
                <div id="ConfirmNew_password">
                    <label for="">Confirm New Password</label>
                    <input type="text" name="confirmPass">
                </div>
            </article>
            <button type="submit" id="changePasswordBtn" name="changePass">Change Password</button>
        </form>
    </article>
</section>
</main>
</div>
</body>
<?php include "footer.php" ?>