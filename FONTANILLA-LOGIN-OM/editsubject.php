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
	<h1>Edit the Subject!</h1>
	<?php $getSubjectByID = getSubjectByID($pdo, $_GET['subject_id']); ?>
    
    <?php if ($getSubjectByID): ?>
		<form action="core/handleForms.php?subject_id=<?php echo $_GET['subject_id']; ?>
		&student_id=<?php echo $_GET['student_id']; ?>" method="POST">
			<p>
				<label for="firstName">Subject Name</label> 
				<input type="text" name="subjectName" 
				value="<?php echo $getSubjectByID['subject_name']; ?>">
			</p>
			<p>
				<label for="firstName">Instructor</label> 
				<input type="text" name="instructor" 
				value="<?php echo $getSubjectByID['instructor']; ?>">
			</p>
			<p>
				<input type="submit" name="editSubjectBtn" value="Update">
			</p>
		</form>
    <?php else: ?>
        <p>Subject not found!</p>
    <?php endif; ?>

	<div class="return">
		<a href="viewsubjects.php?student_id=<?php echo $_GET['student_id']; ?>">Return to Subjects</a>
	</div>
	
</body>
</html>