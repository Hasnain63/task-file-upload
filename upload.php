<?php
//This is just like a normal form submission
//You can access the uploaded files through $_FILES 
// if (isset($_FILES["file1"]))
// 	move_uploaded_file($_FILES["file1"]["tmp_name"], "picture1.jpg");

// // if(isset($_FILES["file2"]))
// // 	move_uploaded_file($_FILES["file2"]["tmp_name"], "picture2.jpg");

// //You can access other form element through $_POST
// echo "Thanks Files recieved successfully.";

include 'db.php';
if (isset($_FILES["file1"])) {
	$uploadfile = $_FILES["file1"]["tmp_name"];
	$name = $_FILES["file1"]["name"];
	$folderPath = "uploads/";

	if (!is_writable($folderPath) || !is_dir($folderPath)) {
		echo "error";
		exit();
	}
	if (move_uploaded_file($_FILES["file1"]["tmp_name"], $folderPath . $_FILES["file1"]["name"])) {

		$sql = "INSERT INTO tbl_file (file_name,file_path) VALUES ('$name','$folderPath')";

		if ($conn->query($sql) === TRUE) {
			echo "Thanks Files recieved successfully.";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}