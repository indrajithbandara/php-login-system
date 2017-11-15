<?php 
session_start();
include 'includes/functions.php';
define('TITLE', 'Welcome Page');
include 'includes/header.php';
$user = getUser();
?>
<div id="logform">
	<h1>Home Page</h1>
	<?php if(!empty($user) ) { ?>
			</br> Welcome, <?php echo $user['first_name'] . ' ' . $user['last_name']; ?>
			</br></br> You are successfully logged in as <?= $user['user_name']; ?>!
			</br></br>
			<a href="logout.php">Log out</a>
	<?php } else { ?>
			<h2>Please Login or Register</h2>
			<a href="login.php">Login</a> or 
			<a href="register.php">Register</a>
	<?php } ?>
</div>

<?php include 'includes/footer.php'; ?>