<?php include "header.php" ?>
<section id="add-prop-section-wrapper">
    <h1>Edit Vlog</h1>
    <p>We are glad to see you again!</p>
    <?php 
        // Check if 'id' is set in the GET request
        if(isset($_GET['id'])){
            $editId = $_GET['id'];
            
            // Fetch vlog post details from the database using the provided ID
            $sql = "SELECT * FROM vlogposts WHERE `id` = '$editId'";

            $result = $conn->query($sql);
            if($result){
                // Extract vlog details from the query result
                foreach($result as $value){
                    $vlogtitle = $value['vlogtitle'];
                    $vlogdescription = $value['vlogdescription'];
                    $vlogcategory = $value['vlogcategory'];
                    $vlogimage = $value['vlogimage'];
                    $vlogdate = $value['vlogdate'];
                }
            }
        }else{
            header('Location: listed-property.php');
        }
    ?>
    <form action="" method="post" id="add-prop-form" enctype="multipart/form-data">
        <h2>Vlogy Description</h2>
        <article id="prop-description">
            <div class="title">
                <label for="">Vlog Title</label>
                <!-- Pre-fill the vlog title -->
                <input type="text" value="<?php echo $vlogtitle ?>" name="editvlogtitle">
            </div>
            <div class="description">
                <label for="">Vlog Description</label>
                <!-- Pre-fill the vlog description -->
                <textarea name="editvlogdescription" id="" cols="30" rows="10"><?php echo $vlogdescription ?></textarea>
            </div>
        </article>
        <h2>Category</h2>
        <article id="prop-description">
            <div class="title">
                <label for="">Vlog Category</label>
                <!-- Pre-fill the vlog category and provide other options -->
                <select name="editvlogcategory" id="">
                    <option value="<?php echo $vlogcategory ?>">
                        <?php echo $vlogcategory ?>
                    </option>
                    <option value="news">News</option>
                    <option value="sports">Sports</option>
                    <option value="fashion">Fashion</option>
                    <option value="tech">Tech</option>                                                                               
                    <option value="lifestyle">Lifestyle</option>
                </select>
            </div>
        </article>

        <h2>Media</h2>
        <!-- File input for updating vlog image -->
        <input type="file" name="editvlogimage"><br><br>
        <div id="editimgCon">
            <!-- Display the current vlog image -->
            <img src="img/<?php echo $vlogimage ?>" alt="">
        </div>
        <!-- Submit button to update the vlog -->
        <button type="submit" name="editvlogbtn" id="add-prop-formBotton">Update Vlog</button>
    </form>
</section>

<?php 
    // Handle form submission for updating the vlog
    if (!isset($_POST['editvlogbtn']) || !isset($_GET['id'])) {
        exit;
    }

    $editId = $_GET['id'];
    $editvlogtitle = htmlspecialchars($_POST['editvlogtitle']);
    $editvlogdescription = htmlspecialchars($_POST['editvlogdescription']);
    $editvlogcategory = htmlspecialchars($_POST['editvlogcategory']);

    // Check if a new image was uploaded
    if (!empty($_FILES['editvlogimage']['name'])) {
        $file_name = $_FILES['editvlogimage']['name'];
        $file_size = $_FILES['editvlogimage']['size'];
        $file_tmp  = $_FILES['editvlogimage']['tmp_name'];

        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = ['png', 'jpg', 'jpeg'];

        if (!in_array($file_ext, $allowed_extensions)) {
            echo 'File extension is not allowed';
            exit;
        }

        if ($file_size > 1000000) {
            echo 'File size should not be more than 1MB';
            exit;
        }

        $unique_string = uniqid();
        $new_filename = $unique_string . "." . $file_ext;
        $target_dir = './img/' . $new_filename;

        move_uploaded_file($file_tmp, $target_dir);

        $sql = "UPDATE vlogposts SET vlogtitle = '$editvlogtitle', vlogdescription = '$editvlogdescription', vlogimage = '$new_filename', vlogcategory = '$editvlogcategory' WHERE id = '$editId'";
    } else {
        // Update without changing image
        $sql = "UPDATE vlogposts SET vlogtitle = '$editvlogtitle', vlogdescription = '$editvlogdescription', vlogcategory = '$editvlogcategory' WHERE id = '$editId'";
    }

    $result = $conn->query($sql);

    if ($result) {
        $_SESSION['update'] = 'Updated successfully';
        header('Location: listed-property.php');
        exit;
    }

    echo 'Cannot Update Vlog Post';
?>
</main>

<?php include "footer.php" ?>