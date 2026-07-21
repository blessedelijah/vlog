	<?php include "header.php" ?>
	
		<section id="add-prop-holder">
			<p>Dashboard</p>
			<a href="post-vlog.php" id="add-prop-btn">Post A Vlog</a>
		</section>
		<section id="main_container">
			<div>
				<article>
					<p>My Vlogs</p>
					<!-- <p>28</p> -->
				</article>
				<article id="small-box1"><i class="fi fi-rr-home-heart"></i></article>
			</div>
			<div>
				<article>
					<p>Post A New Vlog</p>
					<!-- <p>28</p> -->
				</article>
				<article id="small-box2">
					<i class="fi fi-rs-shopping-bag-add"></i>
				</article>
			</div>
			<div>
				<article>
					<p>My Profile</p>
					<!-- <p>28</p> -->
				</article>
				<article id="small-box3">
					<i class="fi fi-rr-envelope-download"></i>
				</article>
			</div>
			<div>
				<article>
					<p>Total Vlogs</p>
					<p><?php postCount(); ?></p>
				</article>
				<article id="small-box4">
					<i class="fi fi-rr-heart"></i>
				</article>
			</div>
		</section>
		
		</main>
	</div>
</body>
<?php include "footer.php" ?>