<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>
	<h1>Are you sure you want to delete this user?</h1>

	<?php $getStudentByID = getStudentByID($pdo, $_GET['student_id']); ?>

	<div class="container">
		<h2>Username: <?php echo $getStudentByID['student_num']; ?></h2>
		<h2>FirstName: <?php echo $getStudentByID['first_name']; ?></h2>
		<h2>LastName: <?php echo $getStudentByID['last_name']; ?></h2>
		<h2>Date Of Birth: <?php echo $getStudentByID['date_of_birth']; ?></h2>
		<h2>Section: <?php echo $getStudentByID['section']; ?></h2>
		<h2>Date Added: <?php echo $getStudentByID['date_added']; ?></h2>
	</div>

	<div>
		<form action="core/handleForms.php?student_id=<?php echo $_GET['student_id']; ?>" method="POST">
			<input type="submit" name="deleteStudentBtn" value="Delete">
		</form>			
	</div>	

</body>
</html>