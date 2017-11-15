<?php 
session_start();

if(isset($_SESSION['user_id']) ) {
	Redirect('http://localhost/login_script/index.php', false);
}

define('TITLE', 'Register');
include_once 'includes/header.php';
include_once 'includes/functions.php';
require_once 'db.php';
$message = '';
$registered = false;


if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['user_name']) && isset($_POST['email']) && isset($_POST['password'])){
	$sql = "INSERT INTO users (first_name, last_name, user_name, email, password) VALUES (:fname, :lname, :uname, :email, :password)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':fname', $_POST['first_name']);
	$stmt->bindParam(':lname', $_POST['last_name']);
	$stmt->bindParam(':uname', $_POST['user_name']);
	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

	if( $stmt->execute() ){
		$message = 'Successfully created new user';
		Redirect('http://localhost/projects/login_script/login.php', false);
	} else {
		$message = 'Sorry there must have been an issue creating your account.';
	}

}


?>
<div id="logform">
	<h1>Register</h1>
	<span>Already a member? </span><a href="login.php">Login here</a>

	<?php if(isset($message)){ ?>
		<p><?php echo $message; ?></p>
		<?php } ?>
	<form action="register.php" method="POST">
		
		<input type="text" placeholder="First name" name="first_name">
		<input type="text" placeholder="Last name" name="last_name">
		<input type="text" placeholder="Username" name="user_name">
		<input id="reg-email" type="text" placeholder="Email" name="email">
		<input id="reg-password" type="password" placeholder="Password" name="password">
		<input id="conf-password" type="password" placeholder="Confirm password" name="confirm_password">

		<input id="submit" type="submit" value="Login" disabled>

	</form>
</div>


<?php 
include 'includes/footer.php';
?>