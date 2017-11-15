<?php 
session_start();
include 'includes/functions.php';
checkSession();

if (isset($_POST['email']) && isset($_POST['password'])) {
	$message = '';
	$results = checkLogin();
	if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){
		$_SESSION['user_id'] = $results['user_id'];
		Redirect('index.php', false);
	} else {
		$message = 'Sorry, email and password do not match. Please try again.';
	}

}


define('TITLE', 'Login');
include 'includes/header.php';
?>
<div id="logform">
	<h1>Login</h1>
	<span>Not yet a member? </span><a href="register.php">Register here</a>

	<?php if(isset($message)){ ?>
		<p><?php echo $message; ?></p>
		<?php } ?>

	<form action="login.php" method="POST">
		
		<input type="text" placeholder="Email" name="email">
		<input type="password" placeholder="Password" name="password">

		<input type="submit" value="Login">

	</form>
</div>


<?php 
include 'includes/footer.php';
?>