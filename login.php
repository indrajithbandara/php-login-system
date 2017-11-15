<?php 
session_start();

if(isset($_SESSION['user_id']) ) {
	header("Location: index.php");
}

define('TITLE', 'Login');
include 'includes/header.php';
include 'includes/functions.php';
require 'db.php';


if (isset($_POST['email']) && isset($_POST['password'])) {

	$records = $conn->prepare('SELECT user_id,email,password FROM users WHERE email=:email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){
		$_SESSION['user_id'] = $results['user_id'];
		Redirect('http://localhost/login_script/index.php', false);
	} else {
		$message = 'Sorry, email and password do not match. Please try again.';
	}

}


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