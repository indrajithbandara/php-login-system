<?php 
session_start();
require 'db.php';

if (isset($_SESSION['user_id']) ) {
	$records = $conn->prepare('SELECT user_id,email,password FROM users WHERE user_id=:user_id');
	$records->bindParam(':user_id', $_SESSION['user_id'] );
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if(count($results) > 0) {
		$user = $results;
	}
}

define('TITLE', 'Welcome Page');
include 'includes/header.php';
?>
<div id="logform">
	<h1>Home</h1>

	<?php if(!empty($user) ) { ?>
		</br> Welcome, <?= $user['email']; ?>
		</br></br> You are successfully logged in!
		</br></br>
		<a href="logout.php">Log out</a>
		<?php } else { ?>

		<h2>Please Login or Register</h2>
		<a href="login.php">Login</a> or 
		<a href="register.php">Register</a>

		<?php } ?>
</div>

<?php include 'includes/footer.php'; ?>

