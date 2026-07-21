<?php include "header.php" ?>
    <section id="main-aside-wrapper">
        <main>
            <?php GetCategoryPost(); ?>


        </main>
        <aside>
            <section id="featured-blog">
                <article id="inner_featured-blog">
                    <section id="featured-title-wrapper">
                        <h2 id="featured-title">Trending Articles</h2>
                    </section>
                    <?php GetTrendingPost(); ?>
                    <!-- <section id="featured-arti-sec">
                        <div id="featured-arti-imgbox">
                            <p id="numbers">1</p>
                            <img src="img/6.jpg" alt="">
                        </div>
                        <div id="featured-arti-writeup">
                            <h2>Building your audience with subscriber signups</h2>
                            <p class="date-featured">Sep 25, 2022</p>
                        </div>
                    </section>
                    <section id="featured-arti-sec">
                        <div id="featured-arti-imgbox">
                            <p id="numbers">2</p>
                            <img src="img/7.jpg" alt="">
                        </div>
                        <div id="featured-arti-writeup">
                            <h2>Building your audience with subscriber signups</h2>
                            <p class="date-featured">Sep 25, 2022</p>
                        </div>
                    </section>
                    <section id="featured-arti-sec">
                        <div id="featured-arti-imgbox">
                            <p id="numbers">3</p>
                            <img src="img/3.jpg" alt="">
                        </div>
                        <div id="featured-arti-writeup">
                            <h2>Building your audience with subscriber signups</h2>
                            <p class="date-featured">Sep 25, 2022</p>
                        </div>
                    </section> -->
                </article>
            </section>

            <section id="featured-blog">
                <article id="inner_featured-blog">
                    <section id="featured-title-wrapper">
                        <h2 id="featured-title">Follow Me</h2>
                    </section>
                    
                    <section id="social-handle-parent">

                            <article id="social-handle1">
                                <div id="SocialIconBox">
                                    <i class="fa-brands fa-facebook-f" id="icons"></i>
                                </div>
                                <div id="socialName">Facebook</div>
                            </article>

                            <article id="social-handle1">
                                <div id="SocialIconBox">
                                    <i class="fa-brands fa-instagram" id="icons"></i>
                                </div>
                                <div id="socialName">Instagram</div>
                            </article>

                            <article id="social-handle1">
                                <div id="SocialIconBox">
                                    <i class="fa-brands fa-x-twitter" id="icons"></i>
                                </div>
                                <div id="socialName">Twitter</div>
                            </article>

                            <article id="social-handle1">
                                <div id="SocialIconBox">
                                    <i class="fa-brands fa-linkedin-in" id="icons"></i>
                                </div>
                                <div id="socialName">Linkedin</div>
                            </article>

                        </section>
                </article>
            </section>

            <section id="featured-blog">
                <article id="inner_featured-blog">
                    <section id="featured-title-wrapper">
                        <h2 id="featured-title">Tag Cloud</h2>
                    </section>
                    <article id="tag-container">
                            <div><span class="color1"></span><p>Get Started</p></div>
                            <div><span class="color2"></span><p>Jokes</p></div>
                            <div><span class="color3"></span><p>Fashion</p></div>
                            <div><span class="color4"></span><p>Sign In</p></div>
                        </article>
                </article>
            </section>
        </aside>
    </section>
    
    <?php include "footer.php" ?>