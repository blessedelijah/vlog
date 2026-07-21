<?php include "header.php" ?>
<section id="single_page_wrapper">
    <?php addComment(); ?>
    <?php  getSinglePost(); ?>
    <?php post_views(); ?>
    <form action="" method="post" id="comment">
        <h2>Add Comment to this post</h2><br>
        <textarea name="comment" cols="50" rows="10" id=""></textarea><br>
        <?php
            if(isset($_SESSION['username'])){
                echo '<button type="submit" name="commentbtn">Comment</button>';
            }else{
                echo '<h2>Login to comment</h2>';
            }
        ?>
       
    </form><br>
    <article>
        <?php getComment(); ?>
        <!-- <div>
            <p>Hello world! </p><br>
            <i>By Augustine</i>
        </div> -->
    </article>
</section>
<?php include "footer.php" ?>