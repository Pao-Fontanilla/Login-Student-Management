<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: red;"><?php echo $_SESSION['message']; ?> <?php echo $_SESSION['username']; ?> is currently the user</h1>
	<?php } unset($_SESSION['message']); ?>
	
	<h1>Welcome To Student Management System!</h1>
	<h1>Add new Students!</h1>

	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="firstName">Student Number</label> 
			<input type="text" name="student_num">
		</p>
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="firstName">
		</p>
		<p>
			<label for="firstName">Last Name</label> 
			<input type="text" name="lastName">
		</p>
		<p>
			<label for="firstName">Date of Birth</label> 
			<input type="date" name="dateOfBirth">
		</p>
		<p>
			<label for="firstName">Section</label> 
			<input type="text" name="section">
		</p>
		<input type="submit" name="insertStudentBtn">
	</form>

	<div class="container">
		<h3>Users List</h3>

		<?php $getAllUsers = getAllUsers($pdo); ?>
		<?php foreach ($getAllUsers as $row) { ?>
			<li>
				<a href="viewuser.php?user_id=<?php echo $row['user_id']; ?>"><?php echo $row['username']; ?></a>
			</li>
		<?php } ?><br>
		
		<?php if (isset($_SESSION['username'])) { ?>
			<div class="return">
				<a style="color: red;"href="core/handleForms.php?logoutAUser=1">Logout</a>
			</div>
		<?php } else { echo "<h1>No user logged in</h1>";}?>
		
	</div>

	<?php $getAllStudents = getAllStudents($pdo); ?>
	<?php foreach ($getAllStudents as $row) { ?>
		<div class="container">
			<h3>Student Number: <?php echo $row['student_num']; ?></h3>
			<h3>FirstName: <?php echo $row['first_name']; ?></h3>
			<h3>LastName: <?php echo $row['last_name']; ?></h3>
			<h3>Date Of Birth: <?php echo $row['date_of_birth']; ?></h3>
			<h3>Section: <?php echo $row['section']; ?></h3>
			<h3>Date Added: <?php echo $row['date_added']; ?></h3>


			<div class="editAndDelete">
				<a href="viewsubjects.php?student_id=<?php echo $row['student_id']; ?>">View Subjects</a>
				<a href="editstudent.php?student_id=<?php echo $row['student_id']; ?>">Edit</a>
				<a href="deletestudent.php?student_id=<?php echo $row['student_id']; ?>">Delete</a>
			</div>
		</div> 
	<?php } ?>
	
</body>
</html>