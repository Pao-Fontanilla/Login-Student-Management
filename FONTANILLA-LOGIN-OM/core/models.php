<?php  

require_once 'dbConfig.php';

function insertNewUser($pdo, $username, $password) {

	$checkUserSql = "SELECT * FROM user_passwords WHERE username = ?";
	$checkUserSqlStmt = $pdo->prepare($checkUserSql);
	$checkUserSqlStmt->execute([$username]);

	if ($checkUserSqlStmt->rowCount() == 0) {

		$sql = "INSERT INTO user_passwords (username,password) VALUES(?,?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$username, $password]);

		if ($executeQuery) {
			$_SESSION['message'] = "User successfully inserted";
			return true;
		}

		else {
			$_SESSION['message'] = "An error occured from the query";
		}

	}
	else {
		$_SESSION['message'] = "User already exists";
	}
}

function loginUser($pdo, $username, $password) {
	$sql = "SELECT * FROM user_passwords WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]); 

	if ($stmt->rowCount() == 1) {
		$userInfoRow = $stmt->fetch();
		$usernameFromDB = $userInfoRow['username']; 
		$passwordFromDB = $userInfoRow['password'];

		if ($password == $passwordFromDB) {
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login successful!";
			return true;
		}

		else {
			$_SESSION['message'] = "Password is invalid, but user exists";
		}
	}

	
	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesn't exist from the database. You may consider registration first";
	}

}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM user_passwords";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}

}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * FROM user_passwords WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

//added NOW() values
function insertStudent($pdo, $student_num, $first_name, $last_name, 
	$date_of_birth, $section) {

	$sql = "INSERT INTO students (student_num, first_name, last_name, 
		date_of_birth, section, date_added) VALUES(?,?,?,?,?, NOW())";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$student_num, $first_name, $last_name, 
		$date_of_birth, $section]);

	if ($executeQuery) {
		return true;
	}
}

function updateStudent($pdo, $first_name, $last_name, 
	$date_of_birth, $section, $student_id) {

	$sql = "UPDATE students
				SET first_name = ?,
					last_name = ?,
					date_of_birth = ?, 
					section = ?
				WHERE student_id = ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, 
		$date_of_birth, $section, $student_id]);
	
	if ($executeQuery) {
		return true;
	}

}

function deleteStudent($pdo, $student_id) {
	$deleteStudentSubj = "DELETE FROM subjects WHERE student_id = ?";
	$deleteStmt = $pdo->prepare($deleteStudentSubj);
	$executeDeleteQuery = $deleteStmt->execute([$student_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM students WHERE student_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$student_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}

function getAllStudents($pdo) {
	$sql = "SELECT * FROM students";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getStudentByID($pdo, $student_id) {
	$sql = "SELECT * FROM students WHERE student_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$student_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

//updated sql with added_by and last_updated
function getSubjectsByStudent($pdo, $student_id) {
	
	$sql = "SELECT 
				subjects.subject_id AS subject_id,
				subjects.subject_name AS subject_name,
				subjects.instructor AS instructor,
				subjects.date_added AS date_added,
				CONCAT(students.first_name,' ',students.last_name) AS student,
				subjects.added_by AS added_by,
				subjects.last_updated AS last_updated
			FROM subjects
			JOIN students ON subjects.student_id = students.student_id
			WHERE subjects.student_id = ?
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$student_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
	return [];
}

//updated sql and function
function insertSubject($pdo, $subject_name, $instructor, $added_by, $student_id) {
	$sql = "INSERT INTO subjects (subject_name, instructor, added_by, student_id, date_added, last_updated) 
			VALUES (?,?,?,?,NOW(), NOW())";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$subject_name, $instructor, $added_by, $student_id]);
	if ($executeQuery) {
		return true;
	}

}

function getSubjectByID($pdo, $subject_id) {
	$sql = "SELECT 
				subjects.subject_id AS subject_id,
				subjects.subject_name AS subject_name,
				subjects.instructor AS instructor,
				subjects.date_added AS date_added,
				CONCAT(students.first_name,' ',students.last_name) AS student
			FROM subjects
			JOIN students ON subjects.student_id = students.student_id
			WHERE subjects.subject_id  = ? 
			GROUP BY subjects.subject_name";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$subject_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}
//added NOW() in sql
function updateSubject($pdo, $subject_name, $instructor, $student_id) {
	$sql = "UPDATE subjects
			SET subject_name = ?,
				instructor = ?,
				last_updated = NOW()
			WHERE subject_id = ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$subject_name, $instructor, $student_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteSubject($pdo, $subject_id) {
	$sql = "DELETE FROM subjects WHERE subject_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$subject_id]);
	if ($executeQuery) {
		return true;
	}
}

?>