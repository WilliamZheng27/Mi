<?php header("Content-Type: application/xml; charset=utf-8");
$servername = "localhost";
$username = "root";
$password = "zhengyuxiao12345";
$database = "Mi_User_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_query($conn,'set names utf8');
$user = $_POST["users_id"];
$pwd = $_POST["users_pwd"];
$studentname = $_POST["users_name"];
//$studenttel = $_POST["modal-form-register-tel"];
//$temp = $_POST["modal-form-register-sex"];
//$temp2 = $_POST["modal-form-register-type"];
//echo $user;
//echo $pwd;
//echo $studentname;
//echo $studenttel;
//echo $temp;
}
//echo $studentsex;
//$user = "16337328";
//$pwd = "123456";
//echo $user;
//echo $pwd;
//Check if the user already exists
$sel = mysqli_select_db($conn,$database);
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
//		echo $row["username"];
//		echo $row["pwd"];
		if ($row["users_id"] == $user){
				echo "exist";
				exit;
		}
	}
}
$sel = mysqli_select_db($conn,$database);
$sql = "INSERT into users values ('$studentname','$user','$pwd')";
$result = $conn->query($sql);
if (mysqli_affected_rows($conn)>0) {
	$sel = mysqli_select_db($conn,$database);
	$sql = "CREATE TABLE user".$user.
	" ( tags_id varchar(256),
	    tags_userid varchar(20),
	    tags_gps_lat double,
	    tags_gps_lon double,
	    tags_story varchar(1024),
	    tags_picurl varchar(256),
	)";
	$result = $conn->query($sql);
	echo "success";
}
else{
	 echo "failed";
}
$conn->close();
