<?php  
require_once 'models.php';
require_once 'dbConfig.php';

if (isset($_POST['registerUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$insertQuery = insertNewUser($pdo, $username, $password);

		if ($insertQuery) {
			header("Location: ../login.php");
		}
		else {
			header("Location: ../register.php");
		}
	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for registration!";

		header("Location: ../login.php");
	}

}

if (isset($_POST['loginUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$loginQuery = loginUser($pdo, $username, $password);
	
		if ($loginQuery) {
			header("Location: ../index.php");
		}
		else {
			header("Location: ../login.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for the login!";
		header("Location: ../login.php");
	}
 
}

if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}

if (isset($_POST['insertStudentBtn'])) {

	$query = insertStudent($pdo, $_POST['student_num'], $_POST['firstName'], 
		$_POST['lastName'], $_POST['dateOfBirth'], $_POST['section']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Insertion failed";
	}

}

if (isset($_POST['editStudentBtn'])) {
	$query = updateStudent($pdo, $_POST['firstName'], $_POST['lastName'], 
		$_POST['dateOfBirth'], $_POST['section'], $_GET['student_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Edit failed";;
	}

}

if (isset($_POST['deleteStudentBtn'])) {
	$query = deleteStudent($pdo, $_GET['student_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}

//added username
if (isset($_POST['insertNewSubjectBtn'])) {
	$query = insertSubject($pdo, $_POST['subjectName'], $_POST['instructor'],$_SESSION['username'], $_GET['student_id']);

	if ($query) {
		header("Location: ../viewsubjects.php?student_id=" .$_GET['student_id']);
	}
	else {
		echo "Insertion failed";
	}
}

if (isset($_POST['editSubjectBtn'])) {
	$query = updateSubject($pdo, $_POST['subjectName'], $_POST['instructor'], $_GET['subject_id']);

	if ($query) {
		header("Location: ../viewsubjects.php?student_id=" .$_GET['student_id']);
	}
	else {
		echo "Update failed";
	}

}

if (isset($_POST['deleteSubjectBtn'])) {
	$query = deleteSubject($pdo, $_GET['subject_id']);

	if ($query) {
		header("Location: ../viewsubjects.php?student_id=" .$_GET['student_id']);
	}
	else {
		echo "Deletion failed";
	}
}

?>