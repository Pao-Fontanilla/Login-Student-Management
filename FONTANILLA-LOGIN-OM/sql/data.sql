CREATE TABLE user_passwords (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(50),
	password VARCHAR(50),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE students (
student_id INT AUTO_INCREMENT PRIMARY KEY,
student_num VARCHAR(50),
first_name VARCHAR(50),
last_name VARCHAR(50),
date_of_birth VARCHAR(50),
section TEXT,
date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE subjects (
subject_id INT AUTO_INCREMENT PRIMARY KEY,
subject_name VARCHAR(50),
instructor VARCHAR(50),
student_id INT,
date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
added_by VARCHAR(50),
last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
