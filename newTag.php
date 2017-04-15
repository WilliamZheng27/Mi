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
$user_id = $POST["User_id"];
$tag_id = $POST["Tag_id"];
$tag_userid = $POST["Tag_userid"];
$tag_gps_lat = $POST["Tag_gps_lat"];
$tag_gps_lon = $POST["Tag_gps_lon"];
$tag_story = $POST["Tag_story"];
$tag_picurl = $POST["Tag_picurl"];
$sql = "insert into user".$user_id." (
    ($tag_id,
    $tag_userid,
    $tag_gps_lat,
    $tag_gps_lon,
    $tag_story,
    $tag_picurl)";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    $database = "Mi_Tag_db";
    $sel = mysqli_select_db($conn, $database);
    $sql = "insert into tags (
        $tag_id,
        $tag_userid,
        $tag_gps_lat,
        $tag_gps_lon,
        $tag_story,
        $tag_picurl)";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
        echo "success";
    else
        echo "failed";
}
?>
