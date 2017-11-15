<?php 
session_start();
include 'includes/functions.php';
checkSession();

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['user_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm'])){
	$message = '';
	$result = createUser($_POST);
	if( $result === 1 ){
		Redirect('/login.php', false);
	} else {
		$message = 'Sorry there must have been an issue creating your account.';
	}
}

define('TITLE', 'Register');
include_once 'includes/header.php';
?>
<div id="logform">
	<h1>Register</h1>
	<span>Already a member? </span><a href="login.php">Login here</a>
	<?php if(isset($message)){ ?>
		<p><?= $message; ?></p>
	<?php } ?>
	<form action="register.php" method="POST">
		<input type="text" placeholder="First name" name="first_name" required>
		<input type="text" placeholder="Last name" name="last_name" required>
		<input type="text" placeholder="Username" name="user_name" required>
		<input id="reg-email" type="text" placeholder="Email" name="email" required>
		<input id="reg-password" type="password" placeholder="Password" name="password" required>
		<input id="conf-password" type="password" placeholder="Confirm password" name="confirm" required>
		<input id="submit" type="submit" value="Login">
	</form>
</div>

<?php include 'includes/footer.php'; ?>