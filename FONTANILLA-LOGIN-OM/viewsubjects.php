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
	<h1>Add New Subject</h1>

	<form action="core/handleForms.php?student_id=<?php echo $_GET['student_id']; ?>" method="POST">
		<?php $getStudentByID = getStudentByID($pdo, $_GET['student_id']); ?>
		<h3>Student: <?php echo $getStudentByID['first_name']; ?></h3>
		<p>
			<label for="firstName">Subject Name</label> 
			<input type="text" name="subjectName">
		</p>
		<p>
			<label for="firstName">Instructor</label> 
			<input type="text" name="instructor">
		</p>
		<input type="submit" name="insertNewSubjectBtn">
	</form>

	<div class="return">
		<a href="index.php">Return to Home</a>
	</div>

	<table style="width:100%; margin-top: 50px;">
		<tr>
			<th>Subject ID</th>
			<th>Subject Name</th>
			<th>Instructor</th>
			<th>Student</th>
			<th>Date Added</th>
			<th>Added by</th>
			<th>Last Updated</th>
			<th>Action</th>
		</tr>
		<?php $getSubjectsByStudent = getSubjectsByStudent($pdo, $_GET['student_id']); ?>
		<?php foreach ($getSubjectsByStudent as $row) { ?>
			<tr>
				<td><?php echo $row['subject_id']; ?></td>	  	
				<td><?php echo $row['subject_name']; ?></td>	  	
				<td><?php echo $row['instructor']; ?></td>	  	
				<td><?php echo $row['student']; ?></td>	  	
				<td><?php echo $row['date_added']; ?></td>
				<td><?php echo $row['added_by']; ?></td>
				<td><?php echo $row['last_updated']; ?></td>
				<td>
					<a href="editsubject.php?subject_id=<?php echo $row['subject_id']; ?>&student_id=<?php 
						echo $_GET['student_id']; ?>">Edit</a>

					<a href="deletesubject.php?subject_id=<?php echo $row['subject_id']; ?>&student_id=<?php 
						echo $_GET['student_id']; ?>">Delete</a>
				</td>	  	
			</tr>
		<?php } ?>
	</table>

</body>
</html>