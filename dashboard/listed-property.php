<?php include "header.php" ?>
<section id="listed_property_wrapper">
        <?php
            // Check if a delete message is set in the session
            if(isset($_SESSION['delete'])){
            // Retrieve the delete message from the session
            $delete_message = $_SESSION['delete'];
            // Display the delete message inside a div with id 'deletebox'
            echo '<div id="deletebox">'.$delete_message.'</div>';
            // Unset the delete message from the session to prevent it from showing again
            unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update'])){
                $update_msg = $_SESSION['update'];

                echo '<div id="successbox">'.$update_msg.'</div>';
                unset($_SESSION['update']);

            }
            
        ?>

    <form id="searchVlog" action="search_vlog.php" method="post">
        <input id="searchInput" type="text" name="search" placeholder="Search for Vlog" required><br>
        <button id="searchBtn" name="searchbtn" type="submit">Search Vlog</button>
    </form><br>

    <h1>My Vlogs</h1>
    <p>We are glad to see you again!</p>
    <article id="inner_listed_property_wrapper">
        <div id="inner_listed_property_scroll">
            <section id="listed_header_wrapper">
                <p class="title">Vlog Title</p>
                <p class="date">Date Published</p>
                <p class="status">Category</p>
                <p class="view">View</p>
                <p class="action">Action</p>
            </section>
            <?php AllAdminVlogs(); ?>
            <!-- <section id="listed_prop_container">
                <div class="title_con">
                    <article id="img_box">
                        <img src="img/house3.jpg" alt="">
                    </article>
                    <article id="writeup_con">
                        <p class="estate_name">Gorgeous Villa Bay View</p>
                        <p class="estate_address">1421 San Pedro St, Los Angeles, CA 900015</p>
                        <p class="estate_price">$13000/mo</p>
                    </article>
                </div>
                <div class="date_con">
                    <p>30 December, 2020</p>
                </div>
                <div class="status_con">
                    <p class="success">success</p>
                </div>
                <div class="view_con">
                    <p>12345</p>
                </div>
                <div class="action_con">
                    <a href="#"><p><i class="fa-regular fa-pen-to-square"></i></p></a>
                    <a href="#"><p><i class="fi fi-rs-trash"></i></p></a>
                </div>
            </section> -->
            <!-- <section id="listed_prop_container">
                <div class="title_con">
                    <article id="img_box">
                        <img src="img/house3.jpg" alt="">
                    </article>
                    <article id="writeup_con">
                        <p class="estate_name">Gorgeous Villa Bay View</p>
                        <p class="estate_address">1421 San Pedro St, Los Angeles, CA 900015</p>
                        <p class="estate_price">$13000/mo</p>
                    </article>
                </div>
                <div class="date_con">
                    <p>30 December, 2020</p>
                </div>
                <div class="status_con">
                    <p class="rejected">rejected</p>
                </div>
                <div class="view_con">
                    <p>12345</p>
                </div>
                <div class="action_con">
                    <a href="#"><p><i class="fa-regular fa-pen-to-square"></i></p></a>
                    <a href="#"><p><i class="fi fi-rs-trash"></i></p></a>
                </div>
            </section> -->
           
        </div>
    </article>
</section>

</main>
<?php include "footer.php" ?>