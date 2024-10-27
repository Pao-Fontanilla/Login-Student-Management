<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getStudentByID = getStudentByID($pdo, $_GET['student_id']); ?>

	<h1>Edit the user!</h1>

	<form action="core/handleForms.php?student_id=<?php echo $_GET['student_id']; ?>" method="POST">
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="firstName" value="<?php echo $getStudentByID['first_name']; ?>">
		</p>
		<p>
			<label for="firstName">Last Name</label> 
			<input type="text" name="lastName" value="<?php echo $getStudentByID['last_name']; ?>">
		</p>
		<p>
			<label for="firstName">Date of Birth</label> 
			<input type="date" name="dateOfBirth" value="<?php echo $getStudentByID['date_of_birth']; ?>">
		</p>
		<p>
			<label for="firstName">Section</label> 
			<input type="text" name="section" value="<?php echo $getStudentByID['section']; ?>">
		</p>
		<input type="submit" name="editStudentBtn" value="submit">
	</form>

</body>
</html>