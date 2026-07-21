<?php include "../function.php";

	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		exit;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="css/user-mediaquery.css">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-thin-rounded/css/uicons-thin-rounded.css'>
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Laila:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>dashboard</title>
</head>
<body>
<?php AddVlog(); ?>
<!-- <section id="loginSuccess-modal">
    <article id="box-con" class="animate__animated  animate__bounceInUp">
        <div id="exitSucessIcon">x</div>
        <div id="successIconBox">
            <img id="chekmark" src="img/close.png" alt="">
        </div>
        <h2>Upload Failed</h2>
    </article>
</section> -->
<div id="admin_wrapper" >
	<aside id="left_sidebar">
		<div id="dash_logo_con">
			<a href="../index.php"><span>Vloggy</span></a>
			<i class="fi fi-rr-menu-burger"></i>
			<!-- <i class="fi fi-rr-bars-sort"></i> -->
		</div>
		<ul>
			<a href="index.php"><li><i class="fi fi-rr-dashboard"></i><span>Dashboard</span></li></a>
			<a href="post-vlog.php"><li><i class="fi fi-rr-square-plus"></i><span>Post a New Vlog</span></li></a>
			<a href="listed-property.php"><li><i class="fi fi-rr-home-heart"></i><span>My Vlogs</span></li></a>
			<a href="profile.php"><li><i class="fi fi-br-user"></i><span>My Profile</span></li></a> 
			<a href="logout.php"><li><i class="fi fi-rr-sign-out-alt"></i><span>Logout</span></li></a>
		</ul>
	</aside>
    <main>
		<header>
			<div class="dark-mode-switch-con">
				<div class="circle-switch"></div>
			</div>
			<p>
				<span class="welcome">Hello, </span>
				<?php
					if(isset($_SESSION['username'])){
						echo $_SESSION['username'];
					}else{
						header('Location: ../index.php');
						exit;
					}
				?>
			 </p>
			<ul>
				<li>
					<i class="fi fi-rr-envelope"></i>
				</li>
				<li id="li-sec">
					<i class="fi fi-rr-bell"></i>
				</li>
				<li>
					<a href="profile.php"><?php CheckProfileImageDashHeader(); ?></a>
				</li>
			</ul>
		</header>