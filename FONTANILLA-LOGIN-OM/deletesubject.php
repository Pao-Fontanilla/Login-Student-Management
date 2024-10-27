<?php require_once 'core/dbConfig.php'; ?>
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
	<?php 
		$getSubjectByID = getSubjectByID($pdo, $_GET['subject_id']); 
	?>

	<h1>Are you sure you want to delete this subject?</h1>

	<div class="container">
		<h2>Subject Name: <?php echo $getSubjectByID['subject_name'] ?></h2>
		<h2>Instructor: <?php echo $getSubjectByID['instructor'] ?></h2>
		<h2>Subject Owner: <?php echo $getSubjectByID['student'] ?></h2>
		<h2>Date Added: <?php echo $getSubjectByID['date_added'] ?></h2>

	</div>

	<div>
		<form action="core/handleForms.php?subject_id=<?php echo $_GET['subject_id']; ?>&student_id=<?php echo $_GET['student_id']; ?>" method="POST">
			<input type="submit" name="deleteSubjectBtn" value="Delete">
		</form>				
	</div>	

	<div class="return">
		<a href="viewsubjects.php?student_id=<?php echo $_GET['student_id']; ?>">Return to Subjects</a>
	</div>

</body>
</html>